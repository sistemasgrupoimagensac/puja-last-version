<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCRON extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test para los cron cada 30segundos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        Log::info("Fecha de ejecución del TEST CRON \"{$currentDate}\" horas, esto se deberia ejecutar cada 30segundos.");
    }
}
