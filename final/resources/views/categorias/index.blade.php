@extends('plantillas.plantilla')
@section('titulo')
Categorias
@endsection
@section('cabecera')
Lista de Categorias
@endsection
@section('contenido')
@if($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>
@endif
<div class="container">
    <a href="{{route('categorias.create')}}" class="btn btn-success mb-3">Crear Categoria</a>
</div>

<table class="table table-striped table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
    <tr>
      <th scope="row" class="align-middle">
      <a href="{{route('categorias.show', $categoria)}}" class="btn btn-info fa fa-info-circle fa-lg"></a>
      </th>
  <td class="align-middle">{{$categoria->nombre}}</td>
 
  <td class="align-middle" style="white-space: nowrap">
  <form name="borrar" method='post' action='{{route('categorias.destroy', $categoria)}}'>
    @csrf
    @method('DELETE')
    <a href='{{route('categorias.edit', $categoria)}}' class="btn btn-warning fa fa-edit fa-lg"></a>
    <button type='submit' class="btn btn-danger fa fa-trash fa-lg" onclick="return confirm('¿Deseas borrarlo?')">
      </button>
  </form>
  </td>
    </tr>
   @endforeach
  </tbody>
  </table>
{{$categorias->links()}}
<div class="text-center">
  <a href="{{route('home')}}" class="btn btn-dark fa fa-home fa-2x"></a>
  </div>
@endsection
