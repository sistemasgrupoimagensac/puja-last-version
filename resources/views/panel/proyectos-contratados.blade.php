@extends('layouts.app')

@section('title')
    Planes contratados
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')


    <main class="main-misavisos custom-container my-5">
        <div class="container-fluid p-0 d-flex">
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
                            {{-- <p class="fs-4 m-0">Adquiere un plan con los mejores precios del mercado.</p> --}}

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

                        </div>



                        {{-- Modal confirmación de cancelar renovacion automatica --}}
                        <div class="modal fade" id="confirmRenovacionModal" tabindex="-1" aria-labelledby="confirmRenovacionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-content py-4">
                                        <i class="fa-regular fa-circle-question fa-4x text-danger"></i>
                                        <div class="modal-header justify-content-center">
                                            <h4 class="modal-title">¿Confirmar cambio en la renovación automática?</h4>
                                        </div>
                                        <div class="d-flex p-3 justify-content-center gap-3">
                                            <button type="button" class="btn btn-danger w-100" id="confirm-renovacion-btn" data-id={{ $proyecto_cliente_id }}>Confirmar</button>
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
            // const modal = document.getElementById('confirmRenovacionModal');
    
            confirmButton.addEventListener('click', () => {
                // const checkbox = document.querySelector('.form-check-input');
                const clienteId = confirmButton.getAttribute('data-id');
                // const renovacionAutomatica = checkbox.checked;
    
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