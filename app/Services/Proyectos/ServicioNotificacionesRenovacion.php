<?php

namespace App\Services\Planes;

use App\Models\ProyectoPlanesActivos;
use App\Models\ProyectoClienteContacto;
use App\Notifications\RecordatorioRenovacionNotification;
use App\Notifications\PromocionRenovacionNotification;
use Carbon\Carbon;

class ServicioNotificacionesRenovacion
{
    public function enviarRecordatorioRenovacion(ProyectoPlanesActivos $plan)
    {
        $diasRestantes = Carbon::parse($plan->fecha_fin)->diffInDays(Carbon::today());

        if ($diasRestantes === 45) {
            $this->notifyContacts($plan, new RecordatorioRenovacionNotification($plan));
        }
    }

    public function enviarPromocionRenovacion(ProyectoPlanesActivos $plan)
    {
        if (!$plan->renovacion_automatica && Carbon::parse($plan->fecha_fin)->isPast()) {
            $this->notifyContacts($plan, new PromocionRenovacionNotification($plan));
        }
    }

    private function notifyContacts(ProyectoPlanesActivos $plan, $notification): void
    {
        $contactos = ProyectoClienteContacto::where('proyecto_cliente_id', $plan->proyecto_cliente_id)
            ->where('habilitado_correo', true)
            ->get();

        foreach ($contactos as $contacto) {
            $contacto->notify($notification);
        }
    }
}
