<?php

namespace App\Filament\Resources\TransaccionResource\Widgets;

use Filament\Widgets\ChartWidget;

class TransactionChart extends ChartWidget
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
        return 'line';
    }
}
