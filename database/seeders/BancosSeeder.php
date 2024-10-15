<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bancos')->insert([
            ['nombre' => 'BCP'],
            ['nombre' => 'Interbank'],
            ['nombre' => 'Scotiabank'],
            ['nombre' => 'BBVA'],
            ['nombre' => 'Banbif'],
            ['nombre' => 'Pichincha'],
            ['nombre' => 'Propio'],
        ]);
    }
}
