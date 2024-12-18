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
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'acceso a la playa',              'icono' => 'fa-house-flood-water',    'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'acceso al campo',                'icono' => 'fa-cow icon-orange',      'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'aeropuerto cerca',               'icono' => 'fa-plane-departure',      'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'biblioteca',                     'icono' => 'fa-book',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'cancha de fútbol',               'icono' => 'fa-futbol',               'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'cancha de tenis',                'icono' => 'fa-table-tennis',         'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'centro deportivo',               'icono' => 'fa-person-running',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'club house',                     'icono' => 'fa-house-flag',           'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'frente a parque',                'icono' => 'fa-building-wheat',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'ingreso independiente',          'icono' => 'fa-road',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'internet / wifi',                'icono' => 'fa-wifi',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'parque interno',                 'icono' => 'fa-tree',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'parrilla',                       'icono' => 'fa-fire-burner',          'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'recepción',                      'icono' => 'fa-bell-concierge',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sala de entretenimiento',        'icono' => 'fa-dice',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sala de reuniones',              'icono' => 'fa-handshake',            'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'sauna',                          'icono' => 'fa-hot-tub-person',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'televisión por cable',           'icono' => 'fa-tv',                   'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista a parque',                 'icono' => 'fa-tree-city',            'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista al mar',                   'icono' => 'fa-water',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista interior',                 'icono' => 'fa-arrow-right-to-city',  'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'vista panorámica a la ciudad',   'icono' => 'fa-city',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona céntrica',                  'icono' => 'fa-arrows-to-circle',     'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona comercial',                 'icono' => 'fa-cash-register',        'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 1, 'caracteristica' => 'zona industrial',                'icono' => 'fa-industry',             'created_at' => now(), 'updated_at' => now()],

            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'aire acondicionado',             'icono' => 'fa-snowflake',            'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'almacén',                        'icono' => 'fa-warehouse',            'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'amoblado',                       'icono' => 'fa-couch',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'área de servicio',               'icono' => 'fa-user-gear',            'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'áreas comunes',                  'icono' => 'fa-comments',             'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'ascensor(es)',                   'icono' => 'fa-elevator',             'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'balcón',                         'icono' => 'fa-house-chimney-window', 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'calefacción',                    'icono' => 'fa-fire',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'caseta de seguridad',            'icono' => 'fa-building-shield',      'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'chimenea',                       'icono' => 'fa-house-chimney',        'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'cocina con isla',                'icono' => 'fa-sink',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'cocina equipada',                'icono' => 'fa-kitchen-set',          'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'condominio',                     'icono' => 'fa-building',             'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'duplex',                         'icono' => 'fa-building',             'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'gas natural',                    'icono' => 'fa-fire-flame-simple',    'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'gimnasio',                       'icono' => 'fa-dumbbell',             'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'habitación de servicio',         'icono' => 'fa-screwdriver-wrench',   'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'habitación principal con baño',  'icono' => 'fa-bath icon-orange',     'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jacuzzi',                        'icono' => 'fa-water-ladder',         'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jardín externo',                 'icono' => 'fa-sun-plant-wilt',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'jardín interno',                 'icono' => 'fa-plant-wilt',           'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'juego para niños',               'icono' => 'fa-volleyball',           'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'kitchenette',                    'icono' => 'fa-calendar-week',        'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'lavandería',                     'icono' => 'fa-soap',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'pet friendly',                   'icono' => 'fa-dog',                  'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'piscina',                        'icono' => 'fa-person-swimming',      'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'servicios básicos',              'icono' => 'fa-faucet-drip',          'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'tanque de agua',                 'icono' => 'fa-droplet',              'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'Terma eléctrica',                'icono' => 'fa-bolt',                 'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'terraza',                        'icono' => 'fa-umbrella-beach',       'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'triplex',                        'icono' => 'fa-hotel',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'video vigilancia',               'icono' => 'fa-video',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 2, 'caracteristica' => 'walk in closet',                 'icono' => 'fa-door-closed',          'created_at' => now(), 'updated_at' => now()],

            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'cochera techada',                'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'cochera sin techar',             'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'casa 1 piso',                    'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'casa 2 pisos',                   'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'casa 3 pisos',                   'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'más de 3 pisos',                 'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'con terraza',                    'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
            ['categoria_caracteristica_id' => 3, 'caracteristica' => 'con sótano',                     'icono' => 'fa-check',                'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('caracteristicas_extra')->insert($caracteristicas);
    }
}
