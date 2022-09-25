<?php

namespace App\Filament\Resources\FamilyPlaningChampionResource\Pages;

use App\Filament\Resources\FamilyPlaningChampionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilyPlaningChampions extends ListRecords
{
    protected static string $resource = FamilyPlaningChampionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
