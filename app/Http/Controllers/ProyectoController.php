<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Proyecto;
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

        // Si se pasa un ID, buscar el proyecto y pasarlo a la vista para editar
        if ($id) {
            $proyecto = Proyecto::with('unidades')->findOrFail($id); // Traer también las unidades relacionadas
        }

        return view('proyectos.create', compact('bancos', 'progresos', 'proyecto'));
    }

    /**
     * Guardar un nuevo proyecto o actualizar uno existente junto con sus unidades.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proyecto_id' => 'nullable|exists:proyectos,id',  // Asegurar que el ID del proyecto sea válido si está presente
            'nombre_proyecto' => 'required|string|max:255',
            'unidades_cantidad' => 'required|integer',
            'banco_id' => 'required|exists:bancos,id',
            'proyecto_progreso_id' => 'required|exists:proyecto_progreso,id',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'nullable|date|after:today',
            'unidades' => 'nullable|string',
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

            // Usar `updateOrCreate` para crear o actualizar el proyecto según `proyecto_id`
            $proyecto = Proyecto::updateOrCreate(
                ['id' => $request->proyecto_id],
                [
                    'nombre_proyecto' => $request->nombre_proyecto,
                    'unidades_cantidad' => $request->unidades_cantidad,
                    'banco_id' => $request->banco_id,
                    'proyecto_progreso_id' => $request->proyecto_progreso_id,
                    'descripcion' => $request->descripcion,
                    'fecha_entrega' => $request->fecha_entrega,

                    // Valores predeterminados para evitar el error de campos vacíos
                    'area_desde' => $request->input('area_desde', 0),
                    'area_hasta' => $request->input('area_hasta', 0),
                    'area_techada_desde' => $request->input('area_techada_desde', 0),
                    'area_techada_hasta' => $request->input('area_techada_hasta', 0),
                    'dormitorios_desde' => $request->input('dormitorios_desde', 0),
                    'dormitorios_hasta' => $request->input('dormitorios_hasta', 0),
                    'banios_desde' => $request->input('banios_desde', 0),
                    'banios_hasta' => $request->input('banios_hasta', 0),
                    'precio_desde' => $request->input('precio_desde', 0),
                ]
            );

            // Guardar o actualizar las unidades asociadas al proyecto
            foreach ($unidadesArray as $unidadData) {
                ProyectoUnidades::updateOrCreate(
                    [
                        'id' => $unidadData['id'] ?? null,  // Actualizar si ya existe `id`
                        'proyecto_id' => $proyecto->id,      // Asegurar que pertenece al mismo proyecto
                    ],
                    [
                        'dormitorios' => $unidadData['dormitorios'],
                        'banios' => $unidadData['banios'],
                        'precio_soles' => $unidadData['precio_soles'],
                        'precio_dolares' => $unidadData['precio_dolares'] ?? 0,
                        'area' => $unidadData['area'],
                        'area_techada' => $unidadData['area_techada'] ?? 0,
                        'piso_numero' => $unidadData['piso_numero'],
                    ]
                );
            }

            return response()->json([
                'message' => 'Proyecto guardado correctamente.',
                'proyecto' => $proyecto,
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al guardar el proyecto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
