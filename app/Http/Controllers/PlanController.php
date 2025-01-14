<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\newAdMail;
use App\Models\Aviso;
use App\Models\HistorialAvisos;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\ProyectoCliente;
use App\Models\ProyectoPlanesActivos;
use App\Models\Subscription;
use App\Models\SubscriptionPlanProject;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use IntlDateFormatter;

class PlanController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $sesion_iniciada = false;

            $tienePlanes = false;
        
            if (Auth::check()) {
                $user_id = Auth::id();
                $user = User::find($user_id);
                $active_plan_users = $user->active_plans()->get();
                $tienePlanes = $active_plan_users->isNotEmpty();
                if ( $user_id === 29 ) {
                    return redirect('/my-posts/create');
                }
            }
            
            if(isset($user)) {

                $show_modal = !$user->celular && !$user->numero_documento;

                if($user->tipo_usuario_id === 3) {
                    $sesion_iniciada = true;
                    return view('planes', compact('sesion_iniciada', 'show_modal', 'user', 'tienePlanes'));

                } else {
                    return redirect('/');
                }
            
            } else {
                $show_modal = false;
                return view('planes', compact('sesion_iniciada', 'show_modal', 'tienePlanes'));
            }

        } catch (\Throwable $th) {

            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la vista de planes',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function planes_propietario(Request $request)
    {
        if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        $user = Auth::user();
        $aviso_id = $request->input('aviso_id');
        return view ('planes-propietario',compact('aviso_id', 'user'));
    }

    public function planes_acreedor(Request $request) 
    {
        if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        $user = Auth::user();
        $aviso_id = $request->input('aviso_id');
        return view ('planes-acreedor',compact('aviso_id', 'user'));
    }

    // Contratar un Plan y/o publicar un aviso
    public function post_ad(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required|integer',
                'tipo_aviso' => 'nullable|integer',
                'aviso_id' => 'nullable|integer',
                'plan_user_id' => 'nullable|integer',
                'acreedor_post_free' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'http_code' => 400,
                    'status' => "Error",
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }
            if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
            $user_id = Auth::id();
            $plan_id = $request->plan_id;
            $tipo_aviso = $request->tipo_aviso;
            $aviso_id = $request->aviso_id;
            $plan_user_id = $request->plan_user_id;

            if ( !$plan_user_id ) {
                $selected_plan = Plan::find($plan_id);
                $typical_ad = (int)$selected_plan->typical_ads;
                $top_ad = (int)$selected_plan->top_ads;
                $premium_ad = (int)$selected_plan->premium_ads;
                $start_date = now();
                $end_date = Carbon::now()->addDays($selected_plan->duration_in_days);
            } else {
                $selected_plan_user = PlanUser::find($plan_user_id);
                $plan_id = (int)$selected_plan_user->plan_id;
                $typical_ad = (int)$selected_plan_user->typical_ads_remaining;
                $top_ad = (int)$selected_plan_user->top_ads_remaining;
                $premium_ad = (int)$selected_plan_user->premium_ads_remaining;
                $start_date = $selected_plan_user->start_date;
                $end_date = $selected_plan_user->end_date;

                if ( (int)$selected_plan_user->estado !== 1 ) {
                    return response()->json([
                        'http_code' => 400,
                        'status' => "Error",
                        'error' => true,
                        'message' => "El plan que deseas publicar está en estado inactivo.",
                    ], 400);
                }
                $end_date_for_compare = Carbon::parse($selected_plan_user->end_date);
                if ( $end_date_for_compare->lessThanOrEqualTo(now()) ) {
                    return response()->json([
                        'http_code' => 400,
                        'status' => "Error",
                        'error' => true,
                        'message' => "El plan que deseas usar está caducado.",
                    ], 400);
                }
            }
            
            if ( isset($aviso_id) ) {
                $alert_ad = false;
                if ( $tipo_aviso == 1 ) {
                    if ( $typical_ad === 0 ) $alert_ad = true;
                    $typical_ad--;
                } else if ( $tipo_aviso == 2 ) {
                    if ( $top_ad === 0 ) $alert_ad = true;
                    $top_ad--;
                } else if ( $tipo_aviso == 3 ) {
                    if ( $premium_ad === 0 ) $alert_ad = true;
                    $premium_ad--;
                }

                if ( $alert_ad ) {
                    return response()->json([
                        'http_code' => 400,
                        'status' => "Error",
                        'error' => true,
                        'message' => "Tipo de aviso no válido para publicar.",
                    ], 400);
                }
            }

            $estado = 1;
            if ( (int)$typical_ad === 0 && (int)$top_ad === 0 && (int)$premium_ad === 0 ) $estado = 2;
            $plan_user = PlanUser::updateOrCreate([
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                ],[
                'estado' => $estado,
                'typical_ads_remaining' => $typical_ad,
                'top_ads_remaining' => $top_ad,
                'premium_ads_remaining' => $premium_ad,
            ]);

            $aviso = "No se publicó ningun aviso.";
            if ( isset($aviso_id) ) {
                $aviso = Aviso::find($aviso_id);
                $aviso->ad_type = $tipo_aviso;
                $aviso->fecha_publicacion = now();
                $aviso->plan_user_id = $plan_user->id;
                $aviso->save();

                $hist_aviso = HistorialAvisos::updateOrCreate([
                    "aviso_id" => $aviso->id,
                    ],[
                    "estado_aviso_id" => 3,
                ]);

                //Enviar correo que se subió un inmueble
                Log::info('Iniciando el envío de correo para informar de aviso nuevo...');
                Mail::to(Auth::user()->email)
                    ->cc(['soporte@pujainmobiliaria.com.pe'])
                    ->bcc(['grupoimagen.908883889@gmail.com'])
                ->send(new newAdMail($aviso->id));
                Log::info('Correo enviado aviso nuevo.');

                if (!$hist_aviso) {
                    return response()->json([
                        'message' => 'Falló porque no se actualizó el historial avisos',
                        'error' => true
                    ], 422);
                } 
            }

            if ( $request->input("acreedor_post_free") == 1 ) return redirect('/my-posts/create');

            return response()->json([
                'http_code' => 200,
                'status' => 'Success',
                'message' => 'Pago correcto.',
                'planuser_id' => $plan_user->id,
                'aviso' => $aviso,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al realizar el contrato de un plan y/o publicar un aviso.',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
    }

    // Usar un plan contratado activo para publicar un aviso
    public function use_plan(Request $request)
    {
        try {
            $user_id = 1;
            $plan_id = $request->plan_id;
            $tipo_aviso = $request->tipo_aviso;
            $aviso_id = $request->aviso_id;

            $selected_plan = Plan::find($plan_id);
            $typical_ad = $selected_plan->typical_ads;
            $top_ad = $selected_plan->top_ads;
            $premium_ad = $selected_plan->premium_ads;


            if ( $tipo_aviso == 1 ) {
                $typical_ad = $selected_plan->typical_ads - 1;
            } else if ( $tipo_aviso == 2 ) {
                $top_ad = $selected_plan->top_ads - 1;
            } else if ( $tipo_aviso == 3 ) {
                $premium_ad = $selected_plan->premium_ads - 1;
            }

            $plan_user = PlanUser::create([
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                'estado' => 1,
                'typical_ads_remaining' => $typical_ad,
                'top_ads_remaining' => $top_ad,
                'premium_ads_remaining' => $premium_ad,
                'start_date' => now(),
                'end_date' => Carbon::now()->addDays($selected_plan->duration_in_days),
            ]);

            $aviso = Aviso::find($aviso_id);
            $aviso->ad_type = $tipo_aviso;
            $aviso->fecha_publicacion = now();
            $aviso->plan_user_id = $plan_user->id;
            $aviso->save();

            if ( !$plan_user ){
                return response()->json([
                    'http_code' => 400,
                    'status' => "KO",
                    'error' => true,
                    'message' => "Suscripción fallida.",
                ], 400);
            }
            return response()->json([
                'http_code' => 200,
                'status' => "OK",
                'error' => false,
                'planuser_id' => $plan_user->id,
                'aviso' => $aviso,
                // 'selected_plan' => $selected_plan,
                // 'selected_plan_top' => $selected_plan->top_ads,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la factura',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
    }

    public function pay_plan(Request $request)
    {
        try {
            return response()->json([
                'http_code' => 200,
                'status' => 'OK',
                'request' => $request,
            ], 200);
            // $user_id = auth()->id();
            $user_id = $request->user_id;
            $plan_id = (int)$request->plan_id;
            // $sunat_document_type = $request->sunat_document_type;
            $selected_plan = Plan::finOrFail($plan_id);
            $cant_dias = $selected_plan->duration_in_days;

            $planUser = PlanUser::create([
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                // 'document_type_id' => $sunat_document_type,
                'estado' => 1,
                'typical_ads_remaining' => $selected_plan->typical_ads,
                'top_ads_remaining' => $selected_plan->top_ads,
                'premium_ads_remaining' => $selected_plan->premium_ads,
                'start_date' => now(),
                'end_date' => Carbon::now()->addDays($cant_dias),
            ]);

            return response()->json([
                'http_code' => 200,
                'status' => 'OK',
                'message' => 'Creado  correctamente plan user.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la factura',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
    }

    // Listar todos los planes activos por usuario
    public function list_plans_user(Request $request)
    {
        if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        $user_id = Auth::id();
        // $user_id = 1;
        $user = User::find($user_id);
        $active_plan_users = $user->active_plans()->get();
        // dd($active_plan_users);

        return response()->json([
            "http_code" => 200,
            "status" => "OK",
            "active_plan_users" => $active_plan_users,
        ], 200);
    }

    // Data OPEN PAY
    public function get_data_openpay () {
        $openpay_id = env('OPENPAY_ID', '');
        $openpay_pk = env('OPENPAY_PK', '');
        $openpay_sb_mode = env('OPENPAY_SANDBOX_MODE');
        $openpay_sb_mode = filter_var(env('OPENPAY_SANDBOX_MODE', false), FILTER_VALIDATE_BOOLEAN);
        
        if ( !empty($openpay_id) && !empty($openpay_pk) /* && $openpay_sb_mode */ ) {
            return response()->json([
                "http_code" => 200,
                "status" => "Success",
                "message" => "Data de openPay entregada correctamente.",
                "openpay_id" => $openpay_id,
                "openpay_pk" => $openpay_pk,
                "openpay_sb_mode" => $openpay_sb_mode,
            ], 200);
        } else {
            return response()->json([
                "http_code" => 400,
                "status" => "Error",
                "message" => "Error al consultar la data de openPay.",
            ], 400);
        }
    }

    // Pagos por OPEN PAY
    public function pay_openpay (Request $request) 
    {
        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');

        $urlAPI = $base_url . $openpay_id . '/charges';
        $encoded_sk = base64_encode("$openpay_sk:");

        $data = json_encode($request->all());

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody($data, 'application/json')->post($urlAPI);

        return response()->json($response->json());
    }

    // Pagos de cuenta de proyecto
    public function mostrarPagoProyecto(Request $request)
    {
        $proyectoClienteId = session('proyectoClienteId');
        // $proyectoCliente = ProyectoCliente::find($proyectoClienteId);
        $proyectoCliente = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
            ->where('proyecto_cliente_id', $proyectoClienteId)
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_fin', '>=', Carbon::now())
            ->select(
                'proyecto_clientes.user_id as user_id',
                'proyecto_clientes.pagado as pagado',
                'proyecto_planes_activos.pago_unico as pago_unico',
                'proyecto_planes_activos.pago_fraccionado as pago_fraccionado',
                'proyecto_planes_activos.monto as precio_plan',
            )
            // ->orderBy('proyecto_planes_activos.fecha_inicio', 'desc')
        ->first();
        $planUser = PlanUser::where('user_id', $proyectoCliente->user_id)->first();
        // dd($planUser);
        $planUserId = $planUser->id;
    
        // Evitar que accedan a la pantalla de pago si ya está pagado
        if (!$proyectoCliente || $proyectoCliente->pagado) {
            return response()->view('errors.404', [], 404);
        }
    
        // Recuperar los datos de la sesión
        $precio = session('precio');
        $precioPlan = $proyectoCliente->precio_plan;
        $razonSocial = session('razonSocial');
        $correo = session('correo');
        $telefono = session('telefono');
        $documento = session('documento');
        $tipoDocumento = session('tipoDocumento');
        $fechaInicioRaw = session('fechaInicio');
        $fechaFinRaw = session('fechaFin');
        $periodoPlan = session('periodoPlan');
        $numeroAnuncios = session('numeroAnuncios');
        $userTypeId = session('userTypeId');
        $pagoUnico = $proyectoCliente->pago_unico;
        $pagoFraccionado = $proyectoCliente->pago_fraccionado;
    
        $fechaInicio = $this->formatearFecha($fechaInicioRaw);
        $fechaFin = $this->formatearFecha($fechaFinRaw);

        $descripcion = $proyectoCliente->pago_unico 
            ? 'Pago único por la totalidad del plan.' 
            : 'Primer pago mensual del plan.';
    
        if (!$precio || !$razonSocial) {
            return response()->view('errors.404', [], 404);
        }
    
        return view('proyecto-pago', compact(
            'precio', 
            'precioPlan',
            'razonSocial', 
            'correo', 
            'telefono', 
            'documento', 
            'tipoDocumento', 
            'userTypeId',
            'fechaInicio',
            'fechaFin',
            'periodoPlan',
            'numeroAnuncios',
            'proyectoClienteId',
            'fechaInicioRaw',
            'fechaFinRaw',
            'descripcion',
            'pagoUnico',
            'pagoFraccionado',
            'planUserId',
        ));
    }
    
    private function formatearFecha($fecha)
    {
        $date = new DateTime($fecha);

        $formatter = new IntlDateFormatter(
            'es_ES',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE
        );
        
        // Formatear la fecha
        return $formatter->format($date);
    }

    public function crearCliente(Request $request)
    {
        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $urlCustomerAPI = "{$base_url}{$openpay_id}/customers";

        // Datos del cliente
        $customerData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number')
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody(json_encode($customerData), 'application/json')->post($urlCustomerAPI);

        return response()->json($response->json());
    }

    // public function crearCliente(Request $request)
    // {
    //     $base_url = env('OPENPAY_URL');
    //     $openpay_id = env('OPENPAY_ID');
    //     $openpay_sk = env('OPENPAY_SK');
    
    //     // Verificar configuración
    //     if (!$base_url || !$openpay_id || !$openpay_sk) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Configuración de OpenPay incompleta.',
    //         ], 500);
    //     }
    
    //     $encoded_sk = base64_encode("$openpay_sk:");
    //     $urlCustomerAPI = "{$base_url}{$openpay_id}/customers";
    
    //     // Datos del cliente
    //     $customerData = [
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'phone_number' => $request->input('phone_number'),
    //     ];
    
    //     try {
    //         // Realizar la petición HTTP
    //         $response = Http::withHeaders([
    //             'Content-Type' => 'application/json',
    //             'Authorization' => 'Basic ' . $encoded_sk,
    //         ])->withBody(json_encode($customerData), 'application/json')->post($urlCustomerAPI);
    
    //         // Registrar la respuesta para auditoría o depuración
    //         Log::info('Respuesta de OpenPay al crear cliente', [
    //             'url' => $urlCustomerAPI,
    //             'request' => $customerData,
    //             'status' => $response->status(),
    //             'body' => $response->json(),
    //         ]);
    
    //         // Verificar si hubo error en la respuesta
    //         if ($response->failed()) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Error al crear el cliente en OpenPay.',
    //                 'details' => $response->json(),
    //             ], $response->status());
    //         }
    
    //         // Retornar respuesta exitosa
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Cliente creado exitosamente en OpenPay.',
    //             'data' => $response->json(),
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Manejo de excepciones
    //         Log::error('Error al conectar con OpenPay', [
    //             'url' => $urlCustomerAPI,
    //             'request' => $customerData,
    //             'exception' => $e->getMessage(),
    //         ]);
    
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'No se pudo conectar con OpenPay.',
    //             'details' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    
    public function asociarTarjeta(Request $request)
    {
        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $customerId = $request->input('customer_id');
        $urlCardAPI = "{$base_url}{$openpay_id}/customers/{$customerId}/cards";

        $cardData = [
            'token_id' => $request->input('source_id'), // Token de la tarjeta
            'device_session_id' => $request->input('device_session_id'),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody(json_encode($cardData), 'application/json')->post($urlCardAPI);

        return response()->json($response->json());
    }

    // public function saveSubscriptionStatus(Request $request)
    // {
    //     // Obtiene el `proyectoClienteId` y el `subscription_id` desde la solicitud
    //     $subscription = SubscriptionPlanProject::create([
    //         'subscription_id' => $request->input('subscription_id'),
    //         'status' => $request->input('status'),
    //         'proyecto_cliente_id' => $request->input('proyectoClienteId')
    //     ]);

    //     dd($subscription);

    //     if ($subscription) {
    //         return response()->json([
    //             'status' => 'Success',
    //             'message' => 'El estado de la suscripción ha sido guardado correctamente.'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => 'No se pudo guardar el estado de la suscripción.'
    //         ], 500);
    //     }
    // }

    public function realizarDebito(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|string',
            'card_id' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $urlChargeAPI = "{$base_url}{$openpay_id}/customers/{$request->customer_id}/charges";

        // Datos del cargo
        $chargeData = [
            'method' => 'card',
            'source_id' => $request->card_id,
            'amount' => $request->amount,
            'currency' => 'PEN', // Ajusta la moneda si es necesario
            'description' => $request->description,
            'device_session_id' => $request->device_session_id, // Opcional si lo necesitas para seguridad
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody(json_encode($chargeData), 'application/json')->post($urlChargeAPI);

        $chargeResponse = $response->json();

        if ($response->successful() && isset($chargeResponse['id'])) {
            return response()->json([
                'status' => 'Success',
                'charge_id' => $chargeResponse['id'],
                'message' => 'El débito se ha realizado con éxito.',
            ], 201);
        }

        return response()->json([
            'status' => 'Error',
            'message' => 'Error al realizar el débito.',
            'details' => $chargeResponse,
        ], 500);
    }

    public function crearPlanUserProyectos(Request $request)
    {
        
    }

    public function getPlans(Request $request)
    {
        try {
            $request->validate([
                'package' => 'required|string',
                'total_ads' => 'required|integer|min:1',
                'duration_in_days' => 'required|integer|min:1',
            ], [
                'package.required' => 'El campo paquete es obligatorio.',
                'package.string' => 'El campo paquete debe ser una cadena de texto.',
                'total_ads.required' => 'El campo total de anuncios es obligatorio.',
                'total_ads.integer' => 'El total de anuncios debe ser un número entero.',
                'total_ads.min' => 'El total de anuncios debe ser al menos 1.',
                'duration_in_days.required' => 'El campo duración en días es obligatorio.',
                'duration_in_days.integer' => 'La duración en días debe ser un número entero.',
                'duration_in_days.min' => 'La duración en días debe ser al menos 1.',
            ]);

            $packageMapping = [
                'unaviso' => 1,
                'masavisos' => 2,
                'mixto' => 3,
                'top' => 4,
                'acreedor' => 5,
            ];

            $package = strtolower($request->input('package'));
            $package_id = $packageMapping[$package] ?? null;
            if (is_null($package_id)) {
                return response()->json([
                    'http_code' => 400,
                    'status' => 'Error',
                    'message' => 'Paquete no válido.',
                ]);
            }
            $duration_in_days = $request->input('duration_in_days');
            $total_ads = $request->input('total_ads');

            $plans = Plan::with(['promotion' => function ($query) {
                    $query->where('status', 1)
                        ->where('promo_start', '<=', Carbon::now())
                    ->where('promo_end', '>=', Carbon::now());
                }])
                ->with(['promotion2' => function ($query) {
                    $query->where('status', 1)
                        ->where('promo_start', '<=', Carbon::now())
                    ->where('promo_end', '>=', Carbon::now());
                }])
                // ->where('price', '>=', 1.00)
                ->where('name', '!=', "plan free acreedor")
                ->where([
                    'estado' => 1,
                    'package_id' => $package_id,
                    'total_ads' => $total_ads,
                    'duration_in_days' => $duration_in_days,
                ])
                // ->orderBy('price', 'desc')
                ->orderByRaw('price = 0 DESC, price DESC')
            ->get();

            if ( !$plans ) {
                return response()->json([
                    'http_code' => 400,
                    'status' => 'Error',
                    'message' => 'El plan no existe.',
                ]);
            }

            return response()->json([
                'http_code' => 200,
                'status' => 'Success',
                'message' => 'Se retorna los planes.',
                'data' => $plans,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 404,
                'status' => 'Error',
                'message' => 'Error al mostrar el plan.',
                'error' => $th->getMessage()
            ], 404);
        }

    }

    public function getPlan(Request $request)
    {
        try {
            $request->validate([
                'plan_id' => 'required|integer',
            ], [
                'plan_id.required' => 'El campo plan id es obligatorio.',
                'plan_id.integer' => 'El plan id debe ser un número entero.',
            ]);

            $plan = Plan::with(['promotion' => function ($query) {
                $query->where('status', 1)
                        ->where('promo_start', '<=', Carbon::now())
                    ->where('promo_end', '>=', Carbon::now());
                }])
                ->with(['promotion2' => function ($query) {
                    $query->where('status', 1)
                        ->where('promo_start', '<=', Carbon::now())
                    ->where('promo_end', '>=', Carbon::now());
                }])
                ->where('id', $request->plan_id)
            ->first();

            if ( !$plan ) {
                return response()->json([
                    'http_code' => 400,
                    'status' => 'Error',
                    'message' => 'El plan no existe.',
                ]);
            }

            return response()->json([
                'http_code' => 200,
                'status' => 'Success',
                'message' => 'Se retorna el plan.',
                'data' => $plan,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 404,
                'status' => 'Error',
                'message' => 'Error al mostrar el plan.',
                'error' => $th->getMessage()
            ], 404);
        }

    }
    
}
