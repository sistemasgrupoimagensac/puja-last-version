<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaccionResource\Pages;
use App\Filament\Resources\TransaccionResource\RelationManagers;
use App\Models\Transaccion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

// class TransaccionResource extends Resource
// {
//     protected static ?string $model = Transaccion::class;

//     protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//     public static function form(Form $form): Form
//     {
//         return $form
//             ->schema([
//                 //
//             ]);
//     }

//     public static function table(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 //
//             ])
//             ->filters([
//                 //
//             ])
//             ->actions([
//                 Tables\Actions\EditAction::make(),
//             ])
//             ->bulkActions([
//                 Tables\Actions\BulkActionGroup::make([
//                     Tables\Actions\DeleteBulkAction::make(),
//                 ]),
//             ]);
//     }

//     public static function getRelations(): array
//     {
//         return [
//             //
//         ];
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => Pages\ListTransaccions::route('/'),
//             'create' => Pages\CreateTransaccion::route('/create'),
//             'edit' => Pages\EditTransaccion::route('/{record}/edit'),
//         ];
//     }
// }

class TransaccionResource extends Resource
{
    protected static ?string $model = Transaccion::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('customer_name')->label('Nombre del Cliente')->sortable(),
                Tables\Columns\TextColumn::make('amount')->label('Monto')->sortable(),
                IconColumn::make('status')
                    ->label('Estado')
                    ->boolean() // Muestra iconos según el estado booleano
                    ->trueIcon('heroicon-o-check-circle') 
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('creation_date')->label('Fecha de Creación')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Transacciones Exitosas')
                    ->query(fn (Builder $query) => $query->where('status', 1)),
                Tables\Filters\Filter::make('Transacciones Fallidas')
                    ->query(fn (Builder $query) => $query->where('status', 0)),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaccions::route('/'),
        ];
    }
}