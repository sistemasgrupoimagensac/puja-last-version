<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="description" content="Servicio online de remates de inmuebles a nivel nacional - Grupo Imagen 2024"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
		
		<title>Pujainmobiliaria - @yield('title')</title>

		@vite(['resources/sass/app.scss'])

		@stack('styles')

		@stack('scripts-head')

	</head>

	<body>

		@yield('header')

		@yield('content')

		@yield('footer')

		@vite(['resources/js/app.js', 'resources/js/profile-user.js', 'resources/js/scripts/updatePlaceholdersRegister.js'])

		@stack('scripts')

	</body>

</html>