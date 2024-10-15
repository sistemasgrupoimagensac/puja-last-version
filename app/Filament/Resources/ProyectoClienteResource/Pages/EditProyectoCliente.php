<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditProyectoCliente extends EditRecord
{
    protected static string $resource = ProyectoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Cargar el user_email del cliente desde la tabla `users`
        $user = User::find($this->record->user_id);
        
        if ($user) {
            $data['user_email'] = $user->email; // Asignar el correo al campo user_email

            $user->update([
                'nombres' => $data['razon_social'], // Actualiza el nombre del usuario con la razón social
                'email' => $data['user_email'], // Actualiza el email en la tabla `users`
                'direccion' => $data['direccion_fiscal'], // Actualiza la dirección fiscal en la tabla `users`
                'numero_documento' => $data['ruc'], // Actualiza el RUC en la tabla `users`
            ]);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Evitar la modificación del correo electrónico durante la edición
        unset($data['user_email']);

        return $data;
    }
}
