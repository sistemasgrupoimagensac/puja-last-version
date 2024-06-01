<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorialAvisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historial_aviso_1 = [
            'aviso_id'          => 1,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $historial_aviso_2 = [
            'aviso_id'          => 2,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $historial_aviso_3 = [
            'aviso_id'          => 3,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $historial_aviso_4 = [
            'aviso_id'          => 4,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $historial_aviso_5 = [
            'aviso_id'          => 5,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $historial_aviso_6 = [
            'aviso_id'          => 6,
            'estado_aviso_id'   => 3,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('historial_avisos')->insert([$historial_aviso_1, $historial_aviso_2, $historial_aviso_3, $historial_aviso_4, $historial_aviso_5, $historial_aviso_6]);
    }
}
