<!DOCTYPE html>
<html lang="es" class="color-sidebar sidebarcolor4">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-extended.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
	<title>Record</title>
	<style>
		.btn-hover {border:1px solid transparent !important}
		.btn-hover:hover {border-color:#038DFE !important; color:#038DFE !important}
		@media print {
			.page-wrapper {margin: 0}
			.d-print-border-none {border: none !important; box-shadow: none !important}
		}
	</style>
	@yield('estilo')
</head>
<body>
	<!--wrapper-->
	<div class="wrapper" id="appRecord">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper d-print-none" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Record</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="menu-label d-none">Others</li>
				@if(Auth::user())
				@include('menus.' . Auth::user()->rol)
				@else
				@include('menus.basico')
				@endif
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header class="d-print-none">
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box d-none">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#"><i class='bx bx-search'></i></a>
							</li>
						</ul>
					</div>
					@if(Auth::user())
					<div class="user-box">
						<a class="d-flex align-items-center nav-link" href="#" role="button" aria-expanded="false">
							<img src="{{ asset('img/user_' . Auth::user()->rol . '.png') }}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{ Auth::user()->name }}</p>
								<p class="designattion mb-0">{{ Auth::user()->human_rol }}</p>
							</div>
						</a>
					</div>
					<div class="top-menu border-start border-end px-2">
						<a href="javascript:void(0)" onclick="endSesion(event)">
							<i class="bx bx-power-off fs-2"></i>
						</a>
					</div>
					@else
					<div class="user-box">
						<a class="d-flex align-items-center nav-link" href="#" role="button" aria-expanded="false">
							<img src="{{ asset('img/user_client.png') }}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Anónimo</p>
								<p class="designattion mb-0">Invitado</p>
							</div>
						</a>
					</div>
					<div class="top-menu border-start border-end px-2">
						<a href="{{ route('login') }}">
							<i class="bx bx-log-in-circle fs-2"></i>
						</a>
					</div>
					@endif
				</nav>
			</div>
			<form id="lockSesion" method="POST" action="{{ route('logout') }}">@csrf</form>
		</header>
		<div class="page-wrapper">
			<div class="page-content">
                @yield('contenido')
			</div>
		</div>
		<!--start overlay--><div class="overlay toggle-icon"></div><!--end overlay-->
		<!--Start Back To Top Button--><a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a><!--End Back To Top Button-->
		<footer class="page-footer d-print-none">
			<p class="mb-0">Copyright © 2022. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		var ruta = "{{ route('mimetic') }}";
        function endSesion(event){
			event.preventDefault();
            document.getElementById('lockSesion').submit();
        }
	</script>
	@yield('logica')
</body>
</html>