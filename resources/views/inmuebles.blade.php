@extends('layouts.app')

@section('title')
    Inmuebles
@endsection

@section('header')
  @include('components.header')
@endsection

@section('content')

  {{-- Sección de filtros --}}
  <section class="custom-container my-3">
    @include('components.filters')
  </section>

  {{-- Sección de cards de inmuebles --}}
  <section class="custom-container my-5">
    @include('components.card_inmueble', [
      'link' => '/inmueble',
      'image' => 'images/house_1.webp',
      'user' => 'Remax',
      'type' => 'Alquiler',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 1200,
      'exchange' => 3.7,
      'address' => 'Av. Ensenada 563',
      'district' => 'Surquillo',
      'department' => 'Lima',
      'area' => 600,
      'bedrooms' => 2,
      'bathrooms' => 1,
      'description' => 'Se alquila exclusivo departamento en perfecto estado (como nuevo), con espectacular vista al parque Mariscal Castilla y a la ciudad, completamente AMOBLADO, no se acepta mascota, cuenta con vista externa desde todos los ambientes tiene siguiente distribución: Sala-comedor con salida ha amplio balcón con mampara de aluminio con muy buenos acabados con vista al parque, luz indirecta, 3 dormitorios amplios todos con closet, el principal con cama king con veladores en perfecto estado, salida a pequeño balcon con walkin closet, los otros dos domitorios con vista externa con cama, veladores y escritorio, amplia sala de estar con espacio para mueble de escritorio y sofa. Cuenta con 2.5 baños uno de ellos incorporado al dormitorio principal con muy bueno acabados con tableros de marmol, cocina con espacio para refrigeradora de dos cuerpos, tablero de granito y reposteros de melamine con encimera y horno empotrado, area de servicio completa: amplia lavanderia con lavaseca, super ventilado y cuarto y baño de servicio. Todos los ambientes ventilados e iluminados pisos laminados en perfecto estado, incluye 2 estacionamientos paralelos en sotano 1 y 2 en edificio con seguridad 24 horas los 7 dias de la semana, areas comunes en perfecto estado como ( piscina con espectacular vista, gym,area de parrilla, terraza y sala de usos multiples en el ultimo piso) y en el primer piso (salon para juego de niños).',
      'like' => false,
    ])

    @include('components.card_inmueble', [
      'link' => '/inmueble',
      'image' => 'images/house_2.webp',
      'user' => 'Inmobiliaria García',
      'type' => 'Venta',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 1244000,
      'exchange' => 3.7,
      'address' => 'Av. Sanchez Cerro 1453',
      'district' => 'Lince',
      'department' => 'Lima',
      'area' => 200,
      'bedrooms' => 2,
      'bathrooms' => 1,
      'description' => 'Se alquila exclusivo departamento en perfecto estado (como nuevo), con espectacular vista al parque Mariscal Castilla y a la ciudad, completamente AMOBLADO, no se acepta mascota, cuenta con vista externa desde todos los ambientes tiene siguiente distribución: Sala-comedor con salida ha amplio balcón con mampara de aluminio con muy buenos acabados con vista al parque, luz indirecta, 3 dormitorios amplios todos con closet, el principal con cama king con veladores en perfecto estado, salida a pequeño balcon con walkin closet, los otros dos domitorios con vista externa con cama, veladores y escritorio, amplia sala de estar con espacio para mueble de escritorio y sofa. Cuenta con 2.5 baños uno de ellos incorporado al dormitorio principal con muy bueno acabados con tableros de marmol, cocina con espacio para refrigeradora de dos cuerpos, tablero de granito y reposteros de melamine con encimera y horno empotrado, area de servicio completa: amplia lavanderia con lavaseca, super ventilado y cuarto y baño de servicio. Todos los ambientes ventilados e iluminados pisos laminados en perfecto estado, incluye 2 estacionamientos paralelos en sotano 1 y 2 en edificio con seguridad 24 horas los 7 dias de la semana, areas comunes en perfecto estado como ( piscina con espectacular vista, gym,area de parrilla, terraza y sala de usos multiples en el ultimo piso) y en el primer piso (salon para juego de niños).',
      'like' => false,
    ])

    @include('components.card_inmueble', [
      'link' => '/inmueble',
      'image' => 'images/house_3.webp',
      'user' => 'Inmobiliaria Pérez',
      'type' => 'Venta',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 2100000,
      'exchange' => 3.7,
      'address' => 'Calle Las Flores 234',
      'district' => 'Lince',
      'department' => 'Lima',
      'area' => 600,
      'bedrooms' => 4,
      'bathrooms' => 2,
      'description' => 'Se alquila exclusivo departamento en perfecto estado (como nuevo), con espectacular vista al parque Mariscal Castilla y a la ciudad, completamente AMOBLADO, no se acepta mascota, cuenta con vista externa desde todos los ambientes tiene siguiente distribución: Sala-comedor con salida ha amplio balcón con mampara de aluminio con muy buenos acabados con vista al parque, luz indirecta, 3 dormitorios amplios todos con closet, el principal con cama king con veladores en perfecto estado, salida a pequeño balcon con walkin closet, los otros dos domitorios con vista externa con cama, veladores y escritorio, amplia sala de estar con espacio para mueble de escritorio y sofa. Cuenta con 2.5 baños uno de ellos incorporado al dormitorio principal con muy bueno acabados con tableros de marmol, cocina con espacio para refrigeradora de dos cuerpos, tablero de granito y reposteros de melamine con encimera y horno empotrado, area de servicio completa: amplia lavanderia con lavaseca, super ventilado y cuarto y baño de servicio. Todos los ambientes ventilados e iluminados pisos laminados en perfecto estado, incluye 2 estacionamientos paralelos en sotano 1 y 2 en edificio con seguridad 24 horas los 7 dias de la semana, areas comunes en perfecto estado como ( piscina con espectacular vista, gym,area de parrilla, terraza y sala de usos multiples en el ultimo piso) y en el primer piso (salon para juego de niños).',
      'like' => false,
    ])


  </section>

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    <script src="{{ asset('js/scripts/inmuebles.js') }}"></script>
@endpush