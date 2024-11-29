<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCronogramaPago;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ServicioDebitoAutomatico
{
    protected $baseUrl;
    protected $openpayId;
    protected $encodedSk;

    public function __construct()
    {
        $this->baseUrl = env('OPENPAY_URL');
        $this->openpayId = env('OPENPAY_ID');
        $openpaySk = env('OPENPAY_SK');
        $this->encodedSk = base64_encode("$openpaySk:");
    }

    /**
     * Gestiona un pago específico del cronograma.
     *
     * @param ProyectoCronogramaPago $pago
     */
    public function gestionarPago(ProyectoCronogramaPago $pago): void
    {

        Log::info($pago);
        dd($pago);

        $cliente = $pago->proyectoCliente;
        $tarjeta = $cliente->tarjeta; // Relación definida en el modelo ProyectoCliente

        if (!$tarjeta) {
            $this->registrarFalloFinal($pago, 'No hay tarjeta asociada');
            return;
        }

        $successful = $this->procesarCobroAutomatico($pago, $tarjeta->card_id, $tarjeta->customer_id);

        if (!$successful && $pago->reintento_hasta && now()->greaterThanOrEqualTo($pago->reintento_hasta)) {
            $this->registrarFalloFinal($pago, 'Reintentos agotados');
        }
    }

    /**
     * Procesa un cobro automático para un pago específico.
     *
     * @param ProyectoCronogramaPago $pago
     * @param string $cardId
     * @param string $customerId
     * @return bool
     */
    public function procesarCobroAutomatico(ProyectoCronogramaPago $pago, string $cardId, string $customerId): bool
    {
        $chargeId = $this->realizarCobro(
            $customerId,
            $cardId,
            $pago->monto,
            "Cobro automático del cronograma de pago"
        );

        if ($chargeId) {
            $pago->update([
                'estado_pago_id' => 2, // Estado 'Pagado'
                'fecha_ultimo_intento' => now(),
                'fallo_final' => false,
            ]);
            return true;
        }

        $pago->increment('intentos');
        $pago->update([
            'estado_pago_id' => 4, // Estado 'Reintento'
            'fecha_ultimo_intento' => now(),
        ]);

        return false;
    }

    /**
     * Realiza un cobro en la pasarela de pagos OpenPay.
     *
     * @param string $customerId
     * @param string $cardId
     * @param float $amount
     * @param string $description
     * @return string|null
     */
    protected function realizarCobro(string $customerId, string $cardId, float $amount, string $description): ?string
    {
        $urlChargeAPI = "{$this->baseUrl}{$this->openpayId}/customers/{$customerId}/charges";

        $chargeData = [
            'method' => 'card',
            'source_id' => $cardId,
            'amount' => $amount,
            'currency' => 'PEN',
            'description' => $description,
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $this->encodedSk,
            ])->withBody(json_encode($chargeData), 'application/json')->post($urlChargeAPI);

            if ($response->successful() && isset($response->json()['id'])) {
                Log::info("Cobro exitoso: {$response->json()['id']} para cliente {$customerId}");
                return $response->json()['id'];
            }

            Log::warning("Cobro fallido para cliente {$customerId}. Respuesta: " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("Error durante el cobro para cliente {$customerId}: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Registra un fallo final en el cronograma de pagos.
     *
     * @param ProyectoCronogramaPago $pago
     * @param string $razon
     */
    protected function registrarFalloFinal(ProyectoCronogramaPago $pago, string $razon): void
    {
        $pago->update([
            'estado_pago_id' => 4, // Estado 'Fallo final'
            'fallo_final' => true,
            'razon_fallo' => $razon,
        ]);
        Log::error("Fallo final registrado para pago ID: {$pago->id}. Razón: {$razon}");
    }
}
