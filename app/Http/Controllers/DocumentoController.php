<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentoController extends Controller
{
    public function consultar(Request $request)
    {
       
        $documento = $request->input('documento');
        $tipo = $request->input('btnradio');

        if (!$documento || !$tipo) {
            return response()->json(['error' => 'Faltan parámetros requeridos.'], 400);
        }

        // Determina la URL de la API en función del tipo de documento
        $apiURL = $tipo === 'DNI' ? 'https://apiperu.dev/api/dni' : 'https://apiperu.dev/api/ruc';
        $token = 'db3ed63994d8aef68d6a7db28083109d033ee0e32211ecd7932a86dd15093a31';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post($apiURL, [
            'dni' => $documento
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Error al realizar la consulta.'], $response->status());
        }

    }
}
