<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Proyecto;
use App\Models\ProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoImagenesAdicionales;
use App\Models\ProyectoImagenesUnidades;
use App\Models\ProyectoPagoEstado;
use App\Models\ProyectoPlanesActivos;
use App\Models\ProyectoProgreso;
use App\Models\ProyectoUnidades;
use App\Models\User;
use App\Services\Proyectos\ServicioEstadoCliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function create($id = null)
    {
        $bancos = Banco::all();
        $progresos = ProyectoProgreso::all();
        $proyecto = null;
        $imagenes = collect(); // Colección vacía si es un nuevo proyecto
        $imagenesUnidades = collect(); // Colección para las imágenes de las unidades
    
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

        $imagenesUnidades = $imagenesUnidades ?? [];
    
        return view('proyectos.create', compact('bancos', 'progresos', 'proyecto', 'imagenes', 'imagenesUnidades'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $proyectoCliente = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_planes_activos.proyecto_cliente_id', '=', 'proyecto_clientes.id')
            ->where('user_id', $user->id)
            ->where('proyecto_planes_activos.fecha_inicio', '<=', Carbon::now())
            ->where('proyecto_planes_activos.fecha_fin', '>=', Carbon::now())
            ->select(
                'proyecto_clientes.id as id',
                'proyecto_planes_activos.id as plan_activo_id',
                'proyecto_planes_activos.numero_anuncios as plan_activo_cant_anuncios',
            )
            ->orderBy('proyecto_planes_activos.fecha_inicio', 'asc')
        ->first();

        if (!$proyectoCliente) {
            return back()->with('error', 'No se encontró un cliente asociado a este usuario.');
        }

        if( $request->proyecto_id === null ){

            $cantidadProyectos = Proyecto::where('proyecto_cliente_id', $proyectoCliente->id)
                ->where('proyecto_plan_activo_id', $proyectoCliente->plan_activo_id)
            ->count();
    
            if ( $cantidadProyectos >= $proyectoCliente->plan_activo_cant_anuncios ) {

                return response()->json([
                    'message' => 'Límite de anuncios disponibles alcanzado. No puedes crear más proyectos.',
                ], 403);

            }

        }

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

            $unidadesArray = $request->filled('unidades') ? json_decode($request->unidades, true) : [];

            $proyecto = Proyecto::updateOrCreate([
                'id' => $request->proyecto_id
                ],[
                'proyecto_cliente_id' => $proyectoCliente->id,
                'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
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
            ]);

            foreach ($unidadesArray as $key => $unidadData) {
                $unidad = ProyectoUnidades::updateOrCreate([
                    'id' => $unidadData['id'] ?? null,
                    'proyecto_id' => $proyecto->id,
                    ],[
                    'dormitorios' => $unidadData['dormitorios'],
                    'banios' => $unidadData['banios'],
                    'precio_soles' => $unidadData['precio_soles'],
                    // 'precio_dolares' => $unidadData['precio_dolares'] ?? 0,
                    'precio_dolares' => is_numeric($unidadData['precio_dolares']) ? $unidadData['precio_dolares'] : 0,
                    'area' => $unidadData['area'],
                    'area_techada' => $unidadData['area_techada'] ?? 0,
                    'piso_numero' => $unidadData['piso_numero'],
                    'estado' => $unidadData['estado'],
                ]);

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

            if (!isset($proyecto)) {
                return response()->view('errors.404', [], 404);
            }
    
            // Obtener las imágenes adicionales del proyecto
            $imagenes = ProyectoImagenesAdicionales::where('proyecto_id', $proyecto->id)
                ->where('estado', 1) // Solo imágenes activas
                ->get()
            ->toArray();

            usort($imagenes, function ($a, $b) {
                // Ordena primero las imágenes con tipo=1
                if ($a['tipo'] === '1' && $b['tipo'] !== '1') {
                    return -1;
                }
                if ($a['tipo'] !== '1' && $b['tipo'] === '1') {
                    return 1;
                }
                return 0; // Mantener el orden relativo de las demás imágenes
            });

            // Obtener las unidades con las imágenes relacionadas y estado activo (1)
            $unidades = ProyectoUnidades::where('proyecto_id', $proyecto->id)
                ->where('estado', 1)
                ->with(['imagenes' => function ($query) {
                    $query->where('estado', 1); // Solo imágenes activas
                }])
                ->get();

            if (Auth::check()) {
                $user_id_log = Auth::id();
            }

            // dd($proyecto->cliente->user_id, $user_id_log);

            if ($proyecto->cliente->activo || $proyecto->cliente->user_id === $user_id_log) {
                // si el cliente esta activo
                return view('proyecto', compact('proyecto', 'imagenes', 'unidades'));
            } else {
                // si no esta activo
                return response()->view('errors.404', [], 404);
            }
            
        } catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    public function savePaidProjectStatus(Request $request)
    {
        // Buscar el cliente del proyecto
        $proyectoPlanActivo = ProyectoPlanesActivos::find($request->proyectoPlanActivoId);
        $proyectoCliente = ProyectoCliente::where('id', $proyectoPlanActivo->proyecto_cliente_id)->first();

        if (!$proyectoPlanActivo) {
            return response()->json([
                'status' => 'Error',
                'message' => 'ProyectoCliente no encontrado.',
            ], 404);
        }
    
        // Obtener el estado "pagado"
        $estadoPagado = ProyectoPagoEstado::where('nombre', 'pagado')->first();
    
        if (!$estadoPagado) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Estado de pago "pagado" no encontrado.',
            ], 500);
        }
    
        // Actualizar el cronograma según el tipo de pago
        if ($proyectoPlanActivo->pago_unico) {
            // Si es un pago único, actualizar el único registro del cronograma
            $cronograma = ProyectoCronogramaPago::where('proyecto_plan_activo_id', $proyectoPlanActivo->id)->first();
    
            if ($cronograma) {
                $cronograma->update([
                    'estado_pago_id' => $estadoPagado->id,
                    'fecha_ultimo_intento' => now(),
                ]);
            }
    
            // Marcar el proyecto como completamente pagado y al día
            $proyectoPlanActivo->update([
                'pagado' => true,
                'activo' => true,
            ]);
            $proyectoCliente->update(['al_dia' => 1]);

        } else {
            // Si es un pago fraccionado, actualizar el primer pago pendiente
            $primerPagoPendiente = ProyectoCronogramaPago::where('proyecto_plan_activo_id', $proyectoPlanActivo->id)
                ->where('estado_pago_id', '!=', $estadoPagado->id)
                ->orderBy('fecha_programada', 'asc')
            ->first();
            
            if ($primerPagoPendiente) {
                $primerPagoPendiente->update([
                    'estado_pago_id' => $estadoPagado->id,
                    'fecha_ultimo_intento' => now(),
                ]);

                $proyectoPlanActivo->update([
                    'pagado' => true,
                    'activo' => true,
                ]);
                // Marcar como "al día" porque el primer pago pendiente se realizó con éxito
                $proyectoCliente->update(['al_dia' => 1]);
            }
    
            // Verificar si todos los pagos están completados
            $todosPagosRealizados = ProyectoCronogramaPago::where('proyecto_plan_activo_id', $proyectoPlanActivo->id)
                ->where('estado_pago_id', '!=', $estadoPagado->id)
                ->doesntExist();
    
            if ($todosPagosRealizados) {
                // Marcar el proyecto como completamente pagado si no hay pagos pendientes
                $proyectoCliente->update(['al_dia' => 1]);
            }
        }
    
        // Actualizar el estado del cliente
        app(ServicioEstadoCliente::class)->actualizarEstadoCliente($proyectoCliente);
    
        // Retornar una respuesta
        $todosPagosRealizados = $proyectoCliente->pago_unico || $todosPagosRealizados ?? false;
    
        return response()->json([
            'status' => 'Success',
            'message' => $todosPagosRealizados
                ? 'El estado de pago ha sido actualizado correctamente. Todos los pagos están completados.'
                : 'El estado de pago ha sido actualizado para el primer pago, pero aún hay pagos pendientes.',
        ], 200);
    }
    
    

}