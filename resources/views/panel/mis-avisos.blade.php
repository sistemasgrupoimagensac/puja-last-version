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
            <section id="" class="col">
                <div class="container px-5 pt-2">
                    <h2>Mis avisos</h2>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
  @include('components.footer')
@endsection