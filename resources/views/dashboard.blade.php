<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <title>GeoTest - Dashboard</title>
</head>
<body>
    <div id="mainApp">
        <!-- <div class="d-flex bg-dark bg-gradient align-items-stretch" style="height:100vh !important"> -->
        <div class="row d-flex align-items-stretch m-0" style="height:100vh !important">
            <div class="col-sm-3 bg-dark bg-gradient p-0 border-end border-dark border-4">
                <div class="pt-4 pb-4" style="background:#FFFFFF09; border-bottom:1px solid #FFFFFF22">
                    <div class="text-center">
                        <i class="bi bi-person-bounding-box text-light fs-1"></i>
                    </div>
                    <div class="text-center text-light">
                        <h5 class="mb-0">{{ $user['name'] }}</h5>
                        <small>{{ $user['email'] }}</small>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('logout') }}" class="btn btn-success btn-sm mt-3">Cerrar sesión</a>
                    </div>
                </div>
                <listado ruta="{{ route('jobs') }}"></listado>
            </div><!-- End col left -->
            <div class="col-sm-9 bg-light p-0">
                <mapa zoom="3" pin="{{ asset('img/pin_01.png') }}" pin2="{{ asset('img/pin_02.png') }}"></mapa>
                <table-data ocultar></table-data>
                <grafico-torta 
                    etiquetas
                    leyenda="top"
                    radio="65"
                    efecto
                    ocultar></grafico-torta>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi_tT6MneCkFxjcSTT5zZnsgnyUzqWAdQ"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>