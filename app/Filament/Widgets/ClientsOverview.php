<?php
namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\FamilyPlaningChampion;
use App\Models\ServiceProvider;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
 
class ClientsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Clients', Client::all()->count()),
            Card::make('Total FP Champion', FamilyPlaningChampion::all()->count()),
            Card::make('Total Service Providers', ServiceProvider::all()->count()),
        ];
    }
}