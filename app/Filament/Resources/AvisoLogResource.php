<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvisoLogResource\Pages;
use App\Filament\Resources\AvisoLogResource\RelationManagers;
use App\Models\AvisoLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AvisoLogResource extends Resource
{
    protected static ?string $model = AvisoLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Log de avisos';
    protected static ?int $navigationSort = 32;

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
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('aviso_id')->label('ID Aviso')->sortable(),
                Tables\Columns\TextColumn::make('type')->label('Acción'),
                Tables\Columns\TextColumn::make('request')
                    ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->limit(80)
                    ->wrap(),
                Tables\Columns\BooleanColumn::make('success')->label('Éxito'),
                Tables\Columns\TextColumn::make('user.email')->label('Usuario')->default('Sistema'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Fecha'),
            ])
            ->filters([
                SelectFilter::make('aviso_id')
                    ->label('Filtrar por Aviso')
                    ->options(
                        \App\Models\Aviso::pluck('id', 'id')->toArray()
                    )
                    ->searchable(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAvisoLogs::route('/'),
            /* 'create' => Pages\CreateAvisoLog::route('/create'),
            'view' => Pages\ViewAvisoLog::route('/{record}'),
            'edit' => Pages\EditAvisoLog::route('/{record}/edit'), */
        ];
    }
}
