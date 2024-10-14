<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProyectoCliente extends EditRecord
{
    protected static string $resource = ProyectoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
