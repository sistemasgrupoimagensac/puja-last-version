<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $subscriptions = [
            ['name' => 'TOP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MIXTO', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('subscriptions')->insert($subscriptions);
    }
}
