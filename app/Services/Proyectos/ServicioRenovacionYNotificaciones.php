<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoPlanesActivos;
use App\Notifications\RecordatorioRenovacionNotification;
use App\Notifications\PromocionRenovacionNotification;

class ServicioRenovacionYNotificaciones
{
    public function enviarRecordatorioRenovacion(ProyectoPlanesActivos $plan)
    {
        if ($plan->diasRestantes() === 45) {
            $plan->proyectoCliente->notificar(new RecordatorioRenovacionNotification($plan));
        }
    }

    public function enviarPromocionRenovacion(ProyectoPlanesActivos $plan)
    {
        if (!$plan->renovacion_automatica && $plan->estado === 'activo') {
            $plan->proyectoCliente->notificar(new PromocionRenovacionNotification($plan));
        }
    }
}
