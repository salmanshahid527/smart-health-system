<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyPlaningChampionResource\Pages;
use App\Filament\Resources\FamilyPlaningChampionResource\RelationManagers;
use App\Models\FamilyPlaningChampion;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class FamilyPlaningChampionResource extends Resource
{
    protected static ?string $model = FamilyPlaningChampion::class;

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
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.union_council_code')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.contact_number')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta.address')
                    ->required()
                    ->maxLength(255),

                    Forms\Components\TextInput::make('meta.eduction')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta.marital_status')
                    ->required()
                    ->maxLength(255),
            ])->columns(2),
                Forms\Components\Section::make('Singup Details')
                ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
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
            'index' => Pages\ListFamilyPlaningChampions::route('/'),
            'create' => Pages\CreateFamilyPlaningChampion::route('/create'),
            'edit' => Pages\EditFamilyPlaningChampion::route('/{record}/edit'),
        ];
    }    
}
