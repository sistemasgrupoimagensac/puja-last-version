<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;
use Illuminate\Http\UploadedFile;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Grid::make()
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                
                TiptapEditor::make('content')
                    ->label('Content')
                    ->required()
                    ->profile('simple')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->disk('public')
                    ->directory('images/posts')
                    ->image()
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull()

                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ]),
        
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->url(fn ($record) => url('/blog/' . $record->slug))
                    ->openUrlInNewTab(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_publish')
                    ->label(fn ($record) => $record->is_published ? 'Ocultar' : 'Publicar')
                    ->icon(fn ($record) => $record->is_published ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->is_published ? 'danger' : 'success')
                    ->action(function ($record) {
                        $record->is_published = !$record->is_published;
                        $record->save();
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
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