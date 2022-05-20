<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <title>Record</title>
	<style>
		.a-check {color:#999}
		.a-check:hover {color:#CCC}
	</style>
</head>
<body class="bg-lock-screen">
    <div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
				<div class="card-body p-md-5 text-center">
					<!-- <h2 class="text-white">10:53 AM</h2>
					<h5 class="text-white">Tuesday, January 14, 2021</h5> -->
					<div class="">
						<!-- <img src="assets/images/icons/user.png" class="mt-5" width="120" alt="" /> -->
						<img src="{{ asset('img/record-logo.png') }}" class="mt-5x" alt="">
					</div>
					<p class="mt-2x mb-5" style="font:11px Verdana; letter-spacing:2px; color:#FFFFFF77">Encuestas online</p>
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-floating my-3">
							<input type="text" class="form-control" id="x-1" name="email" placeholder="" value="{{ old('email') }}" autocomplete="off" autofocus>
							<label for="x-1">Usuario:</label>
						</div>
						<div class="form-floating my-3">
							<input type="password" class="form-control" id="x-2" name="password" placeholder="">
							<label for="x-2">Contraseña:</label>
						</div>
						<div class="d-grid">
							<button type="submit" class="btn btn-primary bg-gradient">Login</button>
						</div>
					</form>
					@if (session('status'))
					<div class="mb-4 font-medium text-sm text-green-600">
						{{ session('status') }}
					</div>
					@endif
					<div class="mt-3">
						<a href="{{ route('panel') }}" class="a-check"><i class='bx bx-link-external'></i> Ingresar a la sala de encuestas directamente</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />

    <link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Syndron - Bootstrap5 Admin Template</title>
</head> --}}
