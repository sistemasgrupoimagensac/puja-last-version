<?php

namespace App\Http\Controllers\Web\PanelProyecto;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use IntlDateFormatter;

class ProyectosContratadosController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        }
        
        $user_id = Auth::id();
        $user = User::find($user_id);

        $tienePlanes = false;
        $projectInfo = false;

        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $tipo_usuario = $user->tipo_usuario_id;
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects();

            // Formatear las fechas en $projectInfo
            $projectInfo['fecha_inicio_formateada'] = $this->formatearFecha($projectInfo['fecha_inicio_contrato']);
            $projectInfo['fecha_fin_formateada'] = $this->formatearFecha($projectInfo['fecha_fin_contrato']);
        }

        return view('panel.proyectos-contratados', compact('user', 'tienePlanes', 'tipo_usuario', 'projectInfo'));
    }

    // Método privado para formatear la fecha
    private function formatearFecha($fecha)
    {
        $date = new DateTime($fecha);

        $formatter = new IntlDateFormatter(
            'es_ES', // Idioma y localización
            IntlDateFormatter::LONG, // Formato largo (17 de octubre de 2024)
            IntlDateFormatter::NONE // No necesitamos la hora
        );
        
        // Formatear la fecha
        return $formatter->format($date);
    }
}
