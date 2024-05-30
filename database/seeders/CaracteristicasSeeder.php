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
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Acabados de Lujo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Amueblado/a', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Av. acceso afirmada', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Av. acceso asfaltada', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Caseta de guardia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Centros comerciales cercanos', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cerca a Parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cerca a colegios', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cerca eléctrica', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cerco de material noble', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cerco vivo', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Chimenea', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Closet', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cocina', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Cuartos de servicio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Duplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'En Condominio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Frente al Parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Frente al mar', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Intercomunicador', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Jacuzzi', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Jardín(es)', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Mascotas', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Piscina', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Recepción', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Reposteros en cocina', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Seguridad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Terraza', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Triplex', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Vista Parque', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Vista a la ciudad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Vista al mar', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Walk in closet', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'Zona industrial', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Acceso por camino de tierra', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Area de BBQ', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Aire acondicionado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Área de juegos infantiles', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Área de lavanderia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Áreas verdes', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Canchas deportivas', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Control de accesos', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Gimnasio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Seguridad privada', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Kitchenet', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Línea blanca', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Parrilla', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Posee luminarias', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Servicio de limpieza', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Servicios básicos (agua/luz)', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Sistema de alarma de seguridad', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Uso comercial', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Uso profesional', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'Video vigilancia', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Área común', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Club house', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Cocheras de visitas', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Comedor diario', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Desague', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Dormitorio principal con baño', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Equipado', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Hall de ingreso', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Ingreso independiente', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Parque interno', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Patio', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Sala de entretenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Sala de estar', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Sauna', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Solarium', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 4, 'caracteristica' => 'Turco', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('caracteristicas_extra')->insert($caracteristicas);
    }
}
