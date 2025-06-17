<?php

namespace App\Filament\Resources\AvisoLogResource\Pages;

use App\Filament\Resources\AvisoLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAvisoLog extends ViewRecord
{
    protected static string $resource = AvisoLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
