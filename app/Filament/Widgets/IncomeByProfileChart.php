<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class IncomeByProfileChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
