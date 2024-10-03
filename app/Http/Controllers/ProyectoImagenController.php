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

        if (!App::environment('production')) {
            $nameDev = "wsb-dev/" . env('ROUTE_WSB') . "/";
            $routeImagesProjects = "{$nameDev}{$routeImagesProjects}";
        }


        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:400'
        ]);

        if ($validator->fails()) {
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

    public function destroy($proyectoId, $imagenId)
    {
        // Validar la existencia de la imagen en el proyecto
        $imagen = ProyectoImagenesAdicionales::where('proyecto_id', $proyectoId)
            ->where('id', $imagenId)
            ->firstOrFail();

        // Cambiar el estado de la imagen a inactivo en la base de datos
        $imagen->update(['estado' => 0]);

        // Eliminar la imagen físicamente de Wasabi
        $imagePath = parse_url($imagen->image_url, PHP_URL_PATH);
        $deletedFromWasabi = Storage::disk('wasabi')->delete($imagePath);

        // Si la eliminación física falla, retorna un mensaje de advertencia
        if (!$deletedFromWasabi) {
            return response()->json([
                'message' => 'El estado de la imagen fue actualizado, pero no se pudo eliminar.',
            ], 500);
        }

        return response()->json([
            'message' => 'Imagen eliminada correctamente.',
        ], 200);  // Código 200 para éxito total
    }

}
