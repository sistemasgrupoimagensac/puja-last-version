<?php

namespace App\Filament\Resources\AvisoLogResource\Pages;

use App\Filament\Resources\AvisoLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvisoLog extends EditRecord
{
    protected static string $resource = AvisoLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
