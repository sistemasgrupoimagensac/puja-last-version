<?php

// namespace App\Http\Controllers;

// use App\Models\Proyecto;
// use App\Models\ProyectoImagenesAdicionales;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class ProyectoImagenController extends Controller
// {
//     /**
//      * Subir imágenes a Wasabi y guardar en la base de datos.
//      */
//     public function store(Request $request, $proyectoId)
//     {
//         $request->validate([
//             'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:400' // Validar tamaño máximo y tipos permitidos
//         ]);

//         $proyecto = Proyecto::findOrFail($proyectoId);

//         // Directorio en Wasabi para almacenar las imágenes del proyecto
//         $routeImages = "images/proyectos/{$proyecto->id}";

//         $uploadedImages = [];

//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 // Subir la imagen a Wasabi con visibilidad pública
//                 $path = Storage::disk('wasabi')->put($routeImages, $image, 'public');

//                 // Obtener la URL completa de la imagen
//                 $wasabiEndpoint = config('filesystems.disks.wasabi.endpoint');
//                 $imageUrl = $wasabiEndpoint . '/' . $path;

//                 // Guardar la referencia de la imagen en la base de datos
//                 $imagen = ProyectoImagenesAdicionales::create([
//                     'proyecto_id' => $proyecto->id,
//                     'imagen' => $imageUrl,
//                     'estado' => 1
//                 ]);

//                 // Añadir a la lista de imágenes subidas
//                 $uploadedImages[] = [
//                     'id' => $imagen->id,
//                     'url' => $imageUrl
//                 ];
//             }
//         }

//         return response()->json([
//             'message' => 'Imágenes subidas correctamente.',
//             'images' => $uploadedImages
//         ]);
//     }

//     /**
//      * Eliminar una imagen de Wasabi y la base de datos.
//      */
//     public function destroy($proyectoId, $imagenId)
//     {
//         $imagen = ProyectoImagenesAdicionales::where('proyecto_id', $proyectoId)
//             ->where('id', $imagenId)
//             ->firstOrFail();

//         // Eliminar la imagen de Wasabi
//         $wasabiEndpoint = config('filesystems.disks.wasabi.endpoint');
//         Storage::disk('wasabi')->delete(str_replace($wasabiEndpoint, '', $imagen->imagen));

//         // Eliminar la referencia en la base de datos
//         $imagen->delete();

//         return response()->json([
//             'message' => 'Imagen eliminada correctamente.',
//         ]);
//     }
// }



namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoImagenesAdicionales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectoImagenController extends Controller
{
    /**
     * Subir imágenes a Wasabi y guardar en la base de datos.
     */
    public function store(Request $request, $proyectoId)
    {
        // Validar las imágenes subidas
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:400' // 400 KB máximo por imagen
        ]);

        // Buscar el proyecto o retornar error 404 si no existe
        $proyecto = Proyecto::findOrFail($proyectoId);

        // Definir la ruta en Wasabi para almacenar las imágenes del proyecto
        $routeImages = "images/proyectos/{$proyecto->id}";

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Subir la imagen a Wasabi con visibilidad pública
                $path = Storage::disk('wasabi')->put($routeImages, $image, 'public');

                // Obtener la URL completa de la imagen
                $wasabiEndpoint = config('filesystems.disks.wasabi.endpoint');
                $imageUrl = $wasabiEndpoint . '/' . $path;

                // Guardar la referencia de la imagen en la base de datos
                $imagen = ProyectoImagenesAdicionales::create([
                    'proyecto_id' => $proyecto->id,
                    'imagen' => $imageUrl,
                    'estado' => 1
                ]);

                // Añadir a la lista de imágenes subidas para retornar al frontend
                $uploadedImages[] = [
                    'id' => $imagen->id,
                    'url' => $imageUrl
                ];
            }
        }

        return response()->json([
            'message' => 'Imágenes subidas correctamente.',
            'images' => $uploadedImages
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
