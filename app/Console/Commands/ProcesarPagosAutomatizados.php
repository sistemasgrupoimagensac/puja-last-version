<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioOrquestadorPagos;

class ProcesarPagosAutomatizados extends Command
{
    protected $signature = 'proyectos:procesar-pagos';
    protected $description = 'Procesa pagos y actualiza estados.';

    protected $orquestadorPagos;

    public function __construct(ServicioOrquestadorPagos $orquestadorPagos)
    {
        parent::__construct();
        $this->orquestadorPagos = $orquestadorPagos;
    }

    public function handle()
    {
        $this->orquestadorPagos->procesarPagos();
        $this->info('Pagos procesados.');
    }
}
