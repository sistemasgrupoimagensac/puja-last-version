<?php

namespace Database\Seeders;

use App\Models\ProyectoPlanesEstados;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoPlanesEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $estados = [
            [
                'nombre' => 'activo',
                'descripcion' => 'Cuando el plan está vigente y funcionando.',
            ],
            [
                'nombre' => 'pendiente',
                'descripcion' => 'Cuando el plan ha sido registrado pero aún no ha iniciado (útil para nuevos registros).',
            ],
            [
                'nombre' => 'vencido',
                'descripcion' => 'Cuando la fecha de finalización ha pasado y no se ha renovado.',
            ],
            [
                'nombre' => 'renovado',
                'descripcion' => 'Cuando el plan ha sido renovado y tiene un nuevo período de vigencia.',
            ],
            [
                'nombre' => 'dado_de_baja',
                'descripcion' => 'Cuando el cliente solicita la baja del plan.',
            ],
            [
                'nombre' => 'suspendido',
                'descripcion' => 'Cuando el plan es temporalmente deshabilitado (por ejemplo, falta de pago).',
            ],
            [
                'nombre' => 'cancelado',
                'descripcion' => 'Cuando el plan es eliminado por el cliente o por el administrador antes de su inicio.',
            ],
            [
                'nombre' => 'finalizado',
                'descripcion' => 'Cuando el plan termina naturalmente y no se renueva.',
            ],
        ];

        foreach($estados as $estado) {
            ProyectoPlanesEstados::create($estado);
        }
    }
}
