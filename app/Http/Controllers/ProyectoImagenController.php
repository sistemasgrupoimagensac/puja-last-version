<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoImagenesAdicionales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;


class ProyectoImagenController extends Controller
{
    /**
     * Subir imágenes a Wasabi y guardar en la base de datos.
     */
    public function store(Request $request, $proyectoId)
    {

        $routeImagesProjects = "proyectos/images/{$proyectoId}";

        if ( !App::environment('production') ) {
            $nameDev = "wsb-dev/".env('ROUTE_WSB')."/";
            $routeImagesProjects = "{$nameDev}{$routeImagesProjects}";
        }


        $validator = Validator::make($request->all(),[
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:400'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Error formato y/o tamaño imagen',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Buscar el proyecto o retornar error 404 si no existe
        $proyecto = Proyecto::findOrFail($proyectoId);

   

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                // Subir la imagen a Wasabi con visibilidad pública
                $path = Storage::disk('wasabi')->put($routeImagesProjects, $image);

                $imageProjectName = basename($path);
                $imageProjectURL = url($routeImagesProjects . '/' . $imageProjectName);

                $imagen = ProyectoImagenesAdicionales::create([
                    'proyecto_id' => $proyectoId,
                    'image_url' => $imageProjectURL,
                    'estado' => 1
                ]);
            }
        }

        return response()->json([
            'message' => 'Imágenes subidas correctamente.',
        ], 200);  // Código 200 para indicar éxito
    }

    /**
     * Eliminar una imagen de Wasabi y la base de datos.
     */
    public function destroy($proyectoId, $imagenId)
    {
        // Validar la existencia de la imagen en el proyecto
        $imagen = ProyectoImagenesAdicionales::where('proyecto_id', $proyectoId)
            ->where('id', $imagenId)
            ->firstOrFail();

        // Eliminar la imagen de Wasabi utilizando la URL de la imagen guardada
        $imagePath = parse_url($imagen->imagen, PHP_URL_PATH);
        Storage::disk('wasabi')->delete($imagePath);

        // Eliminar la referencia de la base de datos
        $imagen->delete();

        return response()->json([
            'message' => 'Imagen eliminada correctamente.',
        ], 200);  // Código 200 para éxito
    }
}
