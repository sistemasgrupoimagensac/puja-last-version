<?php

namespace App\Http\Controllers;
use App\Models\Contacto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function index() 
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        // validar
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'correo' => 'required|string|email|max:60',
            'telefono' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'consulta' => 'required|in:1,2,3,4,5,6',
            'mensaje' => 'required|string|max:2000',
        ]);

        // si la validación tiene errores
        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        // guardar en la base de datos
        Contacto::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'consulta' => $request->input('consulta'),
            'mensaje' => $request->input('mensaje'),
        ]);

        // envio
        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Envío de consulta correcto',
        ], 200);
    }
}
