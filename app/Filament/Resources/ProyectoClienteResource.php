<?php

// namespace App\Filament\Resources;

// use App\Filament\Resources\ProyectoClienteResource\Pages;
// use App\Filament\Resources\ProyectoClienteResource\RelationManagers;
// use App\Models\ProyectoCliente;
// use Filament\Forms;
// use Filament\Forms\Form;
// use Filament\Resources\Resource;
// use Filament\Tables;
// use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

// class ProyectoClienteResource extends Resource
// {
//     protected static ?string $model = ProyectoCliente::class;

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
//             'index' => Pages\ListProyectoClientes::route('/'),
//             'create' => Pages\CreateProyectoCliente::route('/create'),
//             'edit' => Pages\EditProyectoCliente::route('/{record}/edit'),
//         ];
//     }
// }


namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoClienteResource\Pages;
use App\Models\ProyectoCliente;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProyectoClienteResource extends Resource
{
    protected static ?string $model = ProyectoCliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Inmobiliaria')
                    ->schema([
                        Forms\Components\TextInput::make('razon_social')->required()->label('Razón Social'),
                        Forms\Components\TextInput::make('ruc')->required()->label('RUC'),
                        Forms\Components\TextInput::make('direccion_fiscal')->required()->label('Dirección Fiscal'),
                        Forms\Components\TextInput::make('telefono_inmobiliaria')->label('Teléfono de la Inmobiliaria'),
                        Forms\Components\TextInput::make('nombre_comercial')->label('Nombre Comercial'),
                    ]),

                Forms\Components\Section::make('Información del Representante')
                    ->schema([
                        Forms\Components\TextInput::make('representante_legal')->label('Representante Legal'),
                        Forms\Components\TextInput::make('direccion_representante')->label('Dirección del Representante'),
                    ]),

                Forms\Components\Section::make('Información de Contacto')
                    ->schema([
                        Forms\Components\TextInput::make('nombre_contacto')->required()->label('Nombre de la Persona de Contacto'),
                        Forms\Components\TextInput::make('telefono_contacto')->required()->label('Teléfono de la Persona de Contacto'),
                        Forms\Components\TextInput::make('email_contacto')->required()->email()->label('Correo de la Persona de Contacto'),
                    ]),

                Forms\Components\Section::make('Datos del Contrato')
                    ->schema([
                        Forms\Components\DatePicker::make('fecha_inicio_contrato')->required()->label('Fecha de Inicio del Contrato'),
                        Forms\Components\DatePicker::make('fecha_fin_contrato')->required()->label('Fecha de Finalización del Contrato'),
                        Forms\Components\TextInput::make('numero_anuncios')
                            ->numeric()
                            ->label('Número de Anuncios')
                            ->default(1)
                            ->minValue(1),
                    ]),

                Forms\Components\Section::make('Credenciales de Usuario')
                    ->schema([
                        Forms\Components\TextInput::make('user_email')
                            ->label('Correo Electrónico de Inicio de Sesión')
                            ->required(),

                        Forms\Components\TextInput::make('user_password')
                            ->label('Contraseña')
                            ->password()
                            ->default(fn () => Str::random(10)) // Contraseña aleatoria
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('razon_social')->label('Razón Social'),
                Tables\Columns\TextColumn::make('ruc')->label('RUC'),
                Tables\Columns\TextColumn::make('nombre_contacto')->label('Nombre de Contacto'),
                Tables\Columns\TextColumn::make('user.email')->label('Correo Electrónico'),
                Tables\Columns\TextColumn::make('fecha_inicio_contrato')->label('Inicio de Contrato'),
                Tables\Columns\TextColumn::make('fecha_fin_contrato')->label('Fin de Contrato'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyectoClientes::route('/'),
            'create' => Pages\CreateProyectoCliente::route('/create'),
            'edit' => Pages\EditProyectoCliente::route('/{record}/edit'),
        ];
    }
}
