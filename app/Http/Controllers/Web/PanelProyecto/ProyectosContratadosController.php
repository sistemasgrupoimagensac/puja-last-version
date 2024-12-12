<?php

namespace App\Http\Controllers\Web\PanelProyecto;

use App\Http\Controllers\Controller;
use App\Mail\ContactarAsesorComercialMail;
use App\Models\ProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoPlanesActivos;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use IntlDateFormatter;

class ProyectosContratadosController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        }
        
        $user_id = Auth::id();
        $user = User::find($user_id);

        $tienePlanes = false;
        $projectInfo = false;

        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $proyectoCliente = ProyectoCliente::where('user_id', $user_id)->first();
            $tipo_usuario = $user->tipo_usuario_id;
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();

            $proyectoPlanesActivos = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
                ->join('proyecto_cronograma_pagos', 'proyecto_cronograma_pagos.proyecto_plan_activo_id', '=', 'proyecto_planes_activos.id')
                ->where('proyecto_clientes.user_id', $user_id)
                ->select(
                    'proyecto_clientes.id as id',
                    'proyecto_clientes.al_dia as al_dia',
                    'proyecto_clientes.razon_social as razon_social',
                    'proyecto_planes_activos.activo as activo',
                    'proyecto_planes_activos.pagado as pagado',
                    'proyecto_planes_activos.id as proy_plan_act_id',
                    'proyecto_planes_activos.duracion as periodo_plan',
                    'proyecto_planes_activos.fecha_fin as fecha_fin_contrato',
                    'proyecto_planes_activos.numero_anuncios as numero_anuncios',
                    'proyecto_planes_activos.fecha_inicio as fecha_inicio_contrato',
                    'proyecto_planes_activos.renovacion_automatica as renovacion_automatica',
                    'proyecto_cronograma_pagos.monto as monto',
                    'proyecto_cronograma_pagos.id as cronograma_id',
                    'proyecto_cronograma_pagos.estado_pago_id as estado_pago_id',
                    'proyecto_cronograma_pagos.fecha_programada as fecha_programada',
                    'proyecto_cronograma_pagos.fecha_ultimo_intento as fecha_ultimo_intento',
                    'proyecto_cronograma_pagos.proyecto_plan_activo_id as proyecto_plan_activo_id',
                    DB::raw("IF(proyecto_planes_activos.fecha_fin < CURDATE(), 'CADUCADO', 'VIGENTE') AS caducidad"),

                )
            ->get();
            
            // $projectInfo = $user->canPublishProjects();

            $new = [];
            foreach ( $proyectoPlanesActivos as $proy ) {
                $proyecto_plan_activo_id = $proy->proyecto_plan_activo_id;
            
                if (!isset($new[$proyecto_plan_activo_id])) {
                    $new[$proyecto_plan_activo_id] = [
                        'id' => $proy->id,
                        'al_dia' => $proy->al_dia,
                        'activo' => $proy->activo,
                        'pagado' => $proy->pagado,
                        'razon_social' => $proy->razon_social,
                        'periodo_plan' => $proy->periodo_plan,
                        'numero_anuncios' => $proy->numero_anuncios,
                        'proy_plan_act_id' => $proy->proy_plan_act_id,
                        'fecha_fin_formateada' => $this->formatearFecha($proy->fecha_fin_contrato),
                        'renovacion_automatica' => $proy->renovacion_automatica,
                        'fecha_inicio_formateada' => $this->formatearFecha($proy->fecha_inicio_contrato),
                        'caducidad' => $proy->caducidad,
                    ];
                }

                $new[$proyecto_plan_activo_id]["cronograma"][] = [
                    'monto' => $proy->monto,
                    'cronograma_id' => $proy->cronograma_id,
                    'estado_pago_id' => $proy->estado_pago_id,
                    'fecha_programada' => $proy->fecha_programada,
                    'fecha_ultimo_intento' => $proy->fecha_ultimo_intento,
                ];
            }

        }

        return view('panel.proyectos-contratados', compact('user', 'tienePlanes', 'tipo_usuario', 'new'));
    }

    public function contactarPlanProyecto(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return back()->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }
        
        $destinatario = $user->creator->email;

        Mail::to($destinatario)
            ->cc('pherrera@360creative.pe')
            ->send(new ContactarAsesorComercialMail($user));

        return back()->with('status', 'Correo enviado con éxito!');
    }

    // Método privado para formatear la fecha
    private function formatearFecha($fecha)
    {
        $date = new DateTime($fecha);

        $formatter = new IntlDateFormatter(
            'es_ES', // Idioma y localización
            IntlDateFormatter::LONG, // Formato largo (17 de octubre de 2024)
            IntlDateFormatter::NONE // No necesitamos la hora
        );
        
        // Formatear la fecha
        return $formatter->format($date);
    }
}
