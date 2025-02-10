<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
use Exception;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function banks()
    {
        $banks = Banco::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Bancos obtenidos',
            'banks' => $banks,
        ]);
    }
    
    public function project_progress()
    {
        $progress = ProyectoProgreso::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Progesos del proyecto.',
            'progress' => $progress,
        ]);
    }
    
    public function show($id)
    {
        $project = Proyecto::with(['unidades' => function ($query) {
            $query->where('estado', 1);
        }])->findOrFail($id);

        $additional_imgs = ProyectoImagenesAdicionales::where('proyecto_id', $id)->get();

        $units_imgs = ProyectoImagenesUnidades::where('proyecto_id', $id)
            ->where('estado', 1)
            ->groupBy('proyecto_unidades_id')
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Proyecto obtenido.',
            'project' => $project,
            'additional_imgs' => $additional_imgs,
            'units_imgs' => $units_imgs,
        ]);
    }

    public function store(Request $request, $userId)
    {
        User::findOrFail($userId);

        $currentClientProject = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_planes_activos.proyecto_cliente_id', '=', 'proyecto_clientes.id')
            ->where('user_id', $userId)
            ->where('proyecto_planes_activos.fecha_inicio', '<=', Carbon::now())
            ->where('proyecto_planes_activos.fecha_fin', '>=', Carbon::now())
            ->select(
                'proyecto_clientes.id as id',
                'proyecto_planes_activos.id as plan_activo_id',
                'proyecto_planes_activos.numero_anuncios as plan_activo_cant_anuncios',
            )
            ->orderBy('proyecto_planes_activos.fecha_inicio', 'asc')
        ->first();

        if ( !$currentClientProject ) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró un proyecto asociado a este usuario.',
            ], 422);
        }

        if( $request->proyecto_id === null ){

            $number_projects = Proyecto::where('proyecto_cliente_id', $currentClientProject->id)
                ->where('proyecto_plan_activo_id', $currentClientProject->plan_activo_id)
            ->count();
    
            if ( $number_projects >= $currentClientProject->plan_activo_cant_anuncios ) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Límite de anuncios disponibles alcanzado. No puedes crear más proyectos.',
                ], 422);

            }

        }

        $request->validate([
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

        try {

            $unidadesArray = $request->filled('unidades') ? json_decode($request->unidades, true) : [];

            $proyecto = Proyecto::updateOrCreate([
                'id' => $request->proyecto_id
                ],[
                'proyecto_cliente_id' => $currentClientProject->id,
                'proyecto_plan_activo_id' => $currentClientProject->plan_activo_id,
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

    public function savePaidProjectStatus(Request $request)
    {

        $request->validate(['proyectoPlanActivoId' => 'required|integer']);

        $proyectoPlanActivo = ProyectoPlanesActivos::find($request->proyectoPlanActivoId);
        $proyectoCliente = ProyectoCliente::where('id', $proyectoPlanActivo->proyecto_cliente_id)->first();    
        $estadoPagado = ProyectoPagoEstado::where('nombre', 'pagado')->first();
    
        if ( !$estadoPagado ) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Estado de pago "pagado" no encontrado.',
            ], 500);
        }

        if ( $proyectoPlanActivo->pago_unico ) {
            
            $cronograma = ProyectoCronogramaPago::where(['proyecto_plan_activo_id', $proyectoPlanActivo->id])->first();
    
            if ( $cronograma) {
                $cronograma->update(['estado_pago_id' => $estadoPagado->id, 'fecha_ultimo_intento' => now()]);
            }
            $proyectoCliente->update(['al_dia' => true]);
            $proyectoPlanActivo->update(['pagado' => true, 'activo' => true]);

        } else {
            
            $primerPagoPendiente = ProyectoCronogramaPago::where('proyecto_plan_activo_id', $proyectoPlanActivo->id)
                ->where('estado_pago_id', '!=', $estadoPagado->id)
                ->orderBy('fecha_programada', 'asc')
            ->first();
            
            if ( $primerPagoPendiente ) {
                $primerPagoPendiente->update(['estado_pago_id' => $estadoPagado->id, 'fecha_ultimo_intento' => now()]);
                $proyectoPlanActivo->update(['pagado' => true, 'activo' => true]);
                $proyectoCliente->update(['al_dia' => true]);
            }
    
            $todosPagosRealizados = ProyectoCronogramaPago::where('proyecto_plan_activo_id', $proyectoPlanActivo->id)
                ->where('estado_pago_id', '!=', $estadoPagado->id)
            ->doesntExist();
    
            if ($todosPagosRealizados) {
                $proyectoCliente->update(['pagado' => true]);
            }
        }
    
        app(ServicioEstadoCliente::class)->actualizarEstadoCliente($proyectoCliente);
    
        $todosPagosRealizados = $proyectoCliente->pago_unico || $todosPagosRealizados ?? false;
    
        return response()->json([
            'status' => 'Success',
            'message' => $todosPagosRealizados
                ? 'El estado de pago ha sido actualizado correctamente. Todos los pagos están completados.'
                : 'El estado de pago ha sido actualizado para el primer pago, pero aún hay pagos pendientes.',
        ], 200);
    }


}
