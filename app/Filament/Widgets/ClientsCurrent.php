<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Client;

class ClientsCurrent extends BarChartWidget
{
    protected static ?string $heading = 'Current User';

    protected function getData(): array
    {
        $data = Trend::query(Client::where('type', 1))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Clients Current user',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)'
                        ]
                ],
            ],
            'labels' =>  $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
