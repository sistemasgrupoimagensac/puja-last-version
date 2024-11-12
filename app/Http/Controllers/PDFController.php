<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PDFController extends Controller
{
    public function getPDF($archivo)
    {
        // Verifica que el usuario esté autenticado
        if (!Auth::check()) {
            abort(403, 'No tienes permiso para acceder a este archivo');
        }
    
        // Define la ruta del archivo en Wasabi
        $path = "proyectos/contratos/{$archivo}";
    
        // Verifica si el archivo existe en Wasabi
        if (!Storage::disk('wasabi')->exists($path)) {
            abort(404, 'El archivo PDF no existe');
        }
    
        // Devuelve el archivo PDF como respuesta
        return Storage::disk('wasabi')->response($path);
    }
    
}
