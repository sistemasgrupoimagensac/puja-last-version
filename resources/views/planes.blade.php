@extends('layouts.app')

@section('styles')
    
@endsection

@section('header')
  @include('components.header')
@endsection


@section('content')

<div class="container my-5">

  <h1 class="text-center icon-orange">Elige tu plan</h1>


  {{-- Cards de plans --}}
  <div>

    {{-- <div class="" role="" aria-label="Basic radio toggle button group">
      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
      <label class="btn-lg btn-outline-secondary button-filter" for="btnradio1">5 Avisos</label>
    
      <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
      <label class="btn btn-outline-secondary button-filter" for="btnradio2">10 Avisos</label>
    
      <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
      <label class="btn btn-outline-secondary button-filter" for="btnradio3">25 Avisos</label>
    </div> --}}

    <div role="group" class="d-flex flex-wrap justify-content-between gap-3" x-data="{ open: false }">

      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="5avisos" autocomplete="off" checked>
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="5avisos" style="width: 180px">5 Avisos</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="10avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="10avisos" style="width: 185px">10 Avisos</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="25avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="25avisos" style="width: 185px">25 Avisos</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="num_avisos" id="50avisos" autocomplete="off">
        <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="50avisos" style="width: 185px">50 Avisos</label>
      </div>
      {{-- <div class="text-center"> --}}
      <button style="width: 185px" class="btn icon-orange" :click="open = ! open" >mostrar más</button>
      {{-- </div> --}}
      <div x-show="open" x-transition>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="75avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="75avisos" style="width: 185px">75 Avisos</label>
        </div>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="100avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="100avisos" style="width: 185px">100 Avisos</label>
        </div>
        <div>
          <input type="radio" class="btn-check" name="num_avisos" id="200avisos" autocomplete="off">
          <label class="btn btn-lg btn-outline-secondary button-filter fs-2" for="200avisos" style="width: 185px">200 Avisos</label>
        </div>
      </div>

      <button style="width: 185px" class="btn icon-orange">mostrar menos</button>


    </div>
    

    <x-card-plan></x-card-plan>

    <div x-data="{ open: false }">
      <button x-on:click="open = ! open">Toggle Dropdown</button>
   
      <div x-show="open" x-transition>
          Dropdown Contents...
      </div>
  </div>


  </div>



</div>
    

<x-footer></x-footer>

@endsection


@section('scripts')
    
@endsection