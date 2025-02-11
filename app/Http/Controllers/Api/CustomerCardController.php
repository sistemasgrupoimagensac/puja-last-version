<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoCliente;
use App\Models\ProyectoClienteTarjeta;
use Illuminate\Http\Request;

class CustomerCardController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'proyecto_cliente_id' => 'required|integer',
            'customer_id' => 'required|string',
            'card_id' => 'required|string',
            'card_brand' => 'nullable|string',
            'card_last_digits' => 'nullable|string',
            'expiration_month' => 'nullable|string',
            'expiration_year' => 'nullable|string',
            'holder_name' => 'nullable|string',
            'type' => 'nullable|string',
        ]);
    
        $proyectoCliente = ProyectoCliente::find($request->proyecto_cliente_id);
        if (!$proyectoCliente) {
            return response()->json(['status' => 'Error', 'message' => 'ProyectoCliente no encontrado.'], 404);
        }
    
        $existingCard = ProyectoClienteTarjeta::where('card_id', $request->card_id)->first();
    
        if ( !$existingCard ) {
            ProyectoClienteTarjeta::create([
                'proyecto_cliente_id' => $request->proyecto_cliente_id,
                'customer_id' => $request->customer_id,
                'card_id' => $request->card_id,
                'card_brand' => $request->card_brand,
                'card_last_digits' => substr($request->card_last_digits, -4), // Últimos 4 dígitos de la tarjeta
                'expiration_month' => $request->expiration_month,
                'expiration_year' => $request->expiration_year,
                'holder_name' => $request->holder_name,
                'type' => $request->type,
            ]);
    
            return response()->json([
                'status' => 'Success', 
                'message' => 'Tarjeta guardada exitosamente.'
            ], 201);
        }
    
        return response()->json([
            'status' => 'Warning', 
            'message' => 'La tarjeta ya existe en la base de datos.'
        ], 200);
    }
}
