@extends('plantillas.plantilla')
@section('titulo')
Crear Articulo
@endsection
@section('cabecera')
Crear Articulo
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
<form name="c" method='POST' action="{{route('articulos.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="col">
        <input type="text" class="form-control" placeholder="Nombre" name='nombre' required>
      </div>
    </div>
    <div class="form-row mt-3">
        <div class="col">
          <select name='categoria' class="form-control">
            <option selected>Electronica</option>
            <option>Bazar</option>
            <option>Hogar</option>
        </select>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Precio" name='precio' required>
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Stock" name='stock' required>
          </div>
      <div class="form-group">
        <div class="col">
            <b>Imagen:</b>&nbsp;<input type='file' name='foto' accept="image/*">
        </div>
      </div>
      <div class="form-row mt-3">
        <div class="col">
            <input type='submit' value='Guardar' class='btn btn-success mr-3'>
            <input type='reset' value='Limpiar' class='btn btn-warning mr-3'>
            <a href={{route('articulos.index')}} class='btn btn-info'>Volver</a>
        </div>
    </div>

  </form>
@endsection