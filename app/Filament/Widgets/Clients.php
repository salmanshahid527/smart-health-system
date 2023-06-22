<?php
//https://bestofphp.com/repo/Flowframe-laravel-trend
namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Client;

class Clients extends LineChartWidget
{
    protected static ?string $heading = 'Clients';

    protected function getData(): array
    {
        $data = Trend::model(Client::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Clients created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' =>  $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
