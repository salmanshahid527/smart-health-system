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
                    ->integer(),
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
                    ->default(["Girls" => "", "Boys" => "", "Total" => ""])
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys(),
            ])->columns(3),
            Forms\Components\Section::make('Client Category')
            ->schema([
                    
                Forms\Components\Select::make('type')
                        ->options([
                            1 => 'Current User',
                            2 => 'Ever User',
                            3 => 'Never User',
                        ])
                        ->required()
                        ->reactive(),
                    Forms\Components\Select::make('current_method')
                    // 14: Current and 16 Ever Methods: 
                    // 1= condom, 2= pills, 3= injection, 4=IUD, 5=PPIUCD, 6= Implant, 7= male sterilization, 8= female sterilization, 9=withdrawal, 10=rhythm, 11=LAM (locational amenorrhea method)
                        ->options([
                            1 => 'Condom',
                            2 => 'Pills',
                            3 => 'Injection',
                            4 => 'IUD',
                            5 => 'PPIUCD',
                            6 => 'Implant',
                            7 => 'Male sterilization',
                            8 => 'Female sterilization',
                            9 => 'Withdrawal',
                            10 => 'Rhythm',
                            11 => 'LAM (locational amenorrhea method)'
                        ])
                        ->required()
                        // ->reactive()
                        ->hidden(function (Closure $get) {
                            return !in_array($get('type'), [1]);
                        }),
                    Forms\Components\TextInput::make('period_months')
                        ->required()
                        ->integer()
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->range()
                            ->from(1) // Set the lower limit.
                            ->to(99) // Set the upper limit.
                            ->maxValue(99), // Pad zeros at the start of smaller numbers.
                        )
                        ->hidden(function (Closure $get) {
                            return !in_array($get('type'), [1]);
                        }),
                        

                    Forms\Components\Select::make('current_method')
                    ->label('Ever Method')
                        ->options([
                            1 => 'Condom',
                            2 => 'Pills',
                            3 => 'Injection',
                            4 => 'IUD',
                            5 => 'PPIUCD',
                            6 => 'Implant',
                            7 => 'Male sterilization',
                            8 => 'Female sterilization',
                            9 => 'Withdrawal',
                            10 => 'Rhythm',
                            11 => 'LAM (locational amenorrhea method)'
                        ])
                        ->required()
                        ->hidden(function (Closure $get) {
                            return !in_array($get('type'), [2]);
                        }),
                    Forms\Components\Select::make('reason')
                    ->label('Reason for Discontinuation')
                    //  17: Reasons for discontinuation: 
                    // 1=Side effects, 2=Unavailability of products,       3=Affordability, 4=Husband and/or in law’s disagreement, 5=Desire of more children,  6=Other 
                        ->options([
                            1 => 'Side effects',
                            2 => 'Unavailability of products',
                            3 => 'Affordability',
                            4 => 'Husband and/or in law’s disagreement',
                            5 => 'Desire of more children',
                            6 => 'Other'
                        ])
                        ->required()
                        ->hidden(function (Closure $get){
                            return in_array($get('type'), [1,3]);
                        }),
                        
                    Forms\Components\Select::make('reason')
                    //  18: Reasons for never use: 1=Husband and/or in law’s disagreement, 2=Misconceptions/myths/religion, 3=Don’t have any idea about FP/lack of awareness, 4=Feel shy to discuss with husband, 5=Affordability, 6=Other (specify)___________
                        ->options([
                            1 => 'Husband and/or in law’s disagreement',
                            2 => 'Misconceptions/myths/religion',
                            3 => 'Don’t have any idea about FP/lack of awareness',
                            4 => 'Feel shy to discuss with husband',
                            5 => 'Affordability',
                            6 => 'Other'
                        ])
                        ->required()
                        ->hidden(function (Closure $get){
                            return in_array($get('type'), [1,2]);
                        }),
                ])
                ->columns(2),
                Forms\Components\Select::make('registered_at')
                    ->options([
                        'HHV' => 'House hold visit',
                        'NM' => 'Neighborhood meeting',
                        'OM' => 'Orientation meeting',
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
