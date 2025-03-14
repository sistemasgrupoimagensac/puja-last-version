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

    <main class="main-misavisos custom-container my-5">
        <div class="container-fluid p-0 d-flex">
            @include('components.menu_panel')
            <section class="col px-lg-5 pt-2">
                <h1>Planes contratados</h1>
                
                @if($tienePlanes)

                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 my-5">

                    @if ($tipo_usuario === 3)
                        <div class="card text-bg-light" style="width: 20rem;">
                            <div class="card-body d-flex text-center align-items-center">
                                <p class="fs-4 m-0">Adquiere un plan con los mejores precios del mercado.</p>
                            </div>
                            
                            <a class="btn btn-danger fs-5 rounded-top-0 h-25" href="/planes-inmobiliaria">
                                <div class="d-flex justify-content-center align-items-center gap-2 h-100">
                                    <i class="fa-solid fa-plus fa-lg"></i>
                                    <span class="fs-2">Plan</span>

                                </div>
                            </a>
                        </div>
                    @endif

                    @foreach($active_plan_users as $plan)
                    
                        <x-card-planes-contratados 
                            planTitle="{{ $plan['name'] }}"

                            term="{{ $plan['duration_in_days'] }}"
                            start="{{ \Carbon\Carbon::parse($plan['plan_user']['start_date'])->format('d/m/Y') }}"
                            {{-- end="{{ \Carbon\Carbon::parse($plan['plan_user']['end_date'])->format('d/m/Y') }}" --}}

                            totalAdsHired="{{ $plan['total_ads'] }}"
                            typicalAdsHired="{{ $plan['typical_ads'] }}"
                            topAdsHired="{{ $plan['top_ads'] }}"
                            topPlusAdsHired="{{ $plan['premium_ads'] }}"

                            typicalAdsRemaining="{{ $plan['plan_user']['typical_ads_remaining'] }}"
                            topAdsRemaining="{{ $plan['plan_user']['top_ads_remaining'] }}"
                            topPlusAdsRemaining="{{ $plan['plan_user']['premium_ads_remaining'] }}"
                        />
    
                    @endforeach
                </div>
                
                @else
                    <p>No tienes planes activos en este momento.</p>
                @endif

            </section>
        </div>

    </main>
@endsection