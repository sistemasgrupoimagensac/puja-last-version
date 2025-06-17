<?php

namespace App\Filament\Resources\AvisoLogResource\Pages;

use App\Filament\Resources\AvisoLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAvisoLogs extends ListRecords
{
    protected static string $resource = AvisoLogResource::class;

    /* protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    } */
}
