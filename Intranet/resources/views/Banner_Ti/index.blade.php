@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Gestor del Banner Ti')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="row justify-content-center">
  @can('Banner_Ti.create')
  <div class="col-lg-4 col-md-5">
    <div class="card">
      <div class="card-header">
        Subir imágenes
      </div>
      <div class="card-body" style="text-align: center;">
        {!! Form::open(['route' => 'Banner_Ti.store', 'method' => 'POST', 'files' => true]) !!}
        <p>
          Resolución de imágenes: <strong>960px x 720px</strong>
        </p>
         
        {!!  Form::File('Name_file[]', ['id' => 'imagen', 'accept' => '.jpeg, .jpg, .png', 'class' => 'input-file', 'multiple', 'required']) !!}
      </div>
      <div class="card-footer">
        {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  @endcan
  <div class="col-lg-8 col-md-7">
    <div class="card ">
      <div class="card-header">
        <h3 class="card-title">Imágenes activas</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped">
          <thead>
            <tr >
              <th style="text-align: center;">Imagen</th>
              <th style="text-align: center;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($imagenes as $imagen)
              <tr>
                <td>
                  <img src="{{ asset('img/Banner_Ti/'.$imagen->Name_file) }}" class="img-fluid" width="30%">
                </td>
                <td style="text-align: center; vertical-align: middle;">
                  @can('Banner_Ti.destroy')
                   <a href="{{ route('Banner_Ti.destroy', $imagen->id) }}">
                      <button class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Eliminar imagen" onclick="return confirm('¿Seguro de eliminar la imagen?')"><i class="fa fa-trash"></i></button>
                  </a> 
                  @endcan
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
    
</div>
@endsection