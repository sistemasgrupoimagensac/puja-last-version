<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Tables\Actions\Action;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\TextInput::make('title')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('slug')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\Textarea::make('content')
    //                 ->required(),
    //             Forms\Components\Toggle::make('is_published')
    //                 ->label('Published')
    //                 ->default(false),
    //         ]);
    // }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                            ->columnSpan(6), // Título ocupa media pantalla
    
                        Forms\Components\TextInput::make('slug')
                            ->disabled()  // Deshabilita el campo de slug
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(6),  // Slug debajo del título en la derecha
    
                        TiptapEditor::make('content')
                            ->label('Content')
                            ->required()
                            ->profile('default')
                            ->columnSpanFull(),  // Editor de texto ocupa todo el ancho
                    ]),
            ]);
    }
    

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             //
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('title')->sortable(),
    //             IconColumn::make('is_published')
    //                 ->boolean() // Usa esto para mostrar íconos basados en true/false.
    //                 ->trueIcon('heroicon-o-check-circle') // Ícono para true.
    //                 ->falseIcon('heroicon-o-x-circle')    // Ícono para false.
    //                 ->trueColor('success') // Color para true.
    //                 ->falseColor('danger'), // Color para false.
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->dateTime(),
    //         ])
    //         ->filters([
    //             // Añadir filtros si es necesario
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->url(fn ($record) => url('/blog/' . $record->slug))  // URL pública basada en el slug
                    ->openUrlInNewTab(),  // Abre en una nueva pestaña
                IconColumn::make('is_published')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                // Añadir filtros si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Acción de editar ya existente
                Action::make('toggle_publish')
                    ->label(fn ($record) => $record->is_published ? 'Ocultar' : 'Publicar')
                    ->icon(fn ($record) => $record->is_published ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->is_published ? 'danger' : 'success')
                    ->action(function ($record) {
                        $record->is_published = !$record->is_published;
                        $record->save();
                    }),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
