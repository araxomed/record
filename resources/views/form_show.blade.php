@extends('layouts.base')
@section('estilo')
<style>
    .colmin {width:1%; white-space: nowrap; text-align:center}
</style>
@endsection
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Banco de formularios</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <encuesta-show path="{{ route('vue.form') }}" keydata="{{ $data->id }}" display="preview"></encuesta-show>
    </div>
</div>
@endsection