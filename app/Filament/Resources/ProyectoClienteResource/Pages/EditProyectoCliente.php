<?php

namespace App\Filament\Resources\ProyectoClienteResource\Pages;

use App\Filament\Resources\ProyectoClienteResource;
use App\Models\ProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\ProyectoPagoEstado;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use App\Services\Proyectos\ServicioVigenciaProyecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EditProyectoCliente extends EditRecord
{
    protected static string $resource = ProyectoClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Cargar el user_email del cliente desde la tabla `users`
        $user = User::find($this->record->user_id);
        
        if ($user) {
            $data['user_email'] = $user->email; // Asignar el correo al campo user_email
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Evitar la modificación del correo electrónico durante la edición
        unset($data['user_email']);

        // Actualizar el usuario relacionado si existe
        $user = User::find($this->record->user_id);
        if ($user) {
            $user->update([
                'nombres' => $data['razon_social'], // Actualiza el nombre del usuario con la razón social
                'direccion' => $data['direccion_fiscal'], // Actualiza la dirección fiscal en la tabla `users`
                'numero_documento' => $data['ruc'], // Actualiza el RUC en la tabla `users`
                'celular' => $data['telefono_inmobiliaria'], // Actualizar el celular en la tabla usuarios
            ]);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $proyectoCliente = $this->record;

        // Genera cronograma de pagos
        $this->generatePaymentSchedule($proyectoCliente);
        
        // Calcular y actualizar la vigencia
        app(ServicioVigenciaProyecto::class)->actualizarVigencia($proyectoCliente);

    }
    
    private function generatePaymentSchedule($proyectoCliente): void
    {
        $estadoPendiente = ProyectoPagoEstado::where('nombre', 'pendiente')->first()->id;

        $proyectoCliente_all = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
            ->where('proyecto_clientes.id', $proyectoCliente->id)
            ->select(
                'proyecto_clientes.id as id',
                'proyecto_clientes.al_dia as al_dia',
                'proyecto_clientes.razon_social as razon_social',
                'proyecto_planes_activos.id as plan_activo_id',
                'proyecto_planes_activos.duracion as periodo_plan',
                'proyecto_planes_activos.pago_unico as pago_unico',
                'proyecto_planes_activos.monto as precio_plan',
                'proyecto_planes_activos.fecha_fin as fecha_fin_contrato',
                'proyecto_planes_activos.numero_anuncios as numero_anuncios',
                'proyecto_planes_activos.fecha_inicio as fecha_inicio_contrato',
            )
            // ->orderBy('proyecto_planes_activos.fecha_inicio', 'desc')
        ->get();
        // $proyectoCliente->proyectoPlanesActivos;
        Log::info("Entra una y otra vez");
        Log::info($proyectoCliente_all);
        
        foreach ($proyectoCliente_all as $proyectoCliente) {
            Log::info("dentro del foreach");
            Log::info($proyectoCliente->plan_activo_id);
            
            $fechaInicio = Carbon::parse($proyectoCliente->fecha_inicio_contrato);
        
            if ($proyectoCliente->pago_unico) {
                ProyectoCronogramaPago::updateOrCreate([
                    'proyecto_cliente_id' => $proyectoCliente->id,
                    'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                    ],[
                    'fecha_programada' => $fechaInicio,
                    'monto' => $proyectoCliente->precio_plan,
                    'estado_pago_id' => $estadoPendiente,
                    'intentos' => 0,
                ]);
            } else {
                // Caso de pago fraccionado con el 50% inicial
                $primerPago = $proyectoCliente->precio_plan * 0.5; // 50% del total
                $montoRestante = $proyectoCliente->precio_plan * 0.5; // 50% restante
                $numeroPagosRestantes = $proyectoCliente->periodo_plan - 1;
        
                // Monto mensual para los pagos restantes
                $montoMensual = $numeroPagosRestantes > 0 ? $montoRestante / $numeroPagosRestantes : 0;
        
                // Primer pago al inicio del contrato
                ProyectoCronogramaPago::updateOrCreate([
                    'proyecto_cliente_id' => $proyectoCliente->id,
                    'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                    ],[
                    'fecha_programada' => $fechaInicio,
                    'monto' => $primerPago,
                    'estado_pago_id' => $estadoPendiente,
                    'intentos' => 0,
                ]);
        
                // Pagos restantes divididos en los meses restantes
                for ($i = 1; $i < $proyectoCliente->periodo_plan; $i++) {
                    ProyectoCronogramaPago::create([
                        'proyecto_cliente_id' => $proyectoCliente->id,
                        'proyecto_plan_activo_id' => $proyectoCliente->plan_activo_id,
                        'fecha_programada' => $fechaInicio->copy()->addMonths($i),
                        'monto' => $montoMensual,
                        'estado_pago_id' => $estadoPendiente,
                        'intentos' => 0,
                    ]);
                }
            }
        }
    }
}
