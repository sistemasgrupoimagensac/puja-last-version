<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_usuario = [
            ['tipo' => 'CreadoPorGoogle', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Propietario', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Corredor', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Acreedor', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Proyecto', 'created_at' => now(), 'updated_at' => now()],

            // ['tipo' => 'CreadoPorGoogle', 'created_at' => now(), 'updated_at' => now()],
            // ['tipo' => 'Propietario', 'created_at' => now(), 'updated_at' => now()],
            // ['tipo' => 'Inmobiliaria', 'created_at' => now(), 'updated_at' => now()],
            // ['tipo' => 'Constructora', 'created_at' => now(), 'updated_at' => now()],
            // ['tipo' => 'Corredor', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_usuario')->insert($tipos_usuario);
    }
}
