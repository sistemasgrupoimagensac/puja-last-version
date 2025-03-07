<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Http\Request;

class GenerarComprobantes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.generar-comprobantes';
    protected static ?string $navigationLabel = 'Generar Comprobantes';
    protected static ?string $title = 'Generar Comprobantes';    

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view cpes') ?? false;
    }

}
