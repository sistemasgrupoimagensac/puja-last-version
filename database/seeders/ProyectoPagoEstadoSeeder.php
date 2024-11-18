<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyectoPagoEstado;

class ProyectoPagoEstadoSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que el primer estado sea 'pendiente' para coincidir con el valor predeterminado en las migraciones
        $estados = ['pendiente', 'pagado', 'fallido', 'reintento', 'fallo_final'];

        foreach ($estados as $estado) {
            ProyectoPagoEstado::create(['nombre' => $estado]);
        }
    }
}