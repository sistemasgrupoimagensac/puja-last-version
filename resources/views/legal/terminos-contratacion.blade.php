@extends('layouts.app')

@section('title')
  Terminos y Condiciones de Contratación Publicitaria
@endsection

@push('styles')
  	@vite(['resources/sass/pages/terminos.scss'])
@endpush

@section('header')
  @include('components.header')
@endsection

@section('content')
    
  <div class="container my-5">
    <div class="terminos p-5">
      <h1 class="terminos-titulo">Términos y Condiciones Generales de Contratación</h1>
      <h3 class="terminos-articulo">1. CONTRATACIÓN</h3>
      <p>Ea, minus accusamus delectus non nisi reprehenderit iusto corporis temporibus, ducimus a odit natus optio tenetur magnam magni rerum vitae quae. Possimus.</p>
      <p>Deleniti nostrum modi perferendis autem nulla hic eveniet ex. Aperiam, voluptatem excepturi. Itaque nam ipsam recusandae minus, perferendis modi minima molestiae vitae.</p>
      <p>Voluptatem reprehenderit, quia earum, eligendi illum temporibus eaque nobis ea accusamus deleniti asperiores odio! Laborum delectus dolorem, culpa quia autem deserunt voluptatem.</p>
      <h3 class="terminos-articulo">2. ACCESO AL SITIO WEB</h3>
      <p>Ea, minus accusamus delectus non nisi reprehenderit iusto corporis temporibus, ducimus a odit natus optio tenetur magnam magni rerum vitae quae. Possimus.</p>
      <p>Deleniti nostrum modi perferendis autem nulla hic eveniet ex. Aperiam, voluptatem excepturi. Itaque nam ipsam recusandae minus, perferendis modi minima molestiae vitae.</p>
      <p>Voluptatem reprehenderit, quia earum, eligendi illum temporibus eaque nobis ea accusamus deleniti asperiores odio! Laborum delectus dolorem, culpa quia autem deserunt voluptatem.</p>
      <h3 class="terminos-articulo">3. UTILIZACIÓN DEL SITIO WEB</h3>
      <p>Ea, minus accusamus delectus non nisi reprehenderit iusto corporis temporibus, ducimus a odit natus optio tenetur magnam magni rerum vitae quae. Possimus.</p>
      <p>Deleniti nostrum modi perferendis autem nulla hic eveniet ex. Aperiam, voluptatem excepturi. Itaque nam ipsam recusandae minus, perferendis modi minima molestiae vitae.</p>
      <p>Voluptatem reprehenderit, quia earum, eligendi illum temporibus eaque nobis ea accusamus deleniti asperiores odio! Laborum delectus dolorem, culpa quia autem deserunt voluptatem.</p>
    </div>
  </div>
@endsection

@section('footer')
	<x-footer></x-footer>
@endsection