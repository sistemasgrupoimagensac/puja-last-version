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
            'tipo_usuario_id'   => 2,
            'not_pay'           => 0,
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
            'tipo_usuario_id'   => 2,
            'not_pay'           => 0,
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

        $user_3 = [
            'tipo_usuario_id'   => 4,
            'not_pay'           => 1,
            'codigo_unico'      => 'PUJA-001-001-003',
            'nombres'           => 'Luz',
            'apellidos'         => 'Pantoja',
            'email'             => 'lpantoja@bustamanteromero.com.pe',
            'password'          => Hash::make('Lpan03@bus.'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '00000001',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $user_4 = [
            'tipo_usuario_id'   => 4,
            'not_pay'           => 1,
            'codigo_unico'      => 'PUJA-001-001-004',
            'nombres'           => 'Sofia',
            'apellidos'         => 'Huaripata',
            'email'             => 'shuaripata@bustamanteromero.com.pe',
            'password'          => Hash::make('Shua04@bus.'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '00000002',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $user_5 = [
            'tipo_usuario_id'   => 4,
            'not_pay'           => 1,
            'codigo_unico'      => 'PUJA-001-001-005',
            'nombres'           => 'Estefano',
            'apellidos'         => 'Cervantes Hurtado',
            'email'             => 'ecervantes@bustamanteromero.com.pe',
            'password'          => Hash::make('Ecer05@bus.'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '00000003',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $user_6 = [
            'tipo_usuario_id'   => 4,
            'not_pay'           => 1,
            'codigo_unico'      => 'PUJA-001-001-006',
            'nombres'           => 'Gerardo ',
            'apellidos'         => 'Janampa',
            'email'             => 'gjanampa@bustamanteromero.com.pe',
            'password'          => Hash::make('Gjan06@bus.'),
            'tipo_documento_id' => 1,
            'numero_documento'  => '00000004',
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        DB::table('users')->insert([$user_1, $user_2, $user_3, $user_4, $user_5, $user_6]);
    }
}
