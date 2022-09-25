<?php

namespace App\Filament\Resources\FamilyPlaningChampionResource\Pages;

use App\Filament\Resources\FamilyPlaningChampionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFamilyPlaningChampion extends CreateRecord
{
    protected static string $resource = FamilyPlaningChampionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'fpc';
        return $data;
    }
}
