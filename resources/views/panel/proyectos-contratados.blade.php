@extends('layouts.app')

@section('title')
    Planes contratados
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')

    <main class="main-misavisos custom-container my-5">
        <div class=" p-0 row">
            @include('components.menu-panel-proyecto')
            <section class="col px-lg-5 pt-2">
                <h1>Resumen anuncios contratados</h1>

                @if (isset($projectInfo))

                    @if ($projectInfo['al_dia'])

                        <div class="card text-bg-light my-5 shadow" style="width: 20rem;">

                            <div class="card-header text-secondary fw-bold h5">
                                {{ $user->nombres }}
                            </div>

                            <div class="card-body bg-white">
                                {{-- Tu contenido actual --}}
                                <div class="d-flex text-center align-items-center ">
                                    <div class="d-flex flex-column gap-2 align-items-start">
                                        <div>
                                            <span class="fw-bold">Anuncios contratados: </span>
                                            <h5 class="m-0 d-inline">
                                                <span class="badge text-bg-warning">{{ $projectInfo['numero_anuncios'] }} proyectos</span>
                                            </h5>
                                        </div>
                                        <p class="m-0">
                                            <span class="fw-bold">Inicio contrato: </span>
                                            <span>{{ $projectInfo['fecha_inicio_formateada'] }}</span>
                                        </p>
                                        <p class="m-0">
                                            <span class="fw-bold">Fin contrato: </span>
                                            <span>{{ $projectInfo['fecha_fin_formateada'] }}</span>
                                        </p>
                                    </div>
                                </div>

                                <h5 class="m-0"><span class="badge text-bg-warning mt-2">Periodo: {{ $projectInfo['periodo_plan'] }} meses</span></h5>
                            </div>

                            <div class="card-footer py-3">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-text">
                                        <div class="form-check form-switch">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                role="switch" 
                                                id="flexSwitchCheckCheckedDisabled"
                                                {{ $renovacion_automatica ? 'checked' : '' }}
                                                disabled
                                            >
                                        </div>
                                    </div>
                                    <button 
                                        type="button" 
                                        class="btn
                                        {{ $renovacion_automatica ? 'btn-success' : 'btn-outline-success' }}
                                        form-control"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmRenovacionModal"
                                    >
                                        Renovación
                                    </button>
                                </div>

                                <button type="button" class="btn btn-link text-decoration-none text-danger btn-sm mt-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalCronogramaPagos">
                                    Cronograma de pagos
                                </button>
                            </div>

                            {{-- Modal de cronograma de pagos --}}
                            <div class="modal fade" id="modalCronogramaPagos" tabindex="-1" aria-labelledby="modalCronogramaPagosLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="modalCronogramaPagosLabel">Cronograma de Pagos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                            
                                            @if($cronogramasPago->isEmpty())
                                                <p>No hay pagos programados.</p>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Fecha Programada</th>
                                                                <th>Monto</th>
                                                                <th>Estado de Pago</th>
                                                                <th>Fecha Transacción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($cronogramasPago as $cronograma)
                                                                <tr>
                                                                    <td>{{ $cronograma->id }}</td>
                                                                    <td>{{ $cronograma->fecha_programada->format('d/m/Y') }}</td>
                                                                    <td>${{ number_format($cronograma->monto, 2) }}</td>

                                                                    <td
                                                                        class=""
                                                                    
                                                                    >{{ $cronograma->estadoPago->nombre }}</td>
                                                                    
                                                                    @if ( $cronograma->estadoPago->nombre === 'pagado')
                                                                        
                                                                    @endif
                                                                    <td>{{ $cronograma->estadoPago->nombre }}</td>
                                                                    <td>{{ $cronograma->fecha_ultimo_intento ? $cronograma->fecha_ultimo_intento->format('d/m/Y') : 'N/A' }}</td>
                                                
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal confirmación de cancelar renovación automática --}}
                            <div class="modal fade" id="confirmRenovacionModal" tabindex="-1" aria-labelledby="confirmRenovacionModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-content py-4">
                                            <i class="fa-regular fa-circle-question fa-4x text-danger"></i>
                                            <div class="modal-header justify-content-center">
                                                <h4 class="modal-title">¿Confirmar cambio en la renovación automática?</h4>
                                            </div>
                                            <div class="d-flex p-3 justify-content-center gap-3">
                                                <button type="button" class="btn btn-danger w-100" id="confirm-renovacion-btn" data-id="{{ $proyecto_cliente_id }}">Confirmar</button>
                                                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    @else
                        <p>No tienes planes activos en este momento.</p>
                    @endif
                    
                @endif
            </section>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const confirmButton = document.getElementById('confirm-renovacion-btn');

            confirmButton.addEventListener('click', () => {
                const clienteId = confirmButton.getAttribute('data-id');

                // Enviar el valor actualizado al backend
                fetch('/planes/renovacion/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        proyecto_cliente_id: clienteId,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                        } else {
                            alert('Ocurrió un error al actualizar la renovación automática.');
                        }
                        location.reload()
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error en el sistema.');
                    });
            });
        });
    </script>

@endsection
