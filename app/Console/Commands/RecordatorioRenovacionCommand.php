<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioRenovacionYNotificaciones;
use App\Models\ProyectoPlanesActivos;

class RecordatorioRenovacionCommand extends Command
{
    protected $signature = 'renovacion:recordatorio';
    protected $description = 'Envia recordatorios de renovación automática a los usuarios 45 días antes de que finalice su contrato.';

    protected $servicio;

    public function __construct(ServicioRenovacionYNotificaciones $servicio)
    {
        parent::__construct();
        $this->servicio = $servicio;
    }

    public function handle()
    {
        ProyectoPlanesActivos::conRenovacion()->get()->each(
            fn($plan) => $this->servicio->enviarRecordatorioRenovacion($plan)
        );
        $this->info('Recordatorios de renovación enviados.');
    }
}
