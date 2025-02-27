<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AvisoRepository;
use App\Services\Aviso\ObtenerAviso;
use Illuminate\Http\Request;

class InmuebleController extends Controller
{
    public function __construct(protected AvisoRepository $repository)
    {        
    }

    public function __invoke(Request $request, $inmueble)
    {
        $request->validate(['user_id' => 'integer']);

        try {

            $aviso = (new ObtenerAviso($this->repository))->__invoke($inmueble);
            $user_login_id = 0;
            $tipo_usuario = 0;
            $user_not_pay = false;
            $plan_id = 117;
            if ( $plan_id === 117 ) $tipo_aviso = 3;

            if ( $request->user_id ) {
                $user = User::findOrFail($request->user_id);
                $user_login_id = $user->id;
                $tipo_usuario = $user->tipo_usuario_id;
                if ( $tipo_usuario === 4 && $user->not_pay === 1 ) $user_not_pay = true;
                if ( $tipo_usuario === 3 && $user->not_pay === 1 ) $user_not_pay = true;
            }

            $ad_user_id = $aviso->inmueble->user_id;
            $ultimoHistorial = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->id;
            $publicado = $ultimoHistorial == 3 ? true : false;
            $ad_belongs = false;
            if ( (int)$user_login_id === (int)$ad_user_id ) {
                $ad_belongs = true;
            } else {
                $aviso->views++;
                $aviso->save();
            }

            $ad = [
                'aviso_id' => $aviso->id,
                'is_puja' => $aviso->inmueble->is_puja(),
                'remate_precio_base' => $aviso->inmueble->remate_precio_base(),
                'remate_valor_tasacion' => $aviso->inmueble->remate_valor_tasacion(), 
                'ad_type' => $aviso->ad_type, 
                'imagenPrincipal' => $aviso->inmueble->imagenPrincipal(),
                'title' => $aviso->inmueble->title(),
                'imagenes' => $aviso->inmueble->imagenes,
                'planos' => $aviso->inmueble->planos,
                'tituloReal' => $aviso->inmueble->tituloReal(),
                'address' => $aviso->inmueble->address(),
                'distrito' => $aviso->inmueble->distrito(),
                'provincia' => $aviso->inmueble->provincia(),
                'currencySoles' => $aviso->inmueble->currencySoles(),
                'precioSoles' => $aviso->inmueble->precioSoles(),
                'currencyDolares' => $aviso->inmueble->currencyDolares(),
                'precioDolares' => $aviso->inmueble->precioDolares(),
                'remate_direccion' => $aviso->inmueble->remate_direccion(),
                'remate_nombre_centro' => $aviso->inmueble->remate_nombre_centro(),
                'numero_remate' => $aviso->inmueble->numero_remate(),
                'remate_fecha' => $aviso->inmueble->remate_fecha(),
                'remate_nombre_contacto' => $aviso->inmueble->remate_nombre_contacto(),
                'remate_hora' => $aviso->inmueble->remate_hora(),
                'remate_telef_contacto' => $aviso->inmueble->remate_telef_contacto(),
                'remate_correo_contacto' => $aviso->inmueble->remate_correo_contacto(),
                'remate_partida_registral' => $aviso->inmueble->remate_partida_registral(),
                'dormitorios' => $aviso->inmueble->dormitorios(),
                'typeInmueble' => $aviso->inmueble->typeInmueble(),
                'banios' => $aviso->inmueble->banios(),
                'area' => $aviso->inmueble->area(),
                'remate_precio_base' => $aviso->inmueble->remate_precio_base(),
                'areaConstruida' => $aviso->inmueble->areaConstruida(),
                'antiguedad' => $aviso->inmueble->antiguedad(),
                'aniosAntiguedad' => $aviso->inmueble->aniosAntiguedad(),
                'descripcion' => $aviso->inmueble->principal->caracteristicas->descripcion,
                'estado' => $ultimoHistorial->estado,
                'caracteristicas' => $aviso->inmueble->extra->caracteristicas,
                'latitud' => $aviso->inmueble->principal->ubicacion->latitud,
                'longitud' => $aviso->inmueble->principal->ubicacion->longitud,
                'es_exacta' => $aviso->inmueble->principal->ubicacion->es_exacta,
                'phone' => $aviso->inmueble->user->phone,
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Inmueble detalle',
                'aviso' => $ad,

                'ad_belongs' => $ad_belongs,
                'publicado' => $publicado,
                'tipo_usuario' => $tipo_usuario,
                'user_not_pay' => $user_not_pay,
                'plan_id' => $plan_id,
                'tipo_aviso' => $tipo_aviso,
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al mostrar el aviso.',
                'error' => $th->getMessage()
            ], 500);

        }
    }
}
