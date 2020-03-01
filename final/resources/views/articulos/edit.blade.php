@extends('plantillas.plantilla')
@section('titulo')
Editar Articulo
@endsection
@section('cabecera')
Editar Articulo
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="c" method='POST' action="{{route('articulos.update',$articulo)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-row">
      <div class="col">
      <input type="text" class="form-control" value="{{$articulo->detalle}}" placeholder='Detalle' name='detalle' required>
      </div>
    </div>
    <div class="form-row mt-3">
        <div class="col">
            <input type="text" class="form-control" value="{{$articulo->nombre}}" placeholder='Nombre' name='nombre' required>
            </div>
            <div class="col">
                <input type="text" class="form-control" value="{{$articulo->precio}}" placeholder='Precio'name='precio' required>
                </div>
      <div class="form-group">
        <div class="col">
        <img src="{{asset($articulo->foto)}}" width="50px" height="50px" class="rounded-circle mr-4">
            <b>Imagen:</b>&nbsp;<input type='file' name='foto' accept="image/*">
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Guardar' class='btn btn-success mr-3'>
            <a href={{route('articulos.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>

  </form>
@endsection