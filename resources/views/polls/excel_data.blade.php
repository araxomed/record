@extends('layouts.base_screen')
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('encuestas') }}">Encuestas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Resultados</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div style="line-height:.8rem">
                <h3 class="mb-0 font-weight-bold">{{ $poll->formulario }}</h3>
                <div style="font-family:Verdana; font-size:.75rem !important; letter-spacing:2px">Nombre de la encuesta</div>
            </div>
            <a href="{{ route('encuestas') }}" class="fs-3 text-secondary">
                <i class='bx bx-arrow-back'></i>
            </a>
        </div>
        <hr>
        <excel-data mimetic="{{ route('mimetic') }}" keydata="{{ $poll->id }}"></excel-data>
    </div>
</div>
@endsection
@section('logica')
<script>
    var fc = document.getElementById('ml-enc');
    if(fc != null && fc != undefined){
        fc.classList.add('mm-active');
    }
</script>
@endsection