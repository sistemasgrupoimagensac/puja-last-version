<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoLeadResource\Pages;
use App\Models\ProyectoLead;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
// use Filament\Forms\Components\TextArea;

class ProyectoLeadResource extends Resource
{
    protected static ?string $model = ProyectoLead::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->required()->label('Nombre'),
                TextInput::make('correo')->required()->label('Correo')->email(),
                TextInput::make('telefono')->required()->label('Teléfono'),
                Textarea::make('mensaje')->label('Mensaje')->nullable(),
                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'contactado' => 'Contactado',
                        'sin_contactar' => 'Sin Contactar',
                    ])->default('sin_contactar'),
                Toggle::make('respondio')->label('¿Respondió?'),
                Toggle::make('interesado')->label('¿Está interesado?'),
                DatePicker::make('fecha_contacto')->label('Fecha de Contacto'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre'),
                TextColumn::make('correo')->label('Correo'),
                TextColumn::make('telefono')->label('Teléfono'),
                TextColumn::make('estado')->label('Estado'),
                IconColumn::make('respondio')
                    ->boolean()
                    ->label('¿Respondió?'),
                IconColumn::make('interesado')
                    ->boolean()
                    ->label('¿Interesado?'),
                TextColumn::make('fecha_contacto')->label('Fecha de Contacto')->date(),
            ])
            ->filters([
                // Puedes agregar filtros personalizados aquí si es necesario
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyectoLeads::route('/'),
            'create' => Pages\CreateProyectoLead::route('/create'),
            'edit' => Pages\EditProyectoLead::route('/{record}/edit'),
        ];
    }
}
