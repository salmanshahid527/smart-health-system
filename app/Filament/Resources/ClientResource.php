<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unique_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('spouse_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mother_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_numbers')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_of_registration')
                    ->required(),
                Forms\Components\DateTimePicker::make('followup_date')
                    ->required(),
                Forms\Components\Toggle::make('consent_of_contact_back')
                    ->required(),
                Forms\Components\KeyValue::make('no_of_children')
                    ->default(["Girls" => "", "Boys" => ""])
                    
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'current-user' => 'Current User',
                        'ever-user' => 'Ever User',
                        'never-user' => 'Never User',
                    ])
                    ->required(),
                Forms\Components\Select::make('registered_at')
                    ->options([
                        'HHV' => 'HHV',
                        'NHM' => 'NHM',
                        'OM' => 'OM',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('unique_id'),
                Tables\Columns\TextColumn::make('spouse_name'),
                Tables\Columns\TextColumn::make('mother_name'),
                Tables\Columns\TextColumn::make('contact_numbers'),
                Tables\Columns\TextColumn::make('addresses'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('date_of_registration')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('followup_date')
                    ->dateTime(),
                Tables\Columns\BooleanColumn::make('consent_of_contact_back'),
                Tables\Columns\TextColumn::make('no_of_children'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('registered_at'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }    
}
