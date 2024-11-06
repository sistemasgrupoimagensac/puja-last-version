<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoClienteResource\Pages;
use App\Models\ProyectoCliente;
use App\Models\User;
use Filament\Forms\Components\Builder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;

class ProyectoClienteResource extends Resource
{
    protected static ?string $navigationLabel = 'Ejecutivo de Cuenta';

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
                        TextInput::make('telefono_inmobiliaria')
                            ->tel()
                            ->telRegex('/^9[0-9]{8}$/')
                            ->label('Teléfono de la Inmobiliaria'),
                        TextInput::make('nombre_comercial')->label('Nombre Comercial'),
                    ])
                    ->columns(2),

                Section::make('Representantes Legales')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('representantesLegales')
                            ->relationship('representantesLegales')
                            ->schema([
                                TextInput::make('nombre')->required()->label('Nombre del Representante Legal'),
                                TextInput::make('direccion')->required()->label('Dirección'),
                                \Filament\Forms\Components\Select::make('tipo_documento')
                                    ->required()
                                    ->label('Tipo de Documento')
                                    ->options([
                                        'DNI' => 'DNI',
                                        'CE' => 'CE',
                                    ]),
                                TextInput::make('numero_documento')
                                    ->required()
                                    ->label('Número de Documento')
                                    ->maxLength(20),
                                \Filament\Forms\Components\Select::make('estado_civil')
                                    ->label('Estado Civil')
                                    ->options([
                                        'soltero' => 'Soltero',
                                        'casado' => 'Casado',
                                        'viudo' => 'Viudo',
                                        'divorciado' => 'Divorciado',
                                    ])
                                    ->nullable(),
                            ])
                            ->addActionLabel('Agregar Representante')
                            ->label('Representantes Legales')
                            ->grid(2)
                            ->columns(2)
                    ])
                    ->columns(1),

                Section::make('Información de Contacto')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('contactos')
                            ->relationship('contactos') // Define la relación con la tabla de contactos
                            ->schema([
                                TextInput::make('nombre')
                                    ->required()
                                    ->label('Nombre de la Persona de Contacto'),
                                    
                                TextInput::make('telefono')
                                    ->required()
                                    ->tel()
                                    ->telRegex('/^9[0-9]{8}$/')
                                    ->label('Teléfono de la Persona de Contacto'),
                                
                                TextInput::make('email')
                                    ->required()
                                    ->email()
                                    ->label('Correo de la Persona de Contacto'),
                            ])
                            ->addActionLabel('Agregar Contacto')
                            ->grid(2)
                            ->columns(2)
                            ->hiddenLabel(false)
                            ->deletable(true)
                            ->collapsible()
                    ])
                    ->columns(1), // Mantener la sección en una columna

                
                Section::make('Google sheet (opcional)')
                    ->relationship('googleSheet')
                    ->schema([
                
                        Toggle::make('sheet_habilitado')
                            ->label('Habilitar Google Sheet')
                            ->onColor('success')
                            ->inline(false)
                            ->default(false)
                            ->reactive(), // Hacer el toggle reactivo
                
                        TextInput::make('google_sheet_url')
                            ->label('URL de Google Sheet')
                            ->url()
                            ->placeholder('https://docs.google.com/spreadsheets/...')
                            ->disabled(fn ($get) => !$get('sheet_habilitado'))
                            ->reactive(),
                    ])
                    ->columns(1),
                    
                Section::make('Datos del Contrato')
                    ->schema([
                        DatePicker::make('fecha_inicio_contrato')
                            ->required()
                            ->label('Fecha de Inicio del Contrato')
                            ->reactive(), // Hacer que el campo sea reactivo para actualizaciones en vivo
                        
                        DatePicker::make('fecha_fin_contrato')
                            ->required()
                            ->label('Fecha de Finalización del Contrato')
                            ->reactive() // Hacer que el campo sea reactivo para actualizarse en base a 'fecha_inicio_contrato'
                            ->afterStateUpdated(function (callable $set, $get, $state) {
                                $fechaInicio = $get('fecha_inicio_contrato');
                                $fechaFin = $state;
                                
                                if ($fechaInicio && $fechaFin) {
                                    // Calcular la diferencia en días entre la fecha de inicio y la de fin
                                    $diff = \Carbon\Carbon::parse($fechaInicio)->diffInDays(\Carbon\Carbon::parse($fechaFin));

                                    // Verificar si la diferencia es mayor a 365 días
                                    if ($diff > 365) {
                                        // Restringir la fecha y mostrar un mensaje de error
                                        $set('fecha_fin_contrato', null); // Resetear la fecha fin
                                        \Filament\Notifications\Notification::make()
                                            ->title('Error en la Fecha de Finalización')
                                            ->body('El período no debe ser mayor a un año (365 días)')
                                            ->danger()
                                            ->send();
                                    }
                                }
                            }),

                        TextInput::make('numero_anuncios')
                            ->numeric()
                            ->label('Número de Anuncios')
                            ->default(1)
                            ->minValue(1),
                            
                        TextInput::make('precio_plan')
                            ->label('Costo del Proyecto')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->prefix('S/')
                            ->placeholder('Ingrese el monto del proyecto'),
                    ])
                    ->columns(2),

                Section::make('Estado del Cliente')
                    ->schema([
                        Toggle::make('habilitado')
                            ->label('Habilitado')
                            ->default(true),

                        ToggleButtons::make('activo')
                            ->label('Activo')
                            ->boolean()
                            ->inline()
                            ->disabled()
                            ->default(fn ($record) => $record->activo ?? false),

                        ToggleButtons::make('pagado')
                            ->label('Pagado')
                            ->boolean()
                            ->inline()
                            ->disabled()
                    ])
                    ->columns(3),

                Section::make('Credenciales de Usuario')
                    ->schema([
                        TextInput::make('user_email')
                            ->label('Correo Electrónico de Inicio de Sesión')
                            ->required()
                            ->email()
                            ->rules(function ($livewire) {
                                return [
                                    'required',
                                    'email',
                                    Rule::unique(User::class, 'email')
                                        ->ignore($livewire->record->user_id ?? null),
                                ];
                            })
                            ->validationAttribute('Correo Electrónico de Inicio de Sesión')
                            ->disabled(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),

                        TextInput::make('user_password')
                            ->label('Contraseña')
                            ->password()
                            ->default(fn () => Str::random(10))
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
                TextColumn::make('user.email')->label('Correo Electrónico'),
                TextColumn::make('fecha_inicio_contrato')->label('Inicio de Contrato'),
                TextColumn::make('fecha_fin_contrato')->label('Fin de Contrato'),
                IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),
                IconColumn::make('pagado')
                    ->boolean()
                    ->label('Pagó'),
            ])
            ->filters([
                Filter::make('activo')
                    ->label('Clientes Activos')
                    ->query(fn (Builder $query) => $query->where('activo', true)),
                Filter::make('inactivo')
                    ->label('Clientes Inactivos')
                    ->query(fn (Builder $query) => $query->where('activo', false)),
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
