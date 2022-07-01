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
            <li class="breadcrumb-item active" aria-current="page">Población asignada</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<comp-asignados mimetic="{{ route('mimetic') }}" user="{{ Auth::user()->id }}" pathpoll="{{ route('vue.form') }}"></comp-asignados>
@endsection