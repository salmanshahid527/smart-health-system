<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceProviderResource\Pages;
use App\Filament\Resources\ServiceProviderResource\RelationManagers;
use App\Models\ServiceProvider;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class ServiceProviderResource extends Resource
{
    protected static ?string $model = ServiceProvider::class;

    protected static ?string $navigationLabel = 'Service Providers';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Section::make('Personal Details')
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.union_council_name')
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.union_council_code')
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.contact_number')
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.address')
                    ->maxLength(255),

                    Forms\Components\TextInput::make('meta.eduction')
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta.marital_status')
                    ->maxLength(255),
            ])->columns(2),
                Forms\Components\Section::make('Singup Details')
                ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique(ServiceProvider::class, 'email', fn ($record) => $record)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListServiceProviders::route('/'),
            'create' => Pages\CreateServiceProvider::route('/create'),
            'edit' => Pages\EditServiceProvider::route('/{record}/edit'),
        ];
    }    
}
