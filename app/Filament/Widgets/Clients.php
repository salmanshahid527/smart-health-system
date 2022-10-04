<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class Clients extends LineChartWidget
{
    protected static ?string $heading = 'Clients';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Clients created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
