<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoLeadResource\Pages;
use App\Models\ProyectoLead;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProyectoLeadResource extends Resource
{
    protected static ?string $model = ProyectoLead::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required()->label('Nombre'),
                Forms\Components\TextInput::make('correo')->required()->label('Correo')->email(),
                Forms\Components\TextInput::make('telefono')->required()->label('Teléfono'),
                Forms\Components\Textarea::make('mensaje')->label('Mensaje')->nullable(),
                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'contactado' => 'Contactado',
                        'sin_contactar' => 'Sin Contactar',
                    ])->default('sin_contactar'),
                Forms\Components\Toggle::make('respondio')->label('¿Respondió?'),
                Forms\Components\Toggle::make('interesado')->label('¿Está interesado?'),
                Forms\Components\DatePicker::make('fecha_contacto')->label('Fecha de Contacto'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('correo')->label('Correo'),
                Tables\Columns\TextColumn::make('telefono')->label('Teléfono'),
                Tables\Columns\TextColumn::make('estado')->label('Estado'),
                Tables\Columns\IconColumn::make('respondio')
                    ->boolean()
                    ->label('¿Respondió?'),
                Tables\Columns\IconColumn::make('interesado')
                    ->boolean()
                    ->label('¿Interesado?'),
                Tables\Columns\TextColumn::make('fecha_contacto')->label('Fecha de Contacto')->date(),
            ])
            ->filters([
                // Puedes agregar filtros personalizados aquí si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
