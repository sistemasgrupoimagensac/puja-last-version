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

        // Actualizar el usuario relacionado si existe
        $user = User::find($this->record->user_id);
        if ($user) {
            $user->update([
                'nombres' => $data['razon_social'], // Actualiza el nombre del usuario con la razón social
                'direccion' => $data['direccion_fiscal'], // Actualiza la dirección fiscal en la tabla `users`
                'numero_documento' => $data['ruc'], // Actualiza el RUC en la tabla `users`
                'celular' => $data['telefono_inmobiliaria'], // Actualizar el celular en la tabla usuarios
            ]);
        }

        // Calcular `fecha_fin_contrato` si `fecha_inicio_contrato` y `periodo_plan` están presentes
        // if (isset($data['fecha_inicio_contrato'], $data['periodo_plan'])) {
        //     $fechaInicio = Carbon::parse($data['fecha_inicio_contrato']);
        //     $data['fecha_fin_contrato'] = $fechaInicio->addMonths((int) $data['periodo_plan'])->toDateString();
        // }

        // TODO: hacer que la actualizacion de fin de contrato se ejecute en un cronjob

        return $data;
    }
}
