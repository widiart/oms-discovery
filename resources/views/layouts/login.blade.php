<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!--begin::Head-->
	<head><base href=""/>
		<title>{{ env('APP_NAME') }}</title>
		<meta charset="utf-8" />
		<!-- [Favicon] icon -->
		<link rel="icon" href="{{ asset('/assets/images/favicon.svg') }}" type="image/x-icon"> <!-- [Google Font] Family -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
		<!-- [Tabler Icons] https://tablericons.com -->
		<link rel="stylesheet" href="{{ asset('/assets/fonts/tabler-icons.min.css') }}" >
		<!-- [Feather Icons] https://feathericons.com -->
		<link rel="stylesheet" href="{{ asset('/assets/fonts/feather.css') }}" >
		<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
		<link rel="stylesheet" href="{{ asset('/assets/fonts/fontawesome.css') }}" >
		<!-- [Material Icons] https://fonts.google.com/icons -->
		<link rel="stylesheet" href="{{ asset('/assets/fonts/material.css') }}" >
		<!-- [Template CSS Files] -->
		<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" id="main-style-link" >
		<link rel="stylesheet" href="{{ asset('/assets/css/style-preset.css') }}" >
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
		{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
	<!-- [ Pre-loader ] start -->
		<div class="loader-bg">
			<div class="loader-track">
			<div class="loader-fill"></div>
			</div>
		</div>
		<!-- [ Pre-loader ] End -->

		<div class="auth-main">
			@yield('content')
		</div>
		@yield('scripts', '')
	</body>
	<!--end::Body-->
</html>