<?php

// namespace App\Http\Controllers;

// use App\Models\Banco;
// use App\Models\Proyecto;
// use App\Models\ProyectoProgreso;
// use App\Models\ProyectoUnidades;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Exception;

// class ProyectoController extends Controller
// {
//     /**
//      * Mostrar el formulario de creación de un nuevo proyecto.
//      */
//     public function create()
//     {
//         $bancos = Banco::all();
//         $progresos = ProyectoProgreso::all();

//         return view('proyectos.create', compact('bancos', 'progresos'));
//     }

//     /**
//      * Guardar un nuevo proyecto junto con sus unidades.
//      */
//     public function store(Request $request)
//     {
//         // Usar el validador para realizar la validación de los campos
//         $validator = Validator::make($request->all(), [
//             'nombre_proyecto' => 'required|string|max:255',
//             'unidades_cantidad' => 'required|integer',
//             'banco_id' => 'required|exists:bancos,id',
//             'proyecto_progreso_id' => 'required|exists:proyecto_progreso,id',
//             'descripcion' => 'required|string',
//             'fecha_entrega' => 'nullable|date|after:today',  // Validar fecha de entrega como fecha válida y futura
//             'unidades' => 'nullable|string', // Validar como string inicialmente para convertir luego
//         ]);

//         // Si la validación falla, devolver los errores con el código de estado 422
//         if ($validator->fails()) {
//             return response()->json([
//                 'message' => 'Errores de validación',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

//         try {
//             // Convertir el campo unidades a un array si no está vacío
//             $unidadesArray = [];
//             if ($request->filled('unidades')) {
//                 $unidadesArray = json_decode($request->unidades, true);  // Convertir de JSON string a array
//                 if (!is_array($unidadesArray)) {
//                     throw new Exception('El campo unidades debe ser un array válido.');
//                 }
//             }

//             // Crear un nuevo proyecto
//             $proyecto = Proyecto::create([
//                 'nombre_proyecto' => $request->nombre_proyecto,
//                 'unidades_cantidad' => $request->unidades_cantidad,
//                 'banco_id' => $request->banco_id,
//                 'proyecto_progreso_id' => $request->proyecto_progreso_id,
//                 'descripcion' => $request->descripcion,
//                 'fecha_entrega' => $request->fecha_entrega,
//                 'area_desde' => 0,
//                 'area_hasta' => 0,
//                 'area_techada_desde' => 0,
//                 'area_techada_hasta' => 0,
//                 'dormitorios_desde' => 0,
//                 'dormitorios_hasta' => 0,
//                 'banios_desde' => 0,
//                 'banios_hasta' => 0,
//                 'precio_desde' => 0,
//             ]);

//             // Guardar las unidades asociadas al proyecto si se han enviado como un array válido
//             foreach ($unidadesArray as $unidadData) {
//                 ProyectoUnidades::create([
//                     'proyecto_id' => $proyecto->id,
//                     'dormitorios' => $unidadData['dormitorios'],
//                     'banios' => $unidadData['banios'],
//                     'precio_soles' => $unidadData['precio_soles'],
//                     'precio_dolares' => $unidadData['precio_dolares'] ?? 0,
//                     'area' => $unidadData['area'],
//                     'area_techada' => $unidadData['area_techada'] ?? 0,
//                     'piso_numero' => $unidadData['piso_numero'],
//                 ]);
//             }

//             // Si todo se guarda correctamente, enviar respuesta exitosa
//             return response()->json([
//                 'message' => 'Proyecto guardado correctamente.',
//                 'proyecto' => $proyecto,
//             ], 201);

//         } catch (Exception $e) {
//             // Manejar cualquier error en la base de datos o en el proceso
//             return response()->json([
//                 'message' => 'Error al guardar el proyecto.',
//                 'error' => $e->getMessage(),
//             ], 500);
//         }
//     }
// }

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

            // Si se envía un proyecto_id, buscar el proyecto en lugar de crearlo
            if ($request->has('proyecto_id') && !empty($request->proyecto_id)) {
                // Buscar el proyecto existente
                $proyecto = Proyecto::findOrFail($request->proyecto_id);
            } else {
                // Si no existe un proyecto_id, crear un nuevo proyecto
                $proyecto = Proyecto::create([
                    'nombre_proyecto' => $request->nombre_proyecto,
                    'unidades_cantidad' => $request->unidades_cantidad,
                    'banco_id' => $request->banco_id,
                    'proyecto_progreso_id' => $request->proyecto_progreso_id,
                    'descripcion' => $request->descripcion,
                    'fecha_entrega' => $request->fecha_entrega,

                    // Valores predeterminados para evitar el error de campos vacíos
                    'area_desde' => 0,
                    'area_hasta' => 0,
                    'area_techada_desde' => 0,
                    'area_techada_hasta' => 0,
                    'dormitorios_desde' => 0,
                    'dormitorios_hasta' => 0,
                    'banios_desde' => 0,
                    'banios_hasta' => 0,
                    'precio_desde' => 0,
                ]);
            }

            // Actualizar el proyecto con los valores enviados (solo si el proyecto ya existe)
            $proyecto->update([
                'nombre_proyecto' => $request->nombre_proyecto,
                'unidades_cantidad' => $request->unidades_cantidad,
                'banco_id' => $request->banco_id,
                'proyecto_progreso_id' => $request->proyecto_progreso_id,
                'descripcion' => $request->descripcion,
                'fecha_entrega' => $request->fecha_entrega,
            ]);

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

