<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioDebitoAutomatico;
use App\Services\Proyectos\ServicioProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoClienteTarjeta;
use App\Models\ProyectoPagoEstado;
use Carbon\Carbon;

class ProcesarCobrosProyectos extends Command
{
    protected $signature = 'proyectos:cobros-automaticos';
    protected $description = 'Procesa los cobros automáticos de los clientes de proyectos';

    public function handle()
    {
        $servicioPago = new ServicioDebitoAutomatico;
        $servicioCliente = new ServicioProyectoCliente;
        $today = Carbon::today();

        // Obtener los estados de pago
        $estadoPending = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;
        $estadoRetrying = ProyectoPagoEstado::where('nombre', 'reintento')->first()->id;
        $estadoPaid = ProyectoPagoEstado::where('nombre', 'pagado')->first()->id;
        $estadoFinalFailed = ProyectoPagoEstado::where('nombre', 'fallo_final')->first()->id;

        // Selecciona pagos pendientes cuyo due_date es hoy o en reintento (retrying)
        $payments = ProyectoCronogramaPago::where(function ($query) use ($today, $estadoPending) {
                $query->where('estado_pago_id', $estadoPending)
                      ->where('fecha_vencimiento', $today);
            })
            ->orWhere(function ($query) use ($today, $estadoRetrying) {
                $query->where('estado_pago_id', $estadoRetrying)
                      ->where('reintento_hasta', '>=', $today);
            })
            ->get();

        foreach ($payments as $payment) {
            // Obtener tarjeta asociada al cliente del proyecto
            $tarjeta = ProyectoClienteTarjeta::where('proyecto_cliente_id', $payment->proyecto_cliente_id)->first();

            if (!$tarjeta) {
                // Si no hay tarjeta asociada, registra el fallo y continúa con el siguiente pago
                $payment->update([
                    'estado_pago_id' => $estadoFinalFailed,
                    'fallo_final' => true,
                    'razon_fallo' => 'No hay tarjeta asociada',
                ]);
                continue;
            }

            // Intentar el cobro automático con los datos de la tarjeta y el cliente
            $successful = $servicioPago->procesarCobroAutomatico($payment, $tarjeta->card_id, $tarjeta->customer_id);

            if ($successful) {
                $payment->update([
                    'estado_pago_id' => $estadoPaid,
                    'intentos' => $payment->intentos + 1,
                    'ultimo_intento' => now(),
                    'fallo_final' => false,
                ]);
            } else {
                $payment->increment('intentos', 1);
                $payment->update([
                    'ultimo_intento' => now(),
                    'razon_fallo' => 'Tarjeta denegada'
                ]);

                if ($payment->estado_pago_id == $estadoPending) {
                    $payment->update([
                        'estado_pago_id' => $estadoRetrying,
                        'reintento_hasta' => $today->copy()->addDays(7),
                    ]);
                }

                if ($payment->reintento_hasta && $today->greaterThanOrEqualTo($payment->reintento_hasta)) {
                    $payment->update([
                        'estado_pago_id' => $estadoFinalFailed,
                        'fallo_final' => true,
                    ]);
                    $servicioCliente->deshabilitarServicioProyecto($payment->proyecto_cliente_id);
                }
            }
        }
    }
}
