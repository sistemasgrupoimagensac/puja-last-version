<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCliente;
use App\Models\ProyectoPagoEstado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class ServicioEstadoPagos
{
    public function actualizarEstadoPagos()
    {

        Log::info("servicio: estado de pago");

        $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first();
        $estadoReintento = ProyectoPagoEstado::where('nombre', 'reintento')->first();
        $hoy = Carbon::now();

        ProyectoCliente::query()
            ->with(['cronogramaPagos' => function ($query) use ($estadoPendiente, $estadoReintento, $hoy) {
                $query->whereIn('estado_pago_id', [$estadoPendiente->id, $estadoReintento->id])
                    ->whereDate('fecha_programada', '<=', $hoy->copy()->subDays(7));
            }])
            ->get()
            ->each(function ($cliente) {
                $pagosCriticos = $cliente->cronogramaPagos->isNotEmpty();
                $cliente->update(['activo' => !$pagosCriticos]);
            });
    }
}
