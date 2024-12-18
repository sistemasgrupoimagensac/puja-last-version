<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="description" content="Servicio online de remates de inmuebles a nivel nacional - Grupo Imagen 2024"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-WNQLTLGR');
		</script>
			<!-- End Google Tag Manager -->
		
		<title>Pujainmobiliaria - @yield('title')</title>

		@vite(['resources/sass/app.scss'])

		@stack('styles')

		@stack('scripts-head')

	</head>

	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNQLTLGR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@yield('header')

		@yield('content')

		@yield('footer')

		@vite(['resources/js/app.js', 'resources/js/profile-user.js', 'resources/js/scripts/updatePlaceholdersRegister.js'])

		@stack('scripts')

	</body>

</html>