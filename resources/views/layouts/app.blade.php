<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Servicio online de remates de inmuebles a nivel nacional - Grupo Imagen 2024"/>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Pujainmobiliaria - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('styles')
</head>

<body>

  @yield('header')

  @yield('content')

  @yield('footer')

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>

</html>