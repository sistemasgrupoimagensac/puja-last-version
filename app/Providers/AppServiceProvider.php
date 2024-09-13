<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();

        Paginator::defaultView('vendor.pagination.bootstrap-5');
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-5');
        // Blade::component('blog.components', 'post-card');
        

        // RUTAS PARA CAMBIAR EL TEXTO DEL CORREO
        // VENDOR ==> laravel framework src Illuminate notificactions resources views email.blade.php
        // VENDOR ==> laravel framework src Illuminate Mail resources views message.blade.php
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('¡Hola!')
                ->subject('Verificación de correo electrónico')
                ->line('Por favor haga clic en el botón a continuación para verificar su dirección de correo electrónico.')
                ->action('Verificar correo electrónico', $url)
                ->salutation('Saludos cordiales');
        });
    }
}

