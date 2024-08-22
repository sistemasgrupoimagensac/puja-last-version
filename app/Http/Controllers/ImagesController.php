<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MultimediaInmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    //
    public function get_images($id_inmueble, $archivo){
        $path = "images/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }
    
    public function get_planos($id_inmueble, $archivo){
        $path = "planos/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }

    public function get_videos($id_inmueble, $archivo){
        $path = "videos/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }
    
    public function get_pdf($archivo){
        $existe_archivo = Storage::disk('wasabi')->exists('pdf/'. $archivo);
        if (!$existe_archivo) {
            abort(404, 'El archivo no existe');
        }
        return Storage::disk('wasabi')->response('pdf/' . $archivo);
    }
}
