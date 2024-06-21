<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MisAvisosController extends Controller
{
    public function __construct()
    {        
    }

    public function __invoke(Request $request)
    {
        return view('panel.mis-avisos');
    }
}
