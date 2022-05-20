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
            <li class="breadcrumb-item active" aria-current="page">Encuestas</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">ENCUESTAS</h5>
                <div class="text-secondary font-13">Listado de encuestas diseñadas</div>
            </div>
            <div class="font-22">
                <i class="bx bx-chevron-up-circle"></i>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th class="colmin px-4">No.</th>
                        <th>Formulario / Encuesta</th>
                        <th>Ärea</th>
                        <th class="colmin px-4">Estado</th>
                        <th class="colmin px-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $elm)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $elm->formulario }}</td>
                        <td>{{ $elm->tema->tema }}</td>
                        <td class="text-center px-5"><span class="badge bg-light-success text-dark rounded-pill border border-success px-3 pe-none">{{ ['draft' => 'Borrador', 'final' => 'Publicado', 'archived' => 'Archivado'][$elm->estado] }}</span></td>
                        <td class="text-center px-4">
                            <div class="d-flex order-actions justify-content-center">
                                <a href="{{ route('encuesta.fillable', $elm->id) }}" title="Diligenciamiento"><i class='bx bxs-edit'></i></a>
                                <a href="{{ route('encuesta.registro', $elm->id) }}" title="Registros" class="mx-3"><i class='bx bx-book-heart'></i></a>
                                <a href="{{ route('encuesta.dashboard', $elm->id) }}" title="Estadísticas"><i class='bx bxs-bar-chart-alt-2'></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection