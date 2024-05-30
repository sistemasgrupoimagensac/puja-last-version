<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosAvisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['estado' => 'Borrador', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Publicado', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Aceptado', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('estados_avisos')->insert($estados);
    }
}
