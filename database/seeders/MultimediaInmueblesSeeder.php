<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultimediaInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_inmueble_1 = [
            'inmueble_id'       => 1,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/11/01/42/16/70/38/1200x1200/1233673592.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_2 = [
            'inmueble_id'       => 2,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/11/00/65/11/87/83/1200x1200/335224844.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_3 = [
            'inmueble_id'       => 3,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/111/01/43/51/46/38/1200x1200/1460950624.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_4 = [
            'inmueble_id'       => 4,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/111/01/43/46/37/85/1200x1200/1459672071.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_5 = [
            'inmueble_id'       => 5,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/111/01/41/66/66/04/1200x1200/1127846966.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $for_inmueble_6 = [
            'inmueble_id'       => 6,
            'imagen_principal'  => 'https://img10.naventcdn.com/avisos/resize/111/01/43/64/00/85/1200x1200/1464163414.jpg',
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('multimedia_inmuebles')->insert([$for_inmueble_1, $for_inmueble_2, $for_inmueble_3, $for_inmueble_4, $for_inmueble_5, $for_inmueble_6]);
    }
}
