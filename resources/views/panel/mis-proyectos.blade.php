@extends('layouts.app')

@section('title')
    Mis Avisos
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    <main class="main-misavisos custom-container my-5">
        <div class="container-fluid p-0 d-flex">
            {{-- menú del panel --}}
            @include('components.menu-panel-proyecto')
            <section class="col px-lg-5 pt-lg-2">
                <h1>Mis avisos de Proyectos</h1>
                <hr>
                <section class="my-3">
                    @foreach ($proyectos as $proyecto)

                        @include('components.proyecto-card-panel', [
                            'id' => $proyecto->id,
                            'link' => "/proyecto/$proyecto->slug",
                            'image' => $proyecto->imagenesAdicionales->first()->image_url,
                            'title' => $proyecto->nombre_proyecto,
                            'address' => $proyecto->direccion,
                            'distrito' => $proyecto->distrito,
                            'provincia' => $proyecto->provincia,
                            'departamento' => $proyecto->departamento,
                            'precioDesde' => $proyecto->precio_desde,
                            'fechaInicioContrato' => $projectInfo["fecha_inicio_contrato"],
                            'fechaFinContrato' => $projectInfo["fecha_fin_contrato"],
                        ])
                        
                    @endforeach
                </section>
            </section>
        </div>
    </main>

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    {{-- @vite([ 'resources/js/scripts/components/mis_avisos.js' ]) --}}
@endpush
