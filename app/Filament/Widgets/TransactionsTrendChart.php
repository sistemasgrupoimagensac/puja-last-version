<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionsTrendChart extends ChartWidget
{
    protected static ?string $maxHeight = '400px';

    public ?string $filter = 'week';

    public function getColumnSpan(): int|string|array
    {
        return [
            'xl' => 2,
            'lg' => 2,
            'md' => 1,
            'sm' => 1,
        ];
    }

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

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => false,  // Esta línea oculta la leyenda
                ],
            ],
            'scales' => [
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Período',
                    ],
                ],
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Transacciones',
                    ],
                    'beginAtZero' => true,
                ],
            ],
        ];
    }


    public function getDescription(): ?string
    {
        return 'Número de transacciones exitosas en el tiempo';
    }

    protected function getType(): string
    {
        return 'line';
    }
}