<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCliente;
use Carbon\Carbon;

class ServicioEstadoCliente
{
    public function actualizarEstadoCliente(ProyectoCliente $cliente)
    {
        $ultimoPagoPendiente = $cliente->cronogramaPagos()
            ->whereIn('estado_pago_id', [1, 4]) // 1 = Pendiente, 4 = Reintento
            ->orderBy('fecha_programada', 'asc')
            ->first();

        $pagoCritico = $ultimoPagoPendiente && $ultimoPagoPendiente->fecha_programada->addDays(7)->isPast();

        $vigente = $cliente->vigente;

        $cliente->update([
            'al_dia' => !$pagoCritico,
            'vigente' => $vigente,
            'activo' => $vigente && !$pagoCritico,
        ]);
    }
}
