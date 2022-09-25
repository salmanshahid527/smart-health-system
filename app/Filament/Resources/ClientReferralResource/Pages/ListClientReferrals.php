<?php

namespace App\Filament\Resources\ClientReferralResource\Pages;

use App\Filament\Resources\ClientReferralResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientReferrals extends ListRecords
{
    protected static string $resource = ClientReferralResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
