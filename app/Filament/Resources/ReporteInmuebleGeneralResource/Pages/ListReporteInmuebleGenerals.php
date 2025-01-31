<?php

namespace App\Filament\Resources\ReporteInmuebleGeneralResource\Pages;

use App\Filament\Resources\ReporteInmuebleGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReporteInmuebleGenerals extends ListRecords
{
    protected static string $resource = ReporteInmuebleGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
