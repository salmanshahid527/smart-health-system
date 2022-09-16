<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Closure;
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
            Forms\Components\Section::make('Client Details')
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
                Forms\Components\Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('contact_numbers')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_of_registration')
                    ->required(),
                Forms\Components\Toggle::make('consent_of_contact_back')
                    ->required(),
                Forms\Components\KeyValue::make('no_of_children')
                    ->default(["Girls" => "", "Boys" => ""])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->required(),
            ])->columns(3),
            Forms\Components\Section::make('Client Category')
            ->schema([
                    
                Forms\Components\Select::make('meta.type')
                        ->options([
                            'Current User' => 'Current User',
                            'Ever User' => 'Ever User',
                            'Never User' => 'Never User',
                        ])
                        ->required()
                        ->reactive(),
                    Forms\Components\Select::make('meta.current_method')
                        ->options([
                            'Condom' => 'Condom',
                            'Pills' => 'Pills',
                            'Injection' => 'Injection',
                            'IUD' => 'IUD',
                            'PPIUCD' => 'PPIUCD',
                            'Implant' => 'Implant',
                            'Male sterilization' => 'Male sterilization',
                            'Female sterilization' => 'Female sterilization',
                            'Withdrawal' => 'Withdrawal',
                            'Rhythm' => 'Rhythm',
                            'LAM (locational amenorrhea method)' => 'LAM (locational amenorrhea method)'
                        ])
                        ->required()
                        ->hidden(fn (Closure $get) => $get('meta.type') !== 'Current User'),
                    Forms\Components\TextInput::make('meta.period_of_months')
                        ->required()
                        ->numeric()
                        ->hidden(fn (Closure $get) => $get('meta.type') !== 'Current User'),
                        

                    Forms\Components\Select::make('meta.current_method')
                        ->options([
                            'Condom' => 'Condom',
                            'Pills' => 'Pills',
                            'Injection' => 'Injection',
                            'IUD' => 'IUD',
                            'PPIUCD' => 'PPIUCD',
                            'Implant' => 'Implant',
                            'Male sterilization' => 'Male sterilization',
                            'Female sterilization' => 'Female sterilization',
                            'Withdrawal' => 'Withdrawal',
                            'Rhythm' => 'Rhythm',
                            'LAM (locational amenorrhea method)' => 'LAM (locational amenorrhea method)'
                        ])
                        ->required()
                        ->hidden(fn (Closure $get) => $get('meta.type') !== 'Ever User'),
                    Forms\Components\Select::make('meta.reason_for_discontinuation')
                    //  17: Reasons for discontinuation: 1=Side effects, 2=Unavailability of products,       3=Affordability, 4=Husband and/or in law’s disagreement, 5=Desire of more children,  6=Other 
                        ->options([
                            'Side effects' => 'Side effects',
                            'Unavailability of products' => 'Unavailability of products',
                            'Affordability' => 'Affordability',
                            'Husband and/or in law’s disagreement' => 'Husband and/or in law’s disagreement',
                            'Desire of more children' => 'Desire of more children',
                            'Other'
                        ])
                        ->required()
                        ->hidden(fn (Closure $get) => $get('meta.type') !== 'Ever User'),
                        
                    Forms\Components\Select::make('meta.reason_for_never_use')
                    //  18: Reasons for never use: 1=Husband and/or in law’s disagreement, 2=Misconceptions/myths/religion, 3=Don’t have any idea about FP/lack of awareness, 4=Feel shy to discuss with husband, 5=Affordability, 6=Other (specify)___________
                        ->options([
                            'Husband and/or in law’s disagreement' => 'Husband and/or in law’s disagreement',
                            'Misconceptions/myths/religion' => 'Misconceptions/myths/religion',
                            'Don’t have any idea about FP/lack of awareness' => 'Don’t have any idea about FP/lack of awareness',
                            'Feel shy to discuss with husband' => 'Feel shy to discuss with husband',
                            'Affordability' => 'Affordability',
                            'Other'
                        ])
                        ->required()
                        ->hidden(fn (Closure $get) => $get('meta.type') !== 'Never User'),
                ])
                ->columns(2),
                Forms\Components\Select::make('registered_as')
                    ->options([
                        'House hold visit' => 'House hold visit',
                        'Neighborhood meeting' => 'Neighborhood meeting',
                        'Orientation meeting' => 'Orientation meeting',
                    ])
                    ->required(),

                Forms\Components\DateTimePicker::make('followup_date')
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
