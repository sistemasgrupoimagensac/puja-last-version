<?php

namespace App\Http\Controllers;

use App\Models\ProyectoCliente;
use Illuminate\Http\Request;

class ConfirmacionPagoAntesDeDebitar extends Controller
{
    public function check(Request $request)
    {
        $proyectoCliente = ProyectoCliente::where('id', $request->proyectoClienteId)->first();
        $alDia = $proyectoCliente->al_dia;

        return response()->json([
            'up_to_date' => $alDia,
        ]);
    }
}
