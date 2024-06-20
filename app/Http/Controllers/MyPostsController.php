<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyPostsController extends Controller
{
    public function index (){
        $userId = Auth::id();

        $avisos = Aviso::join('inmuebles as i', 'avisos.inmueble_id', '=', 'i.id')
            ->join('users', 'users.id', '=', 'i.user_id')
            ->join('principal_inmuebles as pi', 'pi.inmueble_id', '=', 'i.id')
            ->join('operaciones_tipos_inmuebles as oti', 'oti.principal_inmueble_id', '=', 'pi.id')
            ->join('tipos_operaciones as to', 'to.id', '=', 'oti.tipo_operacion_id')
            ->join('tipos_inmuebles as ti', 'ti.id', '=', 'oti.tipo_inmueble_id')
            ->join('subtipos_inmuebles as sti', 'sti.id', '=', 'oti.subtipo_inmueble_id')
            ->join('caracteristicas_inmuebles as ci', 'ci.principal_inmueble_id', '=', 'pi.id')
            ->join('ubicaciones_inmuebles as ui', 'ui.principal_inmueble_id', '=', 'pi.id')
            ->join('departamentos as depa', 'depa.id', '=', 'ui.departamento_id')
            ->join('provincias as provi', 'provi.id', '=', 'ui.provincia_id')
            ->join('distritos as dist', 'dist.id', '=', 'ui.distrito_id')

            ->join('historial_avisos as ha', 'ha.aviso_id', '=', 'avisos.id')
            ->join('estados_avisos as ea', 'ea.id', '=', 'ha.estado_aviso_id')

            ->join('extras_inmuebles as ei', 'ei.inmueble_id', '=', 'i.id')
            // ->join('extra_inmueble_caracteristicas as eic', 'eic.extra_inmueble_id', '=', 'ei.id')
            // ->leftJoin('caracteristicas_extra as ce', 'ce.id', '=', 'eic.caracteristica_extra_id')
            // ->leftJoin('categoria_caracteristicas_extra as cce', 'cce.id', '=', 'ce.categoria_caracteristica_id')

            ->join('multimedia_inmuebles as mi', 'mi.inmueble_id', '=', 'i.id')
            // ->join('imagenes_multimedia_inmuebles as imi', 'imi.multimedia_inmueble_id', '=', 'mi.id')
            // ->leftJoin('videos_multimedia_inmuebles as vmi', 'vmi.multimedia_inmueble_id', '=', 'mi.id')
            // ->leftJoin('planos_multimedia_inmuebles as pmi', 'pmi.multimedia_inmueble_id', '=', 'mi.id')

            ->where('i.user_id', $userId)
            ->select('avisos.fecha_publicacion as av_fecha_publi', 'avisos.estado as av_estado',
                'users.email as user_email',
                'i.codigo_unico as inm_cu', 'i.estado as inm_estado',
                'pi.estado as pi_estado',
                'oti.estado as oti_estado',
                'to.tipo as to_tipo', 'to.estado as to_estado',
                'ti.tipo as ti_tipo', 'ti.estado as ti_estado',
                'sti.subtipo as sti_subtipo', 'sti.estado as sti_estado',
                'ci.habitaciones as ci_habitaciones', 'ci.banios as ci_banios', 'ci.medio_banios as ci_medio_banios',
                'ci.estacionamientos as ci_estacionamientos', 'ci.area_construida as ci_area_construida', 'ci.area_total as ci_area_total',
                'ci.antiguedad as ci_antiguedad', 'ci.anios_antiguedad as ci_anios_antiguedad', 'ci.precio_soles as ci_precio_soles',
                'ci.precio_dolares as ci_precio_dolares', 'ci.titulo as ci_titulo', 'ci.descripcion as ci_descripcion', 'ci.estado as ci_estado',
                'ui.direccion as ui_direccion', 'ui.latitud as ui_latitud', 'ui.longitud as ui_longitud', 'ui.estado as ui_estado',
                'depa.nombre as depa_nombre', 'depa.estado as depa_estado',
                'provi.nombre as provi_nombre', 'provi.estado as provi_estado',
                'dist.nombre as dist_nombre', 'dist.estado as dist_estado',
                
                'ha.estado_aviso_id as ha_estado_aviso_id', 'ha.aviso_id as ha_avisoid',
                'ea.estado as ea_estado',

                'ei.estado as ei_estado', 'ei.id as ei_id',
                // 'eic.caracteristica_extra_id as eic_caracteristica_extra_id',
                // 'ce.caracteristica as ce_caracteristica', 'ce.estado as ce_estado',
                // 'cce.categoria as cce_categoria', 'cce.estado as cce_estado',

                'mi.imagen_principal as mi_imagen_principal', 'mi.estado as mi_estado',
                // 'imi.imagen as imi_imagen', 'imi.estado as imi_estado',
                // 'vmi.video as vmi_video', 'vmi.estado as vmi_estado',
                // 'pmi.plano as pmi_plano', 'pmi.estado as pmi_estado',
                )
        ->get();


        $avisosArray = $avisos->toArray();

        foreach ($avisosArray as $aviso) {
            $av[] = $aviso["ei_id"];
        }
        
        dd($av);
        return view('avisos', compact('avisos', 'userId'));
    }
}
