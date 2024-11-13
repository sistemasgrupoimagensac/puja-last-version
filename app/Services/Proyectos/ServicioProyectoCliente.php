<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoCliente;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceDisabledNotification;

class ServicioProyectoCliente
{
    /**
     * Deshabilita el servicio para el cliente de proyecto dado.
     *
     * @param int $projectClientId El ID del cliente del proyecto.
     * @return void
     */
    public function deshabilitarServicioProyecto(int $projectClientId): void
    {
        // Encuentra el cliente de proyecto
        $clienteProyecto = ProyectoCliente::find($projectClientId);

        // Si el cliente de proyecto no existe, registra un error y termina
        if (!$clienteProyecto) {
            Log::warning("Cliente de proyecto con ID {$projectClientId} no encontrado al intentar deshabilitar el servicio.");
            return;
        }

        // Cambia el estado del cliente a deshabilitado o inactivo
        $clienteProyecto->update(['activo' => false]);

        // Opcional: Notificar al cliente sobre la deshabilitación del servicio
        $this->notificarDeshabilitacion($clienteProyecto);
    }

    /**
     * Envía una notificación al cliente de proyecto indicando que su servicio ha sido deshabilitado.
     *
     * @param ProyectoCliente $clienteProyecto El cliente del proyecto.
     * @return void
     */
    protected function notificarDeshabilitacion(ProyectoCliente $clienteProyecto): void
    {
        try {
            Mail::to($clienteProyecto->user->email)->send(new ServiceDisabledNotification($clienteProyecto));
        } catch (\Exception $e) {
            Log::error("Error al enviar notificación de deshabilitación al cliente con ID {$clienteProyecto->id}: " . $e->getMessage());
        }

        Log::info("Servicio deshabilitado para el cliente de proyecto con ID {$clienteProyecto->id}.");
    }
}
