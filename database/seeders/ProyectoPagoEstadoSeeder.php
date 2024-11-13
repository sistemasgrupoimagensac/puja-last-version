<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyectoPagoEstado;

class ProyectoPagoEstadoSeeder extends Seeder
{
    public function run()
    {
        $estados = ['pendiente', 'pagado', 'fallido', 'reintento', 'fallo_final'];

        foreach ($estados as $estado) {
            ProyectoPagoEstado::create(['nombre' => $estado]);
        }
    }
}
