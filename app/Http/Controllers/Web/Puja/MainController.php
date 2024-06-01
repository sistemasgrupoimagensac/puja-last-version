<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('welcome');
    }
}
