<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCronogramaPago;
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

    // Método que realiza el cobro real en la pasarela de pagos
    public function realizarCobro($customerId, $cardId, $amount, $description)
    {
        $urlChargeAPI = "{$this->baseUrl}{$this->openpayId}/customers/{$customerId}/charges";

        $chargeData = [
            'method' => 'card',
            'source_id' => $cardId,
            'amount' => $amount,
            'currency' => 'PEN',
            'description' => $description,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $this->encodedSk,
        ])->withBody(json_encode($chargeData), 'application/json')->post($urlChargeAPI);

        $chargeResponse = $response->json();

        return $response->successful() && isset($chargeResponse['id']) ? $chargeResponse['id'] : null;
    }

    // Método que usa realizarCobro para los cobros automáticos
    public function procesarCobroAutomatico(ProyectoCronogramaPago $payment, string $cardId, string $customerId): bool
    {
        $chargeId = $this->realizarCobro(
            $customerId,
            $cardId,
            $payment->monto,
            "Cobro automático del cronograma de pago"
        );

        return $chargeId !== null;
    }
}
