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


    // Rutas para el entorno DEV
    public function dev_get_images($name_dev, $id_inmueble, $archivo){
        $path = "wsb-dev/{$name_dev}/images/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }
    
    public function dev_get_planos($name_dev, $id_inmueble, $archivo){
        $path = "wsb-dev/{$name_dev}/planos/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }

    public function dev_get_videos($name_dev, $id_inmueble, $archivo){
        $path = "wsb-dev/{$name_dev}/videos/{$id_inmueble}/{$archivo}";
        $existe_archivo = Storage::disk('wasabi')->exists($path);
        if (!$existe_archivo) abort(404, 'El archivo no existe');
        return Storage::disk('wasabi')->response($path);
    }
}
