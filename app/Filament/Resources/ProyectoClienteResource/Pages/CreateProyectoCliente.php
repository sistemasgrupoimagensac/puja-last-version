<?php

// namespace App\Filament\Resources\ProyectoClienteResource\Pages;

// use App\Filament\Resources\ProyectoClienteResource;
// use App\Models\ProyectoClienteContacto;
// use Filament\Resources\Pages\CreateRecord;
// use App\Models\User;
// use App\Notifications\SendCredentialsProjectNotification;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\ValidationException;
// use Illuminate\Support\Str;

// class CreateProyectoCliente extends CreateRecord
// {
//     protected static string $resource = ProyectoClienteResource::class;

//     protected function mutateFormDataBeforeCreate(array $data): array
//     {
//         // Validar que el correo electrónico no exista en la tabla `users`
//         $validator = Validator::make($data, [
//             'user_email' => 'required|email|unique:users,email', // Validar que sea único en `users`
//         ]);

//         if ($validator->fails()) {
//             throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
//         }

//         // Generar una contraseña aleatoria
//         $randomPassword = Str::random(10);

//         $user = User::create([
//             'tipo_usuario_id' => 5, // El tipo de usuario específico (cliente inmobiliario)
//             'not_pay' => 1, // Valor por defecto
//             'nombres' => $data['razon_social'], // Usar el nombre de la razón social del formulario
//             'email' => $data['user_email'], // Usar el email del formulario
//             'password' => Hash::make($randomPassword), // Hashear la contraseña generada
//             'estado' => 1, // Estado activado por defecto
//             'acepta_termino_condiciones' => 1, // Aceptación de términos por defecto
//             'acepta_confidencialidad' => 1, // Aceptación de confidencialidad por defecto
//             'tipo_documento_id' => 2, // Tipo de documento: RUC (asumiendo que '2' es el ID de RUC)
//             'numero_documento' => $data['ruc'], // Usar el RUC ingresado en el formulario
//             'celular' => $data['telefono_inmobiliaria'],
//             'direccion' => $data['direccion_fiscal'], // Usar la dirección fiscal ingresada en el formulario
//         ]);

//         // Añadir el `user_id` a los datos de cliente
//         $data['user_id'] = $user->id;

//         // Calcular `fecha_fin_contrato` a partir de `fecha_inicio_contrato` y `periodo_plan`
//         if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
//             $fechaInicio = \Carbon\Carbon::parse($data['fecha_inicio_contrato']);
//             $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int) $data['periodo_plan'])->toDateString();
//         }

//         // Enviar notificación con las credenciales al correo del cliente
//         $user->notify(new SendCredentialsProjectNotification($data['user_email'], $randomPassword));
        
//         dd($data);

//         // Recuperar y enviar notificaciones a los contactos con `habilitado_correo` activado
//         $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $data['id'] ?? 0)
//         ->where('habilitado_correo', true)
//         ->get();

//         foreach ($contactos as $contacto) {
//             // Enviar la notificación a cada contacto
//             $user->notify(new SendCredentialsProjectNotification($contacto->email, $randomPassword));
//         }

//         return $data;
//     }
// }

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Models\ProyectoClienteContacto;
use App\Notifications\SendCredentialsProjectNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

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

        if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
            $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
            $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int) $data['periodo_plan'])->toDateString();
        }

        $user->notify(new SendCredentialsProjectNotification($data['user_email'], $data['user_email'], $this->randomPassword));

        return $data;
    }

    protected function afterCreate(): void
    {
        $proyectoCliente = $this->record;

        $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $proyectoCliente->id)
            ->where('habilitado_correo', true)
            ->get();

        foreach ($contactos as $contacto) {
            $contacto->notify(new SendCredentialsProjectNotification($contacto->email, $proyectoCliente->user->email, $this->randomPassword));
        }
    }
}
