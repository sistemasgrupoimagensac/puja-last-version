<?php

namespace App\Filament\Resources\InmuebleResource\Pages;

use App\Filament\Resources\InmuebleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInmuebles extends ListRecords
{
    protected static string $resource = InmuebleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
