<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function getPDF($archivo)
    {
        $path = "proyectos/contratos/{$archivo}";
    
        if (!Storage::disk('wasabi')->exists($path)) {
            return response()->json([
                'status' => 'error',
                'message' => 'El archivo PDF no existe.',
            ], 400);
        }
    
        return Storage::disk('wasabi')->response($path);
    }
}
