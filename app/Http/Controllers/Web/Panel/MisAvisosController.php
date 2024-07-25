<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisAvisosController extends Controller
{
    public function __construct()
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = Aviso::where('estado', 1)->whereHas('inmueble', function($q) {
                            $q->where('estado', 1)->where('user_id', Auth::user()->id);
                        })->get();

        return view('panel.mis-avisos', compact('avisos'));
    }
}
