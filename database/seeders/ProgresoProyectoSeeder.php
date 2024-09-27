<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgresoProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proyecto_progreso')->insert([
            ['estado' => 'En planos'],
            ['estado' => 'En construcción'],
            ['estado' => 'Entrega inmediata'],
        ]);
    }
}
