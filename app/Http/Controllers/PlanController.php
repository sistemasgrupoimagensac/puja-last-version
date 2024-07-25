<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\HistorialAvisos;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        try {

            // $subs = Subscription::find(1);
            $subs = Subscription::find(1)->options;
            // $subs = Subscription::find(1)->options();
            // $subs = Subscription::with('levels.options')->find(1);
            // dd($subs);

            return view('planes');
        } catch (\Throwable $th) {

            return response()->json([
                'http_code' => 500,
                'message' => 'Error al generar la vista de planes',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    
    public function planes_propietario(Request $request){
        $aviso_id = $request->input('aviso_id');

        return view ('planes-propietario',compact('aviso_id'));

    }

    // Contratar un Plan y/o publicar un aviso
    public function post_ad(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required|integer',
                'tipo_aviso' => 'required|integer',
                'aviso_id' => 'required|integer',
                'plan_user_id' => 'nullable|integer',
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
            // $user_id = 1;
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
            
            if ( $aviso_id !== 0 ) {
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
            if ( $aviso_id !== 0 ) {
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

                if (!$hist_aviso) {
                    return response()->json([
                        'message' => 'Falló porque no se actualizó el historial avisos',
                        'error' => true
                    ], 422);
                } 
            }

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
    public function use_plan(Request $request){
        try {
            // if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
            // $user_id = Auth::id();
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

    public function pay_plan(Request $request){
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

        return response()->json([
            "http_code" => 200,
            "status" => "OK",
            "active_plan_users" => $active_plan_users,
        ], 200);
    }
}
