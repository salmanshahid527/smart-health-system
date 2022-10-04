<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use Filament\Widgets\LineChartWidget;

class Clients extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }
}
