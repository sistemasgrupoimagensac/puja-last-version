<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InmuebleResource\Pages;
use App\Filament\Resources\InmuebleResource\RelationManagers;
use App\Models\Inmueble;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InmuebleResource extends Resource
{
    protected static ?string $model = Inmueble::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationLabel = 'Reporte publicaciones';

    protected static ?int $navigationSort = 21;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view publicaciones') ?? false;
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
                        'inmuebles.id as id',
                        DB::raw('CONCAT(u.nombres, " ", u.apellidos) as Cliente'),
                        "u.email",
                        "u.celular as Celular" ,
                        "h.updated_at as Fecha_de_publicacion", 
                        "tu.tipo as Tipo_usuario",
                        "pk.name as Nombre_paquete",
                        "p.name as Nombre_del_plan",
                        "p.price as Monto_del_plan",
                        "pu.price as monto_pagado",
                        "p.duration_in_days as Duracion_en_dias",
                        "p.total_ads as Total_de_avisos",
                        DB::raw('IFNULL(CONCAT(pu.promo1, "%"), "") AS Promo_1'),
                        DB::raw('IFNULL(CONCAT(pu.promo2, "%"), "") AS Promo_2'),
                        // DB::raw('IFNULL(CONCAT(pro.percentage, "%"), "") AS Promo_1'),
                        // DB::raw('IFNULL(CONCAT(pro2.percentage, "%"), "") AS Promo_2'),
                        DB::raw('CONCAT(pu.file_name, "-a4.pdf") as cpe')
                    ])
                    ->join('users as u', 'inmuebles.user_id', '=', 'u.id')
                    ->join('avisos as a', 'inmuebles.id', '=', 'a.inmueble_id')
                    ->join('historial_avisos as h', function ($join) {
                        $join->on('a.id', '=', 'h.aviso_id')
                             ->where('h.estado_aviso_id', '=', 3);
                    })
                    ->leftJoin('plan_user as pu', 'a.plan_user_id', '=', 'pu.id')
                    ->join('plans as p', 'pu.plan_id', '=', 'p.id')
                    ->join('packages as pk', 'p.package_id', '=', 'pk.id')
                    ->join('tipos_usuario as tu', 'pk.user_type_id', '=', 'tu.id')
                    ->leftJoin('promotions as pro', 'p.promotion_id', '=', 'pro.id')
                    ->leftJoin('promotions as pro2', 'p.promotion2_id', '=', 'pro2.id')
                    ->where('h.created_at', '>', Carbon::parse('2025-01-07 00:00:00'))
                ->orderBy('h.updated_at', 'DESC')
            )
            ->columns([
                // TextColumn::make('row_number')->label('N°')->rowIndex(),
                TextColumn::make('id')->label('ID Inmueble')->sortable(),
                TextColumn::make('Cliente')->label('Cliente')->searchable(),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('Celular')->label('Celular'),
                TextColumn::make('Fecha_de_publicacion')->label('Fecha de Publicación')->dateTime(),
                TextColumn::make('Tipo_usuario')->label('Tipo Usuario'),
                TextColumn::make('Nombre_paquete')->label('Paquete'),
                TextColumn::make('Nombre_del_plan')->label('Plan'),
                TextColumn::make('Monto_del_plan')->label('Monto')->money('PEN'),
                TextColumn::make('monto_pagado')->label('Monto Pagado')->money('PEN'),
                TextColumn::make('Duracion_en_dias')->label('Días de Duración'),
                TextColumn::make('Total_de_avisos')->label('Total de Avisos'),
                TextColumn::make('Promo_1')->label('Promoción 1'),
                TextColumn::make('Promo_2')->label('Promoción 2'),
                TextColumn::make('cpe')
                    ->label('CPE')
                    ->formatStateUsing(fn ($state) => !empty($state) ? 'Ver CPE' : 'No Disponible')
                    ->url(fn ($record) => !empty($record->cpe) ? route('cpe.get', ['archivo' => basename($record->cpe)]) : null)
                    ->openUrlInNewTab()
                    ->badge()
                ->color(fn ($state) => $state === 'Ver Contrato' ? 'success' : 'warning')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filtrar por Cliente')
                ->relationship('user', 'nombres'),
            ])
            ->bulkActions([
                ExportBulkAction::make()
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
            'index' => Pages\ListInmuebles::route('/'),
            'create' => Pages\CreateInmueble::route('/create'),
            'edit' => Pages\EditInmueble::route('/{record}/edit'),
        ];
    }
}
