<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionsResource\Pages;
use App\Filament\Resources\SessionsResource\RelationManagers;
use App\Models\Sessions;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class SessionsResource extends Resource
{
    protected static ?string $model = Sessions::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fp_champion_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('district')
                    ->maxLength(255),
                Forms\Components\TextInput::make('uc_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('reporting_month')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_of_participant')
                    ->maxLength(255),
                Forms\Components\TextInput::make('pwd')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('session_theme')
                    ->maxLength(255),
                Forms\Components\TextInput::make('meeting_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_reffered')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fp_champion_name'),
                Tables\Columns\TextColumn::make('district'),
                Tables\Columns\TextColumn::make('uc_name'),
                Tables\Columns\TextColumn::make('reporting_month'),
                Tables\Columns\TextColumn::make('name_of_participant'),
                Tables\Columns\TextColumn::make('pwd'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('session_theme'),
                Tables\Columns\TextColumn::make('meeting_type'),
                Tables\Columns\TextColumn::make('client_reffered'),
            ])
            ->filters([
                SelectFilter::make('district')
                    ->options([
                        'JHANG' => 'JHANG',
                        'RAJAN PUR' => 'RAJAN PUR'
                    ])
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
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSessions::route('/create'),
            'edit' => Pages\EditSessions::route('/{record}/edit'),
        ];
    }    
}
