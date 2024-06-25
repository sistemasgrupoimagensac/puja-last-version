<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caracteristicas = [
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'acceso a la playa', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'acceso al campo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'aeropuerto cerca', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'biblioteca', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'cancha de futbol', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'cancha de tenis', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'centro deportivo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'club house', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'frente a parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'ingreso independiente', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'internet / wifi', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'parque interno', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'parrilla', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'recepcion', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sala de entretenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sala de reuniones', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sauna', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'television por cable', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista a parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista al mar', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista interior', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista panoramica a la ciudad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona céntrica', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona comercial', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona industrial', 'created_at' => now(), 'updated_at' => now()],

            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'aire acondicionado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'almacen', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'amoblado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'area de servicio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'areas comunes', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'ascensor(es)', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'balcon', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'calefaccion', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'caseta de seguridad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'chimenea', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'cocina con isla', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'cocina equipada', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'condominio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'duplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'gas natural', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'gimnasio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'habitacion de servicio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'habitacion principal con banio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jacuzzi', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jardin externo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jardin interno', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'juego para ninios', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'kitchenette', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'lavanderia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'pet friendly', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'piscina', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'servicios basicos', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'tanque de agua', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Terma electrica', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'terraza', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'triplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'video vigilancia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'walk in closet', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('caracteristicas_extra')->insert($caracteristicas);
    }
}
