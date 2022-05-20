@extends('layouts.base')
@section('estilo')
<style>
    .colmin {width:1%; white-space: nowrap; text-align:center}
    /* .prince:hover {border: 1px solid #0D6EFD !important} */
    .prince:hover {border: 1px solid #0D6EFD !important; background:#FAFAFA}
</style>
@endsection
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3 d-print-none">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel', $poll->numdoc) }}">Sala de encuestas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver encuesta</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100 d-print-border-none">
    <div class="card-body">
        <encuesta-show 
            display="read"
            path="{{ route('vue.form') }}"
            pathwrite="{{ route('vue.form.write') }}" 
            pathpanel="{{ route('panel', $poll->numdoc) }}"
            keydata="{{ $poll->id }}" 
            employee="{{ $poll->name }}" 
            cedula="{{ $poll->numdoc }}"></encuesta-show>
    </div>
</div>
@endsection
@section('logica')
<script>
    var fc = document.getElementById('ml-sala');
    if(fc != null && fc != undefined){
        fc.classList.add('mm-active');
    }
</script>
@endsection