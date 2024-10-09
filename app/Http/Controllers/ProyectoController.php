<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Proyecto;
use App\Models\ProyectoImagenesAdicionales;
use App\Models\ProyectoImagenesUnidades;
use App\Models\ProyectoProgreso;
use App\Models\ProyectoUnidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProyectoController extends Controller
{
    /**
     * Mostrar el formulario de creación o edición de un proyecto.
     */
    public function create($id = null)
    {
        $bancos = Banco::all();
        $progresos = ProyectoProgreso::all();
        $proyecto = null;
        $imagenes = collect(); // Colección vacía si es un nuevo proyecto
        $imagenesUnidades = collect(); // Colección para las imágenes de las unidades
    
        // Si se pasa un ID, estamos en modo edición, buscar el proyecto y cargar sus datos e imágenes
        if ($id) {
            $proyecto = Proyecto::with(['unidades' => function ($query) {
                $query->where('estado', 1); // Filtrar solo las unidades activas
            }])->findOrFail($id);
    
            // Obtener las imágenes relacionadas del proyecto
            $imagenes = ProyectoImagenesAdicionales::where('proyecto_id', $id)->get();
    
            // Obtener las imágenes de cada unidad asociada al proyecto
            $imagenesUnidades = ProyectoImagenesUnidades::where('proyecto_id', $id)
                ->where('estado', 1) // Solo imágenes activas
                ->get()
                ->groupBy('proyecto_unidades_id'); // Agrupar por la ID de la unidad para mostrar correctamente
        }
    
        // Pasar la variable $imagenes y $imagenesUnidades a la vista
        return view('proyectos.create', compact('bancos', 'progresos', 'proyecto', 'imagenes', 'imagenesUnidades'));
    }
    

    /**
     * Guardar un nuevo proyecto o actualizar uno existente junto con sus unidades.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proyecto_id' => 'nullable|exists:proyectos,id',
            'nombre_proyecto' => 'required|string|max:255',
            'unidades_cantidad' => 'required|integer',
            'banco_id' => 'required|exists:bancos,id',
            'proyecto_progreso_id' => 'required|exists:proyecto_progreso,id',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'nullable|date',
            'unidades' => 'nullable|string',
            'direccion' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Convertir el campo unidades a un array si no está vacío
            $unidadesArray = $request->filled('unidades') ? json_decode($request->unidades, true) : [];

            // Crear o actualizar el proyecto
            $proyecto = Proyecto::updateOrCreate(
                ['id' => $request->proyecto_id],
                [
                    'nombre_proyecto' => $request->nombre_proyecto,
                    'unidades_cantidad' => $request->unidades_cantidad,
                    'banco_id' => $request->banco_id,
                    'proyecto_progreso_id' => $request->proyecto_progreso_id,
                    'descripcion' => $request->descripcion,
                    'fecha_entrega' => $request->fecha_entrega,
                    'area_desde' => $request->input('area_desde', 0),
                    'area_hasta' => $request->input('area_hasta', 0),
                    'area_techada_desde' => $request->input('area_techada_desde', 0),
                    'area_techada_hasta' => $request->input('area_techada_hasta', 0),
                    'dormitorios_desde' => $request->input('dormitorios_desde', 0),
                    'dormitorios_hasta' => $request->input('dormitorios_hasta', 0),
                    'banios_desde' => $request->input('banios_desde', 0),
                    'banios_hasta' => $request->input('banios_hasta', 0),
                    'precio_desde' => $request->input('precio_desde', 0),
                    'direccion' => $request->direccion,
                    'distrito' => $request->distrito,
                    'provincia' => $request->provincia,
                    'departamento' => $request->departamento,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]
            );

            // Guardar o actualizar las unidades con el estado enviado desde el frontend
            foreach ($unidadesArray as $key => $unidadData) {
                $unidad = ProyectoUnidades::updateOrCreate(
                    [
                        'id' => $unidadData['id'] ?? null,  // Actualizar si ya existe `id`
                        'proyecto_id' => $proyecto->id,
                    ],
                    [
                        'dormitorios' => $unidadData['dormitorios'],
                        'banios' => $unidadData['banios'],
                        'precio_soles' => $unidadData['precio_soles'],
                        'precio_dolares' => $unidadData['precio_dolares'] ?? 0,
                        'area' => $unidadData['area'],
                        'area_techada' => $unidadData['area_techada'] ?? 0,
                        'piso_numero' => $unidadData['piso_numero'],
                        'estado' => $unidadData['estado'],
                    ]
                );

                // Actualizar el ID de la unidad si es nueva
                $unidadesArray[$key]['id'] = $unidad->id;
            }

            return response()->json([
                'message' => 'Proyecto guardado correctamente.',
                'proyecto' => $proyecto,
                'unidades' => $unidadesArray,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al guardar el proyecto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($slug)
    {
        try {
            // Buscar el proyecto por su slug
            $proyecto = Proyecto::where('slug', $slug)->firstOrFail();

            // Obtener las imágenes adicionales del proyecto
            $imagenes = ProyectoImagenesAdicionales::where('proyecto_id', $proyecto->id)
                ->where('estado', 1) // Solo imágenes activas
                ->get();

            // Obtener las unidades relacionadas con el proyecto y estado activo (1)
            $unidades = ProyectoUnidades::where('proyecto_id', $proyecto->id)
                ->where('estado', 1)
                ->get();

            // Pasar el proyecto, las imágenes y las unidades a la vista
            return view('proyecto', compact('proyecto', 'imagenes', 'unidades'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Proyecto no encontrado.',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
