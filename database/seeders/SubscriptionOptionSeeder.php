<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscription_options = [
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 1, 'num_ads_top_plus' => null, 'num_days' => 30, 'price' => 129.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 1, 'num_ads_top_plus' => null, 'num_days' => 60, 'price' => 219.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 1, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 290.00, 'created_at' => now(), 'updated_at' => now()],

            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 3, 'num_ads_top_plus' => null, 'num_days' => 30, 'price' => 290.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 3, 'num_ads_top_plus' => null, 'num_days' => 60, 'price' => 495.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 3, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 650.00, 'created_at' => now(), 'updated_at' => now()],

            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 5, 'num_ads_top_plus' => null, 'num_days' => 30, 'price' => 505.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 5, 'num_ads_top_plus' => null, 'num_days' => 60, 'price' => 850.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '1', 'num_ads_typical' => null, 'num_ads_top' => 5, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1225.00, 'created_at' => now(), 'updated_at' => now()],

            
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 1, 'num_days' => 30, 'price' => 239.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 1, 'num_days' => 60, 'price' => 406.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 1, 'num_days' => 90, 'price' => 537.00, 'created_at' => now(), 'updated_at' => now()],

            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 3, 'num_days' => 30, 'price' => 540.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 3, 'num_days' => 60, 'price' => 915.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 3, 'num_days' => 90, 'price' => 1210.00, 'created_at' => now(), 'updated_at' => now()],

            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 5, 'num_days' => 30, 'price' => 715.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 5, 'num_days' => 60, 'price' => 1220.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '2', 'num_ads_typical' => null, 'num_ads_top' => null, 'num_ads_top_plus' => 5, 'num_days' => 90, 'price' => 1610.00, 'created_at' => now(), 'updated_at' => now()],
            

            ['subscription_level_id' => '3', 'num_ads_typical' => 5, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 259.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 10, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 529.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 25, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 879.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 50, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1139.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 75, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1599.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 100, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1985.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 200, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 3390.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '3', 'num_ads_typical' => 5, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 490.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 10, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 989.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 25, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 1829.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 50, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 2249.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 75, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 3129.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 100, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 3970.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 200, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 6890.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '3', 'num_ads_typical' => 5, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 719.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 10, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 1449.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 25, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 2679.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 50, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 3349.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 75, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 4649.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 100, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 5950.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '3', 'num_ads_typical' => 200, 'num_ads_top' => null, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 10400.00, 'created_at' => now(), 'updated_at' => now()],

            
            ['subscription_level_id' => '4', 'num_ads_typical' => 3, 'num_ads_top' => 2, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 325.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 6, 'num_ads_top' => 4, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 649.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 16, 'num_ads_top' => 9, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1120.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 35, 'num_ads_top' => 15, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1339.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 52, 'num_ads_top' => 23, 'num_ads_top_plus' => null, 'num_days' => 90, 'price' => 1865.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 70, 'num_ads_top' => 28, 'num_ads_top_plus' => 2, 'num_days' => 90, 'price' => 2350.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 160, 'num_ads_top' => 38, 'num_ads_top_plus' => 2, 'num_days' => 90, 'price' => 3980.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '4', 'num_ads_typical' => 3, 'num_ads_top' => 2, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 605.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 6, 'num_ads_top' => 4, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 1199.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 16, 'num_ads_top' => 9, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 2110.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 35, 'num_ads_top' => 15, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 2619.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 52, 'num_ads_top' => 23, 'num_ads_top_plus' => null, 'num_days' => 180, 'price' => 3625.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 70, 'num_ads_top' => 28, 'num_ads_top_plus' => 2, 'num_days' => 180, 'price' => 4630.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 160, 'num_ads_top' => 38, 'num_ads_top_plus' => 2, 'num_days' => 180, 'price' => 8110.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '4', 'num_ads_typical' => 3, 'num_ads_top' => 2, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 875.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 6, 'num_ads_top' => 4, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 1769.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 16, 'num_ads_top' => 9, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 3100.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 35, 'num_ads_top' => 15, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 3889.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 52, 'num_ads_top' => 23, 'num_ads_top_plus' => null, 'num_days' => 365, 'price' => 5475.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 70, 'num_ads_top' => 28, 'num_ads_top_plus' => 2, 'num_days' => 365, 'price' => 6899.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '4', 'num_ads_typical' => 160, 'num_ads_top' => 38, 'num_ads_top_plus' => 2, 'num_days' => 365, 'price' => 12099.00, 'created_at' => now(), 'updated_at' => now()],

            
            ['subscription_level_id' => '5', 'num_ads_typical' => 2, 'num_ads_top' => 2, 'num_ads_top_plus' => 1, 'num_days' => 90, 'price' => 405.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 4, 'num_ads_top' => 4, 'num_ads_top_plus' => 2, 'num_days' => 90, 'price' => 809.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 13, 'num_ads_top' => 9, 'num_ads_top_plus' => 3, 'num_days' => 90, 'price' => 1404.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 25, 'num_ads_top' => 18, 'num_ads_top_plus' => 7, 'num_days' => 90, 'price' => 1699.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 37, 'num_ads_top' => 29, 'num_ads_top_plus' => 9, 'num_days' => 90, 'price' => 2375.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 50, 'num_ads_top' => 40, 'num_ads_top_plus' => 10, 'num_days' => 90, 'price' => 3375.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 120, 'num_ads_top' => 60, 'num_ads_top_plus' => 20, 'num_days' => 90, 'price' => 5190.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '5', 'num_ads_typical' => 2, 'num_ads_top' => 2, 'num_ads_top_plus' => 1, 'num_days' => 180, 'price' => 745.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 4, 'num_ads_top' => 4, 'num_ads_top_plus' => 2, 'num_days' => 180, 'price' => 1499.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 13, 'num_ads_top' => 9, 'num_ads_top_plus' => 3, 'num_days' => 180, 'price' => 2625.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 25, 'num_ads_top' => 18, 'num_ads_top_plus' => 7, 'num_days' => 180, 'price' => 3265.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 37, 'num_ads_top' => 29, 'num_ads_top_plus' => 9, 'num_days' => 180, 'price' => 4575.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 50, 'num_ads_top' => 40, 'num_ads_top_plus' => 10, 'num_days' => 180, 'price' => 6190.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 120, 'num_ads_top' => 60, 'num_ads_top_plus' => 20, 'num_days' => 180, 'price' => 10500.00, 'created_at' => now(), 'updated_at' => now()],
            
            ['subscription_level_id' => '5', 'num_ads_typical' => 2, 'num_ads_top' => 2, 'num_ads_top_plus' => 1, 'num_days' => 365, 'price' => 1075.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 4, 'num_ads_top' => 4, 'num_ads_top_plus' => 2, 'num_days' => 365, 'price' => 2179.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 13, 'num_ads_top' => 9, 'num_ads_top_plus' => 3, 'num_days' => 365, 'price' => 3845.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 25, 'num_ads_top' => 18, 'num_ads_top_plus' => 7, 'num_days' => 365, 'price' => 4749.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 37, 'num_ads_top' => 29, 'num_ads_top_plus' => 9, 'num_days' => 365, 'price' => 6775.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 50, 'num_ads_top' => 40, 'num_ads_top_plus' => 10, 'num_days' => 365, 'price' => 9160.00, 'created_at' => now(), 'updated_at' => now()],
            ['subscription_level_id' => '5', 'num_ads_typical' => 120, 'num_ads_top' => 60, 'num_ads_top_plus' => 20, 'num_days' => 365, 'price' => 14990.00, 'created_at' => now(), 'updated_at' => now()],

        ];

        DB::table('subscription_options')->insert($subscription_options);
    }
}
