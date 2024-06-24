<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tipos_documento = TipoDocumento::where('estado', 1)->get();

        return view('panel.perfil', compact('user', 'tipos_documento'));
    }
}
