<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubTiposInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property_subtype = [
            ['tipo_inmueble_id' => 1,'subtipo' => 'Casa de playa', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 1,'subtipo' => 'Casa de campo', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 1,'subtipo' => 'Casa de ciudad', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 1,'subtipo' => 'Casa en condominio', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 1,'subtipo' => 'Casa en quinta', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Departamento de campo', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Departamento de ciudad', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Departamento de playa', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Departamento Loft', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Departamento PentHouse', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 2,'subtipo' => 'Minidepartamento', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 4,'subtipo' => 'Terreno lote', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 4,'subtipo' => 'Terreno agricola', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 5,'subtipo' => 'Local comercial', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_inmueble_id' => 5,'subtipo' => 'Local industrial', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('subtipos_inmuebles')->insert($property_subtype);
    }
}
