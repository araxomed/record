@extends('layouts.base')
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('encuestas') }}">Encuestas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registros</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<lector-registro mimetic="{{ route('mimetic') }}" keydata="{{ $poll->id }}" pollname="{{ $poll->formulario }}" pathpoll="{{ route('vue.form') }}"></lector-registro>
@endsection
@section('logica')
<script>
    var fc = document.getElementById('ml-enc');
    if(fc != null && fc != undefined){
        fc.classList.add('mm-active');
    }
</script>
@endsection