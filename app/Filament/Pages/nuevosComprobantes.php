<?php

namespace App\Filament\Pages;

use App\Http\Controllers\BillingController;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\NumberInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Http\Request;

class nuevosComprobantes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.nuevos-comprobantes';
    protected static ?string $navigationLabel = 'Comprobantes';

    public $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('dni')
                    ->label('DNI Cliente')
                    ->required(),

                TextInput::make('serie')
                    ->label('Serie')
                    ->required(),

                TextInput::make('correlativo')
                    ->label('Correlativo')
                    ->required(),

                TextInput::make('precio')
                    ->label('Precio')
                    ->step(0.01)
                    ->required(),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Crear una nueva instancia de Request con los datos correctos
        $request = new Request($data);

        // Llamar al controlador con la nueva solicitud
        $response = app(BillingController::class)->anularBoleta($request);

        if ($response->status() === 200) {
            $this->dispatch('notify', ['message' => 'Boleta anulada correctamente', 'status' => 'success']);
        } else {
            $this->dispatch('notify', ['message' => 'Error al anular la boleta', 'status' => 'error']);
        }
    }

}
