<?php

// namespace App\Services\Proyectos;

// use App\Models\ProyectoCronogramaPago;
// use App\Models\ProyectoPagoEstado;
// use App\Models\ProyectoCliente;
// use Illuminate\Support\Facades\Log;
// use Carbon\Carbon;

// class ServicioOrquestadorPagos
// {
//     protected $debitoAutomatico;
//     protected $estadoClienteService;

//     public function __construct(ServicioDebitoAutomatico $debitoAutomatico, ServicioEstadoCliente $estadoClienteService)
//     {
//         $this->debitoAutomatico = $debitoAutomatico;
//         $this->estadoClienteService = $estadoClienteService;
//     }

//     public function procesarPagos()
//     {
//         $hoy = Carbon::today();

//         // Obtener estados
//         $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;
//         $estadoReintento = ProyectoPagoEstado::where('nombre', 'reintento')->first()->id;
//         $estadoPagado = ProyectoPagoEstado::where('nombre', 'pagado')->first()->id;
//         $estadoFallido = ProyectoPagoEstado::where('nombre', 'fallido')->first()->id;

//         // Obtener pagos pendientes o en reintento
//         $pagos = ProyectoCronogramaPago::whereIn('estado_pago_id', [$estadoPendiente, $estadoReintento])
//             ->whereDate('fecha_programada', '<=', $hoy)
//             ->get();

//         foreach ($pagos as $pago) {
//             $cliente = $pago->proyectoCliente;
//             $tarjeta = $cliente->tarjeta; // Relación con ProyectoClienteTarjeta

//             if (!$tarjeta) {
//                 // Marcar como fallo final si no hay tarjeta asociada
//                 $pago->update([
//                     'estado_pago_id' => $estadoFallido,
//                     'fallo_final' => true,
//                     'razon_fallo' => 'No hay tarjeta asociada',
//                 ]);
//                 Log::error("No hay tarjeta asociada para el cliente {$cliente->id}");
//                 continue;
//             }

//             $exito = $this->debitoAutomatico->procesarCobroAutomatico($pago, $tarjeta->card_id, $tarjeta->customer_id);

//             if ($exito) {
//                 // Si el pago se realiza correctamente
//                 $pago->update([
//                     'estado_pago_id' => $estadoPagado,
//                     'fecha_ultimo_intento' => $hoy,
//                     'fallo_final' => false,
//                 ]);
//                 Log::info("Pago realizado con éxito para cliente {$cliente->id}, pago ID: {$pago->id}");
//             } else {
//                 // Si el intento falla
//                 $pago->increment('intentos');
//                 $pago->update([
//                     'estado_pago_id' => $pago->intentos >= 7 ? $estadoFallido : $estadoReintento,
//                     'fallo_final' => $pago->intentos >= 7,
//                     'fecha_ultimo_intento' => $hoy,
//                     'razon_fallo' => 'Cobro no autorizado',
//                 ]);

//                 if ($pago->fallo_final) {
//                     Log::warning("Pago fallido después de 7 intentos para cliente {$cliente->id}, pago ID: {$pago->id}");
//                 }
//             }

//             // Actualizar el estado del cliente después de cada intento
//             $this->estadoClienteService->actualizarEstadoCliente($cliente);
//         }
//     }
// }


namespace App\Services\Proyectos;

use App\Models\ProyectoCronogramaPago;
use Illuminate\Support\Facades\Log;

class ServicioOrquestadorPagos
{
    protected $debitoAutomatico;
    protected $estadoCliente;

    public function __construct(ServicioDebitoAutomatico $debitoAutomatico, ServicioEstadoCliente $estadoCliente)
    {
        $this->debitoAutomatico = $debitoAutomatico;
        $this->estadoCliente = $estadoCliente;
    }

    public function procesarPagos()
    {
        $pagos = ProyectoCronogramaPago::pendientesHoy()->get();
    
        foreach ($pagos as $pago) {
            $cliente = $pago->proyectoCliente;
    
            // Obtener la tarjeta asociada al cliente
            $tarjeta = $cliente->tarjeta; // Relación definida en el modelo ProyectoCliente
    
            if (!$tarjeta) {
                // Registrar un fallo si no hay tarjeta asociada
                $pago->update([
                    'estado_pago_id' => 4, // Estado 'Fallo final'
                    'fallo_final' => true,
                    'razon_fallo' => 'No hay tarjeta asociada',
                ]);
                continue;
            }
    
            $successful = $this->debitoAutomatico->procesarCobroAutomatico(
                $pago,
                $tarjeta->card_id,
                $tarjeta->customer_id
            );
    
            if ($successful) {
                $pago->update([
                    'estado_pago_id' => 2, // Estado 'Pagado'
                    'fecha_ultimo_intento' => now(),
                ]);
            } else {
                $pago->increment('intentos');
                $pago->update([
                    'fecha_ultimo_intento' => now(),
                ]);
            }
    
            $this->estadoCliente->actualizarEstadoCliente($cliente);
        }
    }
    
}
