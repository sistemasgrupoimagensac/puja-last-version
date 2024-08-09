@extends('layouts.app')

@section('title')
    Planes contratados
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')

    @php

    $id = $active_plan_users;
        
    @endphp

    <main id="main-misavisos" class="custom-container mt-3">
        <div class="container-fluid p-0 d-flex">
            @include('components.menu_panel')
            <section id="" class="col px-5 pt-2">
                <h1>Planes contratados</h1>
                
                @if($tienePlanes)

                <div class="d-flex flex-wrap gap-3 mt-5">

                    <div class="card text-bg-light mb-3" style="width: 20rem;">
                        <div class="card-body d-flex text-center align-items-center">
                            <p class="fs-4 m-0">Adquiere un plan con los mejores precios del mercado.</p>
                        </div>
                        
                        @if ($tipo_usuario === 3)
                            <a class="btn btn-danger fs-5 rounded-top-0 h-25" href="/planes-inmobiliaria">
                                <div class="d-flex justify-content-center align-items-center gap-2 h-100">
                                    <i class="fa-solid fa-plus fa-lg"></i>
                                    <span class="fs-2">Plan</span>

                                </div>
                            </a>
                        @endif
                    </div>

                    @foreach($active_plan_users as $plan)
                    
                        <x-card-planes-contratados 
                            planTitle="{{ $plan['name'] }}"

                            term="{{ $plan['duration_in_days'] }}"
                            start="{{ \Carbon\Carbon::parse($plan['plan_user']['start_date'])->format('d/m/Y') }}"
                            end="{{ \Carbon\Carbon::parse($plan['plan_user']['end_date'])->format('d/m/Y') }}"

                            totalAdsHired="{{ $plan['total_ads'] }}"
                            typicalAdsHired="{{ $plan['typical_ads'] }}"
                            topAdsHired="{{ $plan['top_ads'] }}"
                            topPlusAdsHired="{{ $plan['premium_ads'] }}"

                            typicalAdsRemaining="{{ $plan['plan_user']['typical_ads_remaining'] }}"
                            topAdsRemaining="{{ $plan['plan_user']['top_ads_remaining'] }}"
                            topPlusAdsRemaining="{{ $plan['plan_user']['premium_ads_remaining'] }}"

                        />
    
                            
                                {{-- <strong>Nombre del Plan:</strong> {{ $plan['name'] }}<br>
                                <strong>Precio:</strong> ${{ number_format($plan['price'], 2) }}<br>
                                <strong>Duración:</strong> {{ $plan['duration_in_days'] }} días<br>
                                <strong>Top Ads Restantes:</strong> {{ $plan['plan_user']['top_ads_remaining'] }}<br>
                                <strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($plan['plan_user']['start_date'])->format('d/m/Y H:i:s') }}<br>
                                <strong>Fecha de Finalización:</strong> {{ \Carbon\Carbon::parse($plan['plan_user']['end_date'])->format('d/m/Y H:i:s') }}<br> --}}
                            
                        @endforeach
                </div>
                
                    
                @else
                    <p>No tienes planes activos en este momento.</p>
                @endif



            </section>
        </div>

    </main>
@endsection