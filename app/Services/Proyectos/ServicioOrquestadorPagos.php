<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCronogramaPago;

class ServicioOrquestadorPagos
{
    protected $debitoAutomatico;

    public function __construct(ServicioDebitoAutomatico $debitoAutomatico)
    {
        $this->debitoAutomatico = $debitoAutomatico;
    }

    /**
     * Procesa los pagos pendientes para el día de hoy.
     */
    public function procesarPagos(): void
    {
        ProyectoCronogramaPago::pendientesHoy()
            ->get()
            ->each(fn($pago) => $this->debitoAutomatico->gestionarPago($pago));
    }
}
