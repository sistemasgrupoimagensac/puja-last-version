<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['package_id' => '1', 'total_ads' => '1', 'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '79.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '129.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '30', 'price' => '239.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '134.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '219.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '60', 'price' => '406.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '177.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '290.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '1', 'total_ads' => '1',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '90', 'price' => '537.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '3', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '177.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '3', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '290.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '3', 'duration_in_days' => '30', 'price' => '540.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '3', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '302.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '3', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '495.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '3', 'duration_in_days' => '60', 'price' => '915.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '399.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '650.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '3',  'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '90', 'price' => '1210.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '276.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '505.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '30', 'price' => '715.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '470.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '850.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '60', 'price' => '1220.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '622.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1225.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '2', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '90', 'price' => '1610.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],


            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '259.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '3', 'top_ads' => '2', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '325.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '2', 'top_ads' => '2', 'premium_ads' => '1', 'duration_in_days' => '90', 'price' => '405.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '490.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '3', 'top_ads' => '2', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '605.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '2', 'top_ads' => '2', 'premium_ads' => '1', 'duration_in_days' => '180', 'price' => '745.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '5', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '719.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '3', 'top_ads' => '2', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '875.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '5', 'typical_ads' => '2', 'top_ads' => '2', 'premium_ads' => '1', 'duration_in_days' => '365', 'price' => '1075.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '10', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '529.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '6', 'top_ads' => '4', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '649.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '4', 'top_ads' => '4', 'premium_ads' => '2', 'duration_in_days' => '90', 'price' => '809.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '10', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '989.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '6', 'top_ads' => '4', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '1199.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '4', 'top_ads' => '4', 'premium_ads' => '2', 'duration_in_days' => '180', 'price' => '1499.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '10', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '1449.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '6', 'top_ads' => '4', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '1769.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '10', 'typical_ads' => '4', 'top_ads' => '4', 'premium_ads' => '2', 'duration_in_days' => '365', 'price' => '2179.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '25', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '879.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '16', 'top_ads' => '9', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1120.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '13', 'top_ads' => '9', 'premium_ads' => '3', 'duration_in_days' => '90', 'price' => '1404.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '25', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '1829.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '16', 'top_ads' => '9', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '2110.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '13', 'top_ads' => '9', 'premium_ads' => '3', 'duration_in_days' => '180', 'price' => '2625.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '25', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '2679.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '16', 'top_ads' => '9', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '3100.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '25', 'typical_ads' => '13', 'top_ads' => '9', 'premium_ads' => '3', 'duration_in_days' => '365', 'price' => '3845.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '50', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1139.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '35', 'top_ads' => '15', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1339.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '25', 'top_ads' => '18', 'premium_ads' => '7', 'duration_in_days' => '90', 'price' => '1699.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '50', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '2249.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '25', 'top_ads' => '18', 'premium_ads' => '7', 'duration_in_days' => '180', 'price' => '2619.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '35', 'top_ads' => '15', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '3265.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '50', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '3349.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '35', 'top_ads' => '15', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '3889.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '50', 'typical_ads' => '25', 'top_ads' => '18', 'premium_ads' => '7', 'duration_in_days' => '365', 'price' => '4749.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '75', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1599.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '52', 'top_ads' => '23', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1865.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '37', 'top_ads' => '29', 'premium_ads' => '9', 'duration_in_days' => '90', 'price' => '2375.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '75', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '3129.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '52', 'top_ads' => '23', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '3625.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '37', 'top_ads' => '29', 'premium_ads' => '9', 'duration_in_days' => '180', 'price' => '4575.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '75', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '4649.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '52', 'top_ads' => '23', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '5475.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '75', 'typical_ads' => '37', 'top_ads' => '29', 'premium_ads' => '9', 'duration_in_days' => '365', 'price' => '6775.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '100', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1985.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '70', 'top_ads' => '28', 'premium_ads' => '2', 'duration_in_days' => '90', 'price' => '2350.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '50', 'top_ads' => '40', 'premium_ads' => '10', 'duration_in_days' => '90', 'price' => '3375.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '100', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '3970.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '70', 'top_ads' => '28', 'premium_ads' => '2', 'duration_in_days' => '180', 'price' => '4630.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '50', 'top_ads' => '40', 'premium_ads' => '10', 'duration_in_days' => '180', 'price' => '6190.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '100', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '5950.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '70', 'top_ads' => '28', 'premium_ads' => '2', 'duration_in_days' => '365', 'price' => '6899.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '100', 'typical_ads' => '50', 'top_ads' => '40', 'premium_ads' => '10', 'duration_in_days' => '365', 'price' => '9160.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '200', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '3390.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '160', 'top_ads' => '38', 'premium_ads' => '2', 'duration_in_days' => '90', 'price' => '3980.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '120', 'top_ads' => '60', 'premium_ads' => '20', 'duration_in_days' => '90', 'price' => '5190.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '200', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '180', 'price' => '6890.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '160', 'top_ads' => '38', 'premium_ads' => '2', 'duration_in_days' => '180', 'price' => '8110.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '120', 'top_ads' => '60', 'premium_ads' => '20', 'duration_in_days' => '180', 'price' => '10500.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '200', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '365', 'price' => '10400.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '160', 'top_ads' => '38', 'premium_ads' => '2', 'duration_in_days' => '365', 'price' => '12099.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '3', 'total_ads' => '200', 'typical_ads' => '120', 'top_ads' => '60', 'premium_ads' => '20', 'duration_in_days' => '365', 'price' => '14900.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],


            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '129.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '30', 'price' => '239.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            
            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '129.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '60', 'price' => '239.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            
            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '129.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '90', 'price' => '239.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '3', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '650.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '3', 'duration_in_days' => '30', 'price' => '1210.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            
            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '3', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '650.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '3', 'duration_in_days' => '60', 'price' => '1210.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            
            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '3', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '650.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '3', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '3', 'duration_in_days' => '90', 'price' => '1210.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '30', 'price' => '1225.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '30', 'price' => '1610.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '60', 'price' => '1225.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '60', 'price' => '1610.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '5', 'premium_ads' => '0', 'duration_in_days' => '90', 'price' => '1225.00', 'name' => 'Plan Superior', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '4', 'total_ads' => '5', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '5', 'duration_in_days' => '90', 'price' => '1610.00', 'name' => 'Plan Básico', 'created_at' => now(), 'updated_at' => now()],
            
            
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '7', 'price' => '150.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '7', 'price' => '200.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '7', 'price' => '240.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],

            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '15', 'price' => '250.00', 'name' => 'Plan Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '15', 'price' => '350.00', 'name' => 'Plan Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '15', 'price' => '420.00', 'name' => 'Plan Top Plus', 'created_at' => now(), 'updated_at' => now()],


            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '1', 'top_ads' => '0', 'premium_ads' => '0', 'duration_in_days' => '15', 'price' => '0.00', 'name' => 'Plan Free Estandar', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '1', 'premium_ads' => '0', 'duration_in_days' => '15', 'price' => '0.00', 'name' => 'Plan Free Top', 'created_at' => now(), 'updated_at' => now()],
            ['package_id' => '5', 'total_ads' => '1', 'typical_ads' => '0', 'top_ads' => '0', 'premium_ads' => '1', 'duration_in_days' => '15', 'price' => '0.00', 'name' => 'Plan Free Top Plus', 'created_at' => now(), 'updated_at' => now()],

        ];

        DB::table('plans')->insert($plans);
    }
}
