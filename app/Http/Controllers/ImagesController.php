<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MultimediaInmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    //
    public function get_images(Request $request, $archivo){
        $existe_archivo = Storage::disk('wasabi')->exists('images/'. $archivo);

        if (!$existe_archivo) {
            abort(404, 'El archivo no existe');
        }

        // $file_empresario = MultimediaInmueble::where('imagen_principal', $archivo)->first();

        /* if ($file_empresario == null) {
            abort(404, 'El archivo no existe');
        } */

        // $requisito = optional($file_empresario->requisito)->no_requisito ? $file_empresario->requisito->no_requisito . '.'. $file_empresario->ti_original_evidencia : $archivo;
        // $empresario = optional(optional($file_empresario->solicitud_prestamo)->persona)->no_completo_persona;

        /* $headers = [
            'Content-Type' => 'images/jpeg',
            'Content-Disposition' => 'filename="xd"',
        ]; */

        // $files = Storage::disk('wasabi')->get('images/'. $archivo);

        // return response()->file($files, $headers);
        return Storage::disk('wasabi')->response('images/' . $archivo);
    }
    
    public function get_videos(Request $request, $archivo){
        $existe_archivo = Storage::disk('wasabi')->exists('videos/'. $archivo);

        if (!$existe_archivo) {
            abort(404, 'El archivo no existe');
        }

        // $file_empresario = MultimediaInmueble::where('imagen_principal', $archivo)->first();

        /* if ($file_empresario == null) {
            abort(404, 'El archivo no existe');
        } */

        // $requisito = optional($file_empresario->requisito)->no_requisito ? $file_empresario->requisito->no_requisito . '.'. $file_empresario->ti_original_evidencia : $archivo;
        // $empresario = optional(optional($file_empresario->solicitud_prestamo)->persona)->no_completo_persona;

        /* $headers = [
            'Content-Type' => 'images/jpeg',
            'Content-Disposition' => 'filename="xd"',
        ]; */

        // $files = Storage::disk('wasabi')->get('images/'. $archivo);

        // return response()->file($files, $headers);
        return Storage::disk('wasabi')->response('videos/' . $archivo);
    }
}
