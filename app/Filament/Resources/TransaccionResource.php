<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaccionResource\Pages;
use Illuminate\Contracts\View\View;
use App\Models\Transaccion;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Filters\Filter;

class TransaccionResource extends Resource
{
    protected static ?string $model = Transaccion::class;

    public static function getModelLabel(): string
    {
        return 'Transacción';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Transacciones';
    }

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('customer_name')
                    ->label('Nombre')
                    ->sortable()
                    ->formatStateUsing(fn (Transaccion $record): string => $record->customer_name )
                    ->description(fn (Transaccion $record): ?string => $record->customer_email ),
                // TextColumn::make('tipo_usuario_id')
                //     ->label('Tipo de Usuario')
                //     ->formatStateUsing(fn ($record) => match ($record->tipo_usuario_id) {
                //         2 => 'Propietario',
                //         3 => 'Corredor Inmobiliario',
                //         4 => 'Acreedor Hipotecario',
                //         default => 'Desconocido',
                //     }),

                TextColumn::make('amount')
                    ->label('Monto')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 2)),
                IconColumn::make('status')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                TextColumn::make('creation_date')
                    ->label('Fecha y Hora de Transacción')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('d/m/Y - H:i'))
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                ->label('Detalles')
                ->modalContent(fn (Transaccion $record): View => view(
                    'filament.modals.transaccion-details',
                    ['record' => $record],
                ))
                ->modalSubmitAction(false)
                ->icon('heroicon-o-eye'),
            ])
            ->filters([
                Filter::make('Transacciones Exitosas')
                    ->query(fn (Builder $query) => $query->where('status', 1)),
                Filter::make('Transacciones Fallidas')
                    ->query(fn (Builder $query) => $query->where('status', 0)),
                Filter::make('created_at')
                ->form([
                    DatePicker::make('desde'),
                    DatePicker::make('hasta'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['desde'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['hasta'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
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