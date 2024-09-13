<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DocumentoController extends Controller
{
    public function consultar_dni_ruc (Request $request) {

        $validator = Validator::make($request->all(), [
            'dni' => 'nullable|string',
            'ruc' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        $url = env('API_PERU_URL');
        $token = env('API_PERU_TOKEN');

        $tipo_documento = array_keys($request->all())[0];
        $numero_documento = $request->$tipo_documento;
        $apiURL = $url . $tipo_documento;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($apiURL, [
            $tipo_documento => $numero_documento,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Error al realizar la consulta'], $response->status());
        }

    }
}
