<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientReferralResource\Pages;
use App\Filament\Resources\ClientReferralResource\RelationManagers;
use App\Models\ClientReferral;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientReferralResource extends Resource
{
    protected static ?string $model = ClientReferral::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client Referral')
                ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'unique_id')
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('referral_date')
                    ->required(),
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
                    ->required(),
                    
                Forms\Components\Select::make('referrar_method')
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
                    ]),
                ])
                ->columns(2),
                Forms\Components\Section::make('Service Provider')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Service Provider')
                        ->relationship('serviceProvider', 'name')
                        ->searchable()
                        ->required(),
                    Forms\Components\DatePicker::make('visit_date')
                        ->required(),
                    Forms\Components\Select::make('adopted_method')
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
                        ]),
                
                    Forms\Components\Textarea::make('reason')
                        ->label('If no method is given, right reasons'),
                ])
                ->columns(2),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('referral_date')
                    ->date(),
                Tables\Columns\TextColumn::make('current_method'),
                Tables\Columns\TextColumn::make('referrar_method'),
                Tables\Columns\TextColumn::make('visit_date')
                    ->date(),
                Tables\Columns\TextColumn::make('adopted_method'),
                Tables\Columns\TextColumn::make('meta'),
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
            'index' => Pages\ListClientReferrals::route('/'),
            'create' => Pages\CreateClientReferral::route('/create'),
            'edit' => Pages\EditClientReferral::route('/{record}/edit'),
        ];
    }    
}
