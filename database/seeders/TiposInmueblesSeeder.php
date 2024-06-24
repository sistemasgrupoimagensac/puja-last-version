<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo' => 'Casa', 'plural' => 'Casas', 'slug' => 'casas', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Departamento', 'plural' => 'Departamentos', 'slug' => 'departamentos', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Oficina', 'plural' => 'Oficinas', 'slug' => 'oficinas', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Terreno', 'plural' => 'Terrenos', 'slug' => 'terrenos', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Local', 'plural' => 'Locales', 'slug' => 'locales', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('tipos_inmuebles')->insert($tipos);
    }
}
