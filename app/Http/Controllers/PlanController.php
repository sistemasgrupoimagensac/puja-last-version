<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function contratar_plan(Request $request){

        $user_id = 1;
        // $user_id = auth()->id();
        $plan_id = $request->plan_id;

        $plan_user = PlanUser::create([
            'user_id' => $user_id,
            'plan_id' => $plan_id,
            'estado' => 1,
            'start_date' => now(),
            'end_date' => now(),
        ]);

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
            'message' => "Suscripción exitosa.",
        ], 201);

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

    public function list_plans_user(Request $request)
    {
        $user_id = auth()->id();
        // $user_plans = PlanUser::where('user_id', $user_id)->where('estado', 1)->get();
        $user = User::find($user_id);
        $active_plans = $user->plans()->get();



        return response()->json([
            "http_code" => 200,
            "status" => "OK",
            "active_plans" => $active_plans,
        ]);

    }
}
