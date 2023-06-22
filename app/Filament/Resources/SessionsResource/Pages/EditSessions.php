<?php

namespace App\Filament\Resources\SessionsResource\Pages;

use App\Filament\Resources\SessionsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSessions extends EditRecord
{
    protected static string $resource = SessionsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
