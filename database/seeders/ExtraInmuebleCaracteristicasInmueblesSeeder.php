<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraInmuebleCaracteristicasInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extras_inmu = [

            [
                'extra_inmueble_id'         => 1,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 1,
                'caracteristica_extra_id'   => 14,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 1,
                'caracteristica_extra_id'   => 15,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 2,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 2,
                'caracteristica_extra_id'   => 5,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 3,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 3,
                'caracteristica_extra_id'   => 14,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 3,
                'caracteristica_extra_id'   => 15,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 4,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 4,
                'caracteristica_extra_id'   => 2,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 5,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 5,
                'caracteristica_extra_id'   => 14,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 5,
                'caracteristica_extra_id'   => 15,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 6,
                'caracteristica_extra_id'   => 1,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 6,
                'caracteristica_extra_id'   => 14,
                'created_at'                => now(),
                'updated_at'                => now(),
            ],
            [
                'extra_inmueble_id'         => 6,
                'caracteristica_extra_id'   => 15,
                'created_at'                => now(),
                'updated_at'                => now(),
            ]

        ];

        DB::table('extra_inmueble_caracteristicas')->insert($extras_inmu);
    }
}
