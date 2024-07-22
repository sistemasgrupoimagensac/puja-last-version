<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_docs_fact_elec = [
            [
                'id' => 1,
                'state' => 1,
                'type_doc' => '01',
                'name' => 'NOTA DE VENTA',
                'series' => 'N001',
                'correlative' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'state' => 1,
                'type_doc' => '02',
                'name' => 'BOLETA DE VENTA',
                'series' => 'B002',
                'correlative' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'state' => 1,
                'type_doc' => '03',
                'name' => 'FACTURA',
                'series' => 'F001',
                'correlative' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('tipo_documentos')->insert($tipos_docs_fact_elec);
    }
}
