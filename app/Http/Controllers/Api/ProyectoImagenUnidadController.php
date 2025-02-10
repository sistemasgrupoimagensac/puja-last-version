<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoImagenUnidadController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoUnidades;
use App\Models\ProyectoImagenesUnidades;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProyectoImagenUnidadController extends Controller
{

    public function index($unidadId)
    {
        $imagenes = ProyectoImagenesUnidades::where('proyecto_unidades_id', $unidadId)
            ->where('estado', 1)
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Imágenes de las unidades.',
            'images' => $imagenes,
        ]);
    }

    public function store(Request $request, $unidadId)
    {
        $unidad = ProyectoUnidades::findOrFail($unidadId);
        $proyectoId = $unidad->proyecto_id;

        $routeImagesUnits = "proyectos/unidades/{$proyectoId}/{$unidadId}";

        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'message' => 'Error en el formato y/o tamaño de la imagen',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ( $request->hasFile('images') ) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('wasabi')->put($routeImagesUnits, $image);
                $imageName = basename($path);
                $imageURL = url($routeImagesUnits . '/' . $imageName);

                ProyectoImagenesUnidades::create([
                    'proyecto_unidades_id' => $unidadId,
                    'proyecto_id' => $proyectoId,
                    'image_url' => $imageURL,
                    'estado' => 1,
                ]);
            }
        }

        return response()->json([
            'message' => 'Imágenes subidas correctamente.',
            'status' => 'success',
        ]);
    }

    public function destroy($imagenId)
    {
        $imagen = ProyectoImagenesUnidades::where('id', $imagenId)->firstOrFail();
        $imagen->update(['estado' => 0]);

        $imagePath = parse_url($imagen->image_url, PHP_URL_PATH);
        $deletedFromWasabi = Storage::disk('wasabi')->delete($imagePath);

        if ( !$deletedFromWasabi ) {
            return response()->json([
                'status' => 'error',
                'message' => 'El estado de la imagen fue actualizado, pero no se pudo eliminar de Wasabi.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Imagen eliminada correctamente.',
        ]);
    }

}
