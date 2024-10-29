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
            'images' => $imagenes
        ]);
    }

    public function store(Request $request, $unidadId)
    {
        // Obtener la unidad y validar su existencia
        $unidad = ProyectoUnidades::findOrFail($unidadId);
        $proyectoId = $unidad->proyecto_id; // Obtener el ID del proyecto al que pertenece la unidad

        // Ruta para almacenar las imágenes de las unidades
        $routeImagesUnits = "proyectos/unidades/{$proyectoId}/{$unidadId}";

        if (!App::environment('production')) {
            $nameDev = "wsb-dev/" . env('ROUTE_WSB') . "/";
            $routeImagesUnits = "{$nameDev}{$routeImagesUnits}";
        }

        // Validar las imágenes
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:400'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en el formato y/o tamaño de la imagen',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Guardar las imágenes en la base de datos y Wasabi
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Subir la imagen a Wasabi con la ruta generada
                $path = Storage::disk('wasabi')->put($routeImagesUnits, $image);
                $imageName = basename($path);
                $imageURL = url($routeImagesUnits . '/' . $imageName);

                // Guardar la imagen en la base de datos con el proyecto_id
                ProyectoImagenesUnidades::create([
                    'proyecto_unidades_id' => $unidadId,
                    'proyecto_id' => $proyectoId,  // Guardar el ID del proyecto en la tabla
                    'image_url' => $imageURL,
                    'estado' => 1,
                ]);
            }
        }

        return response()->json([
            'message' => 'Imágenes subidas correctamente.',
        ], 200);
    }

    public function destroy($imagenId)
    {
        // Validar la existencia de la imagen en la unidad
        $imagen = ProyectoImagenesUnidades::where('id', $imagenId)->firstOrFail();
            // ->where('id', $imagenId)
            // ->firstOrFail();
            
        // dd($imagen->image_url);


        // Cambiar el estado de la imagen a inactivo en la base de datos
        $imagen->update(['estado' => 0]);


        // Eliminar la imagen físicamente de Wasabi
        $imagePath = parse_url($imagen->image_url, PHP_URL_PATH);
        $deletedFromWasabi = Storage::disk('wasabi')->delete($imagePath);

        // Si la eliminación física falla, retorna un mensaje de advertencia
        if (!$deletedFromWasabi) {
            return response()->json([
                'message' => 'El estado de la imagen fue actualizado, pero no se pudo eliminar de Wasabi.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada correctamente.',
        ], 200);  // Código 200 para indicar éxito
    }
}
