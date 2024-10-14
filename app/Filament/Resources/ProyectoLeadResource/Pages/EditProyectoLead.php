<?php

namespace App\Filament\Resources\ProyectoLeadResource\Pages;

use App\Filament\Resources\ProyectoLeadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProyectoLead extends EditRecord
{
    protected static string $resource = ProyectoLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
