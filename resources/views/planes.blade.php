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

    <x-card-plan></x-card-plan>


  </div>



</div>
    

<x-footer></x-footer>

@endsection


@section('scripts')
    
@endsection