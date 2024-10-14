<?php

namespace App\Filament\Resources\ProyectoLeadResource\Pages;

use App\Filament\Resources\ProyectoLeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProyectoLeads extends ListRecords
{
    protected static string $resource = ProyectoLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
