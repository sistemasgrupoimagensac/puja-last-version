<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCronogramaPago;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
     * Realiza un cobro en la pasarela de pagos OpenPay.
     *
     * @param string $customerId El ID del cliente en OpenPay.
     * @param string $cardId El ID de la tarjeta en OpenPay.
     * @param float $amount El monto a cobrar.
     * @param string $description Una descripción para la transacción.
     * @return string|null Devuelve el ID del cobro si es exitoso, o null si falla.
     */
    public function realizarCobro(string $customerId, string $cardId, float $amount, string $description): ?string
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
     * Procesa el cobro automático para un pago específico.
     *
     * @param ProyectoCronogramaPago $payment El registro de cronograma de pago.
     * @param string $cardId El ID de la tarjeta del cliente.
     * @param string $customerId El ID del cliente en OpenPay.
     * @return bool Devuelve true si el cobro es exitoso, false en caso contrario.
     */
    public function procesarCobroAutomatico(ProyectoCronogramaPago $payment, string $cardId, string $customerId): bool
    {
        $chargeId = $this->realizarCobro(
            $customerId,
            $cardId,
            $payment->monto,
            "Cobro automático del cronograma de pago"
        );

        if ($chargeId) {
            $payment->update([
                'estado_pago_id' => 2, // Estado 'Pagado'
                'fecha_ultimo_intento' => now(),
            ]);
            return true;
        }

        $payment->increment('intentos');
        $payment->update([
            'fecha_ultimo_intento' => now(),
        ]);

        return false;
    }
}