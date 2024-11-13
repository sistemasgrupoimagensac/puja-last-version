<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Models\ProyectoClienteContacto;
use App\Models\ProyectoCronogramaPago;
use App\Notifications\SendCredentialsProjectNotification;
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $validator = Validator::make($data, [
            'user_email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
        }

        // Generar y almacenar la contraseña aleatoria
        $this->randomPassword = Str::random(10);

        $user = User::create([
            'tipo_usuario_id' => 5,
            'not_pay' => 1,
            'nombres' => $data['razon_social'],
            'email' => $data['user_email'],
            'password' => Hash::make($this->randomPassword),
            'estado' => 1,
            'acepta_termino_condiciones' => 1,
            'acepta_confidencialidad' => 1,
            'tipo_documento_id' => 2,
            'numero_documento' => $data['ruc'],
            'celular' => $data['telefono_inmobiliaria'],
            'direccion' => $data['direccion_fiscal'],
        ]);

        $data['user_id'] = $user->id;

        // Calcular y asignar `fecha_fin_contrato` si se especifican `fecha_inicio_contrato` y `periodo_plan`
        if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
            $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
            $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int) $data['periodo_plan'])->toDateString();
        }

        // Calcular la mensualidad solo si el pago es fraccionado
        if (isset($data['pago_unico']) && !$data['pago_unico'] && isset($data['precio_plan'], $data['periodo_plan'])) {
            // Divide el precio del plan entre el periodo para calcular la mensualidad
            $data['mensualidad'] = $data['precio_plan'] / $data['periodo_plan'];
        } else {
            $data['mensualidad'] = null; // No aplica para pago único
        }

        // Enviar notificación con las credenciales al correo del cliente principal
        $user->notify(new SendCredentialsProjectNotification($data['user_email'], $data['user_email'], $this->randomPassword));

        return $data;
    }

    protected function afterCreate(): void
    {
        $proyectoCliente = $this->record;

        // Enviar notificación de credenciales a los contactos habilitados para correo
        $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $proyectoCliente->id)
            ->where('habilitado_correo', true)
            ->get();
    
            foreach ($contactos as $contacto) {
                $contacto->notify(new SendCredentialsProjectNotification($contacto->email, $proyectoCliente->user->email, $this->randomPassword));
            }

        // Verifica si se subió un contrato y guarda en Wasabi
        if (request()->hasFile('contrato_url')) {
            $contrato = request()->file('contrato_url');
            
            // Genera un nombre único usando la razón social y un hash de 6 caracteres
            $nombreRazonSocial = Str::slug($proyectoCliente->razon_social);
            $hash = Str::random(6);
            $nombreArchivo = "{$nombreRazonSocial}_{$hash}.pdf";

            // Guarda el archivo en Wasabi con el nombre único generado
            $ruta = Storage::disk('wasabi')->putFileAs('proyectos/contratos', $contrato, $nombreArchivo);
            
            // Guarda la URL del contrato en la base de datos
            $proyectoCliente->update(['contrato_url' => $ruta]);
        }

        // Generar cronograma de pagos si es un pago fraccionado
        if (!$proyectoCliente->pago_unico) {
            // Calcula el monto mensual de pago
            $monthlyPayment = $proyectoCliente->precio_plan / $proyectoCliente->periodo_plan;
            $startDate = Carbon::parse($proyectoCliente->fecha_inicio_contrato);

            for ($i = 0; $i < $proyectoCliente->periodo_plan; $i++) {
                ProyectoCronogramaPago::create([
                    'project_client_id' => $proyectoCliente->id,
                    'due_date' => $startDate->copy()->addMonths($i),
                    'amount' => $monthlyPayment,
                    'status' => 'pending',
                    'attempts' => 0,
                ]);
            }
        }
    }
}
