<?php

namespace App\Http\Controllers;

use App\Models\Proyecto; // Importar el modelo Proyecto
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function index()
    {
        // Obtener todos los proyectos con su banco, progreso y la imagen adicional con menor ID disponible
        $proyectos = Proyecto::with(['banco', 'progreso', 'imagenesAdicionales' => function ($query) {
            $query->where('estado', 1)->orderBy('id', 'asc')->limit(1); // Obtener la imagen con el menor ID
        }])->paginate(9); // Paginación para los proyectos

        // Retornar la vista con los proyectos y las imágenes
        return view('proyectos', compact('proyectos'));
    }
}
