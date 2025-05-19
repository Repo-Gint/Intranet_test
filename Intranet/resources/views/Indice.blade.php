
@extends('layouts.app')
@section('content')
@php
  $empleado_usuario = auth()->user()->Empleado_rrhh;
  $coleccion = $empleado_usuario->Vacaciones()->orderBy('Start_date', 'DESC')->get();
  $contratacion = $empleado_usuario->Contrataciones->last();
  $tipo = $empleado_usuario->Tipo_empleado->last();
  $fecha_alta = $contratacion->High_date;
  $antiguedad = Antiguedad($fecha_alta);
  $periodo_actual = Periodo_actual($fecha_alta);
  $dias_disfrutar =  Dias_Disfrutar($fecha_alta, $tipo->id);
  $dias_disfrutados = Dias_disfrutados($contratacion, $empleado_usuario);
  $saldo =  Saldo($fecha_alta, $dias_disfrutados);

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <div id="carouselExampleFade" class="carousel slide carousel-fade shadow" data-ride="carousel">
    <div class="carousel-inner">
      @foreach($imagenes as $imagen)
        @if($i)
          <div class="carousel-item active" data-interval="15000">
            <img src="{{ asset('img/Banner/'.$imagen->Name_file) }}" class="d-block w-100" alt="...">
          </div>
          @php
              $i = 0;
          @endphp
        @else
          <div class="carousel-item" data-interval="15000">
            <img src="{{ asset('img/Banner/'.$imagen->Name_file) }}" class="d-block w-100" alt="...">
          </div>
        @endif
      @endforeach 
    </div>
  </div>
  <br>
  <div class="row ">


















    <div class="col-md-3 col-sm-6 col-12">
      <a data-toggle="modal" data-target="#Solicitud_Vacaciones" style="cursor: pointer;">
        <div class="info-box bg-info  shadow">
            <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Solicitud de Vacaciones</h5></span>
            </div>
        </div>
      </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ route('Calendario.index') }}" style="cursor: pointer;">
        <div class="info-box bg-gradient-lightblue shadow">
            <span class="info-box-icon"><i class="fa fa-calendar-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Sala de Juntas</h5></span>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <a data-toggle="modal" data-target="#Orden_Mantenimiento" style="cursor: pointer;">
        <div class="info-box bg-gradient-primary  shadow">
            <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><h5>Orden de Mantenimiento</h5></span>
            </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      @if($conteo > 0)
      <div class="card bg-seccion shadow">
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
                <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" style="width: 60px;">
                <a class="users-list-name" href="#">{{ nombre($empleado, 'Mostrar')}}</a>
                <span class="users-list-date">{{ $departamento->Departament_ES }} | {{ $puesto->Position_ES }}</span>
              </div>
            @endforeach
          </div>         
        </div>
      </div>
      @endif

      <div class="card bg-seccion shadow">
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
                <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" class="rounded-circle shadow" style="width: 70px;">
                <a class="users-list-name " style="color: #0055BF"><strong>{{ nombre($festejado, 'Mostrar')}}</strong></a>
                <span class="users-list-date" style="color: #0055BF"><strong>{{ date_format($date, 'd').'.'.date_format($date, 'm') }}</strong></span>
                @else
                <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" alt="User Image" class="rounded-circle" style="width: 50px;">
                <a class="users-list-name ">{{ nombre($festejado, 'Mostrar')}}</a>
                <span class="users-list-date">{{ date_format($date, 'd').'.'.date_format($date, 'm') }}</span>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <div class="card-footer p-0">
          <img src="{{ asset('img/cumple.jpg') }}" class="img-fluid m-0 p-0 rounded-bottom">
        </div>
      </div>

      <div class="card bg-seccion shadow">
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
                  <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" class="img-circle img-size-32 mr-2">
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
          <img src="{{ asset('img/trayectoria.jpg') }}" class="img-fluid m-0 p-0 rounded-bottom">
        </div>
      </div>

    </div>

    <div class="col-lg-6">
      <div id="carouselTi" class="carousel slide carousel-fade shadow" data-ride="carousel">
        <div class="carousel-inner">
          @php
            $i = 1;
          @endphp
          @foreach($avisos as $aviso)
            @if($i)
              <div class="carousel-item active">
                <a href="{{ ($aviso->Type == 1) ? route('Aviso.ver', $aviso->Slug) : $aviso->Link }}" target="_blank">
                  <img src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image) }}" class="d-block w-100" alt="...">
                </a>
              </div>
              @php
                  $i = 0;
              @endphp
            @else
              <div class="carousel-item">
                <a href="{{ ($aviso->Type == 1) ? route('Aviso.ver', $aviso->Slug) : $aviso->Link }}" target="_blank">
                  <img src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image) }}" class="d-block w-100" alt="...">
                </a>
                
              </div>
            @endif
          @endforeach 
        </div>
      </div>
      <br>
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

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
        <button class="carousel-control-prev" style="filter: invert(100%)" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" style="color: red;" aria-hidden="true"></span>
        <span class="visually-hidden" _msttexthash="116246" _msthash="230">Anterior</span>
      </button>
      <button class="carousel-control-next" style="filter: invert(100%)" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden" _msttexthash="113945" _msthash="231">Próximo</span>
      </button>
      </div>
      <br>
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
{{--
      <div class="card bg-seccion shadow">
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
      </div>--}}

    </div>
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
              {!!  Form::text('Departamento', departamento(auth()->user()->Empleado_rrhh, 'Nombre'), ['class' => 'form form-control', 'readOnly']) !!}
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
              {!! Form::date('date', date('Y-m-d'), ['class' => 'form form-control', 'required']) !!}
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
              {!! Form::date('date', date('Y-m-d'), ['class' => 'form form-control form-control-sm', 'required', 'readOnly' => 'True']) !!}
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
              {!!  Form::text('Departamento', departamento(auth()->user()->Empleado_rrhh, 'Nombre'), ['class' => 'form form-control form-control-sm', 'readOnly']) !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('Ingreso', 'Fecha de Ingreso:') !!}
              {!! Form::date('ingreso',  auth()->user()->Empleado_rrhh->Contrataciones->last()->High_date, ['class' => 'form form-control form-control-sm', 'required', 'readOnly' => 'True']) !!}
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
                {!! Form::label('fecha', 'Días disponibles de vacaciones:') !!}
                {!!  Form::number('saldo_actual', $saldo, ['class' => 'form form-control form-control-sm', 'readOnly' => 'True']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Días de vacaciones a disfrutar:') !!}
                {!!  Form::number('dias_disfrutar', null, ['class' => 'form form-control form-control-sm', 'id' => 'dias_disfrutar', 'min' => '1']) !!}
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
                {!!  Form::number('saldo_restante', null, ['class' => 'form form-control form-control-sm', 'id' => 'saldo_restante', 'readOnly' => 'True']) !!}
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
                {!! Form::label('fecha', 'Del:') !!}
                {!!  Form::date('fecha_inicio_e', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('fecha', 'Al:') !!}
               {!!  Form::date('fecha_fin_e', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                {!! Form::label('fecha', 'Fecha de regreso laboral:') !!}
                {!!  Form::date('fecha_regreso_e', null, ['class' => 'form form-control form-control-sm']) !!}
              </div>
              <div class="col-md-6">
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

<div class="modal fade" id="Orden_Mantenimiento">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Orden de Mantenimiento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
            {!! Form::open(['route' => 'Orden_Mantenimiento.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-4">
                    {!! Form::label('Tipo de Orden', 'Tipo de Orden:') !!}
                    {!! Form::select('type_order_id', listado_tipo_orden(), null, ['class' => 'form form-control form-control-sm tipo_orden', 'placeholder' => 'Selecciona','value' => old('type_order_id'), 'required']) !!}
                </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">           
                    {!!  Form::label('Solicitante', 'Solicitante: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::text('empleado', nombre(auth()->user()->Empleado_rrhh, 'Mostrar'),['class' => 'form-control form-control-sm', 'readOnly']) !!}
                    {!!  Form::hidden('employee_id', auth()->user()->Empleado_rrhh->id,['class' => 'form-control form-control-sm']) !!}
                  </div>
                  <div class="col-lg-4">
                    {!!  Form::label('Departamento', 'Departamento: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::text('departamento', departamento(auth()->user()->Empleado_rrhh, 'Nombre'),['class' => 'form-control form-control-sm', 'readOnly']) !!}
                    {!!  Form::hidden('departament_id', departamento(auth()->user()->Empleado_rrhh, 'Id'),['class' => 'form-control form-control-sm']) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div id="maquina" style="display: none;">
                      {!!  Form::label('Maquina', 'Maquina: ', ['class' => 'col-form-label']) !!}
                      {!!  Form::select('machine_id', [], null,['class' => 'form-control form-control-sm select_maquina', 'placeholder' => 'Seleccionar una Opción', 'value' => old('machine_id')]) !!}
                    </div>
                    <div id="objeto" style="display: none;">
                      {!!  Form::label('Objeto/Equipo', 'Objeto/Equipo: ', ['class' => 'col-form-label']) !!}
                      {!!  Form::text('object', null,['class' => 'form-control form-control-sm input_objeto', 'autocomplete' => 'off']) !!}
                    </div>
                    <div id="proyecto" style="display: none;">
                      {!!  Form::label('Proyecto', 'Proyecto: ', ['class' => 'col-form-label']) !!}
                      {!!  Form::text('proyect', null,['class' => 'form-control form-control-sm input_proyecto', 'autocomplete' => 'off']) !!}
                    </div>
                  </div>
                   <div class="col-md-4">
                      {!! Form::label('Prioridad', 'Prioridad:', ['class' => 'col-form-label']) !!}
                      {!! Form::select('priority_id', listado_prioridades(), null, ['class' => 'form form-control form-control-sm prioridad', 'placeholder' => 'Selecciona', 'value' => old('priority_id'),'required']) !!}
                  </div>
                  <div class="col-lg-4" style="display: none;" id="programado">
                    {!!  Form::label('F. Programada', 'Fecha: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::datetimeLocal('scheduled_date', null,['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccionar una Opción', 'min' => date('Y-m-d').'T'.date('H:i')]) !!}
                  </div>
                </div>

                {!! Form::label('Descripción', 'Descripción:') !!}
                {!! Form::textarea('description', null, ['class' => 'form form-control form-control-sm', 'placeholder' => 'Describe de forma detallada el problema a reportar','autocomplete' => 'off'.'required']) !!}

                <div id="imagen" style="display: none;">
                {!!  Form::label('Imagen', 'Imagen de la falla/problema: ', ['class' => 'col-form-label']) !!}<br>
                {!!  Form::file('received_image', [ 'accept' => '.jpg, .jpeg']) !!}
                </div>
                 
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-lg-6">
                {!!  Form::submit('Generar Orden', ['class' => 'btn btn-success btn-sm btn-block', 'id' => 'Btn_Generar_Orden']); !!} 
                {!! Form::close() !!}
                <div style="display: none; color: green;" id="mensaje_orden">
                <h6> Se esta generando la orden .... </h6>
                </div>
              </div>
              <div class="col-lg-6">
                <a href="{{ route('Orden_Mantenimiento.index') }}"><button class="btn btn-danger btn-sm btn-block">Cancelar</button></a>
              </div>
            </div>  
          </div>
    </div>
  </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
  $('#Btn_Generar_Orden').click(function(){
  $(this).hide();
  $('#mensaje_orden').show();
});

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

  $("input[name='dias_disfrutar']").on("keyup", function() { 
    var val = $("input[name='saldo_actual']").val();
    var val1 = $("input[name='dias_disfrutar']").val();
    var re = val - val1;
    $("input[name='saldo_restante']").val(re);
  });

  $("input[name='dias_disfrutar']").change( function() { 
    var val = $("input[name='saldo_actual']").val();
    var val1 = $("input[name='dias_disfrutar']").val();
    var re = val - val1;
    $("input[name='saldo_restante']").val(re);
  });

  $(".tipo_orden").change(function(event){
    if($(".tipo_orden").val() == 1 || $(".tipo_orden").val() == 2){
      $("#maquina").show();
      $("#imagen").show();
      $("#objeto").hide();
      $("#proyecto").hide();
      $(".input_objeto").val("");
      $(".input_proyecto").val("");

      $.get("Usuario/Modulos/Orden_Mantenimiento/"+event.target.value+"/get_machines", function(response,info){
        $('.select_maquina').empty();
        $('.select_maquina').append('<option value="">Selecciona una opción</option>');
        for(j=0; j<response.length; j++){
          $('.select_maquina').append('<option value="'+response[j].id+'">'+response[j].name+'</option>');
        }
      });         
    }

    if($(".tipo_orden").val() == 3){
      $("#maquina").hide();
      $("#imagen").show();
      $("#objeto").show(); 
      $("#proyecto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_proyecto").val("");    
    }

    if($(".tipo_orden").val() == 4){
      $("#maquina").hide();
      $("#imagen").hide();
      $("#proyecto").show(); 
      $("#objeto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_objeto").val("");  

    }
  });


  $(".prioridad").change(function () { 
    if($(".prioridad").val() == 4){
      $("#programado").show();
    }else{
      $("#programado").hide();
    }
  });

  if($(".tipo_orden").val() == 1 || $(".tipo_orden").val() == 2){
      $("#maquina").show();
      $("#imagen").show();
      $("#objeto").hide();
      $("#proyecto").hide();
      $(".input_objeto").val("");
      $(".input_proyecto").val("");

      $.get("Usuario/Modulos/Orden_Mantenimiento/"+$(".tipo_orden").val()+"/get_machines", function(response,info){
        $('.select_maquina').empty();
        $('.select_maquina').append('<option value="">Selecciona una opción</option>');
        for(j=0; j<response.length; j++){
          $('.select_maquina').append('<option value="'+response[j].id+'">'+response[j].name+'</option>');
        }
      });          
    }

  if($(".tipo_orden").val() == 3){
      $("#maquina").hide();
      $("#imagen").show();
      $("#objeto").show(); 
      $("#proyecto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_proyecto").val("");    
    }

    if($(".tipo_orden").val() == 4){
      $("#maquina").hide();
      $("#imagen").hide();
      $("#proyecto").show(); 
      $("#objeto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_objeto").val("");  

    }

    if($(".prioridad").val() == 4){
      $("#programado").show();
    }else{
      $("#programado").hide();
    }
</script>
@endsection