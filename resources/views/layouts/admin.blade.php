<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!--begin::Head-->
	<head><base href=""/>
		<title>{{ env('APP_NAME') }}</title>
		<meta charset="utf-8" />
		<!-- [Favicon] icon -->
		<link rel="icon" href="{{ asset('/assets/images/favicon.svg') }}" type="image/x-icon"> <!-- [Google Font] Family -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    	<link rel="stylesheet" href="{{ asset('/assets/css/plugins/dataTables.bootstrap5.min.css') }}">
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
		<link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}" >
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
		@include('layouts.components.sidebar')
		@include('layouts.components.header')

		<!-- [ Main Content ] start -->
		<div class="pc-container">
			<div class="pc-content">
				<!-- [ breadcrumb ] start -->
				<div class="page-header">
					<div class="page-block">
					<div class="row align-items-center">
						<div class="col-md-12">
							<ul class="breadcrumb">
								@yield('breadcrumbs', '')
							</ul>
						</div>
						<div class="col-md-12">
							<div class="page-header-title d-flex align-items-center justify-content-between">
								<h2 class="m-b-10">
									@yield('Title', 'Dashboard')
								</h2>
								@yield('toolbar', '')
							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<!-- [ Main Content ] start -->
				<div class="row">
					@yield('content')
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->
		<footer class="pc-footer">
			<div class="footer-wrapper container-fluid">
			<div class="row">
				<div class="col-sm my-1">
				<p class="m-0">
				</p>
				</div>
				<div class="col-auto my-1">
				<ul class="list-inline footer-link mb-0">
				</ul>
				</div>
			</div>
			</div>
		</footer>

		<!-- [Page Specific JS] start -->
		<script src="{{ asset('/assets/js/plugins/apexcharts.min.js') }}"></script>
		<!-- [Page Specific JS] end -->
		<!-- Required Js -->
		<script src="{{ asset('/assets/js/plugins/popper.min.js') }}"></script>
		<script src="{{ asset('/assets/js/plugins/simplebar.min.js') }}"></script>
		<script src="{{ asset('/assets/js/plugins/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/assets/js/fonts/custom-font.js') }}"></script>
		<script src="{{ asset('/assets/js/pcoded.js') }}"></script>
		<script src="{{ asset('/assets/js/plugins/feather.min.js') }}"></script>
		<script src="{{ asset('/assets/js/plugins/choices.min.js') }}"></script>
		@yield('scripts', '')
	</body>
	<!--end::Body-->
</html>