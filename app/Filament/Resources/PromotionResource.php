<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Filament\Resources\PromotionResource\RelationManagers;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view promotions') ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('percentage')
                    ->label('Porcentaje de descuento')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01) // para decimales .01
                ->required(),

                Toggle::make('status')
                    ->label('Estado activo')
                ->default(true),

                DatePicker::make('promo_start')
                    ->label('Inicio de promoción')
                    ->displayFormat('Y-m-d')
                ->required(),

                DatePicker::make('promo_end')
                    ->label('Fin de promoción')
                    ->displayFormat('Y-m-d')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                ->searchable(),
                
                TextColumn::make('percentage')
                    ->label('Porcentaje')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->sortable()
                ->searchable(),

                TextColumn::make('promo_start')
                    ->label('Inicio')
                    ->date()
                ->sortable(),

                TextColumn::make('promo_end')
                    ->label('Fin')
                    ->date()
                ->sortable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn ($state) => $state ? 'Activo' : 'Inactivo')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
