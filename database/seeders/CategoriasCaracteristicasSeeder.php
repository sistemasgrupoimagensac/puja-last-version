<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasCaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['categoria' => 'Características generales', 'created_at' => now(), 'updated_at' => now()],
            ['categoria' => 'Exteriores', 'created_at' => now(), 'updated_at' => now()],
            ['categoria' => 'Servicios', 'created_at' => now(), 'updated_at' => now()],
            ['categoria' => 'Áreas comunes', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categoria_caracteristicas_extra')->insert($categorias);
    }
}
