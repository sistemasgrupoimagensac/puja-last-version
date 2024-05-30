<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_documento = [
            ['documento' => 'DNI', 'created_at' => now(), 'updated_at' => now()],
            ['documento' => 'CE', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_documento')->insert($tipos_documento);
    }
}
