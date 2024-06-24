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
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Amoblado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Aire Acondicionado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Almacén', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Ascensor', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Área de Servicio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Áreas Comunes', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Balcón', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Calefacción', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Caseta de Seguridad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cocina Equipada', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Condominio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Dúplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Frente a Parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Gas Natural', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Gimnasio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Habitación Principal con Baño', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Jardín Interno', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Jardín Externo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Jacuzzi', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Juegos para niños', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Kitchenette', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Lavandería', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Pet Friendly', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Piscina', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Servicios Básicos', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Tanque de Agua', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Terma Eléctrica', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Terraza', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Triplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Video Vigilancia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Walk-in Closet', 'created_at' => now(), 'updated_at' => now()],

            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Biblioteca', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Cancha de Fútbol', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Centro Deportivo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Club House', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Conserje', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Ingreso Independiente', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Internet / WiFi', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Parque Interno', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Parrilla', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Recepción', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Sala de Entretenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Sala de Reuniones', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Sauna', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Televisión por Cable', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Vista al Mar', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Zona Céntrica', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('caracteristicas_extra')->insert($caracteristicas);
    }
}
