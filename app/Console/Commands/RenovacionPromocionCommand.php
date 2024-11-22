<?php

namespace App\Console\Commands;

use App\Models\ProyectoPlanesActivos;
use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioRenovacionYNotificaciones;

class RenovacionPromocionCommand extends Command
{
    protected $signature = 'renovacion:promocion';
    protected $description = 'Envía promociones para renovar planes.';

    protected $servicio;

    public function __construct(ServicioRenovacionYNotificaciones $servicio)
    {
        parent::__construct();
        $this->servicio = $servicio;
    }

    public function handle()
    {
        ProyectoPlanesActivos::sinRenovacion()->get()->each(
            fn($plan) => $this->servicio->enviarPromocionRenovacion($plan)
        );
        $this->info('Promociones enviadas.');
    }
}
