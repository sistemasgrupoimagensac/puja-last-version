<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteInmuebleGeneralResource\Pages;
use App\Models\Inmueble;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class ReporteInmuebleGeneralResource extends Resource
{
    protected static ?string $model = Inmueble::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Reporte general';

    protected static ?int $navigationSort = 22;

    public static function shouldRegisterNavigation(): bool

    {
        return auth()->user()?->can('view avisos generales') ?? false;
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
                Inmueble::query()
                    ->select([
                        "u.id",
                        "u.created_at as fecha_registro",
                        DB::raw('CONCAT(IFNULL(u.nombres, ""), " ", IFNULL(u.apellidos, "")) as cliente'),
                        "tu.tipo as tipo_usuario",
                        "u.celular",
                        "u.email",
                        DB::raw('COUNT(a.id) as Cant_publicaciones'),
                        DB::raw('MAX(h.updated_at) as Ultima_publicacion'),
                        "pk.name as Nombre_paquete",
                        "p.name as Nombre_del_plan",
                        "p.price as Monto_del_plan",
                        "pu.price as monto_pagado",
                        DB::raw('IFNULL(CONCAT(pu.promo1, "%"), "") AS Promo_1'),
                        DB::raw('IFNULL(CONCAT(pu.promo2, "%"), "") AS Promo_2')
                    ])
                    ->join('users as u', 'inmuebles.user_id', '=', 'u.id')
                    ->join('avisos as a', 'inmuebles.id', '=', 'a.inmueble_id')
                    /* ->join('historial_avisos as h', function ($join) {
                        $join->on('a.id', '=', 'h.aviso_id')
                             ->where('h.estado_aviso_id', '=', 3);
                    }) */
                    ->join('historial_avisos as h', 'a.id', '=', 'h.aviso_id')
                    ->leftJoin('plan_user as pu', 'a.plan_user_id', '=', 'pu.id')
                    ->join('plans as p', 'pu.plan_id', '=', 'p.id')
                    ->join('packages as pk', 'p.package_id', '=', 'pk.id')
                    ->join('tipos_usuario as tu', 'pk.user_type_id', '=', 'tu.id')
                    ->leftJoin('promotions as pro', 'p.promotion_id', '=', 'pro.id')
                    ->leftJoin('promotions as pro2', 'p.promotion2_id', '=', 'pro2.id')
                    ->where('h.created_at', '>', Carbon::parse('2025-01-07 00:00:00'))
                    ->groupBy('u.id', 'u.nombres', 'u.apellidos', 'u.email', 'tu.tipo', 'pk.name', 'p.name', 'p.price', 'pu.price', 'pu.promo1', 'pu.promo2', 'u.created_at', 'u.celular', 'u.email')
                ->orderBy(DB::raw('MAX(h.updated_at)'), 'DESC')
            )
            ->columns([
                // TextColumn::make('row_number')->label('N°')->rowIndex(),
                TextColumn::make('id')->label('ID usuario')->sortable(),
                TextColumn::make('fecha_registro')->label('Fecha de registro')->dateTime(),
                TextColumn::make('cliente')->label('Cliente')->searchable(),
                TextColumn::make('tipo_usuario')->label('Tipo Usuario'),
                TextColumn::make('celular')->label('Celular'),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('Cant_publicaciones')->label('Cant. publicaciones'),
                TextColumn::make('Ultima_publicacion')->label('Última publicación')->dateTime(),
                TextColumn::make('Nombre_paquete')->label('Paquete'),
                TextColumn::make('Nombre_del_plan')->label('Plan'),
                TextColumn::make('Monto_del_plan')->label('Monto')->money('PEN'),
                TextColumn::make('monto_pagado')->label('Monto Pagado')->money('PEN'),
                TextColumn::make('Promo_1')->label('Promoción 1'),
                TextColumn::make('Promo_2')->label('Promoción 2'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filtrar por Cliente')
                ->relationship('user', 'nombres'),
            ])
            ->headerActions([
                ExportAction::make()->label('Exportar Todo')
            ])
        ->paginated();

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
            'index' => Pages\ListReporteInmuebleGenerals::route('/'),
            'create' => Pages\CreateReporteInmuebleGeneral::route('/create'),
            'edit' => Pages\EditReporteInmuebleGeneral::route('/{record}/edit'),
        ];
    }
}
