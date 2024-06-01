<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrincipalInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_inmueble_1 = [
            'inmueble_id'       => 1,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_2 = [
            'inmueble_id'       => 2,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_3 = [
            'inmueble_id'       => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_4 = [
            'inmueble_id'       => 4,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_5 = [
            'inmueble_id'       => 5,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_6 = [
            'inmueble_id'       => 6,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('principal_inmuebles')->insert([$for_inmueble_1, $for_inmueble_2, $for_inmueble_3, $for_inmueble_4, $for_inmueble_5, $for_inmueble_6]);
    }
}
