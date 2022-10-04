<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class ClientsCurrent extends BarChartWidget
{
    protected static ?string $heading = 'Current User';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Clients Current user',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)'
                        ]
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            
        ];
    }
}
