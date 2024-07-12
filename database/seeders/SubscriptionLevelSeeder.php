<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscription_levels = [
            ['subscription_id' => '1', 'name' => 'Top', 'created_at' => now(), 'updated_at' => now()],
            ['subscription_id' => '1', 'name' => 'Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['subscription_id' => '2', 'name' => 'Básico', 'created_at' => now(), 'updated_at' => now()],
            ['subscription_id' => '2', 'name' => 'Estándar', 'created_at' => now(), 'updated_at' => now()],
            ['subscription_id' => '2', 'name' => 'Superior', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('subscription_levels')->insert($subscription_levels);
    }
}
