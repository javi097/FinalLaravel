@extends('plantillas.plantilla')
@section('titulo')
    Detalle Categoria
@endsection
@section('cabecera')
    Detalles Categorias <i><b>{{($categoria->nombre)}}</b></i>

@endsection
@section('contenido')
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 48rem;">
        <div class="card-header text-center"><b>ID: {{($categoria->id)}}</b></div>
        <div class="card-body" style="font-size: 1.1em">
            <h5 class="card-title text-center">{{($categoria->nombre)}}</h5>
            <p class="card-text">
            <p><b>Nombre:</b> {{$categoria->nombre}}</p>
            </p>
        <div class="container">
            <a href="{{route('categorias.index')}}" class="float-right btn btn-success">Volver</a>
        </div>
        </div>
    </div>
@endsection
