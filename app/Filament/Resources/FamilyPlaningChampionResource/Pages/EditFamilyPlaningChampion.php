<?php

namespace App\Filament\Resources\FamilyPlaningChampionResource\Pages;

use App\Filament\Resources\FamilyPlaningChampionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilyPlaningChampion extends EditRecord
{
    protected static string $resource = FamilyPlaningChampionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
