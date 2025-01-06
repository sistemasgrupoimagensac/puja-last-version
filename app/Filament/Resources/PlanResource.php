<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('package_id')
                    ->label('Paquete')
                    // Relationship: (nombre de la relación, campo a mostrar)
                    ->relationship('package', 'name')
                    // Si deseas listar por algo más complejo, puedes usar ->options(...)
                    // ->placeholder('Sin promoción')
                    ->searchable()
                ->preload(),

                TextInput::make('name')
                    ->label('Nombre del Plan')
                    ->required()
                ->maxLength(255),

                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                ->required(),

                TextInput::make('duration_in_days')
                    ->label('Duración (días)')
                    ->numeric()
                ->required(),

                Select::make('promotion_id')
                    ->label('Promoción')
                    // Relationship: (nombre de la relación, campo a mostrar)
                    ->relationship('promotion', 'percentage')
                    // Si deseas listar por algo más complejo, puedes usar ->options(...)
                    ->placeholder('Sin promoción')
                    ->searchable()
                    ->preload()
                ->nullable(), // Permitir nulo
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('ID')
                ->sortable(), // Habilita el ordenamiento por ID
                
                TextColumn::make('package.name')
                    ->label('Paquete')
                    ->sortable()
                ->searchable(),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                ->sortable(),

                TextColumn::make('price')
                    ->label('Precio')
                    ->formatStateUsing(fn ($state) => 'S/ '. $state)
                    ->searchable()
                ->sortable(),
            
                TextColumn::make('duration_in_days')
                    ->label('Duración')
                    ->formatStateUsing(fn ($state) => $state . ' días')
                ->sortable(),
            
                TextColumn::make('total_ads')
                    ->label('Total avisos')
                ->sortable(),

                TextColumn::make('promotion.percentage')
                    ->label('Promo (%)')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->sortable()
                ->searchable(),

                // TextColumn::make('promotion.status')
                //     ->label('Estado Promo')
                //     ->formatStateUsing(fn ($state) => $state ? 'Activo' : 'Inactivo')
                // ->sortable(),

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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
