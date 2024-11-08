<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserProjectSubscription;
use App\Models\ProjectPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class AutoDebitSubscription extends Command
{
    protected $signature = 'subscription:auto-debit';
    protected $description = 'Realiza el débito automático de las suscripciones que vencen hoy y crea nuevas suscripciones si el pago es exitoso.';

    public function handle()
    {
        $today = Carbon::today();

        // Buscar suscripciones que terminan hoy y están activas
        $subscriptions = UserProjectSubscription::where('end_date', $today)
            ->where('status', true)
            ->get();

        foreach ($subscriptions as $subscription) {
            $projectPlan = ProjectPlan::find($subscription->project_plan_id);

            if (!$projectPlan) {
                $this->error("Plan no encontrado para la suscripción ID: {$subscription->id}");
                continue;
            }

            $response = $this->makeDebitRequest($subscription);

            if ($response['status'] === 'success') {
                $this->createNewSubscription($subscription, $projectPlan);
                $this->info("Pago exitoso y nueva suscripción creada para el usuario ID: {$subscription->user_id}");
            } else {
                $subscription->increment('retry_count');

                if ($subscription->retry_count >= $projectPlan->retry_times) {
                    $subscription->status = false;
                    $subscription->save();
                    $this->warn("Suscripción ID: {$subscription->id} desactivada después de {$projectPlan->retry_times} intentos fallidos.");
                }
            }
        }
    }

    private function makeDebitRequest($subscription)
    {
        $response = Http::post('https://api.openpay.example/charge', [
            'customer_id' => $subscription->customer_id,
            'card_id' => $subscription->card_id,
            'amount' => $subscription->projectPlan->price,
            'description' => 'Pago automático de suscripción',
        ]);

        return $response->json();
    }

    private function createNewSubscription($oldSubscription, $projectPlan)
    {
        $newStartDate = Carbon::parse($oldSubscription->end_date)->addDay();
        $newEndDate = $newStartDate->copy()->addMonths($projectPlan->duration_in_months);

        UserProjectSubscription::create([
            'user_id' => $oldSubscription->user_id,
            'project_plan_id' => $oldSubscription->project_plan_id,
            'customer_id' => $oldSubscription->customer_id,
            'card_id' => $oldSubscription->card_id,
            'start_date' => $newStartDate,
            'end_date' => $newEndDate,
            'status' => true,
        ]);
    }
}
