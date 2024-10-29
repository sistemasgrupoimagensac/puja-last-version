<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['nombre' => 'Amazonas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Áncash', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Apurímac', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Arequipa', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ayacucho', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cajamarca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Callao', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cusco', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Huancavelica', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Huánuco', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ica', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Junín', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'La Libertad', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lambayeque', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lima', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Loreto', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Madre de Dios', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Moquegua', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pasco', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Piura', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Puno', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Martín', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tacna', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tumbes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ucayali', 'created_at' => now(), 'updated_at' => now()],
        ];
 
        DB::table('departamentos')->insert($departments);
    }
}
