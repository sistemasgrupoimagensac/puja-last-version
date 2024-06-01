<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionesInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_principal_inmueble_1 = [
            'principal_inmueble_id'     => 1,
            'direccion'                 => 'El Rosario, Golf, San Isidro',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150131,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_2 = [
            'principal_inmueble_id'     => 2,
            'direccion'                 => '28 DE JULIO, Miraflores, Lima',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150122,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_3 = [
            'principal_inmueble_id'     => 3,
            'direccion'                 => 'Italia, Miraflores, Lima',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150122,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_4 = [
            'principal_inmueble_id'     => 4,
            'direccion'                 => 'Av. del Pasifico 175, San Miguel, Lima',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150136,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_5 = [
            'principal_inmueble_id'     => 5,
            'direccion'                 => 'Malecon Cisneros, Miraflores, Lima',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150122,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_6 = [
            'principal_inmueble_id'     => 6,
            'direccion'                 => 'AV. Tomas Marsano al 2100, Surquillo, Lima',
            'departamento_id'           => 15,
            'provincia_id'              => 1501,
            'distrito_id'               => 150141,
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        DB::table('ubicaciones_inmuebles')->insert([$for_principal_inmueble_1, $for_principal_inmueble_2, $for_principal_inmueble_3, $for_principal_inmueble_4, $for_principal_inmueble_5, $for_principal_inmueble_6]);
    }
}
