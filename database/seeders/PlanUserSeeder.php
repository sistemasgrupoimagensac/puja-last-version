<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* $plan_user = [
            ['user_id' => '1', 'plan_id' => '3', 'document_type_id' => '2', 'start_date' => now(), 'end_date' => Carbon::now()->addDays(30), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => '2', 'plan_id' => '3', 'document_type_id' => '2', 'start_date' => now(), 'end_date' => Carbon::now()->addDays(30), 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('plan_user')->insert($plan_user); */
    }
}
