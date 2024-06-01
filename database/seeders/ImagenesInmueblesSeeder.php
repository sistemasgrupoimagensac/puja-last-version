<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenesInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_multimedia_1_1 = [
            'multimedia_inmueble_id'    => 1,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/11/01/42/16/70/38/1200x1200/1233673585.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_1_2 = [
            'multimedia_inmueble_id'    => 1,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/11/01/42/16/70/38/1200x1200/1233673596.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_2_1 = [
            'multimedia_inmueble_id'    => 2,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/11/00/65/11/87/83/1200x1200/335224843.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_2_2 = [
            'multimedia_inmueble_id'    => 2,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/11/00/65/11/87/83/1200x1200/335224847.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_3_1 = [
            'multimedia_inmueble_id'    => 3,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/51/46/38/1200x1200/1460950636.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_3_2 = [
            'multimedia_inmueble_id'    => 3,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/51/46/38/1200x1200/1460950620.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_4_1 = [
            'multimedia_inmueble_id'    => 4,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/46/37/85/1200x1200/1459672072.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_4_2 = [
            'multimedia_inmueble_id'    => 4,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/46/37/85/1200x1200/1459672068.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_5_1 = [
            'multimedia_inmueble_id'    => 5,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/41/66/66/04/1200x1200/1127846962.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_5_2 = [
            'multimedia_inmueble_id'    => 5,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/41/66/66/04/1200x1200/1127846959.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_6_1 = [
            'multimedia_inmueble_id'    => 6,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/64/00/85/1200x1200/1464163409.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_multimedia_6_2 = [
            'multimedia_inmueble_id'    => 6,
            'imagen'                    => 'https://img10.naventcdn.com/avisos/resize/111/01/43/64/00/85/1200x1200/1464163402.jpg',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        DB::table('imagenes_multimedia_inmuebles')->insert([$for_multimedia_1_1, $for_multimedia_1_2, $for_multimedia_2_1, $for_multimedia_2_2, $for_multimedia_3_1, $for_multimedia_3_2, $for_multimedia_4_1, $for_multimedia_4_2, $for_multimedia_5_1, $for_multimedia_5_2, $for_multimedia_6_1, $for_multimedia_6_2]);
    }
}
