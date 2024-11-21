<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ProyectoPlanesActivos;

class RecordatorioRenovacionNotification extends Notification implements ShouldQueue
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
            ->subject('Recordatorio de Renovación de Plan')
            ->line("Estimado cliente, tu plan actual finaliza el {$this->plan->fecha_fin}.")
            ->line('Recuerda que puedes dar de baja la renovación automática hasta 30 días antes de esta fecha.')
            ->action('Gestionar Plan', url('/ruta-de-gestion'))
            ->line('Gracias por confiar en nosotros.');
    }
}
