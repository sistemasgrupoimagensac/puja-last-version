<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InmuebleController extends Controller
{
    public function index()
    {
        $fullText = "¡Increíble Oportunidad de Inversión en San Isidro!

        Esta propiedad ofrece una oportunidad única en una de las zonas más codiciadas de San Isidro. Con una ubicación privilegiada y una variedad de opciones para su uso:

        * Zonificación RDA con Parámetros para construcción hasta 8 pisos.
        * Uso Residencial
        * Oficinas Administrativas
        * Hotelería y alojamiento
        * Embajadas

        Esta propiedad es ideal tanto para inversores como para familias que buscan establecerse en un entorno excepcional.

        Ubicación Estratégica: Estratégicamente ubicada en el corazón de San Isidro, esta propiedad está rodeada de comodidades que hacen que la vida diaria sea más fácil y placentera. Con acceso rápido a las principales avenidas como Arequipa, Petit Thouars y Arenales, así como su proximidad a Miraflores y una variedad de centros comerciales, la conveniencia está garantizada. Además, la zona cuenta con una amplia oferta educativa, desde colegios hasta sedes universitarias y centros de idiomas, asegurando una excelente calidad de vida para toda la familia.

        Características de la Propiedad:

        * Amplia sala de estar y comedor para recibir a familiares y amigos.
        * Baño de visitas para mayor comodidad.
        * Cocina espaciosa.
        * Estacionamiento para 2 o 3 autos para la seguridad y conveniencia de los residentes.
        * Amplio patio para disfrutar del aire libre y el clima templado.
        * 4 dormitorios para el descanso de toda la familia.
        * Depósito.
        * Baño compartido para mayor practicidad.

        ¡No pierdas la oportunidad de vivir en esta propiedad excepcional en alquiler en San Isidro!";


        $charLimit = 300;
        $shortText = Str::limit($fullText, $charLimit, '...');

        return view('inmueble', compact('shortText', 'fullText', 'charLimit'));
    }
}
