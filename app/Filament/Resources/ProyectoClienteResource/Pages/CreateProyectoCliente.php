<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Notifications\SendCredentialsProjectNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class CreateProyectoCliente extends CreateRecord
{
    protected static string $resource = ProyectoClienteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Validar que el correo electrónico no exista en la tabla `users`
        $validator = Validator::make($data, [
            'user_email' => 'required|email|unique:users,email', // Validar que sea único en `users`
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['user_email' => 'El correo ya está registrado.']);
        }

        // Generar una contraseña aleatoria
        $randomPassword = Str::random(10);

        $user = User::create([
            'tipo_usuario_id' => 5, // El tipo de usuario específico (cliente inmobiliario)
            'not_pay' => 1, // Valor por defecto
            'nombres' => $data['razon_social'], // Usar el nombre de la razón social del formulario
            'email' => $data['user_email'], // Usar el email del formulario
            'password' => Hash::make($randomPassword), // Hashear la contraseña generada
            'estado' => 1, // Estado activado por defecto
            'acepta_termino_condiciones' => 1, // Aceptación de términos por defecto
            'acepta_confidencialidad' => 1, // Aceptación de confidencialidad por defecto
            'tipo_documento_id' => 2, // Tipo de documento: RUC (asumiendo que '2' es el ID de RUC)
            'numero_documento' => $data['ruc'], // Usar el RUC ingresado en el formulario
            'direccion' => $data['direccion_fiscal'], // Usar la dirección fiscal ingresada en el formulario
        ]);

        // Añadir el `user_id` a los datos de cliente
        $data['user_id'] = $user->id;

        // Enviar notificación con las credenciales al correo del cliente
        $user->notify(new SendCredentialsProjectNotification($data['user_email'], $randomPassword));

        return $data;
    }
}