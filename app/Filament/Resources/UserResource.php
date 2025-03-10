<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    
    protected static ?string $navigationLabel = 'Reporte registrados';

    protected static ?int $navigationSort = 23;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view registrados') ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->select([
                        'users.id as id',
                        DB::raw('
                            CASE 
                                WHEN tu.id = 1 THEN "GOOGLE"
                                WHEN tu.id = 2 THEN "Propietario"
                                WHEN tu.id = 3 THEN "Corredor"
                                WHEN tu.id = 4 THEN "Acreedor"
                                WHEN tu.id = 5 THEN "Proyecto"
                            END as tipo_usuario
                        '),
                        DB::raw('CONCAT(IFNULL(users.nombres, ""), " ", IFNULL(users.apellidos, "")) as cliente'),
                        "users.created_at as fecha_registro",
                        "users.celular",
                        "users.email",
                        DB::raw('IFNULL(td.documento, "") AS tipo_documento'),
                        DB::raw('IFNULL(users.numero_documento, "") AS nro_documento'),
                        DB::raw('IFNULL(users.direccion, "") AS direccion'),
                        DB::raw('IF(users.email_verified_at IS NULL, "NO", "SI") AS puede_publicar'),
                        DB::raw('IF(users.not_pay = 1, "SI", "NO") AS pago_gratis'),
                    ])
                    ->join('tipos_usuario as tu', 'users.tipo_usuario_id', '=', 'tu.id')
                    ->leftJoin('tipos_documento as td', 'users.tipo_documento_id', '=', 'td.id')
                ->orderBy('users.id', 'DESC')
            )
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('tipo_usuario')->label('Tipo usuario'),
                TextColumn::make('cliente')->label('Cliente')->searchable(query: function ($query, $search) {
                    return $query->whereRaw("CONCAT(IFNULL(users.nombres, ''), ' ', IFNULL(users.apellidos, '')) LIKE ?", ["%{$search}%"]);
                }),
                TextColumn::make('fecha_registro')->label('Fecha de registro')->dateTime()->sortable(),
                TextColumn::make('celular')->label('Celular'),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('tipo_documento')->label('Tipo documento'),
                TextColumn::make('nro_documento')->label('Nro. documento'),
                TextColumn::make('direccion')->label('Dirección'),
                TextColumn::make('puede_publicar')->label('Puede publicar'),
                TextColumn::make('pago_gratis')->label('Pago gratis'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()->label('Exportar Todo')
            ])
            ->actions([
                Action::make('verPlanes')
                    ->label('Ver Planes')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Planes del Usuario')
                    ->modalContent(fn ($record) => view('filament.modals.planes-usuario', ['user' => $record]))
                    ->modalButton('Cerrar'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
