<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $user = User::where('estado', 1)->first();
        $tipos_documento = TipoDocumento::where('estado', 1)->get();

        return view('panel.perfil', compact('user', 'tipos_documento'));
    }
}
