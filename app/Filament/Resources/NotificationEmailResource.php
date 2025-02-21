<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationEmailResource\Pages;
use App\Filament\Resources\NotificationEmailResource\RelationManagers;
use App\Models\NotificationEmail;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationEmailResource extends Resource
{
    protected static ?string $model = NotificationEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    
    protected static ?string $navigationLabel = 'Notificaciones por correo';

    protected static ?int $navigationSort = 30;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view notificados') ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->required()
                ->email(),

                TextInput::make('owner_name')
                    ->label('Nombre del usuario')
                ->nullable(),

                Select::make('action_type')
                    ->label('Tipo de Notificación')
                    ->options([
                        NotificationEmail::ACTION_NEW_AD => 'Nuevo Aviso Publicado',
                        NotificationEmail::ACTION_NEW_CPE => 'Nuevo CPE',
                    ])
                ->required(),

                Toggle::make('status')
                    ->label('Activo')
                ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->label('Correo')->sortable()->searchable(),
                TextColumn::make('owner_name')->label('Usuario')->sortable(),
                TextColumn::make('action_type')
                    ->label('Tipo de Notificación')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        NotificationEmail::ACTION_NEW_AD => 'Nuevo Aviso Publicado',
                        NotificationEmail::ACTION_NEW_CPE => 'Nuevo CPE',
                        default => 'Desconocido'
                    }),
                    ToggleColumn::make('status')
                        ->label('Activo')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('action_type')
                    ->options([
                        NotificationEmail::ACTION_NEW_AD => 'Nuevo Aviso Publicado',
                        NotificationEmail::ACTION_NEW_CPE => 'Nuevo CPE',
                    ])
                ->label('Filtrar por Tipo'),
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
            'index' => Pages\ListNotificationEmails::route('/'),
            'create' => Pages\CreateNotificationEmail::route('/create'),
            'edit' => Pages\EditNotificationEmail::route('/{record}/edit'),
        ];
    }
}
