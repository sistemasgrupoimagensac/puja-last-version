<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function userPlans($userId)
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

        if ( strlen($plans) < 0 ) {
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

        

    }
}
