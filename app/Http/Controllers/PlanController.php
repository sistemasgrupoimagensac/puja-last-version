<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
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
}
