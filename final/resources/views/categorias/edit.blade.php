@extends('plantillas.plantilla')
@section('titulo')
Editar Categoria
@endsection
@section('cabecera')
Editar Categoria
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
<form name="c" method='POST' action="{{route('categorias.update',$categoria)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col">
        <input type="text" class="form-control" value="{{$categoria->nombre}}" placeholder='Nombre' name='nombre' required>
    </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Guardar' class='btn btn-success mr-3'>
            <a href={{route('categorias.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>
  </form>
@endsection