@extends('layouts.app')

@section('title')
    Mis Avisos
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    <main id="main-misavisos" class="custom-container mt-3">
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
                    @endif

                </section>
            </section>
        </div>
    </main>
@endsection

@section('footer')
  @include('components.footer')
@endsection