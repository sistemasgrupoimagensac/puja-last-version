<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ProyectoPlanesActivos;

class RenovacionRecordatorio extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;

    /**
     * Create a new message instance.
     */
    public function __construct(ProyectoPlanesActivos $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.renovacion-recordatorio')
            ->subject('Recordatorio de Renovación de Contrato')
            ->with([
                'nombreCliente' => $this->plan->proyectoCliente->razon_social,
                'fechaFin' => $this->plan->fecha_fin->format('d/m/Y'),
                'renovacionAutomatica' => $this->plan->renovacion_automatica,
                'planNombre' => $this->plan->proyectoPlanes->nombre ?? 'Plan Personalizado',
            ]);
    }
}
