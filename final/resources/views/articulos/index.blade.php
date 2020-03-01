@extends('plantillas.plantilla')
@section('titulo')
Articulos
@endsection
@section('cabecera')
Lista de Articulos
@endsection
@section('contenido')
@if($texto=Session::get('mensaje'))
<p class="alert alert-success my-3">{{$texto}}</p>
@endif
<div class="container">
    <a href="{{route('articulos.create')}}" class="btn btn-success mb-3">Crear Articulo</a>
    <form name="search" method="get" action="{{route('articulos.index')}}" class="form-inline float-right">
      <i class="fa fa-search fa-2x ml-2 mr-2" aria-hidden="true"></i>
      <select name='categoria_id' class='form-control mr-2' onchange="this.form.submit()">
        <option value='%'>Todos</option>
        @foreach($categorias as $categoria)
          @if($categoria->id==$request->categoria_id)
      <option selected value="{{$categoria->id}}">{{$categoria->nombre}}</option>
          
          @else
          <option  value="{{$categoria->id}}">{{$categoria->nombre}}</option>
          @endif
        @endforeach
      </select>
      <input type="submit" value="Buscar" class="btn btn-info ml-2">
    
    </form>
</div>

<table class="table table-striped table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($articulos as $articulo)
    <tr>
      <th scope="row" class="align-middle">
      <a href="{{route('articulos.show', $articulo)}}" class="btn btn-info fa fa-info-circle fa-lg"></a>
      </th>
  <td class="align-middle">{{$articulo->nombre}}</td>
  <td class="align-middle">{{$articulo->precio}}</td>
  <td>
      <img src="{{asset($articulo->foto)}}" width="90px" height='90px' class="rounded-circle">
  </td>

  <td class="align-middle" style="white-space: nowrap">
  <form name="borrar" method='post' action='{{route('articulos.destroy', $articulo)}}'>
    @csrf
    @method('DELETE')
    <a href='{{route('articulos.edit', $articulo)}}' class="btn btn-warning fa fa-edit fa-lg"></a>
    <button type='submit' class="btn btn-danger fa fa-trash fa-lg" onclick="return confirm('¿Deseas borrarlo?')">
      </button>
  </form>
  </td>
    </tr>
   @endforeach
  </tbody>
  </table>
  
{{$articulos->links()}}
<div class="text-center">
<a href="{{route('home')}}" class="btn btn-dark fa fa-home fa-2x"></a>
</div>
@endsection