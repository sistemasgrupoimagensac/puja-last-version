<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoCliente;
use Illuminate\Http\Request;

class ConfirmacionPagoAntesDeDebitar extends Controller
{
    public function check(Request $request)
    {
        $proyectoCliente = ProyectoCliente::findOrFail($request->proyectoClienteId);
        $alDia = $proyectoCliente->al_dia;

        return response()->json([
            'status' => 'success',
            'up_to_date' => $alDia,
        ]);
    }
}
