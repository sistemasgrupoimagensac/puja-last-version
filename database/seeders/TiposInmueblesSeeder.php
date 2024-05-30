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
            ['tipo' => 'Casa', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Departamento', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Oficina', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Terreno', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Local', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('tipos_inmuebles')->insert($tipos);
    }
}
