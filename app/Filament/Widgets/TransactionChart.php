<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionChart extends ChartWidget
{

    public ?string $filter = 'week';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        
        $transaccionesExitosasQuery = Transaccion::where('status', 1);

        switch ($activeFilter) {
            case 'today':
                $start = now()->startOfDay();
                $end = now()->endOfDay();
                break;
            case 'week':
                $start = now()->startOfWeek();
                $end = now()->endOfWeek();
                break;
            case 'month':
                $start = now()->startOfMonth();
                $end = now()->endOfMonth();
                break;
            case 'year':
                $start = now()->startOfYear();
                $end = now()->endOfYear();
                break;
            default:
                $start = now()->startOfMonth();
                $end = now()->endOfMonth();
                break;
        }

        // Filtra las transacciones dentro del rango especificado
        $data = Trend::query($transaccionesExitosasQuery)
            ->between(
                start: $start,
                end: $end,
            )
            ->perDay()
            ->sum('amount');

        return [
            'datasets' => [
                [
                    'label' => 'Monto de transacciones exitosas',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hoy',
            'week' => 'Esta semana',
            'month' => 'Este mes',
            'year' => 'Este Año',
        ];
    }

    public function getDescription(): ?string
    {
        return 'The number of blog posts published per month.';
    }

    protected function getType(): string
    {
        return 'line';
    }
}
