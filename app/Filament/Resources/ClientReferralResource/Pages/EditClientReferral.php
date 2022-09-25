<?php

namespace App\Filament\Resources\ClientReferralResource\Pages;

use App\Filament\Resources\ClientReferralResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientReferral extends EditRecord
{
    protected static string $resource = ClientReferralResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
