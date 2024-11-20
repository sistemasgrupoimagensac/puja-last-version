<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioEstadoPagos;

class ActualizarEstadoPagos extends Command
{
    protected $signature = 'proyectos:actualizar-estado-pagos';
    protected $description = 'Actualiza el estado de pagos de los clientes basándose en su cronograma';

    public function handle()
    {
        $servicio = new ServicioEstadoPagos();
        $servicio->actualizarEstadoPagos();

        $this->info('Estado de pagos actualizado exitosamente.');
    }
}
