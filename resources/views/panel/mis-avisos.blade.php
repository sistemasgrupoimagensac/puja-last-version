@extends('layouts.app')

@section('title')
    Mis Avisos
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    <main id="main-misavisos" class="custom-container my-5">
        <div class="container-fluid p-0 d-flex">
            {{-- menú del panel --}}
            @include('components.menu_panel')
            <section class="col px-lg-5 pt-lg-2">
                <h1>Mis avisos</h1>
                <hr>
                {{-- Lista de avisos publicados y por publicar --}}
                <section class="my-3">

                    {{-- AVISOS POR PUBLICAR --}}
                    <h2 class="h3 fw-bold">Por Publicar:</h2>
                    @php
                        $total_avisos_porpublicar = 0
                    @endphp
                    @foreach ($avisos as $aviso)
                        @if ( $aviso->historial->first()->pivot->estado_aviso_id === 1 || $aviso->historial->first()->pivot->estado_aviso_id === 2 )
                            @include('components.aviso_simple', [
                                'id' => $aviso->id,
                                'codigo_unico' => $aviso->inmueble->codigo_unico,
                                'link' => $aviso->historial->first()->pivot->estado_aviso_id === 1 ? route('posts.edit', $aviso->id) :  route('inmueble.single', ['inmueble' => $aviso->link()]),
                                'title' => $aviso->inmueble->title() ?? 'Aviso sin título',
                                'image' => $aviso->inmueble->imagenPrincipal(),
                                'type' => $aviso->inmueble->type(), 
                                'category' => $aviso->inmueble->category(),
                                'currencySoles' => $aviso->inmueble->currencySoles(),
                                'currencyDolares' => $aviso->inmueble->currencyDolares(),
                                'precioSoles' => $aviso->inmueble->precioSoles(),
                                'precioDolares' => $aviso->inmueble->precioDolares(),
                                'precioBase' => $aviso->inmueble->remate_precio_base(),
                                'precioValorTasado' => $aviso->inmueble->remate_valor_tasacion(),
                                'address' => $aviso->inmueble->address(),
                                'distrito'=> $aviso->inmueble->distrito(),
                                'provincia'=> $aviso->inmueble->provincia(),
                                'departamento'=> $aviso->inmueble->departamento(),
                                'estado_aviso' => $aviso->historial[0]->estado,
                                'edit_enabled' => true,
                                'published' => false,
                            ])
                            @php
                                $total_avisos_porpublicar += 1
                            @endphp
                        @endif
                    @endforeach
                    @if ($total_avisos_porpublicar === 0)
                        <p>No tienes avisos por publicar <i class="fa-regular fa-face-frown fa-lg"></i></p>
                    @else
                        {{ $avisos->onEachSide(1)->links() }}
                    @endif

                    {{-- AVISOS PUBLICADOS --}}
                    <h2 class="h3 fw-bold">Publicado:</h2>
                    @php
                        $total_avisos_publicados = 0
                    @endphp
                    @foreach ($avisos as $aviso)
                        @php
                            $endDate = \Carbon\Carbon::parse($aviso->fecha_publicacion);
                            $newEndDate = $endDate->addHours(72);
                            $currentDate = \Carbon\Carbon::now();
                        @endphp
                        @if ( $aviso->historial->first()->pivot->estado_aviso_id === 3 )
                            @include('components.aviso_simple', [
                                'id' => $aviso->id,
                                'codigo_unico' => $aviso->inmueble->codigo_unico,
                                'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
                                'title' => $aviso->inmueble->title() ?? 'Aviso sin título',
                                'image' => $aviso->inmueble->imagenPrincipal(),
                                'type' => $aviso->inmueble->type(),
                                'category' => $aviso->inmueble->category(),
                                'currencySoles' => $aviso->inmueble->currencySoles(),
                                'currencyDolares' => $aviso->inmueble->currencyDolares(),
                                'precioSoles' => $aviso->inmueble->precioSoles(),
                                'precioDolares' => $aviso->inmueble->precioDolares(),
                                'precioBase' => $aviso->inmueble->remate_precio_base(),
                                'precioValorTasado' => $aviso->inmueble->remate_valor_tasacion(),
                                'address' => $aviso->inmueble->address(),
                                'distrito'=> $aviso->inmueble->distrito(),
                                'provincia'=> $aviso->inmueble->provincia(),
                                'departamento'=> $aviso->inmueble->departamento(),
                                'estado_aviso' => $aviso->historial[0]->estado,
                                'edit_enabled' => $currentDate < $newEndDate ? true : false,
                                'published' => true,
                            ])
                            @php
                                $total_avisos_publicados += 1
                            @endphp
                        @endif
                    @endforeach
                    @if ($total_avisos_publicados === 0)
                        <p>No tienes avisos publicados <i class="fa-regular fa-face-sad-cry fa-lg"></i></p>
                    @else
                        {{ $avisos->onEachSide(1)->links() }}
                    @endif

                </section>
            </section>
        </div>
    </main>


    {{-- Modal confirmación de eliminación de aviso --}}
    <div class="modal fade" id="avisoDeleteModal" tabindex="-1" aria-labelledby="avisoDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-content py-4">
                    
                    <i class="fa-regular fa-circle-xmark fa-4x text-danger"></i>
    
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">¿Seguro quiere eliminar el Aviso?</h4>
                    </div>
    
                    <div class="modal-body">
                        <p class="text-secondary m-0">Eliminar el aviso <span class="fw-bold" id="aviso-title-to-delete"></span> es un proceso que no se puede revertir</p>
                        <input type="hidden" id="aviso-id-to-delete"> <!-- Input oculto para el ID del aviso -->
                    </div>
    
                    <div class="d-flex p-3 justify-content-center gap-3">
                        <button type="button" class="btn btn-danger w-100" id="delete-aviso-btn">Eliminar</button>
                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancelar</button>
                    </div>
    
                </div>
                    
            </div>
        </div>
    </div>
    

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    @vite([ 'resources/js/scripts/components/mis_avisos.js' ])
@endpush
