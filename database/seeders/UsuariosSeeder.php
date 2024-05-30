<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_1 = [
            'tipo_usuario_id'   => 1,
            'codigo_unico'      => 'PUJA-001-001-001',
            'nombres'           => 'Alejandro',
            'apellidos'         => 'Rafael Chavez',
            'email'             => 'jrafael@360creative.pe',
            'password'          => Hash::make('123456'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '78550107',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $user_2 = [
            'tipo_usuario_id'   => 1,
            'codigo_unico'      => 'PUJA-001-001-002',
            'nombres'           => 'Osquitar',
            'apellidos'         => 'Echegaray',
            'email'             => 'oechegaray@360creative.pe',
            'password'          => Hash::make('123456'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '48785047',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('users')->insert([$user_1, $user_2]);
    }
}
