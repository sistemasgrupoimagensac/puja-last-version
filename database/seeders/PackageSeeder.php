<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            ['name' => 'Un Aviso', 'user_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mas Avisos', 'user_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mixtos', 'user_type_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Top', 'user_type_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acreedor', 'user_type_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('packages')->insert($packages);
    }
}
