<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        // $avisos = Aviso::where('estado', 1)
        //                 ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
        //                 ->get();

        return view('panel.password');
    }
}
