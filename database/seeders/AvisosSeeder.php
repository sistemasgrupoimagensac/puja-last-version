<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aviso_1 = [
            'inmueble_id'       => 1,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $aviso_2 = [
            'inmueble_id'       => 2,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $aviso_3 = [
            'inmueble_id'       => 3,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $aviso_4 = [
            'inmueble_id'       => 4,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $aviso_5 = [
            'inmueble_id'       => 5,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $aviso_6 = [
            'inmueble_id'       => 6,
            'fecha_publicacion' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('avisos')->insert([$aviso_1, $aviso_2, $aviso_3, $aviso_4, $aviso_5, $aviso_6]);
    }
}
