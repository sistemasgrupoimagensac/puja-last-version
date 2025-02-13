<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\User;
use Illuminate\Http\Request;

class MisAvisosController extends Controller
{
    public function getUserAds($userId)
    {
        $avisos = 
            Aviso::where('estado', 1)
                ->whereHas('inmueble', function($q) use ($userId) {
                    $q->where('estado', 1)->where('user_id', $userId);
                })
            ->orderBy('id', 'desc')
        ->get();

        $ads = $avisos->map(function ($aviso) {
            $avisoArray = $aviso->toArray();
        
            $avisoArray['estado_aviso_id'] = $aviso->historial->first()->pivot->estado_aviso_id;
            $avisoArray['codigo_unico'] = $aviso->inmueble->codigo_unico;
            $avisoArray['link'] = $aviso->link();
            $avisoArray['tituloReal'] = $aviso->inmueble->tituloReal();
            $avisoArray['imagenPrincipal'] = $aviso->inmueble->imagenPrincipal();
            $avisoArray['type'] = $aviso->inmueble->type();
            $avisoArray['category'] = $aviso->inmueble->category();
            $avisoArray['currencySoles'] = $aviso->inmueble->currencySoles();
            $avisoArray['currencyDolares'] = $aviso->inmueble->currencyDolares();
            $avisoArray['precioSoles'] = $aviso->inmueble->precioSoles();
            $avisoArray['precioDolares'] = $aviso->inmueble->precioDolares();
            $avisoArray['remate_precio_base'] = $aviso->inmueble->remate_precio_base();
            $avisoArray['remate_valor_tasacion'] = $aviso->inmueble->remate_valor_tasacion();
            $avisoArray['address'] = $aviso->inmueble->address();
            $avisoArray['distrito'] = $aviso->inmueble->distrito();
            $avisoArray['provincia'] = $aviso->inmueble->provincia();
            $avisoArray['departamento'] = $aviso->inmueble->departamento();
            $avisoArray['estado'] = $aviso->historial[0]->estado;
            $avisoArray['fecha_publicacion'] = $aviso->fecha_publicacion;
            $avisoArray['title'] = $aviso->inmueble->title();
        
            return $avisoArray;
        });

        return response()->json([
            'message' => 'Avisos por usuario',
            'status' => 'success',
            'ads' => $ads,
        ]);
    }
}
