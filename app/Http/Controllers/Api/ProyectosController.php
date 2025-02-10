<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    
    public function index()
    {
        $projects = Proyecto::with(['cliente', 'banco', 'progreso', 'imagenesAdicionales' => function ($query) {
                $query->where('tipo', 1);
            }])
            ->whereHas('planesActivos', function ($query) {
                $query->where('activo', 1);
            })
        ->get();

        return response()->json([
            'message' => 'Se devuelve los proyectos.',
            'status' => 'success',
            'proyectos' => $projects,
        ]);
    }

    public function filtrarProyectos($filtro)
    {
        $progresoMap = [
            'en-planos'         => 1,
            'en-construccion'   => 2,
            'entrega-inmediata' => 3,
        ];

        if ( !array_key_exists($filtro, $progresoMap) ) {
            return response()->json([
                'message' => 'Filtro de proyectos.',
                'status' => 'error',
            ]);
        }

        $projects = Proyecto::with(['cliente', 'banco', 'progreso', 'imagenesAdicionales' => function ($query) {
                $query->where('tipo', 1);
            }])
            ->where('proyecto_progreso_id', $progresoMap[$filtro])
            ->whereHas('planesActivos', function ($query) {
                $query->where('activo', 1);
            })
        ->get();

        return response()->json([
            'message' => 'Se devuelve los proyectos con filtros.',
            'status' => 'success',
            'projects' => $projects,
        ]);
    }
    
}
