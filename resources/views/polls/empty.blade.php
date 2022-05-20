@extends('layouts.base')
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Encuestas</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h3 class="mb-0 font-weight-bold">ERROR</h3>
            <a href="{{ $route_back }}" class="fs-3 text-secondary">
                <i class='bx bx-arrow-back'></i>
            </a>
        </div>
        <hr>
        <div class="mt-4 alert alert-danger py-2 border-1 border border-danger rounded-3" style="border-left-width:5px !important">
            <div class="d-flex align-items-center">
                <i class="bx bxs-error fs-1 me-2"></i>
                <div>
                    <div class="fw-bold">ADVERTENCIA:</div>
                    El recurso solicitado no existe en el sistema, consulte con el administrador del sitio.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('logica')
<script>
    // var fc = document.getElementById('ml-enc');
    // if(fc != null && fc != undefined){
    //     fc.classList.add('mm-active');
    // }
</script>
@endsection