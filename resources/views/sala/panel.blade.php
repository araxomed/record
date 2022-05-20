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
            <li class="breadcrumb-item active" aria-current="page">Sala de encuestas</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-sm-4 col-lg-3">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <h5 class="mb-0x">Información</h5>
                <div class="py-2 border-bottom">
                    <div class="font-13 text-secondary">Encuestado:</div>
                    <div class="font-14 fw-bold">{{ $person->name }}</div>
                </div>
                <div class="py-2 border-bottom">
                    <div class="font-13 text-secondary">Identificación:</div>
                    <div class="font-14 fw-bold">{{ $person->numdoc }}</div>
                </div>
                <div class="py-2">
                    <div class="text-center text-muted">Encuestas realizadas</div>
                    <div class="fs-1 text-center">
                        {{ $total }} de {{ count($forms) }}
                    </div>
                    <div class="progress mb-2">
                        <div class="progress-bar" style="width:{{ $percent }}%">{{ $percent }}%</div>
                    </div>
                </div>
                <div class="d-grid mt-3">
                    <a href="{{ route('panel') }}" class="btn btn-primary bg-gradient rounded-pill">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-left-arrow-alt"></i>
                            <div class="font-13">Atrás</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8 col-lg-9">
        @foreach($forms as $poll)
        <div class="card mb-3 py-2 pe-4 prince border">
            <div class="d-flex">
                <div>
                    <img src="{{ asset('img/poll-a.png') }}" alt="" class="img-fluidx" style="height:180px">
                </div>
                <div class="flex-fill pt-2">
                    <h5 class="fw-bold">{{ $poll->formulario }}</h5>
                    <p class="">{{ $poll->descripcion }}</p>
                    @if($poll->id_response)
                    <span class="badge rounded-pill bg-light-success border border-success py-2 px-3 text-success">Realizado</span>
                    @else
                    <span class="badge rounded-pill bg-light-danger border border-danger py-2 px-3 text-danger">Pendiente</span>
                    @endif
                    <hr>
                    @if($poll->id_response)
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('poll.show', [$poll->id, $person->numdoc]) }}" class="btn btn-success bg-gradient px-4 py-2" style="font:.9rem Arial; letter-spacing:1px">Ver encuesta</a>
                        <div class="text-muted"><i class="bx bx-calendar"></i> Fecha de registro: {{ $poll->created_at }}</div>
                    </div>
                    @else
                    <a href="{{ route('poll.show', [$poll->id, $person->numdoc]) }}" class="btn btn-primary bg-gradient px-4 py-2" style="font:.9rem Arial; letter-spacing:1px">Realizar encuesta</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
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