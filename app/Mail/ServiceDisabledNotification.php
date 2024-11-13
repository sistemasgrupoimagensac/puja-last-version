<?php

namespace App\Mail;

use App\Models\ProyectoCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceDisabledNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $clienteProyecto;

    /**
     * Crea una nueva instancia del mensaje.
     *
     * @param ProyectoCliente $clienteProyecto
     */
    public function __construct(ProyectoCliente $clienteProyecto)
    {
        $this->clienteProyecto = $clienteProyecto;
    }

    /**
     * Construye el mensaje.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de Desactivación de Servicio')
                    ->view('mails.service_disabled')
                    ->with([
                        'razonSocial' => $this->clienteProyecto->razon_social,
                        'fechaFin' => $this->clienteProyecto->fecha_fin_contrato,
                    ]);
    }
}
