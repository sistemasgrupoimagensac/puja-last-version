<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function create()
    {
        return view('crear-aviso');
    }

    public function storePaso1(Request $request)
    {
        // Simular creación de aviso sin interactuar con la base de datos
        $aviso_id = 1; // Usa un ID ficticio para pruebas de frontend
        return response()->json(['id' => $aviso_id]);
    }

    public function storePaso2(Request $request, $id)
    {
        // Simular paso 2 sin interactuar con la base de datos
        return response()->json(['status' => 'success']);
    }

    public function storePaso3(Request $request, $id)
    {
        // Simular paso 3 sin interactuar con la base de datos
        return response()->json(['status' => 'success']);
    }

    public function storePaso4(Request $request, $id)
    {
        // Simular paso 4 sin interactuar con la base de datos
        return response()->json(['status' => 'success']);
    }

    public function storePaso5(Request $request, $id)
    {
        // Simular paso 5 sin interactuar con la base de datos
        return response()->json(['status' => 'success']);
    }

    // public function storePaso6(Request $request, $id)
    // {
    //     // Simular paso 6 sin interactuar con la base de datos
    //     return response()->json(['status' => 'success']);
    // }

    public function storePaso6(Request $request, $id)
{
    // $aviso = Aviso::findOrFail($id);
    // $aviso->update($request->only('acceso_parque', 'ascensores', 'biblioteca', 'cancha_futbol', 'centro_deportivo', 'club_house', 'conserje', 'ingreso_independiente', 'internet_wifi', 'parque_interno', 'parrilla', 'recepcion', 'sala_entretenimiento', 'sala_reuniones', 'sauna', 'television_cable', 'vista_mar', 'zona_centrica'));
    // Aquí podrías realizar alguna lógica adicional si es necesario

    return response()->json(['redirect' => route('panel.mis-avisos')]);
}
}
