<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyectoPlanes;

class ProyectoPlanesTableSeeder extends Seeder
{
    public function run()
    {
        $planes = [
            [
                'nombre' => 'Plan de 3 Meses',
                'descripcion' => 'Plan de 3 meses',
                'duracion_en_meses' => 3,
            ],
            [
                'nombre' => 'Plan de 6 Meses',
                'descripcion' => 'Plan de 6 meses',
                'duracion_en_meses' => 6,
            ],
            [
                'nombre' => 'Plan de 12 Meses',
                'descripcion' => 'Plan de 12 meses',
                'duracion_en_meses' => 12,
            ],
        ];

        foreach ($planes as $plan) {
            ProyectoPlanes::create($plan);
        }
    }
}