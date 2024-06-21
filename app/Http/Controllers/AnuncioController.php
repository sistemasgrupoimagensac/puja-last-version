<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    //
    public function create()
    {
        return view('crear-anuncio');
    }
}
