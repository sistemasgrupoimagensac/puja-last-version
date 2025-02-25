<?php

namespace App\Filament\Resources\AdContactResource\Pages;

use App\Filament\Resources\AdContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdContact extends EditRecord
{
    protected static string $resource = AdContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
