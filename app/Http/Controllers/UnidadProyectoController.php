<?php

namespace App\Http\Controllers;

use App\Models\UnidadProyecto;
use Illuminate\Http\Request;

class UnidadProyectoController extends Controller
{
    // Guardar una nueva unidad
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'dormitorios' => 'required|integer',
            'precio_soles' => 'required|numeric',
            'area' => 'required|numeric',
            'banios' => 'required|integer',
            'piso_numero' => 'required|integer',
        ]);

        // Crear la nueva unidad
        UnidadProyecto::create([
            'proyecto_id' => $request->proyecto_id,
            'dormitorios' => $request->dormitorios,
            'precio_soles' => $request->precio_soles,
            'precio_dolares' => $request->precio_dolares,
            'area' => $request->area,
            'area_techada' => $request->area_techada,
            'banios' => $request->banios,
            'piso_numero' => $request->piso_numero,
        ]);

        return response()->json(['success' => 'Unidad agregada correctamente']);
    }
}
