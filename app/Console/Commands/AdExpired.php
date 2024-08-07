<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class AdExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ad-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este CRON va a cambiar al estado vencido los avisos que culminaron su tiempo de publicación segun su Plan contratado.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subs = Subscription::create([
            'name' => "Prueba",
            'estado' => 1,
        ]);
    }
}
