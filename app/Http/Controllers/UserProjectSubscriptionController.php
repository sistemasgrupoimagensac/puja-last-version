<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\UserProjectSubscription;
use Carbon\Carbon;

class AutoDebitSubscription extends Command
{
    protected $signature = 'subscription:auto-debit';
    protected $description = 'Realiza el débito automático de las suscripciones que vencen hoy y gestiona nuevas suscripciones si el pago es exitoso.';

    public function handle()
    {
        $today = Carbon::now()->toDateString();

        // Obtener las suscripciones activas que vencen hoy
        $subscriptions = UserProjectSubscription::where('end_date', $today)
            ->where('status', true)
            ->get();

        foreach ($subscriptions as $subscription) {
            $projectPlan = $subscription->projectPlan; // Obtener la relación del plan
            $retryCount = 0; // Manejar los intentos localmente

            // Intentar realizar el débito hasta el número de intentos máximo permitido
            while ($retryCount < $projectPlan->retry_times) {
                $response = $this->realizarDebito($subscription->customer_id, $subscription->card_id, $projectPlan->price, $projectPlan->description);

                if ($response['status'] === 'Success') {
                    // Si el débito es exitoso, crear una nueva suscripción
                    $this->crearNuevaSuscripcion($subscription, $projectPlan);
                    $this->info('Débito exitoso para la suscripción ID: ' . $subscription->id);
                    break;
                } else {
                    $retryCount++;
                    $this->warn('Débito fallido para la suscripción ID: ' . $subscription->id . '. Intento número ' . $retryCount);

                    if ($retryCount >= $projectPlan->retry_times) {
                        $subscription->update(['status' => false]); // Desactivar la suscripción
                        $this->warn('Suscripción ID: ' . $subscription->id . ' desactivada tras superar los intentos de débito.');
                        break;
                    }
                }
            }
        }
    }

    private function realizarDebito($customerId, $cardId, $amount, $description)
    {
        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $urlChargeAPI = "{$base_url}{$openpay_id}/customers/{$customerId}/charges";

        $chargeData = [
            'method' => 'card',
            'source_id' => $cardId,
            'amount' => $amount,
            'currency' => 'PEN',
            'description' => $description,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody(json_encode($chargeData), 'application/json')->post($urlChargeAPI);

        return $response->json();
    }

    private function crearNuevaSuscripcion($subscription, $projectPlan)
    {
        $newStartDate = Carbon::parse($subscription->end_date)->addDay();
        $newEndDate = $newStartDate->copy()->addMonths($projectPlan->duration_in_months);

        UserProjectSubscription::create([
            'user_id' => $subscription->user_id,
            'project_plan_id' => $subscription->project_plan_id,
            'customer_id' => $subscription->customer_id,
            'card_id' => $subscription->card_id,
            'start_date' => $newStartDate,
            'end_date' => $newEndDate,
            'status' => true,
        ]);
    }
}
