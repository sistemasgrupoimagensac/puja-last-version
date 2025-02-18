<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\newAdMail;
use App\Models\Aviso;
use App\Models\HistorialAvisos;
use App\Models\NotificationEmail;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\ProyectoCliente;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use IntlDateFormatter;

class PlanController extends Controller
{
    public function getUserPlans($userId)
    {
        $user = User::findOrFail($userId);
        $user_plans = $user->active_plans()->get();
        return response()->json([
            "message" => "Planes respecto al usuario.",
            "status" => "success",
            "user_plans" => $user_plans,
        ]);
    }

    public function getPlans(Request $request)
    {
        $request->validate([
            'package' => 'required|string',
            'total_ads' => 'required|integer|min:1',
            'duration_in_days' => 'required|integer|min:1',
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
                'message' => 'Paquete no válido.',
                'status' => 'error',
            ], 422);
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
            ->where('name', '!=', "plan free acreedor")
            ->where([
                'estado' => 1,
                'package_id' => $package_id,
                'total_ads' => $total_ads,
                'duration_in_days' => $duration_in_days,
            ])
            ->orderByRaw('price = 0 DESC, price DESC')
        ->get();

        if ( count($plans) === 0 ) {
            return response()->json([
                'message' => 'No existen planes con esas referencias.',
                'status' => 'error',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Planes obtenidos.',
            'plans' => $plans,
        ]);
    }

    public function getPlan($planId)
    {
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
            ->where('id', $planId)
        ->first();

        if ( !$plan ) {
            return response()->json([
                'message' => 'El plan no existe.',
                'status' => 'error',
            ]);
        }

        return response()->json([
            'message' => 'Se retorna el plan.',
            'status' => 'success',
            'plan' => $plan,
        ]);
    }

    public function hirePlanAd(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'plan_id' => 'required|integer',
            'type_ad' => 'nullable|integer',
            'ad_id' => 'nullable|integer',
            'plan_user_id' => 'nullable|integer',
            'post_free' => 'nullable|boolean',
        ]);

        $user_id = $request->user_id;
        $plan_id = $request->plan_id;
        $tipo_aviso = $request->type_ad;
        $aviso_id = $request->ad_id;
        $plan_user_id = $request->plan_user_id;
        $post_free = $request->post_free;

        if ( !$plan_user_id ) {
            $selected_plan = Plan::findOrFail($plan_id);
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
                    'message' => "El plan que deseas usar esta inactivo.",
                    'status' => "error",
                ], 400);
            }
            $end_date_for_compare = Carbon::parse($selected_plan_user->end_date);
            if ( $end_date_for_compare->lessThanOrEqualTo(now()) ) {
                return response()->json([
                    'message' => "El plan que deseas usar se encuenntra caducado.",
                    'status' => "error",
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
                    'message' => "Tipo de aviso no válido para publicar.",
                    'status' => "error",
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
            $aviso = Aviso::findOrFail($aviso_id);
            $aviso->ad_type = $tipo_aviso;
            $aviso->fecha_publicacion = now();
            $aviso->plan_user_id = $plan_user->id;
            $aviso->save();

            HistorialAvisos::updateOrCreate([
                "aviso_id" => $aviso->id,
                ],[
                "estado_aviso_id" => 3,
            ]);

            $emailsNewAds = NotificationEmail::where('action_type', NotificationEmail::ACTION_NEW_AD)
                ->where('status', true)
                ->pluck('email')
            ->toArray();
            $emailsNewAds = array_merge($emailsNewAds, ['grupoimagen.908883889@gmail.com']);

            $user = User::findOrFail($user_id);
            Mail::to($user->email)
                ->cc(['soporte@pujainmobiliaria.com.pe'])
                ->bcc($emailsNewAds)
            ->send(new newAdMail($aviso->id));
        }

        if ( $post_free == 1 ) {
            return response()->json([
                'message' => 'Pago gratis, correcto.',
                'status' => 'success',
                'plan_user_id' => $plan_user->id,
                'ad' => $aviso,
            ]);
        }

        return response()->json([
            'message' => 'Pago correcto.',
            'status' => 'success',
            'plan_user_id' => $plan_user->id,
            'ad' => $aviso,
        ]);
    }

    public function getOpenpayData()
    {
        $openpay = [];
        $openpay_id = env('OPENPAY_ID', '');
        $openpay_pk = env('OPENPAY_PK', '');
        $openpay_sb_mode = filter_var(env('OPENPAY_SANDBOX_MODE', false), FILTER_VALIDATE_BOOLEAN);
        
        if ( !empty($openpay_id) && !empty($openpay_pk) ) {

            $openpay = [
                "id" => $openpay_id,
                "pk" => $openpay_pk,
                "sb_mode" => $openpay_sb_mode,
            ];

            return response()->json([
                "message" => "Data de openPay entregada correctamente.",
                "status" => "success",
                "openpay" => $openpay,
            ]);

        } else {

            return response()->json([
                "message" => "Error al consultar la data de openPay.",
                "status" => "error",
            ], 400);

        }
    }

    public function pay(Request $request)
    {
        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');

        $request->validate([
            'source_id' => 'required|string',
            'method' => 'required|string',
            'amount' => 'required|decimal:2',
            'plan_id' => 'integer',
            'currency' => 'required|string',
            'description' => 'string',
            'device_session_id' => 'string',
            'customer' => 'required|array',
            'customer.name' => 'required|string|min:1',
            'customer.last_name' => 'string',
            'customer.phone_number' => 'string',
            'customer.email' => 'email',
        ]);

        $urlAPI = $base_url . $openpay_id . '/charges';
        $encoded_sk = base64_encode("$openpay_sk:");

        $data = json_encode($request->all());

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody($data, 'application/json')->post($urlAPI);

        return response()->json($response->json());
    }

    public function mostrarPagoProyecto(Request $request)
    {
        $request->validate([
            'proyectoClienteId' => 'required|integer',
            'proyectoPlanActivoId' => 'required|integer',
            'precio' => 'required|decimal:2',
            'fechaInicio' => 'required|string',
            'fechaFin' => 'required|string',
            'numeroAnuncios' => 'required|integer',
            'periodoPlan' => 'required|integer',
            'correo' => 'required|email',
            'telefono' => 'required|digits:9',
            'documento' => 'required|string',
            'userTypeId' => 'required|integer',
            'razonSocial' => 'required|string',
            'tipoDocumento' => 'required|integer',
        ]);

        $proyectoClienteId =  $request->proyectoClienteId;
        $proyectoPlanActivoId =  $request->proyectoPlanActivoId;

        $proyectoCliente = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
            ->where('proyecto_clientes.id', $proyectoClienteId)
            ->where('proyecto_planes_activos.id', $proyectoPlanActivoId)
            ->where('proyecto_planes_activos.fecha_inicio', '<=', Carbon::now())
            ->where('proyecto_planes_activos.fecha_fin', '>=', Carbon::now())
            ->where('proyecto_planes_activos.pagado', 0)
            ->select(
                'proyecto_clientes.id as id',
                'proyecto_clientes.user_id as user_id',
                'proyecto_planes_activos.pagado as pagado',
                'proyecto_planes_activos.id as plan_activo_id',
                'proyecto_planes_activos.pago_unico as pago_unico',
                'proyecto_planes_activos.pago_fraccionado as pago_fraccionado',
                'proyecto_planes_activos.monto as precio_plan',
                'proyecto_planes_activos.pago_gratis as pago_gratis',
            )
        ->first();

        if ( !$proyectoCliente ) {
            return response()->json([
                'message' => 'No se encontró el proyecto o no está disponible.',
                'status' => 'error',
            ], 400);
        }

        $planUser = PlanUser::where('user_id', $proyectoCliente->user_id)->first();
        if (! $planUser) {
            return response()->json([
                'message' => 'No se encontró el plan para el usuario.',
                'status' => 'error',
            ], 400);
        }
        $planUserId = $planUser->id;
    
        $precio = $proyectoCliente->precio_plan;
        $fechaInicioRaw = $request->fechaInicio;
        $numeroAnuncios = $request->numeroAnuncios;
        $fechaFinRaw = $request->fechaFin;
        $periodoPlan = $request->periodoPlan;

        $correo = $request->correo;
        $telefono = $request->telefono;
        $documento = $request->documento;
        $userTypeId = $request->userTypeId;
        $razonSocial = $request->razonSocial;
        $tipoDocumento = $request->tipoDocumento;
        $pagoUnico = $proyectoCliente->pago_unico;
        $pagoFraccionado = $proyectoCliente->pago_fraccionado;
    
        $fechaInicio = $this->formatearFecha($fechaInicioRaw);
        $fechaFin = $this->formatearFecha($fechaFinRaw);

        $descripcion = $proyectoCliente->pago_unico 
            ? 'Pago único por la totalidad del plan.' 
            : 'Primer pago mensual del plan.';
    
        if ( !$precio || !$razonSocial ) {
            return response()->json([
                "message" => "No existe precio o razon social.",
                "status" => "error",
            ], 400);
        }

        $pago_gratis = $proyectoCliente->pago_gratis;

        if ( $pago_gratis ) {

            $user = User::findOrFail($proyectoCliente->user_id);
            return response()->json([
                "message" => "Debe pasar a sus avisos, pago gratis activo.",
                "status" => "success",
                "is_free" => true,
            ]);
        }

        $data = [
            'proyectoClienteId' => $proyectoClienteId,
            'proyectoPlanActivoId' => $proyectoPlanActivoId,
            'planUserId' => $planUserId,
            'precio' => $precio,
            'numeroAnuncios' => $numeroAnuncios,
            'periodoPlan' => $periodoPlan,
            'correo' => $correo,
            'telefono' => $telefono,
            'documento' => $documento,
            'userTypeId' => $userTypeId,
            'razonSocial' => $razonSocial,
            'tipoDocumento' => $tipoDocumento,
            'pagoUnico' => $pagoUnico,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'fechaInicioRaw' => $fechaInicioRaw,
            'fechaFinRaw' => $fechaFinRaw,
            'pagoFraccionado' => $pagoFraccionado,
            'descripcion' => $descripcion,
            'pago_gratis' => $pago_gratis,
        ];

        return response()->json([
            "message" => "Plan con pago requerido.",
            "status" => "success",
            "is_free" => false,
            'data' => $data,
        ]);

    }
    
    private function formatearFecha($fecha)
    {
        $date = new DateTime($fecha);

        $formatter = new IntlDateFormatter(
            'es_ES',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE
        );
        
        return $formatter->format($date);
    }

    public function crearCliente(Request $request)
    {
        $request->validate([            
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|integer|digits:9',
        ]);

        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $urlCustomerAPI = "{$base_url}{$openpay_id}/customers";

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
    
    public function asociarTarjeta(Request $request)
    {
        $request->validate([            
            'customer_id' => 'required|string',
            'source_id' => 'required|string',
            'device_session_id' => 'required|string',
        ]);

        $base_url = env('OPENPAY_URL');
        $openpay_id = env('OPENPAY_ID');
        $openpay_sk = env('OPENPAY_SK');
        $encoded_sk = base64_encode("$openpay_sk:");

        $customerId = $request->input('customer_id');
        $urlCardAPI = "{$base_url}{$openpay_id}/customers/{$customerId}/cards";

        $cardData = [
            'token_id' => $request->input('source_id'),
            'device_session_id' => $request->input('device_session_id'),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $encoded_sk,
        ])->withBody(json_encode($cardData), 'application/json')->post($urlCardAPI);

        return response()->json($response->json());
    }

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
            'currency' => 'PEN',
            'description' => $request->description,
            'device_session_id' => $request->device_session_id,
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


}
