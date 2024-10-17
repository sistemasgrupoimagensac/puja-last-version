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
    
                    @if ($projectInfo['activo'])
    
                    <div class="card text-bg-light my-5 shadow" style="width: 20rem;">
    
                        <div class="card-header text-secondary fw-bold h5">
                            {{ $user->nombres }}
                        </div>
    
                        <div class="card-body d-flex text-center align-items-center bg-white">
                            {{-- <p class="fs-4 m-0">Adquiere un plan con los mejores precios del mercado.</p> --}}
    
                            <div class="d-flex flex-column gap-2 align-items-start">
    
                                <p class="m-0">
                                    <span class="fw-bold">Anuncios contratados: </span>
                                    <span>{{ $projectInfo['numero_anuncios'] }}</span>
                                </p>
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

                        <div class="card-footer d-flex align-items-center gap-3 py-3">

                            <p class="m-0">¿Mejorar tu plan?</p>

                            <a class="btn btn-success p-2" href="/contacto">
                                <div class="d-flex justify-content-center align-items-center gap-2 h-100">
                                    <i class="fa-solid fa-envelopes-bulk fa-lg"></i>
                                    <span class="m-0">Contáctanos</span>
        
                                </div>
                            </a>
                        </div>


                        
    
                    </div>
                    
                    
                    @else
                        <p>No tienes planes activos en este momento.</p>
                    @endif
                    
                @endif
                

            </section>
        </div>

    </main>
@endsection