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
            ['estado' => 'Vendido', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Vencido', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Eliminado', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Cancelado', 'created_at' => now(), 'updated_at' => now()],
            ['estado' => 'Pendiente por Eliminar', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('estados_avisos')->insert($estados);
    }
}
