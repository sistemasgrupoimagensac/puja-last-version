<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;
use Filament\Widgets\ChartWidget;

class IncomeByProfileChart extends ChartWidget
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

        // Consulta los ingresos totales agrupados por el tipo de perfil de usuario
        $incomeData = Transaccion::selectRaw('tipo_usuario_id, SUM(amount) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tipo_usuario_id')
            ->pluck('total', 'tipo_usuario_id');
        
        // Mapeamos tipo_usuario_id a nombres legibles
        $profileLabels = [
            2 => 'Propietario',
            3 => 'Corredor',
            4 => 'Acreedor',
        ];

        // Preparar etiquetas y datos para el gráfico
        $labels = [];
        $data = [];

        foreach ($incomeData as $profileId => $totalIncome) {
            // Incluimos el monto acumulado (con formato S/) entre paréntesis en la etiqueta
            $label = $profileLabels[$profileId] ?? 'Desconocido';
            $formattedIncome = number_format($totalIncome, 2);  // Formatear el monto con dos decimales
            $labels[] = "$label (S/ $formattedIncome)";  // Concatenamos el nombre con el monto
            $data[] = $totalIncome;
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'borderWidth' => 0,
                    'backgroundColor' => ['#FF9999', '#66B2FF', '#99FF99'],  // Colores personalizados para cada perfil
                ],
            ],
            'labels' => $labels,
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
        return 'pie';  // Gráfico de torta
    }

    public function getDescription(): ?string
    {
        return 'Ingresos por perfil de usuario';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'position' => 'left',  // Posición de la leyenda
                    'labels' => [
                        'padding' => 20,
                    ]
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,  // Eliminar el eje X
                ],
                'y' => [
                    'display' => false,  // Eliminar el eje Y
                ],
            ],
        ];
    }
    
}
