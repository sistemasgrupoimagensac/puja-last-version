<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class EditProyectoCliente extends EditRecord
{
    protected static string $resource = ProyectoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Cargar el user_email del cliente desde la tabla `users`
        $user = User::find($this->record->user_id);
        
        if ($user) {
            $data['user_email'] = $user->email; // Asignar el correo al campo user_email
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Evitar la modificación del correo electrónico durante la edición
        unset($data['user_email']);

        $user = User::find($this->record->user_id);
        
        if ($user) {
            $user->update([
                'nombres' => $data['razon_social'], // Actualiza el nombre del usuario con la razón social
                'direccion' => $data['direccion_fiscal'], // Actualiza la dirección fiscal en la tabla `users`
                'numero_documento' => $data['ruc'], // Actualiza el RUC en la tabla `users`
            ]);
        }

        return $data;
    }

    protected function beforeSave(array $data): void
    {
        $fechaInicio = $data['fecha_inicio_contrato'];
        $fechaFin = $data['fecha_fin_contrato'];

        if ($fechaInicio && $fechaFin) {
            // Calcular la diferencia en días
            $diff = Carbon::parse($fechaInicio)->diffInDays(Carbon::parse($fechaFin));

            // Verificar si la diferencia es mayor a 365 días
            if ($diff > 365) {
                throw ValidationException::withMessages([
                    'fecha_fin_contrato' => 'El período no debe ser mayor a un año (365 días).',
                ]);
            }
        }
    }
}
