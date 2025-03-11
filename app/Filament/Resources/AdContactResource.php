<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdContactResource\Pages;
use App\Filament\Resources\AdContactResource\RelationManagers;
use App\Models\AdContact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class AdContactResource extends Resource
{
    protected static ?string $model = AdContact::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = 'Contactos por inmueble';

    protected static ?int $navigationSort = 26;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view contactar') ?? false;
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
                AdContact::query()
                    ->select([
                        'ad_contacts.id as id',
                        'ad_contacts.aviso_id as aviso_id',
                        DB::raw('CONCAT(IFNULL(uo.nombres, ""), " ", IFNULL(uo.apellidos, "")) as owner'),
                        DB::raw('CONCAT(IFNULL(ti.tipo, ""), " en ", IFNULL(to.tipo, ""), " en ", IFNULL(d.nombre, "")) as title'),
                        DB::raw('IF(ad_contacts.contact_type = "email", "Email", "WhatsApp") as tipo_contacto'),
                        DB::raw('IF(u.id IS NOT NULL, CONCAT(IFNULL(u.nombres, ""), " ", IFNULL(u.apellidos, "")), "") as usuario'),
                        'ad_contacts.full_name',
                        'ad_contacts.email',
                        'ad_contacts.phone',
                        DB::raw('CONCAT(IFNULL(ad_contacts.type_currency_id, ""), IFNULL(ad_contacts.bid_amount, "")) as monto_puja'),
                        'ad_contacts.message',
                        'ad_contacts.created_at',
                    ])
                    ->join('avisos as a', 'a.id', '=', 'ad_contacts.aviso_id')
                    ->join('inmuebles as i', 'i.id', '=', 'a.inmueble_id')
                    ->join('users as uo', 'uo.id', '=', 'i.user_id')
                    ->join('principal_inmuebles as pi', 'pi.inmueble_id', '=', 'i.id')
                    ->join('operaciones_tipos_inmuebles as op', 'op.principal_inmueble_id', '=', 'pi.id')
                    ->join('tipos_operaciones as to', 'to.id', '=', 'op.tipo_operacion_id')
                    ->join('tipos_inmuebles as ti', 'ti.id', '=', 'op.tipo_inmueble_id')
                    ->join('ubicaciones_inmuebles as ubi', 'ubi.principal_inmueble_id', '=', 'pi.id')
                    ->join('distritos as d', 'd.id', '=', 'ubi.distrito_id')
                    ->leftJoin('users as u', 'u.id', '=', 'ad_contacts.user_id')
                ->orderBy('ad_contacts.id', 'DESC')
            )
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('title')->label('Título')->searchable(query: function ($query, $search) {
                    return $query->whereRaw("CONCAT(IFNULL(ti.tipo, ''), ' en ', IFNULL(to.tipo, ''), ' en ', IFNULL(d.nombre, '')) LIKE ?", ["%{$search}%"]);
                }),
                TextColumn::make('aviso_id')->label('Aviso id')->searchable(),
                TextColumn::make('owner')->label('Dueño')->searchable(query: function ($query, $search) {
                    return $query->whereRaw("CONCAT(IFNULL(uo.nombres, ''), ' ', IFNULL(uo.apellidos, '')) LIKE ?", ["%{$search}%"]);
                }),
                TextColumn::make('tipo_contacto')->label('Tipo contacto'),
                TextColumn::make('usuario')->label('Usuario'),
                TextColumn::make('full_name')->label('Nombre'),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('monto_puja')->label('Monto puja'),
                TextColumn::make('message')->label('Mensaje'),
                TextColumn::make('created_at')->label('Fecha de contacto')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->label('Exportar Todo')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAdContacts::route('/'),
            'create' => Pages\CreateAdContact::route('/create'),
            'edit' => Pages\EditAdContact::route('/{record}/edit'),
        ];
    }
}
