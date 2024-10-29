<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inmueble_1 = [
            'user_id'           => 1,
            'codigo_unico'      => 'INM-001-001-001',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $inmueble_2 = [
            'user_id'           => 1,
            'codigo_unico'      => 'INM-001-001-002',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $inmueble_3 = [
            'user_id'           => 1,
            'codigo_unico'      => 'INM-001-001-003',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $inmueble_4 = [
            'user_id'           => 2,
            'codigo_unico'      => 'INM-001-001-004',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $inmueble_5 = [
            'user_id'           => 2,
            'codigo_unico'      => 'INM-001-001-005',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $inmueble_6 = [
            'user_id'           => 2,
            'codigo_unico'      => 'INM-001-001-006',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('inmuebles')->insert([$inmueble_1, $inmueble_2, $inmueble_3, $inmueble_4, $inmueble_5, $inmueble_6]);
    }
}
