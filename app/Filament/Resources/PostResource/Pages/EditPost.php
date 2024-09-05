<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('view_post')
                ->label('Ver Post')
                ->url(fn() => url('/blog/' . $this->record->slug))
                ->openUrlInNewTab(), // Abre el enlace en una nueva pestaña
        ];
    }
}