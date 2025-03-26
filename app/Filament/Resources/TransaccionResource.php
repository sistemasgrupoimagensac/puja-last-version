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

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Transacciones';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view transactions') ?? false;
    }

    public static function getModelLabel(): string
    {
        return 'Transacción';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Transacciones';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('creation_date')
                    ->label('Fecha y Hora de Transacción')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('d/m/Y - H:i'))
                    ->sortable(),
                TextColumn::make('customer_name')
                    ->label('Nombre')
                    ->sortable()
                    ->formatStateUsing(fn (Transaccion $record): string => $record->customer_name )
                    ->description(fn (Transaccion $record): ?string => $record->customer_email ),

                TextColumn::make('amount')
                    ->label('Monto')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 2)),
                TextColumn::make('status')
                ->label('Estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    '0' => 'danger',
                    '1' => 'success',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    '0' => 'Fallida',
                    '1' => 'Exitosa',
                }),
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
