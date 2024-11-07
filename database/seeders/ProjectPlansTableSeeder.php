<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectPlan;

class ProjectPlansTableSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'Plan de 3 Meses',
                'description' => 'Acceso por 3 meses.',
                'price' => 3000.00,
                'duration_in_months' => 3,
                'status_after_retry' => 'cancelled',
                'retry_times' => 2,
                'currency' => 'PEN',
            ],
            [
                'name' => 'Plan de 6 Meses',
                'description' => 'Acceso por 6 meses.',
                'price' => 5500.00,
                'duration_in_months' => 6,
                'status_after_retry' => 'cancelled',
                'retry_times' => 2,
                'currency' => 'PEN',
            ],
            [
                'name' => 'Plan de 12 Meses',
                'description' => 'Acceso por 12 meses.',
                'price' => 10000.00,
                'duration_in_months' => 12,
                'status_after_retry' => 'cancelled',
                'retry_times' => 2,
                'currency' => 'PEN',
            ],
        ];

        foreach ($plans as $plan) {
            ProjectPlan::create($plan);
        }
    }
}
