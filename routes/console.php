<?php

use App\Console\Commands\AdExpired;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:ad-expired')->daily();

// Correo recordatorio de fin de plan proyecto 45 dias antes
Schedule::command('contract:send-reminder')->daily();

// Debito automático
// Schedule::command('subscription:auto-debit')->daily();

// Cobros automaticos para proyectos
// Schedule::command('proyectos:cobros-automaticos')->daily();

// Actualizar vigencia de proyectos
Schedule::command('proyectos:actualizar-vigencia')->daily();

// Actualizar estado pago proyecto
// Schedule::command('proyectos:actualizar-estado-pagos')->daily();

Schedule::command('proyectos:procesar-pagos')->daily();
