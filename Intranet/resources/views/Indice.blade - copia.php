@extends('layouts.app')
@section('content')
@php
    $imagenes = App\Banner::orderBy('created_at', 'DESC')->get();
    $imagenes_ti = App\Banner_Ti::get();
    $festejados = total_empleados_cumple('Coleccion');
    $trayectoria = total_empleados_trayectoria();
    $conteo =  total_empleados_mes('Conteo');
    $recordatorios = recordatorios();
    $dias_sin_incidentes = dias_sin_incidentes();
    $record = record_sin_incidentes();
    $avisos = avisos();
    $i = 1;
@endphp
@include('flash::message')
@include('layouts.errors')
@if($recordatorios->isNotEmpty())
  <div class="callout callout-warning p-2">
  @foreach($recordatorios as $recordatorio)
    <p>{!! $recordatorio->Text !!}</p>
    @if($recordatorio->By != NULL)
    <small>- {{ $recordatorio->By }}</small>
    @endif
  @endforeach
  </div> 
@endif
  <img src="{{ asset('img/Navidad/cabezera.png') }}" class="img-fluid">
  <div id="carouselExampleFade" class="carousel slide carousel-fade shadow" data-ride="carousel">
    <div class="carousel-inner">
      @foreach($imagenes as $imagen)
        @if($i)
          <div class="carousel-item active">
            <img src="{{ asset('img/Banner/'.$imagen->Name_file) }}" class="d-block w-100" alt="...">
          </div>
          @php
              $i = 0;
          @endphp
        @else
          <div class="carousel-item">
            <img src="{{ asset('img/Banner/'.$imagen->Name_file) }}" class="d-block w-100" alt="...">
          </div>
        @endif
      @endforeach 
    </div>
  </div>
  <br>
  <div class="row ">
    <div class="col-md-4 col-sm-6 col-12">
      <a data-toggle="modal" data-target="#Permiso_Salida" style="cursor: pointer;">
        <div class="info-box bg-gradient-danger shadow">
            <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Permiso de Salida</h5></span>
            </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 col-sm-6 col-12">
      <a data-toggle="modal" data-target="#Solicitud_Vacaciones" style="cursor: pointer;">
        <div class="info-box bg-info  shadow">
            <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Solicitud de Vacaciones</h5></span>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
      <a href="{{ route('Calendario.index') }}" style="cursor: pointer;">
        <div class="info-box bg-gradient-warning shadow">
            <span class="info-box-icon"><i class="fa fa-calendar-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Sala de Juntas</h5></span>
            </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card bg-navidad-seccion shadow">
        <div class="card-header bg-gradient-ligth"style="text-align: center;">
          <strong>Cumpleañeros de {{ mes_espanol(date('m')) }} </strong> <i class="fas fa-birthday-cake"></i>
        </div>
        <div class="card-body p-0 "><br>
          <div class="row justify-content-center">
           @foreach($festejados as $festejado)
              @php
                $date = date_create($festejado->Birthdate);
                $empleado = App\Empleado_rrhh::whereSlug($festejado->Slug)->firstOrFail();
                $puesto =  $empleado->Puesto->last(); 
                $departamento = $puesto->Departamento;
              @endphp
              <div class="col-sm-3 col-4 p-2" style="text-align: center;">
                @php
                $hoy=date_create(date("Y-m-d"));
                @endphp
                @if(date_format($date, 'd') == date_format($hoy, 'd'))
                <span style="color: #0055BF"><strong>¡ Felicidades !</strong></span>
                <img src="http://10.0.0.8/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" class="rounded-circle shadow" style="width: 70px;">
                <a class="users-list-name " style="color: #0055BF"><strong>{{ nombre($festejado, 'Mostrar')}}</strong></a>
                <span class="users-list-date" style="color: #0055BF"><strong>{{ date_format($date, 'd').'.'.date_format($date, 'm') }}</strong></span>
                @else
                <img src="http://10.0.0.8/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" class="rounded-circle" style="width: 50px;">
                <a class="users-list-name ">{{ nombre($festejado, 'Mostrar')}}</a>
                <span class="users-list-date">{{ date_format($date, 'd').'.'.date_format($date, 'm') }}</span>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <div class="card-footer p-0">
          <img src="{{ asset('img/Navidad/cumple.jpg') }}" class="img-fluid m-0 p-0 rounded-bottom">
        </div>
      </div>

      <div class="card bg-navidad-seccion shadow">
        <div class="card-header border-0 bg-gradient-warning" style="text-align: center;">
          <i class="fas fa-star"></i> <strong>Trayectoria {{ mes_espanol(date('m')) }}</strong><i class="fas fa-star"></i>
        </div>
        <div class="card-body table-responsive p-0" style="max-height: 300px;">
          <table class="table table-striped table-valign-middle table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th colspan="2" style="text-align: center;">Empleado</th>
                <th>Ingreso</th>
                <th>Antigüedad</th>
              </tr>
            </thead>
            <tbody>
              @foreach($trayectoria as $empleado)
              @if($empleado->id != 1 && $empleado->id != 2)
              <tr>
                <td>
                  <img src="http://10.0.0.8/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" class="img-circle img-size-32 mr-2">
                </td>
                <td>{{ nombre($empleado, 'Mostrar')}}</td>
                <td>{{ Formato($empleado->High_date) }}</td>
                <td>{{ years($empleado->High_date) }}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer p-0">
          <img src="{{ asset('img/Navidad/trayectoria.jpg') }}" class="img-fluid m-0 p-0 rounded-bottom">
        </div>
      </div>

    </div>
    <div class="col-lg-6">
      @if($conteo > 0)
      <div class="card bg-navidad-seccion shadow">
        <div class="card-header p-0">
          <img src="{{ asset('img/banne6.jpg') }}" class="img-fluid m-0 p-0 rounded-top">
        </div>
        <div class="card-body">  
          @php
            $empleados =  total_empleados_mes('Coleccion'); 
          @endphp
          <div class="row justify-content-center">
            @foreach($empleados as $empleado)
              @php 
              $empleado = App\Empleado_rrhh::whereSlug($empleado->Slug)->firstOrFail();
              $puesto =  $empleado->Puesto->last(); 
              $departamento = $puesto->Departamento;
              @endphp
              <div class="col-sm-3 col-4 p-2" style="text-align: center;">
                <img src="http://10.0.0.8/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" style="width: 60px;">
                <a class="users-list-name" href="#">{{ nombre($empleado, 'Mostrar')}}</a>
                <span class="users-list-date">{{ $departamento->Departament_ES }} | {{ $puesto->Position_ES }}</span>
              </div>
            @endforeach
          </div>         
        </div>
      </div>
      @endif

      <div class="row d-flex align-items-stretch">
        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box shadow" >
            <span class="info-box-icon bg-success"><i class="fa fa-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Récord  Sin accidentes</span>
              <span>{{ $record['dias'].' días' }}</span><br>
              <small>{{ $record['texto'] }}</small>
            </div>
          </div>
        </div> 
        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box shadow">
            <span class="info-box-icon bg-warning"><i class="fa fa-exclamation-triangle"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Días Sin Accidentes</span>
              <span>{!! $dias_sin_incidentes !!}</span>
            </div>
          </div>
        </div>
      </div>

      <div id="carouselTi" class="carousel slide carousel-fade shadow" data-ride="carousel">
        <div class="carousel-inner">
          @php
            $i = 1;
          @endphp
          @foreach($imagenes_ti as $imagen_ti)
            @if($i)
              <div class="carousel-item active">
                <img src="{{ asset('img/Banner_Ti/'.$imagen_ti->Name_file) }}" class="d-block w-100" alt="...">
              </div>
              @php
                  $i = 0;
              @endphp
            @else
              <div class="carousel-item">
                <img src="{{ asset('img/Banner_Ti/'.$imagen_ti->Name_file) }}" class="d-block w-100" alt="...">
              </div>
            @endif
          @endforeach 
        </div>
      </div>
      <br>

      <div class="card bg-navidad-seccion shadow">
        <div class="card-header bg-gradient-indigo" style="text-align: center;">
          <i class="fas fa-bullhorn"></i> <strong>Noticias, Avisos</strong>
        </div>
        <div class="card-body" >
          @foreach($avisos->take(3) as $aviso)
          <div class="media">
            <img src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image) }}" class="rounded align-self-center mr-3" style="width: 25%;">
            <div class="media-body">
              <h5 class="mt-0">{{ $aviso->Name }}</h5>
              <p>{!! reducir_descripcion(strip_tags($aviso->Description)) !!}</p>
              <a href="{{ route('Aviso.ver', $aviso->Slug) }}">Ver más</a>
            </div>
          </div>

          @endforeach
        </div>
        <div class="card-footer" style="text-align:center;">
          <a href="{{ route('Aviso.avisos') }}">Ver todo</a>
        </div>
      </div>

    </div>
  </div>
  <div class="text-center">
    <img src="{{ asset("img/Navidad/feliz_navidad.png") }}" class="img-fluid">
  </div>


<div class="modal fade" id="Permiso_Salida">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Permiso de Salida</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'salida', 'method' => 'POST']) !!}
          <div class="row">
            <div class="col-md-6">
              {!!  Form::label('Nombre', 'Nombre:') !!}
              {!!  Form::text('Nombre', nombre(auth()->user()->Empleado_rrhh, 'Completo'), ['class' => 'form form-control', 'readOnly']) !!}
              {!!  Form::hidden('id', auth()->user()->Empleado_rrhh->id, []) !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('fecha', 'Nómina:') !!}
              {!!  Form::text('Nomina', auth()->user()->Empleado_rrhh->Code, ['class' => 'form form-control', 'readOnly']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              {!! Form::label('fecha', 'Departamento:') !!}
              {!!  Form::text('Departamento', departamento(auth()->user()->Empleado_rrhh), ['class' => 'form form-control', 'readOnly']) !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('Horario', 'Horario Laboral:') !!}
              {!! Form::select('working_hours', horario_laboral(), null, ['class' => 'form form-control', 'required']) !!}
            </div>
          </div>
          <br>       
          <div class="checkbox" style="text-align: center;">
            <div class="row">
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'Con goce de sueldo') !!}
                {!! Form::radio('enjoy_salary', '1', false, array('required')) !!}
              </div>
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'Sin goce de sueldo') !!}
                {!! Form::radio('enjoy_salary', '0', false, array('required')) !!}
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-4">
              {!! Form::label('fecha', 'Fecha:') !!}
              {!! Form::date('date', null, ['class' => 'form form-control', 'required']) !!}
            </div>
            <div class="col-md-4">
              {!! Form::label('fecha', 'Hora de Salida:') !!}
              {!! Form::select('departure_time', hora_de_salida('Salida'), null, ['class' => 'form form-control', 'required']) !!}
            </div>
            <div class="col-md-4">
              {!! Form::label('fecha', 'Hora de regreso:') !!}
              {!! Form::select('return_time', hora_de_salida('Regreso'), null, ['class' => 'form form-control', 'required']) !!}
            </div>
          </div>
          {!!  Form::label('Motivo', 'Motivo:') !!}
          {!!  Form::text('reason', null, [ 'class' => 'form form-control', 'autocomplete' => 'off', 'required']) !!} 
          <br>
          En caso de ser con <strong>Goce de sueldo</strong> se <strong>Pagara</strong> con:<br>
          <div class="checkbox" style="text-align: center;">
            <div class="row">
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'Tiempo X Tiempo') !!}
                {!! Form::radio('way_to_pay', 'tiempoxtiempo', false, array('required')) !!}
              </div>
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'N/A') !!}
                {!! Form::radio('way_to_pay', 'n/a', false, array('required')) !!}
              </div>
            </div>
          </div>
          <div class="modal-footer">
              {!!  Form::submit('Generar Permiso', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Solicitud_Vacaciones">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Solicitud de Vacaciones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'solicitud_vacaciones', 'method' => 'POST']) !!}
          <div class="row">
            <div class="col">
              {!! Form::label('fecha', 'Fecha:') !!}
              {!! Form::date('date', date('Y-m-d'), ['class' => 'form form-control form-control-sm', 'required']) !!}
            </div> 
            <div class="col">
              {!! Form::label('fecha', 'Nómina:') !!}
              {!!  Form::text('Nomina', auth()->user()->Empleado_rrhh->Code, ['class' => 'form form-control form-control-sm', 'readOnly']) !!}
            </div>           
          </div>
          <div class="row">
            <div class="col">
              {!!  Form::label('Nombre', 'Nombre:') !!}
              {!!  Form::text('Nombre', nombre(auth()->user()->Empleado_rrhh, 'Completo'), ['class' => 'form form-control form-control-sm', 'readOnly']) !!}
              {!!  Form::hidden('id', auth()->user()->Empleado_rrhh->id, []) !!}
              
              {!!  Form::hidden('fecha_ingreso', auth()->user()->Empleado_rrhh->Contrataciones->last()->High_date, []) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              {!! Form::label('fecha', 'Departamento:') !!}
              {!!  Form::text('Departamento', departamento(auth()->user()->Empleado_rrhh), ['class' => 'form form-control form-control-sm', 'readOnly']) !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('Ingreso', 'Fecha de Ingreso:') !!}
              {!! Form::date('ingreso', date('Y-m-d'), ['class' => 'form form-control form-control-sm', 'required']) !!}
            </div>
          </div>
          <br>       
          <div class="checkbox" style="text-align: center;">
            <div class="row">
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'Solicitud de Vacaciones') !!}
                {!! Form::radio('permiso', '1', false, array('required', 'id' => 'vac')) !!}
              </div>
              <div class="col-sm-6">
                {!! Form::label('sueldo', 'Permiso Especial') !!}
                {!! Form::radio('permiso', '0', false, array('required', 'id' => 'per')) !!}
              </div>
            </div>
          </div>
          <br>
          <div id="Vacaciones" style="display: none;">
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Días disponibles periodos anteriores:') !!}
                {!!  Form::number('saldo_anterior', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Días disponibles periodo actual:') !!}
                {!!  Form::number('saldo_actual', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Total de días pendientes por disfrutar:') !!}
                {!!  Form::number('suma_periodos', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Días de vacaciones a disfrutar:') !!}
                {!!  Form::number('dias_disfrutar', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha inicio de vacaciones:') !!}
                {!!  Form::date('fecha_inicio', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha de termino vacaciones:') !!}
                {!!  Form::date('fecha_fin', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha regreso laboral:') !!}
                {!!  Form::date('fecha_regreso', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Saldo restante vacaciones:') !!}
                {!!  Form::number('saldo_restante', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
          </div>
          <div id="Especial" style="display: none;">
            <div class="checkbox" style="text-align: center;">
              <div class="row">
                <div class="col-sm-4">
                  {!! Form::label('sueldo', 'Matrimonio') !!}
                  {!! Form::radio('motivo', 'Matrimonio', false) !!}
                </div>
                <div class="col-sm-4">
                  {!! Form::label('sueldo', 'Nacimiento de hijo') !!}
                  {!! Form::radio('motivo', 'Nacimiento', false) !!}
                </div>
                <div class="col-sm-4">
                  {!! Form::label('sueldo', 'Fallecimiento de familiar') !!}
                  {!! Form::radio('motivo', 'Fallecimiento', false) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha a partir del:') !!}
                {!!  Form::date('fecha_inicio_e', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha de regreso laboral:') !!}
               {!!  Form::date('fecha_fin_e', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
              {!!  Form::submit('Generar Formato', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
  $("#vac").click(function(e){
    $("#Vacaciones").css("display", "block");
    $("#Especial").css("display", "none");
    $("input[name='fecha_inicio_e']").val('');
    $("input[name='fecha_fin_e']").val('');
    $("input[name='motivo']").prop( "checked", false);
  });
  $("#per").click(function(e){
    $("#Vacaciones").css("display", "none");
    $("#Especial").css("display", "block");
    $("input[name='saldo_anterior']").val('');
    $("input[name='saldo_actual']").val('');
    $("input[name='suma_periodos']").val('');
    $("input[name='dias_disfrutar']").val('');
    $("input[name='fecha_inicio']").val('');
    $("input[name='fecha_fin']").val('');
    $("input[name='fecha_regreso']").val('');
    $("input[name='saldo_restante']").val('');
  });
</script>
@endsection