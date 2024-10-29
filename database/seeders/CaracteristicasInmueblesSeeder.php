<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicasInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $for_principal_inmueble_1 = [
            'principal_inmueble_id'     => 1,
            'habitaciones'              => 2,
            'banios'                    => 2,
            'estacionamientos'          => 1,
            'area_construida'           => 45.5,
            'area_total'                => 50,
            'antiguedad'                => 1,
            'anios_antiguedad'          => null,
            'precio_soles'              => 1200,
            'precio_dolares'            => 350,
            'titulo'                    => 'Lindo departamento de estreno',
            'descripcion'               => 'Se alquila este departamento, tiene buenas cosas, bonito para pareja, se aceptan mascotas',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_2 = [
            'principal_inmueble_id'     => 2,
            'habitaciones'              => 2,
            'banios'                    => 3,
            'estacionamientos'          => 2,
            'area_construida'           => 45,
            'area_total'                => 50,
            'antiguedad'                => 1,
            'anios_antiguedad'          => null,
            'precio_soles'              => 1500,
            'precio_dolares'            => 400,
            'titulo'                    => 'Lindo departamento de estreno',
            'descripcion'               => 'Se alquila este departamento, tiene buenas cosas, bonito para pareja, se aceptan mascotas',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_3 = [
            'principal_inmueble_id'     => 3,
            'habitaciones'              => 3,
            'banios'                    => 3,
            'estacionamientos'          => 2,
            'area_construida'           => 50,
            'area_total'                => 50,
            'antiguedad'                => 0,
            'anios_antiguedad'          => null,
            'precio_soles'              => 1500,
            'precio_dolares'            => 400,
            'titulo'                    => 'Lindo departamento de estreno',
            'descripcion'               => 'Se alquila este departamento, tiene buenas cosas, bonito para pareja, se aceptan mascotas',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_4 = [
            'principal_inmueble_id'     => 4,
            'habitaciones'              => 3,
            'banios'                    => 2,
            'estacionamientos'          => 4,
            'area_construida'           => 51.2,
            'area_total'                => 55,
            'antiguedad'                => 2,
            'anios_antiguedad'          => 6,
            'precio_soles'              => 1700,
            'precio_dolares'            => 450,
            'titulo'                    => 'Lindo departamento de estreno',
            'descripcion'               => 'Se alquila este departamento, tiene buenas cosas, bonito para pareja, se aceptan mascotas',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_5 = [
            'principal_inmueble_id'     => 5,
            'habitaciones'              => 2,
            'banios'                    => 1,
            'estacionamientos'          => 4,
            'area_construida'           => 51.2,
            'area_total'                => 54,
            'antiguedad'                => 0,
            'anios_antiguedad'          => null,
            'precio_soles'              => 1800,
            'precio_dolares'            => 450,
            'titulo'                    => 'Lindo departamento de estreno',
            'descripcion'               => 'Se alquila este departamento, tiene buenas cosas, bonito para pareja, se aceptan mascotas',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        $for_principal_inmueble_6 = [
            'principal_inmueble_id'     => 6,
            'habitaciones'              => 5,
            'banios'                    => 3,
            'estacionamientos'          => 3,
            'area_construida'           => 120,
            'area_total'                => 125,
            'antiguedad'                => 2,
            'anios_antiguedad'          => 10,
            'precio_soles'              => 400000,
            'precio_dolares'            => 100000,
            'titulo'                    => 'Se vende casa bonita',
            'descripcion'               => 'Se venda linda casa con buenos ambientes para el disfrute de toda la familia',
            'created_at'                => now(),
            'updated_at'                => now(),
        ];

        DB::table('caracteristicas_inmuebles')->insert([$for_principal_inmueble_1, $for_principal_inmueble_2, $for_principal_inmueble_3, $for_principal_inmueble_4, $for_principal_inmueble_5, $for_principal_inmueble_6]);
    }
}
