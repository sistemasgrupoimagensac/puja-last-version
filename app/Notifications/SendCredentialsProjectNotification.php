<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendCredentialsProjectNotification extends Notification
{
    use Queueable;

    public $email;
    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Credenciales de Acceso a Puja Inmobiliaria')
                    ->greeting('¡Hola!')
                    ->line('Se han generado tus credenciales para acceder al sistema:')
                    ->line('**Email:** ' . $this->email)
                    ->line('**Contraseña:** ' . $this->password)
                    ->action('Iniciar Sesión', url('/login')) // Ruta de login
                    ->line('Por favor, cambia tu contraseña una vez que inicies sesión.')
                    ->salutation('Saludos, Equipo Puja Inmobiliaria');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
