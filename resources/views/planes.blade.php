@extends('layouts.app')

@section('title')
  Planes de Pago
@endsection

@push('styles')
  @vite(['resources/sass/pages/planes.scss'])
@endpush

@section('header')
  @include('components.header')
@endsection


@section('content')

<div class="container my-5">

  <h1 class="text-center icon-orange">Elige tu plan</h1>


  {{-- Cards de plans --}}
  <div class="d-flex flex-column align-items-center my-5">

    <div role="group" class="planes-numero-avisos d-flex flex-wrap justify-content-between justify-content-lg-start w-100 gap-3 gap-lg-4 px-1 p-lg-0" style="max-width: 712px" x-data="{ open: false }">

      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="5avisos" autocomplete="off" checked>
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="5avisos" style="width: 160px">5 Avisos</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="10avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="10avisos" style="width: 160px">10 Avisos</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="25avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="25avisos" style="width: 160px">25 Avisos</label>
      </div> 
      <div x-show="open" x-transition>
        <input type="radio" class="btn-check" name="num_avisos" id="50avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="50avisos" style="width: 160px">50 Avisos</label>
      </div>
      <div x-show="open" x-transition>
        <input type="radio" class="btn-check" name="num_avisos" id="75avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="75avisos" style="width: 160px">75 Avisos</label>
      </div>
      <div x-show="open" x-transition>
        <input type="radio" class="btn-check" name="num_avisos" id="100avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="100avisos" style="width: 160px">100 Avisos</label>
      </div>
      <div x-show="open" x-transition>
        <input type="radio" class="btn-check" name="num_avisos" id="200avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2 px-0 py-3" for="200avisos" style="width: 160px">200 Avisos</label>
      </div>

      <button class="btn icon-orange" x-on:click="open = ! open" style="width: 160px" x-show="!open" x-transition>mostrar más</button>
      <button class="btn icon-orange" x-on:click="open = ! open" style="width: 160px" x-show="open" x-transition>mostrar menos</button>
      {{-- <div class="text-center"> --}}
      {{-- <button style="width: 185px" class="btn icon-orange" x-on:click="open = ! open" x-show="!open" x-transition>mostrar más</button>
      <button style="width: 185px" class="btn icon-orange" x-on:click="open = ! open" x-show="open" x-transition>mostrar menos</button> --}}
      {{-- </div> --}}
      {{-- <div x-show="open" x-transition>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="75avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-3" for="75avisos" style="width: 185px">75 Avisos</label>
        </div>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="100avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="100avisos" style="width: 185px">100 Avisos</label>
        </div>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="200avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="200avisos" style="width: 185px">200 Avisos</label>
        </div>
      </div> --}}

      {{-- <button style="width: 185px" class="btn icon-orange">mostrar menos</button> --}}


    </div>
  


  </div>

  <x-card-plan></x-card-plan>




</div>
    

<x-footer></x-footer>

@endsection


@section('scripts')
    
@endsection