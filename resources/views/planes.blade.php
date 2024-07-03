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

  <h1 class="text-center fw-bold">Elige tu plan</h1>


  {{-- Planes --}}
  <form>
    @csrf
    <div class="d-flex flex-column align-items-center my-5 gap-5">

      {{-- numero de avisos --}}
      <fieldset>
        <legend class=" text-center text-secondary h5">1. Selecciona el número de avisos.</legend>

        <div role="group" class="planes-numero-avisos d-flex flex-wrap w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
          <div>
            <input type="radio" class="btn-check" name="num_avisos" id="5avisos" value="5" autocomplete="off" checked>
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="5avisos">5 Avisos</label>
          </div>
          <div>
            <input type="radio" class="btn-check" name="num_avisos" id="10avisos"  value="10" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="10avisos">10 Avisos</label>
          </div>
          <div>
            <input type="radio" class="btn-check" name="num_avisos" id="25avisos"  value="25" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="25avisos">25 Avisos</label>
          </div> 
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" name="num_avisos" id="50avisos"  value="50" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="50avisos">50 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" name="num_avisos" id="75avisos"  value="75" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="75avisos">75 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" name="num_avisos" id="100avisos"  value="100" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="100avisos">100 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" name="num_avisos" id="200avisos"  value="200" autocomplete="off">
            <label class="btn btn-lg btn-outline-primary button-filter fs-3 px-0 py-3" for="200avisos">200 Avisos</label>
          </div>
    
          <div class="avisos-desplegar d-flex align-items-center justify-content-center icon-orange border rounded" x-on:click="open = ! open">
            <p class="m-0" x-show="!open">mostrar más</p>
            <p class="m-0" x-show="open">mostrar menos</p>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend class="h5 text-secondary">2. Elige el tiempo de duración de tu plan.</legend>

        <div role="group" class="planes-numero-avisos d-flex flex-wrap w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
          <div>
            <input type="radio" class="btn-check" name="periodo_plan" id="90" value="1" autocomplete="off" checked>
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90">90 días</label>
          </div>
          <div>
            <input type="radio" class="btn-check" name="periodo_plan" id="180"  value="2" autocomplete="off">
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="180">180 días</label>
          </div>
          <div>
            <input type="radio" class="btn-check" name="periodo_plan" id="365"  value="3" autocomplete="off">
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="365">365 días</label>
          </div> 

        </div>

      </fieldset>
  
      {{-- categoria de plan --}}
      <fieldset>
        <legend class="text-center text-secondary h5">3. Selecciona el plan que se ajusta a tus necesidades.</legend>
        
        <div role="group" class="d-flex flex-column flex-lg-row gap-3 mt-4">
          {{-- plan basico --}}
          <div>
            <input type="radio" class="btn-check plan-btn-basic" name="type_plan" id="basic_plan" value="basic_plan" autocomplete="off" checked>
            <x-card-plan
              title="Básico"
              price="259"
              time="90"
              plan="basic_plan"
              className="btn-light border-dark-subtle"
              avisosTipicos="5"
              avisosTop="0"
              avisosTopPlus="0"
            />
        
          </div>
    
          {{-- plan estandard --}}
          <div>
            <input type="radio" class="btn-check" name="type_plan" id="standard_plan" value="standard_plan" autocomplete="off">
            <x-card-plan 
              title="Estándar" 
              price="325"
              time="90"
              plan="standard_plan"
              className="btn-warning border-warning"
              avisosTipicos="3"
              avisosTop="2"
              avisosTopPlus="0"
            />
          </div>
    
          {{-- plan superior --}}
          <div>
            <input type="radio" class="btn-check" name="type_plan" id="advance_plan" value="advance_plan" autocomplete="off">
            <x-card-plan 
              title="Superior" 
              price="405"
              time="90"
              plan="advance_plan"
              className="btn-success border-success"
              avisosTipicos="2"
              avisosTop="2"
              avisosTopPlus="1"
            />
          </div>

        </div>
      </fieldset>

      
    </div>
  </form>

</div>
    
<x-footer></x-footer>
@endsection