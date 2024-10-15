<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoClienteResource\Pages;
use App\Models\ProyectoCliente;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;

class ProyectoClienteResource extends Resource
{
    protected static ?string $model = ProyectoCliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información de la Inmobiliaria')
                    ->schema([
                        TextInput::make('razon_social')->required()->label('Razón Social'),
                        TextInput::make('ruc')->required()->label('RUC'),
                        TextInput::make('direccion_fiscal')->required()->label('Dirección Fiscal'),
                        TextInput::make('telefono_inmobiliaria')->label('Teléfono de la Inmobiliaria'),
                        TextInput::make('nombre_comercial')->label('Nombre Comercial'),
                    ]),

                Section::make('Información del Representante')
                    ->schema([
                        TextInput::make('representante_legal')->label('Representante Legal'),
                        TextInput::make('direccion_representante')->label('Dirección del Representante'),
                    ]),

                Section::make('Información de Contacto')
                    ->schema([
                        TextInput::make('nombre_contacto')->required()->label('Nombre de la Persona de Contacto'),
                        TextInput::make('telefono_contacto')->required()->label('Teléfono de la Persona de Contacto'),
                        TextInput::make('email_contacto')->required()->email()->label('Correo de la Persona de Contacto'),
                    ]),

                Section::make('Datos del Contrato')
                    ->schema([
                        DatePicker::make('fecha_inicio_contrato')->required()->label('Fecha de Inicio del Contrato'),
                        DatePicker::make('fecha_fin_contrato')->required()->label('Fecha de Finalización del Contrato'),
                        TextInput::make('numero_anuncios')
                            ->numeric()
                            ->label('Número de Anuncios')
                            ->default(1)
                            ->minValue(1),
                    ]),

                Section::make('Credenciales de Usuario')
                    ->schema([
                        TextInput::make('user_email')
                        ->label('Correo Electrónico de Inicio de Sesión')
                        ->required()
                        ->email()
                        ->rules(function ($livewire) {
                            // Validar que el correo sea único solo cuando se crea un nuevo registro
                            return [
                                'required', 
                                'email',
                                Rule::unique(User::class, 'email')->ignore($livewire->record->user_id),
                            ];
                        })
                        ->validationAttribute('Correo Electrónico de Inicio de Sesión')
                        ->disabled(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord), // Deshabilitar campo en modo edición
                    

                        TextInput::make('user_password')
                            ->label('Contraseña')
                            ->password()
                            ->default(fn () => Str::random(10)) // Contraseña aleatoria
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('razon_social')->label('Razón Social'),
                TextColumn::make('ruc')->label('RUC'),
                TextColumn::make('nombre_contacto')->label('Nombre de Contacto'),
                TextColumn::make('user.email')->label('Correo Electrónico'),
                TextColumn::make('fecha_inicio_contrato')->label('Inicio de Contrato'),
                TextColumn::make('fecha_fin_contrato')->label('Fin de Contrato'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyectoClientes::route('/'),
            'create' => Pages\CreateProyectoCliente::route('/create'),
            'edit' => Pages\EditProyectoCliente::route('/{record}/edit'),
        ];
    }
}