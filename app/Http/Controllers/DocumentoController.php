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
            $data = $response->json();
            return view('resultados', compact('data'));
        } else {
            return back()->withErrors(['message' => 'Error al realizar la consulta.']);
        }
    }
}
