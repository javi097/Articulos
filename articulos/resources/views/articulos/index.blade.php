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
</div>
<table class="table table-striped table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Categoria</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($marcas as $marca)
      <tr>
        <th scope="row" class="align-middle">
        <a href="{{route('marcas.show', $marca)}}" class="btn btn-info">Detalles</a>
        </th>
    <td class="align-middle">{{$marca->nombre}}</td>
    <td>
        <img src="{{asset($marca->logo)}}" width="90px" height='90px' class="rounded-circle">
    </td>
    <td class="align-middle">{{$marca->pais}}</td>

    <td class="align-middle" style="white-space: nowrap">
    <form name="borrar" method='post' action='{{route('marcas.destroy', $marca)}}'>
      @csrf
      @method('DELETE')
      <a href='{{route('marcas.edit', $marca)}}' class="btn btn-warning">Editar</a>
      <button type='submit' class="btn btn-danger" onclick="return confirm('¿Borrar Coche?')">
        Borrar</button>
    </form>
    </td>
      </tr>
     @endforeach
    </tbody>
  </table>
  {{$marcas->appends(Request::except('page'))->links()}}
@endsection