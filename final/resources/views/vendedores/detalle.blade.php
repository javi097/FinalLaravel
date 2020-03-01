@extends('plantillas.plantilla')
@section('titulo')
    Detalle Vendedor
@endsection
@section('cabecera')
    Detalles Vendedores <i><b>{{($vendedore->nombre)}}</b></i>

@endsection
@section('contenido')
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 48rem;">
        <div class="card-header text-center"><b>ID: {{($vendedore->id)}}</b></div>
        <div class="card-body" style="font-size: 1.1em">
            <h5 class="card-title text-center">{{($vendedore->nombre)}}</h5>
            <p class="card-text">
            <div class="float-right"><img src="{{asset($vendedore->foto)}}" width="160px" heght="160px" class="rounded-circle"></div>
            <p><b>Nombre:</b> {{$vendedore->nombre}}</p>
            <p><b>Apellidos:</b> {{$vendedore->apellidos}}</p>
            </p>
        <div class="container">
            <a href="{{route('vendedores.index')}}" class="float-left mt-5 btn btn-success">Volver</a>
        </div>
        </div>
    </div>
@endsection
