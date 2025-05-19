@extends('layouts.app')
@section('titulo', 'Módulos de Usuario')
@section('content')
{{--  
<h3>Sistemas</h3>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-2">
        <img src="{{ asset('img/rrhh.jpg') }}" class="img-fluid">
      </div>
      <div class="col-lg-9">
        <h5 class="card-title">Sistema de Recursos Humanos</h5>
        <p class="card-text">Crear, Edita, Elimina registros de empleados. Gestióna vacaciones y genera reportes.</p>
        <a href="#" class="btn btn-primary">Ir</a>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-2">
        <img src="{{ asset('img/rrhh.jpg') }}" class="img-fluid">
      </div>
      <div class="col-lg-9">
        <h5 class="card-title">Sistema de Inventario TI</h5>
        <p class="card-text">Gestiona equipos de computos, asigna y retira dispositivos al personal.</p>
        <a href="#" class="btn btn-primary">Ir</a>
      </div>
    </div>
  </div>
</div>
--}}
<hr>
<div class="row d-flex align-items-stretch">
  @can('Gestor_Archivo.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_archivos.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Material Coorporativo</h4>
            <!--<p class="card-text">Sube, Descarga, Elimina archivos estarandizados.</p>-->     
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('Gestor_Archivo.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Banner.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_imagenes.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Imagenes del Banner</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Banner.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Banner_Ti.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_imagenes.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Imagenes del Banner Ti</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Banner_Ti.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Galeria.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_galeria.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Galeria</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Galeria.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Aviso.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_avisos.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Avisos</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('Aviso.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Recordatorio.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_recordatorio.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Recordatorios y/o Frases</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Recordatorio.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Sin_Incidente.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_seguridad.png') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Seguridad e Higiene</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Sin_Incidente.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  @can('Usuarios.index')
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_usuarios.jpg') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Usuarios</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Usuarios.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
  @endcan
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('img/modulo_mantenimiento.png') }}" class="img-fluid">
          </div>
          <div class="col-lg-8">
            <h4 class="card-title">Ordenes de Mantenimiento</h4>
          </div>
        </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('Orden_Mantenimiento.index') }}" class="btn btn-primary btn-block btn-sm">Ir</a>
      </div>
    </div>
  </div>
</div>



@endsection
@section('javascript')
@endsection