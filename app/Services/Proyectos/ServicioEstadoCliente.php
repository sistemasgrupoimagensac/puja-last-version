<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCliente;

class ServicioEstadoCliente
{
    public function actualizarEstadoCliente(ProyectoCliente $cliente)
    {
        // Obtener el último pago pendiente o en reintento
        $ultimoPagoPendiente = $cliente->cronogramaPagos()
            ->whereIn('estado_pago_id', [1, 4]) // 1 = Pendiente, 4 = Reintento
            ->orderBy('fecha_programada', 'asc')
            ->first();
    
        // Verificar si el último pago está atrasado por más de 7 días
        $pagoCritico = $ultimoPagoPendiente && $ultimoPagoPendiente->fecha_programada->addDays(7)->isPast();
    
        // Actualizar el estado activo y al día
        $cliente->update([
            'activo' => $cliente->vigente && !$pagoCritico,
            // 'al_dia' => !$pagoCritico, // Si no hay pagos críticos, el cliente está al día
        ]);
    }
}