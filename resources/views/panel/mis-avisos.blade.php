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
            @include('components.menu_panel')
            <section id="" class="col px-5 pt-2">
                <h2>Mis avisos</h2>

                <section class="my-3">
                    <div class="card card-aviso shadow bg-white">
                        <div class="card-body h-100">
                            <div class="row g-0 h-100">
                                <div class="col-lg-3 col-xl-2 h-100">
                                    <div class="image-aviso h-100">
                                        <a href="#" target="_blank" class="text-decoration-none text-reset">
                                          <img src="{{ asset('images/house_4.webp') }}" class="card-inmueble-image rounded" alt="imagen inmueble">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xl-10">
                                    <div class="card-aviso-content">
                                        <div class="col-lg-6">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-secondary d-flex justify-content-between align-items-center">
                                        <p class="m-0">
                                          user
                                        </p>
                              
                                        <div class="d-flex gap-2">
                              
                                          <button class="btn btn-light border-secondary-subtle bg-white">
                                            <i class="fas fa-envelope"></i> Email
                                          </button>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>
@endsection

@section('footer')
  @include('components.footer')
@endsection