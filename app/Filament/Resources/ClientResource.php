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
                    ->autofocus()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unique_id')
                    ->required()
                    ->unique(Client::class, 'unique_id', fn ($record) => $record)
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
                Forms\Components\TextInput::make('contact_number')
                    ->integer()
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->required(),
                Forms\Components\TextInput::make('age_years')
                    ->integer()
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->range()
                        ->from(1) // Set the lower limit.
                        ->to(99) // Set the upper limit.
                        ->maxValue(99), // Pad zeros at the start of smaller numbers.
                    ),
                Forms\Components\DatePicker::make('date_of_registration')
                    ->required(),
                Forms\Components\Toggle::make('pwd')->label('PWD Y/N')->default(true),
                Forms\Components\Toggle::make('consent_of_contact_back')->default(true),
                Forms\Components\Toggle::make('referred')
                    ->label('Client referred?')
                    ->default(true),
                Forms\Components\KeyValue::make('no_of_children')
                    ->default(["Girls" => "", "Boys" => ""])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
                    ->required(),
            ])->columns(3),
            Forms\Components\Section::make('Client Category')
            ->schema([
                    
                Forms\Components\Select::make('type')
                        ->options([
                            'Current User' => 'Current User',
                            'Ever User' => 'Ever User',
                            'Never User' => 'Never User',
                        ])
                        ->required()
                        ->reactive(),
                    Forms\Components\Select::make('current_method')
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
                        ->hidden(fn (Closure $get) => $get('type') !== 'Current User'),
                    Forms\Components\TextInput::make('period_months')
                        ->required()
                        ->integer()
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->range()
                            ->from(1) // Set the lower limit.
                            ->to(99) // Set the upper limit.
                            ->maxValue(99), // Pad zeros at the start of smaller numbers.
                        )
                        ->hidden(fn (Closure $get) => $get('type') !== 'Current User'),
                        

                    Forms\Components\Select::make('current_method')
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
                        ->hidden(fn (Closure $get) => $get('type') !== 'Ever User'),
                    Forms\Components\Select::make('reason_for_discontinuation')
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
                        ->hidden(fn (Closure $get) => $get('type') !== 'Ever User'),
                        
                    Forms\Components\Select::make('reason_for_never_use')
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
                        ->hidden(fn (Closure $get) => $get('type') !== 'Never User'),
                ])
                ->columns(2),
                Forms\Components\Select::make('registered_at')
                    ->options([
                        'House hold visit' => 'House hold visit',
                        'Neighborhood meeting' => 'Neighborhood meeting',
                        'Orientation meeting' => 'Orientation meeting',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('followup_date')
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
                Tables\Columns\TextColumn::make('contact_number'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('date_of_registration')
                    ->date(),
                Tables\Columns\TextColumn::make('followup_date')
                    ->date(),
                Tables\Columns\BooleanColumn::make('consent_of_contact_back'),
                Tables\Columns\TextColumn::make('no_of_children'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('registered_at'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
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
