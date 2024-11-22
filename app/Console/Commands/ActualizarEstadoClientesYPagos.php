<?php

namespace App\Console\Commands;

use App\Models\ProyectoCliente;
use Illuminate\Console\Command;
use App\Services\Proyectos\ServicioEstadoCliente;

class ActualizarEstadoClientesYPagos extends Command
{
    protected $signature = 'proyectos:actualizar-estados';
    protected $description = 'Actualiza los estados de clientes y sus pagos.';

    protected $estadoCliente;

    public function __construct(ServicioEstadoCliente $estadoCliente)
    {
        parent::__construct();
        $this->estadoCliente = $estadoCliente;
    }

    public function handle()
    {
        ProyectoCliente::all()->each(fn($cliente) => $this->estadoCliente->actualizarEstadoCliente($cliente));
        $this->info('Estados de clientes y pagos actualizados.');
    }
}
