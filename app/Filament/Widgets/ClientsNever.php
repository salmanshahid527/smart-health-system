<?php

namespace App\Filament\Widgets;

use Filament\Widgets\DoughnutChartWidget;

class ClientsNever extends DoughnutChartWidget
{
    protected static ?string $heading = 'Never User';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Clients Never user',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                      ],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            
        ];
    }
}
