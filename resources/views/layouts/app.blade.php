<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="description" content="Servicio online de remates de inmuebles a nivel nacional - Grupo Imagen 2024"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
		
		<meta property="og:title" content="Puja Inmobiliaria - Remates de Inmuebles en Perú">
		<meta property="og:description" content="Encuentra remates de inmuebles a nivel nacional con Puja Inmobiliaria.">
		<meta property="og:image" content="{{ url('images/home.jpg') }}">
		<meta property="og:url" content="{{ url('/') }}">
		<meta property="og:type" content="website">

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-TJ62TFV5');</script>
		<!-- End Google Tag Manager -->

		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y55C6PC8V3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'G-Y55C6PC8V3');
		</script>

		<!-- TikTok Pixel Code Start -->
		<script>
			!function (w, d, t) {
			w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
			var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
			;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
			ttq.load('CU3C43BC77UF7FM1HFEG');
			ttq.page();
			}(window, document, 'ttq');
		</script>
		<!-- TikTok Pixel Code End -->
		
		<title>Pujainmobiliaria - @yield('title')</title>

		@vite(['resources/sass/app.scss'])

		@stack('styles')

		@stack('scripts-head')

	</head>

	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJ62TFV5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@yield('header')

		@yield('content')

		@yield('footer')

		@vite(['resources/js/app.js', 'resources/js/profile-user.js', 'resources/js/scripts/updatePlaceholdersRegister.js'])

		@stack('scripts')

	</body>

</html>