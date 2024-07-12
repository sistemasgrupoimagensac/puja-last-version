<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_subscriptions = [
            ['user_id' => '1', 'subscription_option_id' => '3', 'start_date' => now(), 'end_date' => Carbon::now()->addDays(90), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => '2', 'subscription_option_id' => '2', 'start_date' => now(), 'end_date' => Carbon::now()->addDays(30), 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('user_subscriptions')->insert($user_subscriptions);
    }
}
