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
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel', $person->numdoc) }}">Sala de encuestas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Diligenciar encuesta</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <encuesta-show 
            display="write"
            path="{{ route('vue.form') }}"
            pathwrite="{{ route('vue.form.write') }}" 
            pathpanel="{{ route('panel', $person->numdoc) }}"
            keydata="{{ $form_id }}" 
            employee="{{ $person->name }}" 
            cedula="{{ $person->numdoc }}"></encuesta-show>
    </div>
</div>
@endsection