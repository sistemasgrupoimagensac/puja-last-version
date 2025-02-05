<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use App\Models\User;
use App\Models\PlanUser;
use App\Models\ProyectoPlanes;
use App\Models\ProyectoCliente;
use App\Models\ProyectoPagoEstado;
use App\Models\ProyectoPlanesActivos;
use App\Models\ProyectoPlanesEstados;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoClienteContacto;
use App\Notifications\SendCredentialsProjectNotification;
use App\Services\Proyectos\ServicioVigenciaProyecto;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CreateProyectoCliente extends CreateRecord
{
    protected static string $resource = ProyectoClienteResource::class;
    protected $randomPassword;

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
        // $this->createActivePlan($proyectoCliente);

        // Crear un plan user por el tema de la boleta
        $this->createPlanUser($proyectoCliente);

        // Actualiza vigencia
        app(ServicioVigenciaProyecto::class)->actualizarVigencia();
    }
    
    private function validateUserEmail(string $email): void
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
        }
    }
    
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
            'created_by' => Auth::id(),
        ]);
    }
    
    private function calculateContractDetails(array $data): array
    {
        if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
            $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
            $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int)$data['periodo_plan'])->toDateString();
        }

        return $data;
    }
    
    private function sendCredentialsNotification(User $user, string $email, string $password): void
    {
        $user->notify(new SendCredentialsProjectNotification($email, $email, $password));
    }
    
    private function notifyContacts($proyectoCliente): void
    {
        $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $proyectoCliente->id)
            ->where('habilitado_correo', true)
            ->get();

        foreach ($contactos as $contacto) {
            $contacto->notify(new SendCredentialsProjectNotification($contacto->email, $proyectoCliente->user->email, $this->randomPassword));
        }
    }

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
    
    private function generatePaymentSchedule($proyectoCliente): void
    {
        $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;

        $proyectoCliente_all = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
            ->where('proyecto_clientes.id', $proyectoCliente->id)
            ->select(
                'proyecto_clientes.id as id',
                'proyecto_clientes.al_dia as al_dia',
                'proyecto_clientes.razon_social as razon_social',
                'proyecto_planes_activos.id as plan_activo_id',
                'proyecto_planes_activos.monto as precio_plan',
                'proyecto_planes_activos.duracion as periodo_plan',
                'proyecto_planes_activos.pago_unico as pago_unico',
                'proyecto_planes_activos.pago_gratis as pago_gratis',
                'proyecto_planes_activos.pago_gratis as pago_gratis',
                'proyecto_planes_activos.fecha_fin as fecha_fin_contrato',
                'proyecto_planes_activos.numero_anuncios as numero_anuncios',
                'proyecto_planes_activos.fecha_inicio as fecha_inicio_contrato',
            )
        ->get();
        
        foreach ( $proyectoCliente_all as $proyectoCliente ) {
            
            $fechaInicio = Carbon::parse($proyectoCliente->fecha_inicio_contrato);

            if ($proyectoCliente->pago_unico) {

                $cronograma = ProyectoCronogramaPago::create([
                    'proyecto_cliente_id'     => $proyectoCliente->id,
                    'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                    'fecha_programada'        => $fechaInicio,
                    'monto'                   => $proyectoCliente->precio_plan,
                    'estado_pago_id'          => $estadoPendiente,
                    'intentos'                => 0,
                ]);

                if ( $proyectoCliente->pago_gratis === 1 ) {

                    ProyectoCliente::findOrFail($proyectoCliente->id)->update(['al_dia' => 1]);
                    ProyectoPlanesActivos::where('id', $proyectoCliente->plan_activo_id)->update(['pagado' => true, 'activo' => true]);
                    $cronograma->update(['estado_pago_id' => 2, 'fecha_ultimo_intento' => now()]); // pagado

                }

            } else {
                
                $primerPago = $proyectoCliente->precio_plan * 0.5;
                $montoRestante = $proyectoCliente->precio_plan * 0.5;
                $numeroPagosRestantes = $proyectoCliente->periodo_plan - 1;
        
                $montoMensual = $numeroPagosRestantes > 0 ? $montoRestante / $numeroPagosRestantes : 0;
        
                ProyectoCronogramaPago::create([
                    'proyecto_cliente_id'     => $proyectoCliente->id,
                    'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                    'fecha_programada'        => $fechaInicio,
                    'monto'                   => $primerPago,
                    'estado_pago_id'          => $estadoPendiente,
                    'intentos'                => 0,
                ]);
        
                for ( $i = 1; $i < $proyectoCliente->periodo_plan; $i++ ) {
                    ProyectoCronogramaPago::create([
                        'proyecto_cliente_id'     => $proyectoCliente->id,
                        'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                        'fecha_programada'        => $fechaInicio->copy()->addMonths($i),
                        'monto'                   => $montoMensual,
                        'estado_pago_id'          => $estadoPendiente,
                        'intentos'                => 0,
                    ]);
                }

            }
        }
    }

    private function createActivePlan($proyectoCliente): void
    {
        // Asociar el plan según la duración seleccionada
        $plan = ProyectoPlanes::where('duracion_en_meses', $proyectoCliente->periodo_plan)->first();

        if (!$plan) {
            throw new \Exception('No se encontró un plan con la duración seleccionada.');
        }

        $estadoPlanActivo = ProyectoPlanesEstados::where('nombre', 'activo')->first();

        ProyectoPlanesActivos::create([
            'proyecto_cliente_id' => $proyectoCliente->id,
            'proyecto_planes_id' => $plan->id,
            'estado_id' => $estadoPlanActivo->id,
            'fecha_inicio' => $proyectoCliente->fecha_inicio_contrato,
            'fecha_fin' => $proyectoCliente->fecha_fin_contrato,
            'monto' => $proyectoCliente->precio_plan,
            'duracion' => $proyectoCliente->periodo_plan,
            'renovacion_automatica' => $proyectoCliente->renovacion ?? false,
        ]);
    }

    private function createPlanUser($proyectoCliente): void
    {
        $userId = ProyectoCliente::where('id', $proyectoCliente->id)->first()->user_id;
        // Asegurarse de que la relación está cargada
        if (!$proyectoCliente->relationLoaded('proyectoPlanesActivos')) {
            $proyectoCliente->load('proyectoPlanesActivos');
        }
        foreach ($proyectoCliente->proyectoPlanesActivos as $plan) {
            PlanUser::create([
                'user_id' => $userId,
                'plan_id' => 1,
                'start_date' => $plan->fecha_inicio,
                'end_date' => $plan->fecha_fin,
                'estado' => 1,
                // 'typical_ads_remaining' => 0,
                // 'top_ads_remaining' => $top_ad,
                // 'premium_ads_remaining' => $premium_ad,
            ]);
        }
    }
}