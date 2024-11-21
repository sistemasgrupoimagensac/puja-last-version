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
                        


                        <div class="card-footer d-flex align-items-center gap-3 py-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="flexCheckDefault" 
                                       data-id={{ $proyecto_cliente_id }}
                                       onchange="toggleRenovacion(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Renovación automática
                                </label>
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
        function toggleRenovacion(checkbox) {
            const proyectoClienteId = checkbox.getAttribute('data-id');
            const isChecked = checkbox.checked;
    
            fetch('/planes/renovacion/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    proyecto_cliente_id: proyectoClienteId,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                } else {
                    alert(data.message);
                    checkbox.checked = !isChecked; // Revertir el estado si hubo un error
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al actualizar la renovación automática.');
                checkbox.checked = !isChecked; // Revertir el estado si hubo un error
            });
        }
    </script>

@endsection