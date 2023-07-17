@extends('layouts.base')
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Proceso de asignación</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <h5 class="mb-0">PROCESO DE ASIGNACIÓN</h5>
        <hr>
        <extra-asignacion mimetic="{{ route('mimetic') }}"></extra-asignacion>
    </div>
</div>
@endsection