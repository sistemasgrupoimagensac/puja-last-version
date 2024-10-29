<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperacionTipoInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_principal_inmueble_1 = [
            'principal_inmueble_id'     => 1,
            'tipo_operacion_id'         => 1,
            'tipo_inmueble_id'          => 2,
            'subtipo_inmueble_id'       => 7,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_2 = [
            'principal_inmueble_id'     => 2,
            'tipo_operacion_id'         => 2,
            'tipo_inmueble_id'          => 2,
            'subtipo_inmueble_id'       => 10,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_3 = [
            'principal_inmueble_id'     => 3,
            'tipo_operacion_id'         => 2,
            'tipo_inmueble_id'          => 1,
            'subtipo_inmueble_id'       => 3,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_4 = [
            'principal_inmueble_id'     => 4,
            'tipo_operacion_id'         => 2,
            'tipo_inmueble_id'          => 2,
            'subtipo_inmueble_id'       => 8,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_5 = [
            'principal_inmueble_id'     => 5,
            'tipo_operacion_id'         => 2,
            'tipo_inmueble_id'          => 2,
            'subtipo_inmueble_id'       => 7,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_6 = [
            'principal_inmueble_id'     => 6,
            'tipo_operacion_id'         => 1,
            'tipo_inmueble_id'          => 1,
            'subtipo_inmueble_id'       => 2,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        DB::table('operaciones_tipos_inmuebles')->insert([$for_principal_inmueble_1, $for_principal_inmueble_2, $for_principal_inmueble_3, $for_principal_inmueble_4, $for_principal_inmueble_5, $for_principal_inmueble_6]);
    }
}
