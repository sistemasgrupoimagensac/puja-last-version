<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Models\ProyectoClienteContacto;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoPagoEstado;
use App\Models\ProyectoPlanesActivos; // Importar el modelo de planes activos
use App\Notifications\SendCredentialsProjectNotification;
use App\Services\Proyectos\ServicioEstadoCliente;
use App\Services\Proyectos\ServicioVigenciaProyecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CreateProyectoCliente extends CreateRecord
{
    protected static string $resource = ProyectoClienteResource::class;
    protected $randomPassword;

    /**
     * Valida y prepara los datos antes de la creación.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->validateUserEmail($data['user_email']);

        $this->randomPassword = Str::random(10);
        $user = $this->createUser($data, $this->randomPassword);

        $data['user_id'] = $user->id;

        // Calcula y asigna fecha de fin de contrato y mensualidad si aplica
        $data = $this->calculateContractDetails($data);

        // Envía la notificación al correo principal
        $this->sendCredentialsNotification($user, $data['user_email'], $this->randomPassword);

        return $data;
    }

    /**
     * Procesos después de la creación del registro.
     */
    protected function afterCreate(): void
    {
        $proyectoCliente = $this->record;

        // Notifica a los contactos habilitados
        $this->notifyContacts($proyectoCliente);

        // Sube y guarda el contrato
        $this->handleContractUpload($proyectoCliente);

        // Genera cronograma de pagos
        $this->generatePaymentSchedule($proyectoCliente);

        // Guarda el plan activo
        $this->createActivePlan($proyectoCliente);

        // Actualiza vigencia y estado del cliente
        app(ServicioVigenciaProyecto::class)->actualizarVigencia();
        // app(ServicioEstadoCliente::class)->actualizarEstadoCliente($proyectoCliente);
    }

    /**
     * Valida el correo electrónico del usuario.
     */
    private function validateUserEmail(string $email): void
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
        }
    }

    /**
     * Crea un usuario asociado al cliente.
     */
    private function createUser(array $data, string $password): User
    {
        return User::create([
            'tipo_usuario_id' => 5,
            'not_pay' => 1,
            'nombres' => $data['razon_social'],
            'email' => $data['user_email'],
            'password' => Hash::make($password),
            'estado' => 1,
            'acepta_termino_condiciones' => 1,
            'acepta_confidencialidad' => 1,
            'tipo_documento_id' => 2,
            'numero_documento' => $data['ruc'],
            'celular' => $data['telefono_inmobiliaria'],
            'direccion' => $data['direccion_fiscal'],
        ]);
    }

    /**
     * Calcula fecha de fin y mensualidad.
     */
    private function calculateContractDetails(array $data): array
    {
        if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
            $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
            $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int)$data['periodo_plan'])->toDateString();
        }

        if (isset($data['pago_unico']) && !$data['pago_unico'] && isset($data['precio_plan'], $data['periodo_plan'])) {
            $data['mensualidad'] = $data['precio_plan'] / $data['periodo_plan'];
        } else {
            $data['mensualidad'] = null;
        }

        return $data;
    }

    /**
     * Envía las credenciales al correo del usuario.
     */
    private function sendCredentialsNotification(User $user, string $email, string $password): void
    {
        $user->notify(new SendCredentialsProjectNotification($email, $email, $password));
    }

    /**
     * Notifica a los contactos habilitados.
     */
    private function notifyContacts($proyectoCliente): void
    {
        $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $proyectoCliente->id)
            ->where('habilitado_correo', true)
            ->get();

        foreach ($contactos as $contacto) {
            $contacto->notify(new SendCredentialsProjectNotification($contacto->email, $proyectoCliente->user->email, $this->randomPassword));
        }
    }

    /**
     * Maneja la subida y almacenamiento del contrato.
     */
    private function handleContractUpload($proyectoCliente): void
    {
        if (request()->hasFile('contrato_url')) {
            $contrato = request()->file('contrato_url');
            $nombreRazonSocial = Str::slug($proyectoCliente->razon_social);
            $hash = Str::random(6);
            $nombreArchivo = "{$nombreRazonSocial}_{$hash}.pdf";

            $ruta = Storage::disk('wasabi')->putFileAs('proyectos/contratos', $contrato, $nombreArchivo);
            $proyectoCliente->update(['contrato_url' => $ruta]);
        }
    }

    /**
     * Genera el cronograma de pagos.
     */
    private function generatePaymentSchedule($proyectoCliente): void
    {
        $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;
        $fechaInicio = Carbon::parse($proyectoCliente->fecha_inicio_contrato);
    
        if ($proyectoCliente->pago_unico) {
            // Caso de pago único
            ProyectoCronogramaPago::create([
                'proyecto_cliente_id' => $proyectoCliente->id,
                'fecha_programada' => $fechaInicio,
                'monto' => $proyectoCliente->precio_plan,
                'estado_pago_id' => $estadoPendiente,
                'intentos' => 0,
            ]);
        } else {
            // Caso de pago fraccionado con el 50% inicial
            $primerPago = $proyectoCliente->precio_plan * 0.5; // 50% del total
            $montoRestante = $proyectoCliente->precio_plan * 0.5; // 50% restante
            $numeroPagosRestantes = $proyectoCliente->periodo_plan - 1;
    
            // Monto mensual para los pagos restantes
            $montoMensual = $numeroPagosRestantes > 0 ? $montoRestante / $numeroPagosRestantes : 0;
    
            // Primer pago al inicio del contrato
            ProyectoCronogramaPago::create([
                'proyecto_cliente_id' => $proyectoCliente->id,
                'fecha_programada' => $fechaInicio,
                'monto' => $primerPago,
                'estado_pago_id' => $estadoPendiente,
                'intentos' => 0,
            ]);
    
            // Pagos restantes divididos en los meses restantes
            for ($i = 1; $i < $proyectoCliente->periodo_plan; $i++) {
                ProyectoCronogramaPago::create([
                    'proyecto_cliente_id' => $proyectoCliente->id,
                    'fecha_programada' => $fechaInicio->copy()->addMonths($i),
                    'monto' => $montoMensual,
                    'estado_pago_id' => $estadoPendiente,
                    'intentos' => 0,
                ]);
            }
        }
    }
    
    /**
     * Crea un registro en la tabla de planes activos.
     */
    private function createActivePlan($proyectoCliente): void
    {
        // Asociar el plan según la duración seleccionada
        $plan = \App\Models\ProyectoPlanes::where('duracion_en_meses', $proyectoCliente->periodo_plan)->first();

        if (!$plan) {
            throw new \Exception('No se encontró un plan con la duración seleccionada.');
        }

        ProyectoPlanesActivos::create([
            'proyecto_cliente_id' => $proyectoCliente->id,
            'proyecto_planes_id' => $plan->id, // ID del plan encontrado
            'fecha_inicio' => $proyectoCliente->fecha_inicio_contrato,
            'fecha_fin' => $proyectoCliente->fecha_fin_contrato,
            'monto' => $proyectoCliente->precio_plan,
            'duracion' => $proyectoCliente->periodo_plan,
            'renovacion_automatica' => $proyectoCliente->renovacion ?? false,
            'estado' => 'activo',
        ]);
    }
}


// =======================================================================


// namespace App\Filament\Resources\ProyectoClienteResource\Pages;

// use App\Filament\Resources\ProyectoClienteResource;
// use Filament\Resources\Pages\CreateRecord;
// use App\Models\User;
// use App\Models\ProyectoClienteContacto;
// use App\Models\ProyectoCronogramaPago;
// use App\Models\ProyectoPagoEstado;
// use App\Notifications\SendCredentialsProjectNotification;
// use App\Services\Proyectos\ServicioEstadoCliente;
// use App\Services\Proyectos\ServicioVigenciaProyecto; // Importar el servicio
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\ValidationException;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;

// class CreateProyectoCliente extends CreateRecord
// {
//     protected static string $resource = ProyectoClienteResource::class;

//     protected $randomPassword;

//     protected function mutateFormDataBeforeCreate(array $data): array
//     {
//         $validator = Validator::make($data, [
//             'user_email' => 'required|email|unique:users,email',
//         ]);

//         if ($validator->fails()) {
//             throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
//         }

//         // Generar y almacenar la contraseña aleatoria
//         $this->randomPassword = Str::random(10);

//         $user = User::create([
//             'tipo_usuario_id' => 5,
//             'not_pay' => 1,
//             'nombres' => $data['razon_social'],
//             'email' => $data['user_email'],
//             'password' => Hash::make($this->randomPassword),
//             'estado' => 1,
//             'acepta_termino_condiciones' => 1,
//             'acepta_confidencialidad' => 1,
//             'tipo_documento_id' => 2,
//             'numero_documento' => $data['ruc'],
//             'celular' => $data['telefono_inmobiliaria'],
//             'direccion' => $data['direccion_fiscal'],
//         ]);

//         $data['user_id'] = $user->id;

//         // Calcular y asignar `fecha_fin_contrato` si se especifican `fecha_inicio_contrato` y `periodo_plan`
//         if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
//             $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
//             $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int) $data['periodo_plan'])->toDateString();
//         }

//         // Calcular la mensualidad solo si el pago es fraccionado
//         if (isset($data['pago_unico']) && !$data['pago_unico'] && isset($data['precio_plan'], $data['periodo_plan'])) {
//             $data['mensualidad'] = $data['precio_plan'] / $data['periodo_plan'];
//         } else {
//             $data['mensualidad'] = null; // No aplica para pago único
//         }

//         // Enviar notificación con las credenciales al correo del cliente principal
//         $user->notify(new SendCredentialsProjectNotification($data['user_email'], $data['user_email'], $this->randomPassword));

//         return $data;
//     }

//     protected function afterCreate(): void
//     {
//         $proyectoCliente = $this->record;

//         // Enviar notificación de credenciales a los contactos habilitados para correo
//         $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $proyectoCliente->id)
//             ->where('habilitado_correo', true)
//             ->get();

//         foreach ($contactos as $contacto) {
//             $contacto->notify(new SendCredentialsProjectNotification($contacto->email, $proyectoCliente->user->email, $this->randomPassword));
//         }

//         // Verifica si se subió un contrato y guarda en Wasabi
//         if (request()->hasFile('contrato_url')) {
//             $contrato = request()->file('contrato_url');
            
//             // Genera un nombre único usando la razón social y un hash de 6 caracteres
//             $nombreRazonSocial = Str::slug($proyectoCliente->razon_social);
//             $hash = Str::random(6);
//             $nombreArchivo = "{$nombreRazonSocial}_{$hash}.pdf";

//             // Guarda el archivo en Wasabi con el nombre único generado
//             $ruta = Storage::disk('wasabi')->putFileAs('proyectos/contratos', $contrato, $nombreArchivo);
            
//             // Guarda la URL del contrato en la base de datos
//             $proyectoCliente->update(['contrato_url' => $ruta]);
//         }

//         // Obtener el ID del estado 'pendiente' para asignarlo a los nuevos pagos
//         $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;

//         // Generar cronograma de pagos
//         $fechaInicio = Carbon::parse($proyectoCliente->fecha_inicio_contrato);

//         if ($proyectoCliente->pago_unico) {
//             // Crear un único pago para proyectos de pago único
//             ProyectoCronogramaPago::create([
//                 'proyecto_cliente_id' => $proyectoCliente->id,
//                 'fecha_programada' => $fechaInicio,
//                 'monto' => $proyectoCliente->precio_plan,
//                 'estado_pago_id' => $estadoPendiente,
//                 'intentos' => 0,
//             ]);
//         } else {
//             // Crear pagos fraccionados
//             $montoMensual = $proyectoCliente->precio_plan / $proyectoCliente->periodo_plan;

//             for ($i = 0; $i < $proyectoCliente->periodo_plan; $i++) {
//                 ProyectoCronogramaPago::create([
//                     'proyecto_cliente_id' => $proyectoCliente->id,
//                     'fecha_programada' => $fechaInicio->copy()->addMonths($i),
//                     'monto' => $montoMensual,
//                     'estado_pago_id' => $estadoPendiente,
//                     'intentos' => 0,
//                 ]);
//             }
//         }

//         // Ejecutar el servicio de vigencia
//         $servicioVigencia = app(ServicioVigenciaProyecto::class);
//         $servicioVigencia->actualizarVigencia();

//         app(ServicioEstadoCliente::class)->actualizarEstadoCliente($proyectoCliente);
//     }
// }