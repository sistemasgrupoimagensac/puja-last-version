<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ProyectoPlanesActivos;

class PromocionRenovacionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $plan;

    public function __construct(ProyectoPlanesActivos $plan)
    {
        $this->plan = $plan;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('¡Renueva tu Plan!')
            ->line("Tu plan finalizó el {$this->plan->fecha_fin}.")
            ->line('Te invitamos a renovar tu plan con las mismas condiciones que ya tienes.')
            ->action('Renovar Ahora', url('/ruta-de-pago'))
            ->line('Gracias por confiar en nosotros.');
    }
}
