<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Proyecto;
use App\Models\ProgresoProyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Mostrar el formulario de creación
    public function create()
    {
        // Obtener bancos y progresos del proyecto
        $bancos = Banco::all();  
        $progresos = ProgresoProyecto::all();  

        // Retornar la vista con los bancos y estados de progreso
        return view('proyectos.create', compact('bancos', 'progresos'));
    }

    // Guardar un nuevo proyecto
    public function store(Request $request)
    {

        return response()->json([
            'request' => $request->all(),
        ], 200);
        // Validación de los datos
        $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'unidades' => 'required|integer',
            'banco_id' => 'required|exists:bancos,id',
            'progreso_proyecto_id' => 'required|exists:progreso_proyecto,id',
            'descripcion' => 'required|string',
        ]);

        // Crear el proyecto
        $proyecto = Proyecto::create([
            'nombre_proyecto' => $request->nombre_proyecto,
            'unidades' => $request->unidades,
            'banco_id' => $request->banco_id,
            'progreso_proyecto_id' => $request->progreso_proyecto_id,
            'descripcion' => $request->descripcion,
        ]);

        // Guardar el proyecto y redirigir según el botón presionado
        if ($request->input('action') == 'guardar') {
            return redirect()->back()->with('success', 'Proyecto guardado parcialmente.');
        } else {
            return redirect('/')->with('success', 'Proyecto guardado y redirigido a la página principal.');
        }
    }
}

