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
            <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Sala de encuestas</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <h5 class="mb-0">IDENTIFICACIÓN DEL ENCUESTADO</h5>
        <hr>
        <div class="mb-3">
            <label for="x-1" class="form-label">Documento de identificación:</label>
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" id="x-1" autocomplete="off" value="{{ $numdoc }}" onkeypress="tecla(event)" autofocus>
                <button type="button" class="btn btn-primary px-5" onclick="enviar()">Verificar</button>
            </div>
        </div>
        @if($status == 'failed')
        <div class="alert alert-warning py-2 border-1 border border-warning rounded-3" style="border-left-width:5px !important">
            <div class="d-flex align-items-center">
                <i class="bx bx-error fs-1 me-2"></i>
                <div>
                    <div class="fw-bold">Advertencia:</div>
                    El usuario con el número de identificación <b>{{ $numdoc }}</b> no tiene permiso para realizar encuestas, favor comunicarse con el administrador del sitio o el área de recurso humano.
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-primary py-2 border-1 border border-primary rounded-3" style="border-left-width:5px !important">
            <div class="d-flex align-items-center">
                <i class="bx bx-info-circle fs-1 me-2"></i>
                <div>
                    <div class="fw-bold">NOTA:</div>
                    Solo el personal autorizado por el área de Recurso Humano podrá realizar las encuestas registradas en el sistema.
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('logica')
<script>
    var fc = document.getElementById('ml-sala');
    if(fc != null && fc != undefined){
        fc.classList.add('mm-active');
    }

    var ruta = "{{ route('panel', '@') }}";
    var ipt = document.getElementById('x-1');

    function enviar(){
        var num = ipt.value.replace(/\s+/g, '');
        var path = ruta.replace('@', num);
        location.href = path;
    }

    function tecla(evt){
        if(evt.key === ' '){
            evt.preventDefault();
        }
        if(evt.keyCode == 13){
            console.log('Is Enter');
            enviar();
        }
    }
</script>
@endsection


@section('logica')
<script>
</script>
@endsection