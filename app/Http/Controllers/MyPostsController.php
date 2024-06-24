<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\CaracteristicaInmueble;
use App\Models\ExtraInmueble;
use App\Models\ExtraInmueblesCaracteristicas;
use App\Models\HistorialAvisos;
use App\Models\ImagenInmueble;
use App\Models\Inmueble;
use App\Models\MultimediaInmueble;
use App\Models\OperacionTipoInmueble;
use App\Models\PlanoInmueble;
use App\Models\PrincipalInmueble;
use App\Models\UbicacionInmueble;
use App\Models\VideoInmueble;
use Database\Seeders\ExtraInmuebleCaracteristicasInmueblesSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MyPostsController extends Controller
{

    // Método invocable
    /* public function __invoke(Request $request)
    {
        // Lógica para el método invocable
        return view('avisos.index', $data);
    } */

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
        return view('avisos.index', compact('avisos', 'userId'));
    }

    public function create (){
        return view('avisos.create');
    }
    
    public function store (Request $request){
        // dd("aaa".Auth::check());
        if (!Auth::check()) {
            return redirect('/');
        }
        $user_id = Auth::id();

        $validator = Validator::make($request->all(), [
            'principal' => 'boolean',
            'ubicacion' => 'boolean',
            'caracteristicas' => 'boolean',
            'multimedia' => 'boolean',
            'extras' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $inmueble = Inmueble::updateOrCreate([
            "codigo_unico" => "2",
            "user_id" => $user_id,
            ],[
            "estado" => 1,
        ]);
        $principal_inmueble = PrincipalInmueble::updateOrCreate([
            "inmueble_id" => $inmueble->id,
            ],[
            "estado" => 1,
        ]);

        $aviso = Aviso::updateOrCreate([
            "inmueble_id" => $inmueble->id,
            ],[
            "fecha_publicacion" => now(),
            "estado" => 1,
        ]);

        $hist_aviso = HistorialAvisos::updateOrCreate([
            "aviso_id" => $aviso->id,
            ],[
            "estado_aviso_id" => 1,
        ]);
        
        if ($request->principal) {
            $validator = Validator::make($request->all(), [
                'tipo_operacion_id' => 'required|integer|digits_between:1,3',
                // 'tipo_inmueble_id' => 'required|integer|digits_between:1,3',
                'subtipo_inmueble_id' => 'required|integer|digits_between:1,3',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $tipo_inmueble = 1;
            if ( (int)$request->subtipo_inmueble_id >= 1 && (int)$request->subtipo_inmueble_id <= 5 ) {
                //casa
                $tipo_inmueble = 1;
            } else if ( (int)$request->subtipo_inmueble_id >= 6 && (int)$request->subtipo_inmueble_id <= 11 ) {
                //Depa
                $tipo_inmueble = 2;
            } else if ( (int)$request->subtipo_inmueble_id >= 12 && (int)$request->subtipo_inmueble_id <= 13 ) {
                //Terreno
                $tipo_inmueble = 3;
            } else if ( (int)$request->subtipo_inmueble_id >= 14 && (int)$request->subtipo_inmueble_id <= 15 ) {
                //Local
                $tipo_inmueble = 4;
            }

            $ope_tipo_inmueble = OperacionTipoInmueble::updateOrCreate([
                "principal_inmueble_id" => $principal_inmueble->id,
                ],[
                "tipo_operacion_id" => $request->tipo_operacion_id,
                "tipo_inmueble_id" => $tipo_inmueble,
                "subtipo_inmueble_id" => $request->subtipo_inmueble_id,
                "estado" => 1,
            ]);

            if (!$ope_tipo_inmueble) {
                return response()->json([
                    'message' => 'No se pudo guardar el registro operaciones',
                    'error' => true
                ], 422);
            }
        }
        
        if ($request->ubicacion) {
            $validator = Validator::make($request->all(), [
                'direccion' => 'required|string|max:250',

                /* 'departamento_id' => 'required|integer|digits_between:1,3',
                'provincia_id' => 'required|integer|digits_between:1,5',
                'distrito_id' => 'required|integer|digits_between:1,7', */
                
                'departamento_id' => 'required|string|digits_between:1,3',
                'provincia_id' => 'required|integer|digits_between:1,5',
                'distrito_id' => 'required|integer|digits_between:1,7',

                'latitud' => 'string|max:500',
                'longitud' => 'string|max:500',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $ubi_inmueble = UbicacionInmueble::updateOrCreate([
                "principal_inmueble_id" => $principal_inmueble->id,
            ],[
                "direccion" => $request->direccion,
                "departamento_id" => $request->departamento_id,
                "provincia_id" => $request->provincia_id,
                "distrito_id" => $request->distrito_id,
                "latitud" => $request->latitud,
                "longitud" => $request->longitud,
                "estado" => 1,
            ]);

            if (!$ubi_inmueble) {
                return response()->json([
                    'message' => 'No se pudo guardar el registro de ubicacion',
                    'error' => true
                ], 422);
            }
        }
        
        if ($request->caracteristicas) {
            $validator = Validator::make($request->all(), [
                'habitaciones' => 'required|integer|digits_between:1,3',
                'banios' => 'required|integer|digits_between:1,3',
                'medio_banios' => 'integer|digits_between:1,3',
                'estacionamientos' => 'required|integer|digits_between:1,3',
                'area_construida' => 'numeric',
                'area_total' => 'numeric',
                'antiguedad' => 'string',
                // 'anios_antiguedad' => 'integer',
                'precio_soles' => 'numeric',
                'precio_dolares' => 'numeric',
                // 'titulo' => 'string|max:100',
                // 'descripcion' => 'string|max:250',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $carac_inmueble = CaracteristicaInmueble::updateOrCreate([
                "principal_inmueble_id" => $principal_inmueble->id,
            ],[
                "habitaciones" => $request->habitaciones,
                "banios" => $request->banios,
                "medio_banios" => $request->medio_banios,
                "estacionamientos" => $request->estacionamientos,
                "area_construida" => $request->area_construida,
                "area_total" => $request->area_total,
                "antiguedad" => $request->antiguedad,
                // "anios_antiguedad" => $request->anios_antiguedad,
                "anios_antiguedad" => null,
                "precio_soles" => $request->precio_soles,
                "precio_dolares" => $request->precio_dolares,
                // "titulo" => $request->titulo,
                // "descripcion" => $request->descripcion,
                "titulo" => null,
                "descripcion" => null,
                "estado" => 1,
            ]);

            if (!$carac_inmueble) {
                return response()->json([
                    'message' => 'No se pudo guardar el registro de caracteristicas',
                    'error' => true
                ], 422);
            }
        }
        
        if ($request->multimedia) {
            $existingImgMain = MultimediaInmueble::where('inmueble_id', $inmueble->id)->first();
            if ( !$existingImgMain || ( $existingImgMain && $request->hasFile('imagen_principal') ) ) {
                $validator = Validator::make($request->all(), [
                    'imagen_principal' => 'required|image|mimes:jpeg,jpg,png|max:4096',
                    // 'imagen.*' => 'required|image|mimes:jpeg,jpg,png|max:4096',
                    // 'video' => 'required|image|mimes:jpeg,jpg,png|max:4096',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'message' => 'Errores de validación',
                        'errors' => $validator->errors()
                    ], 422);
                }
                $image = $request->file('imagen_principal');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                $multim_inmueble = MultimediaInmueble::updateOrCreate([
                    "inmueble_id" => $inmueble->id,
                    ],[
                    "imagen_principal" => $imageName,
                    "estado" => 1,
                ]);
                if (!$multim_inmueble) {
                    return response()->json([
                        'message' => 'No se pudo guardar el registro de multimedia inmueble',
                        'error' => true
                    ], 422);
                }
            }

            $multi_inmueble_id = MultimediaInmueble::where('inmueble_id', $inmueble->id)->value('id');

            if ( $request->hasFile('imagen') ) {
                foreach ($request->file('imagen') as $imagen) {
                    $imagenName = time() . '_' . uniqid() . '.' . $imagen->getClientOriginalExtension();
                    $imagen->move(public_path('images'), $imagenName);


                    $imagenUrl = url('images/' . $imagenName);
        
                    $img_inmueble = ImagenInmueble::create([
                        'multimedia_inmueble_id' => $multi_inmueble_id,
                        'imagen' => $imagenUrl,
                        "estado" => 1,
                    ]);

                    if (!$img_inmueble) {
                        return response()->json([
                            'message' => 'No se pudo guardar el registro de la imagen principal inmueble',
                            'error' => true
                        ], 422);
                    }
                }
            }

            if ( $request->hasFile('video') ) {
                $video = $request->file('video'); 
                $videoName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('videos'), $videoName);

                $video_inmueble = VideoInmueble::create([
                    'multimedia_inmueble_id' => $multi_inmueble_id,
                    'video' => $videoName,
                    "estado" => 1,
                ]);

                if (!$video_inmueble) {
                    return response()->json([
                        'message' => 'No se pudo guardar el registro del video inmueble',
                        'error' => true
                    ], 422);
                }
            }

            if ( $request->hasFile('planos') ) {
                foreach ($request->file('planos') as $plano) {
                    $planoName = time() . '_' . uniqid() . '.' . $plano->getClientOriginalExtension();
                    $plano->move(public_path('planos'), $planoName);
        
                    $plano_inmueble = PlanoInmueble::create([
                        'multimedia_inmueble_id' => $multi_inmueble_id,
                        'plano' => $planoName,
                        "estado" => 1,
                    ]);

                    if (!$plano_inmueble) {
                        return response()->json([
                            'message' => 'No se pudo guardar el registro de los planos inmueble',
                            'error' => true
                        ], 422);
                    }
                }
            }
        }
        
        if ($request->extras) {
            // $extra_inmueble = ExtraInmueble::where('inmueble_id', $inmueble->id)->first();
            $extra_inmueble = ExtraInmueble::updateOrCreate([
                "inmueble_id" => $inmueble->id,
                ],[
                "estado" => 1,
            ]);

            $request->validate([
                'options' => 'required|array',
                'options.*' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            ExtraInmueblesCaracteristicas::where('extra_inmueble_id', $extra_inmueble->id)->update([
                'estado' => 0,
            ]);
            $selectedOptions = $request->input('options', []);
    
            foreach ($selectedOptions as $option) {
                $extra_carac = ExtraInmueblesCaracteristicas::updateOrCreate([
                    'extra_inmueble_id' => $extra_inmueble->id,
                    'caracteristica_extra_id' => $option,
                    ],[
                    'estado' => 1,
                ]);

                if (!$extra_carac) {
                    return response()->json([
                        'message' => 'No se pudo guardar el registro de una caracteristica extra',
                        'error' => true
                    ], 422);
                }
            }

            $hist_aviso = HistorialAvisos::updateOrCreate([
                "aviso_id" => $aviso->id,
            ],[
                "estado_aviso_id" => 3,
            ]);
        }

        return response()->json([
            'message' => 'Registro exitos',
            'error' => false
        ], 201);
    }


}
