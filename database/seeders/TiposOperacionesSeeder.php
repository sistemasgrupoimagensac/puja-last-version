<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposOperacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_property = [
            ['tipo' => 'Venta', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Alquiler', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos_operaciones')->insert($status_property);
    }
}
