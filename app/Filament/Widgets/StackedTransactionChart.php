<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;
use Filament\Widgets\ChartWidget;

class StackedTransactionChart extends ChartWidget
{
    protected static ?string $maxHeight = '260px';

    public ?string $filter = 'week';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        
        // Define rangos según el filtro seleccionado
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

        // Consulta para transacciones exitosas (status = 1) y fallidas (status = 0) agrupadas por tipo_usuario_id
        $successTransactions = Transaccion::selectRaw('tipo_usuario_id, COUNT(*) as total')
            ->where('status', 1)
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tipo_usuario_id')
            ->pluck('total', 'tipo_usuario_id');

        $failedTransactions = Transaccion::selectRaw('tipo_usuario_id, COUNT(*) as total')
            ->where('status', 0)
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tipo_usuario_id')
            ->pluck('total', 'tipo_usuario_id');

        // Mapa para traducir tipo_usuario_id a etiquetas legibles
        $tipoUsuarioLabels = [
            2 => 'Propietario',
            3 => 'Corredor',
            4 => 'Acreedor',
            5 => 'Proyectos',
        ];

        // Tipo de usuarios presentes en el sistema
        $perfiles = [2, 3, 4, 5];

        // Datos para cada perfil
        $successData = [];
        $failedData = [];

        foreach ($perfiles as $perfil) {
            $successData[] = $successTransactions[$perfil] ?? 0;
            $failedData[] = $failedTransactions[$perfil] ?? 0;
        }

        // Reemplazamos los números 2, 3, 4 por sus nombres en el eje X
        $labels = array_map(fn($perfil) => $tipoUsuarioLabels[$perfil], $perfiles);

        return [
            'datasets' => [
                [
                    'label' => 'Transacciones Exitosas',
                    'backgroundColor' => '#00e673',
                    'borderColor' => 'rgba(0, 0, 0, 0)',
                    'borderWidth' => 0,
                    'data' => $successData,
                ],
                [
                    'label' => 'Transacciones Fallidas',
                    'backgroundColor' => '#ff3333',
                    'borderColor' => 'rgba(0, 0, 0, 0)',
                    'borderWidth' => 0,
                    'data' => $failedData,
                ],
            ],
            
            'labels' => $labels,  // Usamos las etiquetas legibles en lugar de los números
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

    protected function getType(): string
    {
        return 'bar';  // Gráfico de barras
    }

    public function getDescription(): ?string
    {
        return 'Distribución de transacciones por perfil';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => true,  // Apilado en el eje X
                ],
                'y' => [
                    'stacked' => true,  // Apilado en el eje Y
                    'ticks' => [
                        'beginAtZero' => true,  // Asegura que empiece desde 0
                        'stepSize' => 1,  // Incrementos de 1 en el eje Y
                    ],
                ],
            ],
        ];
    }
    
}
