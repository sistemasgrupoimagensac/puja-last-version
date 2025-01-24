<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoClienteResource\Pages;
use App\Models\ProyectoCliente;
use App\Models\ProyectoPlanes;
use App\Models\User;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;

class ProyectoClienteResource extends Resource
{
    protected static ?string $navigationLabel = 'Ejecutivo de Cuenta';

    protected static ?string $model = ProyectoCliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información de la Empresa')
                    ->schema([
                        TextInput::make('razon_social')->required()->label('Razón Social'),
                        TextInput::make('ruc')->required()->label('RUC'),
                        TextInput::make('direccion_fiscal')->required()->label('Dirección Fiscal'),
                        TextInput::make('telefono_inmobiliaria')
                            ->tel()
                            ->required()
                            ->telRegex('/^9[0-9]{8}$/')
                            ->label('Teléfono de la empresa'),
                        TextInput::make('nombre_comercial')->label('Nombre Comercial'),
                    ])
                    ->columns(2),

                Section::make('Representantes Legales')
                    ->schema([
                        Repeater::make('representantesLegales')
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
                                Select::make('estado_civil')
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
                        Repeater::make('contactos')
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

                                Checkbox::make('habilitado_correo')
                                    ->label('Habilitar Correo')
                                    ->inline(false)
                                    ->default(true),
                            ])
                            ->addActionLabel('Agregar Contacto')
                            ->grid(2)
                            ->columns(2)
                            ->hiddenLabel(false)
                            ->deletable(true)
                            ->collapsible()
                    ])
                    ->columns(1),

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
                        Repeater::make('proyectoPlanesActivos')
                            ->relationship('proyectoPlanesActivos')
                            ->schema([
                                DatePicker::make('fecha_inicio')
                                    ->required()
                                    ->label('Fecha de Inicio del Contrato')
                                    ->reactive(),

                                DatePicker::make('fecha_fin')
                                    ->label('Fecha fin del contrato')
                                    ->readOnly(),
                                    // ->disabled(),

                                Select::make('duracion')
                                    ->label('Periodo del Plan')
                                    ->options([
                                        3 => '3 meses',
                                        6 => '6 meses',
                                        12 => '12 meses',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $fechaInicio = $get('fecha_inicio');
                                        if ($fechaInicio) {
                                            $fechaInicioCarbon = \Carbon\Carbon::parse($fechaInicio);
                                            $fechaFin = $fechaInicioCarbon->addMonths((int) $state)->toDateString();
                                            $set('fecha_fin', $fechaFin);
                                        }

                                        // Mapeo de duración a proyecto_planes_id
                                        $duracionToPlanId = [
                                            3 => 1,
                                            6 => 2,
                                            12 => 3,
                                        ];
                                
                                        if (isset($duracionToPlanId[$state])) {
                                            $set('proyecto_planes_id', $duracionToPlanId[$state]);
                                        }
                                    }),
                                Hidden::make('proyecto_planes_id'),

                                Hidden::make('estado_id')
                                ->default(2),

                                TextInput::make('numero_anuncios')
                                    ->numeric()
                                    ->label('Número de Anuncios')
                                    ->required()
                                    ->default(1)
                                    ->minValue(1),
                                    
                                TextInput::make('monto')
                                    ->label('Costo del Proyecto')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->prefix('S/')
                                    ->placeholder('Ingrese el monto del proyecto'),

                                Checkbox::make('pago_unico')
                                    ->label('Pago único')
                                    ->inline(false)
                                    ->reactive()
                                    ->afterStateUpdated(function (callable $set, $state) {
                                        if ($state) {
                                            $set('pago_fraccionado', false);
                                        }
                                    }),

                                Checkbox::make('pago_fraccionado')
                                    ->label('Pago fraccionado')
                                    ->inline(false)
                                    ->reactive()
                                    ->default(true)
                                    ->afterStateUpdated(function (callable $set, $state) {
                                        if ($state) {
                                            $set('pago_unico', false);
                                        }
                                    }),
                                    
                                Checkbox::make('renovacion_automatica')
                                    ->label('Renovación automática')
                                    ->inline(false),
                                
                                ToggleButtons::make('pago_gratis')
                                    ->label('Contrato Gratis')
                                    ->boolean()
                                    ->default(fn ($record) => $record->pago_gratis ?? false)
                                ->inline(),

                                ToggleButtons::make('activo')
                                    ->label('Activo')
                                    ->boolean()
                                    ->inline()
                                    // ->disabled()
                                    ->default(fn ($record) => $record->activo ?? false),

                                ToggleButtons::make('pagado')
                                    ->label('Pago Total')
                                    ->boolean()
                                    ->default(fn ($record) => $record->pagado ?? false)
                                    ->inline(),

                                FileUpload::make('contrato_url')
                                    ->label('Contrato')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->disk('wasabi')
                                    ->directory('proyectos/contratos')
                                    ->visibility('public')
                                    ->required()
                                    ->maxSize(4096),
                                    /* ->columnSpan(2) */
                            ])
                            ->addActionLabel('Agregar Contrato')
                            ->columns(4),
                    ]),

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
                            ->hidden(),
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
                IconColumn::make('vigente')
                    ->boolean()
                    ->label('Vigente'),
                TextColumn::make('contrato_url')
                    ->label('Contrato')
                    ->formatStateUsing(fn ($state) => !empty($state) ? 'Ver Contrato' : 'No Disponible')
                    ->url(fn ($record) => $record->contrato_url ? route('contratos.get', ['archivo' => basename($record->contrato_url)]) : null)
                    ->openUrlInNewTab()
                    ->badge()
                    ->color(fn ($state) => $state === 'Ver Contrato' ? 'success' : 'warning'),
            ])
            ->actions([
                Action::make('verCronograma')
                ->label('Pagos')
                ->modalHeading('Cronograma de Pagos')
                ->modalContent(function (ProyectoCliente $record) {
                    $cronogramaPagos = $record->cronogramaPagos()
                        ->with('estadoPago') // Carga la relación de estadoPago
                        ->get();

                    return view('filament.modals.cronograma-pagos', [
                        'cronogramaPagos' => $cronogramaPagos,
                    ]);
                })
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