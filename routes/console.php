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




Schedule::command('proyectos:actualizar-vigencia')->daily();

Schedule::command('proyectos:actualizar-estados')->daily();

Schedule::command('proyectos:procesar-pagos')->daily();

Schedule::command('renovacion:promocion')->daily();

Schedule::command('renovacion:recordatorio')->daily();
