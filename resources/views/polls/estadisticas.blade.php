@extends('layouts.base')
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('encuestas') }}">Encuestas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Estadísticas</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<cmp-estadisticas mimetic="{{ route('mimetic') }}" keydata="{{ $poll->id }}" pathitem="{{ route('poll.item.statistic') }}" bigtotal="{{ $total }}" poblacion="{{ $poblacion }}"></cmp-estadisticas>
@endsection

@section('logica')
<script>
    var fc = document.getElementById('ml-enc');
    if(fc != null && fc != undefined){
        fc.classList.add('mm-active');
    }
</script>
@endsection