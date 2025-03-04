<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendDataMail;
use App\Mail\SendProjectMail;
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
use App\Models\Proyecto;
use App\Models\ProyectoContact;
use App\Models\Remate;
use App\Models\SubTipoInmueble;
use App\Models\TipoInmueble;
use App\Models\UbicacionInmueble;
use App\Models\VideoInmueble;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MyPostsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'principal' => 'boolean',
            'ubicacion' => 'boolean',
            'caracteristicas' => 'boolean',
            'multimedia' => 'boolean',
            'extras' => 'boolean',
            'codigo_unico' => 'nullable|string',
        ]);

        $user_id = $request->user_id;

        $nuevoCodigoUnico = $request->codigo_unico;

        if ( empty($nuevoCodigoUnico) ) {
            $ultimoInmueble = Inmueble::where('codigo_unico', 'like', 'INM-001-001%')
                ->orderBy('id', 'desc')
            ->first(['codigo_unico']);
            if ($ultimoInmueble && $ultimoInmueble->codigo_unico) {
                $codigoUnico = $ultimoInmueble->codigo_unico;
                $parteNumerica = substr($codigoUnico, 14);
                $numero = intval($parteNumerica);
                $nuevoNumero = $numero + 1;
                $nuevoCodigoUnico = substr($codigoUnico, 0, 14) . $nuevoNumero;
            } else {
                $nuevoCodigoUnico = 'INM-001-001-001';
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
                "estado" => 1,
        ]);

        // if ( count($aviso->historial) === 0 ) {
            $hist_aviso = HistorialAvisos::updateOrCreate([
                "aviso_id" => $aviso->id,
                "estado_aviso_id" => 1,
                ],[]
            );
            $hist_aviso->touch();
        // }
        
        if ($request->principal) {
            $request->validate([
                'tipo_operacion_id' => 'required|integer|digits_between:1,3',
                'subtipo_inmueble_id' => 'required|integer|digits_between:1,3',
            ]);
            
            $subtipoInmueble = SubTipoInmueble::findOrFail($request->subtipo_inmueble_id);
            if ( !$subtipoInmueble ) {
                return response()->json([
                    'message' => 'Subtipo de inmueble no encontrado.',
                    'status' => 'error',
                ], 404);
            }
            $tipo_inmueble = $subtipoInmueble->tipoInmueble->id;

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
                    'status' => 'error',
                ], 422);
            }
        }
        
        if ($request->ubicacion) {
            $request->validate([
                'direccion' => 'required|string|max:250',
                'departamento_id' => 'required|integer|digits_between:1,3',
                'provincia_id' => 'required|integer|digits_between:1,5',
                'distrito_id' => 'required|integer|digits_between:1,7',
                'es_exacta' => 'required|boolean',
                'latitud' => 'string|max:500',
                'longitud' => 'string|max:500',
            ]);

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

            if ( !$ubi_inmueble ) {
                return response()->json([
                    'message' => 'No se pudo guardar el registro de ubicación.',
                    'status' => 'error'
                ], 422);
            }
        }
        
        if ($request->caracteristicas) {
            $request->validate([
                'is_puja' => 'nullable|boolean',
                'habitaciones' => 'nullable|max:999',
                'banios' => 'nullable|max:999',
                'medio_banios' => 'nullable|max:999',
                'estacionamientos' => 'nullable|max:999',
                'area_construida' => 'nullable|string',
                'area_total' => 'nullable|string',
                'antiguedad' => 'string',
                'anios_antiguedad' => 'nullable|max:999',
                'precio_soles' => 'nullable|string',
                'precio_dolares' => 'nullable|string',
                'mantenimiento' => 'nullable|string',
                
                // 'remate_precio_base' => 'nullable|string',
                // 'remate_valor_tasacion' => 'nullable|string',
                'remate_partida_registral' => 'nullable|string',
                'remate_direccion_id' => 'nullable|max:999',
                'remate_direccion' => 'nullable|string',
                'remate_nombre_centro' => 'nullable|string',
                // 'remate_fecha' => 'nullable|string',
                // 'remate_hora' => 'nullable|string',
                'remate_nombre_contacto' => 'nullable|string',
                'remate_telef_contacto' => 'nullable|string',
                'remate_correo_contacto' => 'nullable|string',
            ]);

            $precio_soles = $request->precio_soles? $this->convertStringToFloat($request->precio_soles) : null;
            $precio_dolares = $request->precio_dolares ? $this->convertStringToFloat($request->precio_dolares) : null;
            $mantenimiento = $request->mantenimiento ? $this->convertStringToFloat($request->mantenimiento) : null;
            $remate_precio_base = $request->remate_precio_base ? $this->convertStringToFloat($request->remate_precio_base) : null;
            $remate_valor_tasacion = $request->remate_valor_tasacion ? $this->convertStringToFloat($request->remate_valor_tasacion) : null;

            $carac_inmueble = CaracteristicaInmueble::updateOrCreate([
                    "principal_inmueble_id" => $principal_inmueble->id,
                ],[
                    "is_puja" => $request->is_puja,
                    'habitaciones' => $request->habitaciones !== null ? (int)$request->habitaciones : 0,
                    'banios' => $request->banios !== null ? (int)$request->banios : 0,
                    'medio_banios' => $request->medio_banios !== null ? (int)$request->medio_banios : 0,
                    'estacionamientos' => $request->estacionamientos !== null ? (int)$request->estacionamientos : 0,
                    "area_construida" => $this->convertStringToFloat($request->area_construida ?? 0),
                    "area_total" => $this->convertStringToFloat($request->area_total ?? 0),
                    "antiguedad" => $request->antiguedad,
                    'anios_antiguedad' => $request->anios_antiguedad !== null ? (int)$request->anios_antiguedad : 0,
                    "precio_soles" => $precio_soles,
                    "precio_dolares" => $precio_dolares,
                    "mantenimiento" => $mantenimiento,
                    "remate_precio_base" => $remate_precio_base,
                    "remate_valor_tasacion" => $remate_valor_tasacion,
                    "remate_partida_registral" => $request->remate_partida_registral,
                    "remate_direccion_id" => $request->remate_direccion_id,
                    "remate_direccion" => $request->remate_direccion,
                    "remate_nombre_centro" => $request->remate_nombre_centro,
                    "remate_fecha" => $request->remate_fecha,
                    "remate_hora" => $request->remate_hora,
                    "remate_nombre_contacto" => $request->remate_nombre_contacto,
                    "remate_telef_contacto" => $request->remate_telef_contacto,
                    "remate_correo_contacto" => $request->remate_correo_contacto,
                    "estado" => 1,
            ]);
            
            $rematesString = $request->input('remates', null); 
            if ( $rematesString ) {
                $rematesArray = json_decode($rematesString, true);
                if ( 
                    !empty($rematesArray[0]['fecha_remate']) || 
                    !empty($rematesArray[0]['hora_remate']) || 
                    !empty($rematesArray[0]['base_remate']) || 
                    !empty($rematesArray[0]['valor_tasacion']) ) {

                    Remate::where('caracteristicas_inmueble_id', $carac_inmueble->id)->delete();

                    foreach ($rematesArray as $remateData) {
                        $baseRemateFloat    = $this->convertStringToFloat($remateData['base_remate'] ?? 0);
                        $valorTasacionFloat = $this->convertStringToFloat($remateData['valor_tasacion'] ?? 0);

                        $carac_inmueble->remates()->create([
                            'numero_remate'  => $remateData['numero_remate'] ?? 1,
                            'fecha'          => $remateData['fecha_remate'] ?? null,
                            'hora'           => $remateData['hora_remate'] ?? null,
                            'base_remate'    => $baseRemateFloat,
                            'valor_tasacion' => $valorTasacionFloat,
                        ]);
                    }
                }
            }

            if ( !$carac_inmueble ) {
                return response()->json([
                    'message' => 'Error al guardar las características del inmueble.',
                    'status' => 'error'
                ], 422);
            }
        }
        
        if ($request->multimedia) {
            $routeImages = "images/{$inmueble->id}";
            $routePlans = "planos/{$inmueble->id}";
            $routeVideos = "videos/{$inmueble->id}";

            if (!$request->imagen_principal) {
                return response()->json([
                    'message' => 'Sube una imagen principal',
                    'status' => 'error',
                ], 402);
            }
        
            if ($request->hasFile('imagen_principal')) {

                if (isset($multi_inmueble_id)) {
                    $existingImage = MultimediaInmueble::where('id', $multi_inmueble_id)->value('imagen_principal');
                    if ($existingImage) {
                        Storage::disk('wasabi')->delete(str_replace(url('/'), '', $existingImage));
                    }
                }
                
                $request->validate([
                    'imagen_principal' => 'required|image|max:10240',
                ]);
        
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
                            Storage::disk('wasabi')->delete(str_replace(url('/'), '', $imagen->imagen));
                            $imagen->delete();
                        }
                    }
                }                

                if ( $request->file('imagen') !== null ) {

                    $request->validate([
                        'imagen'   => 'required|array',
                        'imagen.*' => 'image|max:10240',
                    ]);

                    foreach ($request->file('imagen') as $imagen) {
                        $path = Storage::disk('wasabi')->put($routeImages, $imagen);
                        $imagenURL = basename($path);
                        $imagenUrl_1 = url($routeImages . '/' . $imagenURL);
            
                        ImagenInmueble::create([
                            'multimedia_inmueble_id' => $multi_inmueble_id,
                            'imagen'                 => $imagenUrl_1,
                            "estado"                 => 1,
                        ]);
                    }
                }
        
            }

            if ( $request->hasFile('video') ) {
                $request->validate([
                    'video' => 'mimes:mp4,mov,ogg,qt|max:10240',
                ]);

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
        
            if ($request->hasFile('planos')) {

                $request->validate([
                    'planos'   => 'required|array',
                    'planos.*' => 'image|max:10240',
                ]);

                PlanoInmueble::where('multimedia_inmueble_id', $multi_inmueble_id)->delete();
        
                foreach ($request->file('planos') as $plano) {
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
                            'status' => 'error',
                        ], 422);
                    }
                }
            }

            $aviso->inmueble->principal->caracteristicas->descripcion = $aviso->inmueble->descripcion;
            $aviso->inmueble->principal->caracteristicas->save();

            $historial_aviso = $aviso->historial()->orderByDesc('historial_avisos.id')->first();
            if ( $historial_aviso && in_array($historial_aviso->id, [1, 2]) ) {
            // if ( $aviso->historial->first()->pivot->estado_aviso_id !== 3 ) {
                $hist_aviso = HistorialAvisos::updateOrCreate([
                    "aviso_id" => $aviso->id,
                    "estado_aviso_id" => 2,
                    ],[]
                );
                $hist_aviso->touch();
                if (!$hist_aviso) {
                    return response()->json([
                        'message' => 'Falló porque no se actualizo el historial avisos',
                        'status' => 'error'
                    ], 422);
                }
            }

            return response()->json([
                'message' => 'Registro exitoso, finalizado correctamente.',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'Registro exitoso pero no culminado.',
            'status' => 'success',
            'codigo_unico' => $inmueble->codigo_unico 
        ]);
    }

    public function updateAdDescription(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|integer',
            'description' => 'required|string',
        ]);

        $aviso = Aviso::findOrFail($request->ad_id);
        $aviso->inmueble->principal->caracteristicas->descripcion = trim($request->description);
        $aviso->inmueble->principal->caracteristicas->save();

        return response()->json([
            "message" => "Se actualizó correctamente la descripción.",
            "status" => "success",
        ]);
    }

    public function sellAd(Request $request)
    {
        $request->validate(['ad_id' => 'required|integer']);

        $aviso = Aviso::findOrFail($request->ad_id);
        // $aviso->historial->first()->pivot->estado_aviso_id = 4;
        // $aviso->historial->first()->pivot->save();
        HistorialAvisos::create([
            'aviso_id' => $aviso->id,
            'estado_aviso_id' => 4,
        ]);

        return response()->json([
            'message' => 'Aviso vendido.',
            'status' => 'success',
        ]);
    }

    public function deleteAd(Request $request)
    {
        $request->validate(['ad_id' => 'required|integer']);

        $aviso = Aviso::findOrFail($request->ad_id);
        HistorialAvisos::create([
            'aviso_id' => $aviso->id,
            'estado_aviso_id' => 6,
        ]);

        return response()->json([
            'message' => 'Aviso eliminado.',
            'status' => 'success',
        ]);
    }

    public function cancelOrActivateAd(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|integer',
        ]);

        $aviso = Aviso::findOrFail($request->ad_id);
        // $ad_status = $aviso->historial->first()->pivot->estado_aviso_id;
        $ad_status = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->id;

        if ( !($ad_status === 3 || $ad_status === 7) ) {
            return response()->json([
                'message' => 'El aviso debe estar cancelado o publicado.',
                'status' => 'error',
            ]);
        }

        $new_state = $ad_status === 3 ? 7 : 3;
        // $aviso->historial->first()->pivot->estado_aviso_id = $new_state;
        // $aviso->historial->first()->pivot->save();
        HistorialAvisos::create([
            'aviso_id' => $aviso->id,
            'estado_aviso_id' => $new_state,
        ]);

        return response()->json([
            'message' => 'Estado del aviso actualizado.',
            'status' => 'success',
        ]);
    }

    public function processContact(Request $request, $tipo_contacto)
    {
        $request->merge(['tipo_contacto' => $tipo_contacto]);
        $request->validate([
            'user_id' => 'nullable|integer',
            'accion' => 'required|integer', // 1 whatsapp, 2 correo
            'current_url' => 'required|string|max:50',
            'ad_id' => 'required|integer',
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'tipo_contacto' => 'nullable|in:email,wsp',
            'phone' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'bid_amount' => 'nullable|string',
            'currency_type' => 'nullable|integer',
            'message' => 'required|string',
            'accept_terms' => 'required|accepted',
        ]);

        $aviso_url = $request->current_url;
        $aviso = Aviso::findOrFail($request->ad_id);
        $email_owner = $aviso->inmueble->user->email;

        $ad_contact = AdContact::updateOrCreate([
            'aviso_id' => $request->ad_id,
            'email' => $request->email,
            'user_id' => $request->user_id ?? null,
            'contact_type' => $request->tipo_contacto,
            ],[
            'full_name' => $request->name,
            'status' => 1,
            'phone' => $request->phone,
            'bid_amount' => $request->bid_amount,
            'type_currency_id' => $request->currency_type, // 1 soles - 2 dolares
            'message' => $request->message,
            'accept_terms' => true,
        ]);

        if ($request->accion == 1) {
            return response()->json([
                'message' => 'Validación correcta. Se puede enviar el mensaje por WhatsApp.',
                'status' => 'success',
            ]);
        }

        Mail::to($email_owner)
            ->cc(['soporte@pujainmobiliaria.com.pe'])
            ->bcc(['grupoimagen.908883889@gmail.com'])
        ->send(new SendDataMail($ad_contact, $aviso_url));

        return response()->json([
            'message' => 'Registro para contactar, correcto.',
            'status' => 'success',
            'ad_contact_id' => $ad_contact->id,
        ]);
    }

    public function procesar_contacto_proyecto (Request $request) 
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'accion' => 'required|integer', // 1 whatsapp, 2 correo
            'current_url' => 'required|string|max:50',
            'project_id' => 'required|integer',
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'bid_amount' => 'nullable|string',
            'currency_type' => 'nullable|integer',
            'message' => 'required|string',
            'time' => 'required|string',
            'accept_terms' => 'required|accepted',
        ]);

        $proyecto_url = $request->current_url;
        $proyecto = Proyecto::findOrFail($request->project_id);
        $contactos = $proyecto->cliente->contactos;
        $googleSheet = $proyecto->cliente->googleSheet;
        $user_id = $proyecto->cliente->user_id;
        $now = now();
        $fechaHora = $now->format('Y-m-d H:i:s');

        $proyecto_contact = ProyectoContact::updateOrCreate([
            'proyecto_id' => $request->project_id,
            'email' => $request->email,
            'user_id' => $user_id ?? null,
            ],[
            'full_name' => $request->name,
            'status' => 0,
            'phone' => $request->phone,
            'message' => $request->message,
            'time' => $request->time,
            'accept_terms' => true,
        ]);

        if ($request->accion == 1) {

            $numero_contacto = "";
            foreach ( $contactos as $contacto ) {
                if ( strlen($contacto->telefono) === 9 ) {
                    $numero_contacto = $contacto->telefono;
                    break;
                }
            }

            return response()->json([
                'http_code' => isset($numero_contacto) ? 200 : 400,
                'status' => isset($numero_contacto) ? 'Success' : 'error',
                'numero_contacto' => $numero_contacto ?? null,
                'message' => isset($numero_contacto) 
                    ? 'Validación correcta. Se puede enviar el mensaje por WhatsApp.' 
                    : 'No se cuenta con un celular válido de contacto.',
            ]);

        }

        // Para correo, enviamos el email como ya lo haces
        Log::info('Iniciando el envío de correo para contactos ...');
        foreach ($contactos as $contacto) {
            Mail::to($contacto->email)
                ->cc(['soporte@pujainmobiliaria.com.pe'])
                ->bcc(['grupoimagen.908883889@gmail.com'])
                ->send(new SendProjectMail($proyecto_contact, $proyecto_url));
        }
        Log::info('Correo enviado para contactos .');

        // Si está habilitada la opción de Google Sheet:
        if ($googleSheet && $googleSheet->sheet_habilitado) {

            $this->sendToGoogleSheet($googleSheet->google_sheet_url, [
                $fechaHora,
                $request->nombre_contacto,
                $request->email,
                $request->telefono_contacto,
                $request->contact_message,
                $request->time
            ]);
        }

        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Registro para contactar, correcto.',
            'ad_contact_id' => $proyecto_contact->id,
        ], 200);
    }

    protected function sendToGoogleSheet($sheetUrl, array $data)
    {
        // Configurar cliente de Google Sheets
        $client = new Client();
        $client->setApplicationName('Your App Name');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig([
            "type" => env('GOOGLE_TYPE'),
            "project_id" => env('GOOGLE_PROJECT_ID'),
            "private_key_id" => env('GOOGLE_PRIVATE_KEY_ID'),
            "private_key" => env('GOOGLE_PRIVATE_KEY'),
            "client_email" => env('GOOGLE_CLIENT_EMAIL'),
            "client_id" => env('GOOGLE_CLIENT_ID_SHEET'),
            "auth_uri" => env('GOOGLE_AUTH_URI'),
            "token_uri" => env('GOOGLE_TOKEN_URI'),
            "auth_provider_x509_cert_url" => env('GOOGLE_AUTH_PROVIDER_X509_CERT_URL'),
            "client_x509_cert_url" => env('GOOGLE_CLIENT_X509_CERT_URL'),
        ]);

        $service = new Sheets($client);

        // Extraer el ID de la hoja de la URL
        preg_match('/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $sheetUrl, $matches);
        $spreadsheetId = $matches[1] ?? null;

        if ($spreadsheetId) {
            // Obtener las hojas del archivo
            $spreadsheet = $service->spreadsheets->get($spreadsheetId);
            $sheetName = $spreadsheet->getSheets()[0]->getProperties()->getTitle(); // Usa la primera hoja
    
            $range = $sheetName . '!A1';
            $body = new Sheets\ValueRange([
                'values' => [$data]
            ]);
            $params = ['valueInputOption' => 'RAW'];
            $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
        }
    }



    // Catálogos

    public function subtypes() 
    {
        $subtypes = SubTipoInmueble::where('estado', 1)->get();
        return response()->json([
            'message' => 'Listado de subtipos.',
            'status' => 'success',
            'subtypes' => $subtypes,
        ]);
    }

    public function departments()
    {
        $departments = Departamento::where('estado', 1)->get();
        return response()->json([
            'message' => 'Listado de departamentos del Perú.',
            'status' => 'success',
            'departments' => $departments,
        ]);
    }

    public function provinces($departmentId)
    {
        $provinces = Provincia::where('departamento_id', $departmentId)->where('estado', 1)->get();
        return response()->json([
            'message' => 'Listado de provincias según departamento del Perú.',
            'status' => 'success',
            'provinces' => $provinces,
        ]);
    }

    public function districts($provinceId)
    {
        $districts = Distrito::where('provincia_id', $provinceId)->where('estado', 1)->get();
        return response()->json([
            'message' => 'Listado de distritos según provincia.',
            'status' => 'success',
            'districts' => $districts,
        ]);
    }

    public function extras($categoryExtraId)
    {
        $extras = Caracteristica::where('categoria_caracteristica_id', $categoryExtraId)->where('estado', 1)->get();
        return response()->json([
            'message' => 'Listado de caracteristicas.',
            'status' => 'success',
            'extras' => $extras,
        ]);
    }



    

    // Funciones XD
    private function convertStringToFloat($value)
    {
        return floatval(str_replace(',', '', $value));
    }

    
}
