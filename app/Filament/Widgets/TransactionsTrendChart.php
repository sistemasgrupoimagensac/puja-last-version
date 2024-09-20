<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionsTrendChart extends ChartWidget
{
    protected static ?string $maxHeight = '400px';
    protected static ?string $maxWidth = '100%'; // Para que ocupe todo el ancho posible
    public ?string $filter = 'today'; // El filtro por defecto es 'año'

    // Hacemos que ocupe dos espacios de ancho
    public function getColumnSpan(): int
    {
        return 2; // El widget ocupará 2 columnas
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        
        // Definir el rango de fechas según el filtro seleccionado
        switch ($activeFilter) {
            case 'today':
                $start = now()->startOfDay();
                $end = now()->endOfDay();
                $dateFormat = '%H:%i'; // Formato para mostrar por horas en el día
                break;
            case 'week':
                $start = now()->startOfWeek();
                $end = now()->endOfWeek();
                $dateFormat = '%d %b'; // Formato para mostrar por días de la semana
                break;
            case 'month':
                $start = now()->startOfMonth();
                $end = now()->endOfMonth();
                $dateFormat = '%d %b'; // Formato para mostrar por días del mes
                break;
            case 'year':
            default:
                $start = now()->startOfYear();
                $end = now()->endOfYear();
                $dateFormat = '%b'; // Formato para mostrar por meses del año
                break;
        }

        // Consulta para obtener la cantidad de transacciones por tipo de usuario desglosadas por el rango de fechas
        $transactionData = Transaccion::select(
            DB::raw("DATE_FORMAT(created_at, '$dateFormat') as period"),
            'tipo_usuario_id',
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('period', 'tipo_usuario_id')
        ->orderBy('created_at')
        ->get();

        // Etiquetas de perfiles
        $profileLabels = [
            2 => 'Propietario',
            3 => 'Corredor',
            4 => 'Acreedor',
        ];

        // Preparar los datos para cada perfil
        $datasets = [];
        $profileData = [];
        $labels = [];

        // Inicializamos un array para cada perfil
        foreach ($profileLabels as $profileId => $profileName) {
            $profileData[$profileId] = [];
        }

        // Rellenamos los datos para cada perfil y agregamos los labels (fechas formateadas)
        foreach ($transactionData as $data) {
            $labels[] = $data->period;
            $profileData[$data->tipo_usuario_id][$data->period] = $data->total;
        }

        // Asegurarnos de que los labels sean únicos
        $labels = array_unique($labels);

        // Generar los datasets para el gráfico de líneas
        foreach ($profileLabels as $profileId => $profileName) {
            $datasets[] = [
                'label' => $profileName,
                'data' => array_map(fn($label) => $profileData[$profileId][$label] ?? 0, $labels),  // Usar 0 si no hay datos
                'borderColor' => $this->getProfileColor($profileId),
                'fill' => false, // No rellenar debajo de la línea
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => array_values($labels), // Etiquetas de tiempo (día, semana, mes, etc.)
        ];
    }

    // Método para obtener el color de la línea según el perfil
    protected function getProfileColor($profileId)
    {
        $colors = [
            2 => '#FF9999',  // Color para Propietario
            3 => '#66B2FF',  // Color para Corredor
            4 => '#99FF99',  // Color para Acreedor
        ];

        return $colors[$profileId] ?? '#CCCCCC'; // Color por defecto si no hay coincidencia
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
        return 'line';  // Gráfico de líneas
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'top',  // Posición de la leyenda
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
                        'text' => 'Número de Transacciones',
                    ],
                    'beginAtZero' => true,  // Empieza el eje Y desde 0
                ],
            ],
        ];
    }
}
