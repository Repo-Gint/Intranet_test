@extends('layouts.app')
@section('content')
@php
  //$departamentos = App\Departamento_rrhh::get();
      //$empleados = App\Empleado_rrhh::orderBy('Names', 'ASC')->where('Active', 1)->get();
@endphp
@section('adicional')
{!! Form::open(['route' => 'EquipoGI.index', 'method' => 'GET']) !!}
  <h5>Buscador:</h5>
    {!!  Form::label('Nombre', 'Nombre: ', ['class' => 'col-form-label']) !!}
    {!!  Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    {!!  Form::label('departamento', 'Departamento: ', ['class' => 'col-form-label']) !!}
    {!!  Form::text('departament', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    <br>
  {!!  Form::submit('Actualizar', ['class' => 'btn btn-info btn-block btn-sm']); !!}
{!! Form::close() !!}
@endsection
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-search"></i> Buscar</a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="text-align: right;">
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Descargar Directorio
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="{{ route('directorio', 'Sin Mail') }}">Sin Email</a>
                <a class="dropdown-item" href="{{ route('directorio', 'Mail') }}">Con Email</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <div class="row d-flex align-items-stretch">
@foreach($empleados as $empleado)
@php
//$puesto = $empleado->Puesto->last();
//$departamento = $puesto->Departamento;
//$contacto = $empleado->Contactos;
@endphp
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">

    <div class="card card-outline bg-directorio" style="background-color: rgba(255,255,255, 0.2);">
      <div class="card-header  border-bottom-0" style="font-size: 14px;">
        <strong>{{ $empleado->Position_ES }}</strong>
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-8">
            <h2 class="lead"><b>{{ $empleado->Name }}</b></h2>
            <ul class="ml-3 mb-0 fa-ul">
              <li class="small">
                <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                <strong>{{ $empleado->Departament_ES }}</strong>
              </li>
              @if($empleado->Business_mail != null)
                <li class="small">
                  <span class="fa-li"><i class="fas fa-lg fa-envelope-open"></i></span>
                  <strong>{{ correo($empleado->Business_mail, "Mostrar") }}</strong>
                </li>
              @endif
              @if($empleado->Extension != null)
              <li class="small">
                <span class="fa-li"><i class="fas fa-lg fa-fax"></i></span>
                <strong>{{ $empleado->Extension }}</strong>
              </li>
              @endif
              @if($empleado->Business_phone != null)
              <li class="small">
                <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                <strong>{{ $empleado->Business_phone }}</strong>
              </li>
              @endif
            </ul>
          </div>
          <div class="col-4 text-center">
            <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <!--<div class="card-footer bg-gradient-primary">      
      </div>-->
    </div>
  </div>

@endforeach
</div>


@endsection
@section('javascript')
<script type="text/javascript">
  const txt = document.querySelector('#Txt_buscar');
  const btn = document.querySelector('#Btn_buscar');

  const filtrar = ()=>{
    console.log(txt.value);
  }
</script>
@endsection