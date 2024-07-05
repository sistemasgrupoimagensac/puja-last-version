@extends('layouts.app')

@section('title')
    Proyectos
@endsection

@push('styles')
    @vite(['resources/sass/pages/landing-projects.scss'])
@endpush

@section('content')


    <nav class="container p-2">

        <a class="navbar-brand" href="/">
            <img class="navbar-logo-puja" src="{{ asset('images/svg/logo_puja.svg') }}" alt="logo de pujainmobiliaria">
        </a>
    </nav>
    <h1>Proyectos Inmobiliarios</h1>

    <div class="project-landing-persona">
        <img src="{{ asset('images/per2.webp') }}" width="100" alt="Cliente satisfecho">
    </div>
    <div class="project-landing-edificio">
        <img src="{{ asset('images/edificio.webp') }}" width="100" alt="Edificio de proyecto inmobiliario">
    </div>


@endsection

@section('footer')
    <x-footer></x-footer>
@endsection