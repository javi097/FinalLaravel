@extends('plantillas.plantilla')
@section('titulo')
Vendedores
@endsection
@section('cabecera')
Lista de Vendedores
@endsection
@section('contenido')
@if($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>
@endif
<div class="container">
    <a href="{{route('vendedores.create')}}" class="btn btn-success mb-3">Crear Vendedor</a>
</div>

<table class="table table-striped table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vendedores as $vendedor)
    <tr>
      <th scope="row" class="align-middle">
      <a href="{{route('vendedores.show', $vendedor)}}" class="btn btn-info fa fa-info-circle fa-lg"></a>
      </th>
  <td class="align-middle">{{$vendedor->nombre}}</td>
  <td class="align-middle">{{$vendedor->apellidos}}</td>
  <td>
      <img src="{{asset($vendedor->foto)}}" width="90px" height='90px' class="rounded-circle">
  </td>

  <td class="align-middle" style="white-space: nowrap">
  <form name="borrar" method='post' action='{{route('vendedores.destroy', $vendedor)}}'>
    @csrf
    @method('DELETE')
    <a href='{{route('vendedores.edit', $vendedor)}}' class="btn btn-warning fa fa-edit fa-lg"></a>
    <button type='submit' class="btn btn-danger fa fa-trash fa-lg" onclick="return confirm('¿Deseas borrarlo?')">
    </button>
  </form>
  </td>
    </tr>
   @endforeach
  </tbody>
  </table>
  
{{$vendedores->links()}}
<div class="text-center">
  <a href="{{route('home')}}" class="btn btn-dark fa fa-home fa-2x"></a>
</div>
@endsection