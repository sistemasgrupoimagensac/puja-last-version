<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\newAdMail;
use App\Mail\SendDataMail;
use App\Models\AdContact;
use App\Models\Aviso;
use App\Models\Caracteristica;
use App\Models\CaracteristicaInmueble;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\ExtraInmueble;
use App\Models\ExtraInmueblesCaracteristicas;
use App\Models\HistorialAvisos;
use App\Models\ImagenInmueble;
use App\Models\Inmueble;
use App\Models\MultimediaInmueble;
use App\Models\OperacionTipoInmueble;
use App\Models\PlanoInmueble;
use App\Models\PrincipalInmueble;
use App\Models\Provincia;
use App\Models\SubTipoInmueble;
use App\Models\UbicacionInmueble;
use App\Models\User;
use App\Models\VideoInmueble;
use Database\Seeders\ExtraInmuebleCaracteristicasInmueblesSeeder;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyPostsController extends Controller
{

    public function openpay () {
        // return view('open-pay.index');
        $latitude = -12.09706477059002;
        $longitude = -77.02302118294135;
        return view('openpay', compact('latitude', 'longitude'));
    }

    public function create (){
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = Auth::user();
    
        $es_propietario = $user->tipo_usuario_id == 2 ? true : false;
        $es_corredor = $user->tipo_usuario_id == 3 ? true : false;
        $es_acreedor = $user->tipo_usuario_id == 4 ? true : false;
        $es_proyecto = $user->tipo_usuario_id == 5 ? true : false;
        $show_modal = !$user->celular && !$user->numero_documento;
    
        return view('crear-aviso', compact('es_acreedor', 'es_propietario', 'es_corredor', 'es_proyecto', 'show_modal'));
    }
    
    
    public function store (Request $request)
    {
        $user_id = Auth::id();

        $validator = Validator::make($request->all(), [
            'principal' => 'boolean',
            'ubicacion' => 'boolean',
            'caracteristicas' => 'boolean',
            'multimedia' => 'boolean',
            'extras' => 'boolean',
            'codigo_unico' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $nuevoCodigoUnico = $request->codigo_unico;

        if ( empty($nuevoCodigoUnico) ) {
            $ultimoInmueble = Inmueble::where('codigo_unico', 'like', 'INM-001-001%')
                ->orderBy('id', 'desc')
                ->first(['codigo_unico']);
            if ($ultimoInmueble && $ultimoInmueble->codigo_unico) {
                $codigoUnico = $ultimoInmueble->codigo_unico;
                $parteNumerica = substr($codigoUnico, 14); // Cortar los primeros 14 caracteres
                $numero = intval($parteNumerica); // Convertir el resto de la cadena a un entero
                $nuevoNumero = $numero + 1; // Sumar 1 al número
                $nuevoCodigoUnico = substr($codigoUnico, 0, 14) . $nuevoNumero; // Crear el nuevo código
            } else {
                // Manejar el caso en que no hay registros o el campo es nulo
                $nuevoCodigoUnico = 'INM-001-001-001'; // Puedes establecer un valor por defecto
            }
        }

        $inmueble = Inmueble::updateOrCreate([
            "codigo_unico" => "$nuevoCodigoUnico",
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
                'departamento_id' => 'required|integer|digits_between:1,3',
                'provincia_id' => 'required|integer|digits_between:1,5',
                'distrito_id' => 'required|integer|digits_between:1,7',
                'es_exacta' => 'required|boolean',
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
                "es_exacta" => $request->es_exacta,
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
                'is_puja' => 'nullable|boolean',
                'habitaciones' => 'nullable|max:999',
                'banios' => 'nullable|max:999',
                'medio_banios' => 'nullable|max:999',
                'estacionamientos' => 'nullable|max:999',
                'area_construida' => 'numeric',
                'area_total' => 'numeric',
                'antiguedad' => 'string',
                'anios_antiguedad' => 'nullable|max:999',
                'precio_soles' => 'nullable|string',
                'precio_dolares' => 'nullable|string',
                
                'remate_precio_base' => 'nullable|string',
                'remate_valor_tasacion' => 'nullable|string',
                'remate_partida_registral' => 'nullable|string',
                'remate_direccion_id' => 'nullable|max:999',
                'remate_direccion' => 'nullable|string',
                'remate_fecha' => 'nullable|string',
                'remate_hora' => 'nullable|string',
                'remate_nombre_contacto' => 'nullable|string',
                'remate_telef_contacto' => 'nullable|string',
                'remate_correo_contacto' => 'nullable|string',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $request->precio_soles          ? $precio_soles = $this->convertStringToFloat($request->precio_soles)                   : $precio_soles = null;
            $request->precio_dolares        ? $precio_dolares = $this->convertStringToFloat($request->precio_dolares)               : $precio_dolares = null;
            $request->remate_precio_base    ? $remate_precio_base = $this->convertStringToFloat($request->remate_precio_base)       : $remate_precio_base = null;
            $request->remate_valor_tasacion ? $remate_valor_tasacion = $this->convertStringToFloat($request->remate_valor_tasacion) : $remate_valor_tasacion = null;

            try {
                $carac_inmueble = CaracteristicaInmueble::updateOrCreate([
                    "principal_inmueble_id" => $principal_inmueble->id,
                    ],[
                    "is_puja" => $request->is_puja,
                    'habitaciones' => $request->habitaciones !== null ? (int)$request->habitaciones : 0,
                    'banios' => $request->banios !== null ? (int)$request->banios : 0,
                    'medio_banios' => $request->medio_banios !== null ? (int)$request->medio_banios : 0,
                    'estacionamientos' => $request->estacionamientos !== null ? (int)$request->estacionamientos : 0,
                    "area_construida" => $request->area_construida,
                    "area_total" => $request->area_total,
                    "antiguedad" => $request->antiguedad,
                    'anios_antiguedad' => $request->anios_antiguedad !== null ? (int)$request->anios_antiguedad : 0,
                    "precio_soles" => $precio_soles,
                    "precio_dolares" => $precio_dolares,
                    "remate_precio_base" => $remate_precio_base,
                    "remate_valor_tasacion" => $remate_valor_tasacion,
                    "remate_partida_registral" => $request->remate_partida_registral,
                    "remate_direccion_id" => $request->remate_direccion_id,
                    "remate_direccion" => $request->remate_direccion,
                    "remate_fecha" => $request->remate_fecha,
                    "remate_hora" => $request->remate_hora,
                    "remate_nombre_contacto" => $request->remate_nombre_contacto,
                    "remate_telef_contacto" => $request->remate_telef_contacto,
                    "remate_correo_contacto" => $request->remate_correo_contacto,
                    "estado" => 1,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error al guardar las características del inmueble',
                    'error' => true,
                    'details' => $e->getMessage(),
                ], 500);
            }

            if (!$carac_inmueble) {
                return response()->json([
                    'message' => 'No se pudo guardar el registro de caracteristicas',
                    'error' => true
                ], 422);
            }
        }

        if ($request->multimedia) {
            $routeImages = "images/{$inmueble->id}";
            $routePlans = "planos/{$inmueble->id}";
            $routeVideos = "videos/{$inmueble->id}";
            if ( !App::environment('production') ) {
                $nameDev = "wsb-dev/".env('ROUTE_WSB')."/";
                $routeImages = "{$nameDev}{$routeImages}";
                $routePlans = "{$nameDev}{$routePlans}";
                $routeVideos = "{$nameDev}{$routeVideos}";
            }

            // Si NO existe imagen principal (como archivo o como url)
            if (!$request->imagen_principal) {
                return response()->json([
                    'message_error' => 'Sube una imagen principal',
                ], 402);
            }
        
            // Archivo (file) de la imagen principal
            if ($request->hasFile('imagen_principal')) {

                // Elimina la imagen principal existente si la hay
                if (isset($multi_inmueble_id)) {
                    $existingImage = MultimediaInmueble::where('id', $multi_inmueble_id)->value('imagen_principal');
                    if ($existingImage) {
                        Storage::disk('wasabi')->delete(str_replace(url('/'), '', $existingImage));
                    }
                }
        
                $validator = Validator::make($request->all(), [
                    'imagen_principal' => 'required|image|max:4096',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'message' => 'Errores de validación',
                        'errors' => $validator->errors()
                    ], 422);
                }
        
                $image = $request->file('imagen_principal');
                $path = Storage::disk('wasabi')->put($routeImages, $image);
                $imageURL = basename($path);
                $imagenUrl1 = url($routeImages . '/' . $imageURL);
        
                MultimediaInmueble::updateOrCreate(
                    ["inmueble_id" => $inmueble->id],
                    ["imagen_principal" => $imagenUrl1, "estado" => 1]
                );
            }

            $multi_inmueble_id = MultimediaInmueble::where('inmueble_id', $inmueble->id)->value('id');
        

            if ($request->imagen) {

                if ($request->filled('imagenes_a_eliminar')) {
                    $imagenesAEliminar = explode(',', $request->imagenes_a_eliminar);
                
                    foreach ($imagenesAEliminar as $imagenId) {
                        $imagen = ImagenInmueble::where('id', $imagenId)->first();
                
                        if ($imagen) {
                            // Eliminar la imagen de Wasabi
                            Storage::disk('wasabi')->delete(str_replace(url('/'), '', $imagen->imagen));
                
                            // Eliminar la referencia de la base de datos
                            $imagen->delete();
                        }
                    }
                }                

                if ( $request->file('imagen') !== null ) {
                    foreach ($request->file('imagen') as $imagen) {
    
                        $validator = Validator::make(['imagen' => $imagen], [
                            'imagen' => 'image|max:4096',
                        ]);
                        if ($validator->fails()) {
                            return response()->json([
                                'message' => 'Errores de validación',
                                'errors' => $validator->errors(),
                            ], 422);
                        }
    
                        $path = Storage::disk('wasabi')->put($routeImages, $imagen);
                        $imagenURL = basename($path);
                        $imagenUrl_1 = url($routeImages . '/' . $imagenURL);
            
                        ImagenInmueble::create([
                            'multimedia_inmueble_id' => $multi_inmueble_id,
                            'imagen' => $imagenUrl_1,
                            "estado" => 1,
                        ]);
                    }
                }
        
            }

            if ( $request->hasFile('video') ) {
                $validator = Validator::make($request->all(), [
                    'video' => 'video|max:8192',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'message' => 'Errores de validación',
                        'errors' => $validator->errors(),
                    ], 422);
                }
                $video = $request->file('video');
                $video_path = Storage::disk('wasabi')->put($routeVideos, $video);
                $videoURL = basename($video_path);
                $videoUrl_2 = url($routeVideos . '/' . $videoURL);
        
                VideoInmueble::updateOrCreate([
                    'multimedia_inmueble_id' => $multi_inmueble_id,
                ],[
                    'video' => $videoUrl_2,
                    "estado" => 1,
                ]);
            }
        
            // Planos
            if ($request->hasFile('planos')) {
                PlanoInmueble::where('multimedia_inmueble_id', $multi_inmueble_id)->delete();
        
                foreach ($request->file('planos') as $plano) {
                    $validator = Validator::make(['planos' => $imagen], [
                        'planos' => 'image|max:4096',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'message' => 'Errores de validación',
                            'errors' => $validator->errors(),
                        ], 422);
                    }
                    $plano_path = Storage::disk('wasabi')->put($routePlans, $plano);
                    $basename_plano_path = basename($plano_path);
                    $planoUrl = url($routePlans . '/' . $basename_plano_path);
        
                    PlanoInmueble::create([
                        'multimedia_inmueble_id' => $multi_inmueble_id,
                        'plano' => $planoUrl,
                        "estado" => 1,
                    ]);
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

            ExtraInmueblesCaracteristicas::where('extra_inmueble_id', $extra_inmueble->id)->delete();
            $selectedOptions = $request->input('options', []);

            if ( $request->options ) {
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
            }

            $hist_aviso = HistorialAvisos::updateOrCreate([
                "aviso_id" => $aviso->id,
                ],[
                "estado_aviso_id" => 2,
            ]);

            if (!$hist_aviso) {
                return response()->json([
                    'message' => 'Falló porque no se actualizo el historial avisos',
                    'error' => true
                ], 422);
            } else {
                $aviso->inmueble->principal->caracteristicas->descripcion = $aviso->inmueble->descripcion;
                $aviso->inmueble->principal->caracteristicas->save();
                return response()->json([
                    'message' => 'Registro exitoso, finalizado correcto.',
                    'status' => 'Success',
                    'redirect_url' => route('inmueble.single', ['inmueble' => $aviso->link()]),
                    'error' => false
                ], 201);
            }
        }

        return response()->json([
            'message' => 'Registro exitoso',
            'error' => false,
            'codigo_unico' => $inmueble->codigo_unico 
        ], 201);
    }

    public function edit (Aviso $aviso)
    {

        // ==========================================================================================================================
        $user = Auth::user();
    
        $es_propietario = $user->tipo_usuario_id == 2 ? true : false;
        $es_corredor = $user->tipo_usuario_id == 3 ? true : false;
        $es_acreedor = $user->tipo_usuario_id == 4 ? true : false;
        $es_proyecto = $user->tipo_usuario_id == 5 ? true : false;

        $inmueble = Inmueble::where("id", $aviso->inmueble_id)->first();
        $principal_inmueble_id = PrincipalInmueble::where("inmueble_id", $aviso->inmueble_id)->pluck('id')->first();

        if ( isset($principal_inmueble_id) ) {
            $caract_inmueble_id = CaracteristicaInmueble::where("principal_inmueble_id", $principal_inmueble_id)->first();
            $op_inmueble = OperacionTipoInmueble::where("principal_inmueble_id", $principal_inmueble_id)->first();
            $ubi_inmueble = UbicacionInmueble::where("principal_inmueble_id", $principal_inmueble_id)->first();
        } else {
            $caract_inmueble_id = null;
            $op_inmueble = null;
            $ubi_inmueble = null;
        }

        $mult_inmueble = MultimediaInmueble::where("inmueble_id", $aviso->inmueble_id)->first();

        if (isset($mult_inmueble)) {

            $imgs_inmueble = ImagenInmueble::where("multimedia_inmueble_id", $mult_inmueble->id)->get();
            $videos_inmueble = VideoInmueble::where("multimedia_inmueble_id", $mult_inmueble->id)->first();
            if(!$videos_inmueble){
                $videos_inmueble = "";
            }
            $planos_inmueble = PlanoInmueble::where("multimedia_inmueble_id", $mult_inmueble->id)->first();

        } else {

            $imgs_inmueble = null;
            $videos_inmueble = null;
            if(!$videos_inmueble){
                $videos_inmueble = "";
            }
            $planos_inmueble = null;

        }
        

        $extra_inmueble = ExtraInmueble::where("inmueble_id", $aviso->inmueble_id)->first();

        if ( isset($extra_inmueble) ) {
            $extra_carac_inmueble = ExtraInmueblesCaracteristicas::where("extra_inmueble_id", $extra_inmueble->id)->get();
        } else {
            $extra_carac_inmueble = null;
        }

        if ($aviso) {
            return view("editar-aviso", compact('inmueble','op_inmueble', 'ubi_inmueble', 'caract_inmueble_id', 'mult_inmueble', 'imgs_inmueble', 'videos_inmueble', 'planos_inmueble', 'extra_inmueble', 'extra_carac_inmueble', 'es_acreedor', 'es_propietario', 'es_corredor', 'es_proyecto'));
        } else {
            dd("Aviso no encontrado, $aviso no existe");
        }
        return view('editar-aviso');
    }

    public function edit_description (Request $request){
        $validator = Validator::make($request->all(), [
            'aviso_id' => 'required|integer',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $aviso = Aviso::findOrFail($request->aviso_id);
        $aviso->inmueble->principal->caracteristicas->descripcion = trim($request->description);
        $aviso->inmueble->principal->caracteristicas->save();

        return response()->json([
            "http_code" => 200,
            "status" => "Success",
            "message" => "Se actualizó correctamente la descripción",
        ], 200);
    }

    public function get_subtipos() 
    {
        $subtipos = SubTipoInmueble::where('estado', 1)->get();
        return response()->json([
            'message' => 'Respuesta exitosa.',
            'subtipos' => $subtipos,
            'error' => false
        ], 200);
    }

    public function getDepartamentos()
    {
        $departamentos = Departamento::where('estado', 1)->get();
        return response()->json([
            'message' => 'Respuesta exitosa.',
            'departamentos' => $departamentos,
            'error' => false
        ], 200);
    }

    public function getProvincias($departamentoId)
    {
        $provincias = Provincia::where('departamento_id', $departamentoId)->where('estado', 1)->get();
        return response()->json($provincias);
    }

    public function getDistritos($provinciaId)
    {
        $distritos = Distrito::where('provincia_id', $provinciaId)->where('estado', 1)->get();
        return response()->json($distritos);
    }

    public function getExtras($extra_id)
    {
        $extras = Caracteristica::where('categoria_caracteristica_id', $extra_id)->where('estado', 1)->get();
        return response()->json($extras);
    }

    public function enviar_datos_contacto (Request $request) {

        $validator = Validator::make($request->all(), [
            'nombre_contacto' => 'required|string|max:50',
            'email_contacto' => 'required|email',
            'telefono_contacto' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'contact_monto_puja' => 'nullable|string',
            'contact_message' => 'required|string',
            'accept_terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        if ( !$request->accept_terms ) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Debe aceptar los TyC.',
            ], 400);
        } else {
            $accept_terms = true;
        }

        $aviso_url = $request->current_url;
        $aviso = Aviso::findOrFail($request->aviso_id);
        $email_owner = $aviso->inmueble->user->email;
        $user_id = Auth::check() ? Auth::id() : null;

        $ad_contact = AdContact::updateOrCreate([
            'aviso_id' => $request->aviso_id,
            'email' => $request->email_contacto,
            'user_id' => $user_id,
            ],[
            'full_name' => $request->nombre_contacto,
            'status' => 1,
            'phone' => $request->telefono_contacto,
            'bid_amount' => $request->contact_monto_puja,
            'type_currency_id' => $request->contact_divisa_monto,
            'message' => $request->contact_message,
            'accept_terms' => $accept_terms,
        ]);

        Log::info('Iniciando el envío de correo para contactos ...');
        Mail::to($email_owner)
            ->cc(['soporte@pujainmobiliaria.com.pe'])
            ->bcc(['grupoimagen.908883889@gmail.com'])
        ->send(new SendDataMail($ad_contact, $aviso_url));
        Log::info('Correo enviado para contactos .');

        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Registro para contactar, correcto.',
            'ad_contact_id' => $ad_contact->id,
        ], 200);

    }

    public function my_post_sold (Request $request) {
        $validator = Validator::make($request->all(), [
            'aviso_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'htpp_code' => 400,
                'status' => 'Error',
                'message' => 'Error de validación.',
                'errors' => $validator->errors()
            ], 422);
        }
        $aviso = Aviso::findOrFail($request->aviso_id);
        $aviso->estado = 4;
        $aviso->save();

        return response()->json([
            'htpp_code' => 200,
            'status' => 'Success',
            'message' => 'Actualización correcta.',
        ], 200);
    }

    // Funciones XD
    private function convertStringToFloat($value)
    {
        return floatval(str_replace(',', '', $value));
    }

}
