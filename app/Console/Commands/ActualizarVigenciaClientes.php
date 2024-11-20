<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioVigenciaProyecto;

class ActualizarVigenciaClientes extends Command
{
    protected $signature = 'proyectos:actualizar-vigencia';
    protected $description = 'Actualiza la vigencia de los clientes basándose en sus fechas de contrato';

    public function handle()
    {
        $servicio = new ServicioVigenciaProyecto();
        $servicio->actualizarVigencia();

        $this->info('Vigencia actualizada exitosamente.');
    }
}
