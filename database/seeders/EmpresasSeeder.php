<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->environment('local', 'staging')) {
            DB::table('empresas')->insert([
                [
                    'id' => 1,
                    'state' => 1,
                    'status_electronic_billing' => 0,
                    'name' => 'G inversiones',
                    'logo' => '/billing/logo.png',
                    'logo_menu' => '/billing/logo-baner.png',
                    'path' => '/billing/',
                ],
            ]);

            DB::table('fact_electronica')->insert([
                [
                    'id' => 1,
                    'empresa_id' => 1,
                    'ruc' => '20605395181',
                    'business_name' => 'GI ADMINISTRADORA DE NEGOCIOS E INVERSIONES S.A.C.',
                    'tradename' => 'G Inversiones S.A.C.',
                    'ubigeo' => '00000',
                    'department' => 'LIMA',
                    'province' => 'LIMA',
                    'district' => 'SAN ISIDRO',
                    'address' => 'AV. ENRIQUE CANAVAL MOREYRA NRO. 290 DPTO. 41 LIMATAMBO (ALTURA DE PETROPERU) LIMA - LIMA - SAN ISIDRO',
                    'phone' => '403-6309',
                    'message_print' => 'Sistema de Facturacion Electronica Desarrollado por 360 Media Creative',
                    'certificate_name' => env('CERTIFICATE_NAME'),
                    'certificate_pass' => env('CERTIFICATE_PASS'),
                    'sol_user' => env('SOL_USER'),
                    'sol_password' => env('SOL_PASSWORD'),
                ],
            ]);
        }
    }
}
