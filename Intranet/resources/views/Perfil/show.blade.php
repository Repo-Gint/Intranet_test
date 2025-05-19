@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
@php
  $coleccion = $empleado->Vacaciones()->where('start_date', '>=', $contratacion->High_date)->orderBy('Start_date', 'DESC')->get();
  $fecha_alta = $contratacion->High_date;
  $antiguedad = Antiguedad($fecha_alta);
  $periodo_actual = Periodo_actual($fecha_alta);
  $dias_disfrutar =  Dias_Disfrutar($fecha_alta, $tipo->id);
  $dias_disfrutados = Dias_disfrutados($contratacion, $empleado);
  $saldo =  Saldo($fecha_alta, $dias_disfrutados);
  $periodos_historial = Periodos_historial($empleado);
  if($puesto->Parent_Puesto != NULL){
      $puesto_superior = $puesto->Parent_Puesto;
      $jefe_directo = $puesto_superior->empleado->last();
   }else{
      $puesto_superior = "";
      $jefe_directo = "";
   }

  $equipo = mi_equipo($puesto);
@endphp
@include('flash::message')
@include('layouts.errors')
<div class="card">
  <div class="card-header p-0">
    <img src="{{ asset("img/perfil.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-3">
        <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $empleado->Photo }}" class="img-thumbnail rounded">
      </div>
      <div class="col-lg-9">
        <dl class="row">
          <dt class="col-sm-4">Nombre: </dt>
          <dd class="col-sm-8">{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</dd>
          <dt class="col-sm-4">Puesto: </dt>
          <dd class="col-sm-8">{{ $puesto->Position_ES }}</dd>
          <dt class="col-sm-4">Departamento: </dt>
          <dd class="col-sm-8">{{ $puesto->Departamento->Departament_ES }}</dd>
          <dt class="col-sm-4">Jefe Directo:</dt>
          @if($puesto->Parent_id != null)
            @if($jefe_directo == null || empty($jefe_directo))
              <dd class="col-sm-8">{{ $puesto_superior->Position_ES }}</dd>
            @else
              <dd class="col-sm-8">{{ $puesto_superior->Position_ES.' - '.$jefe_directo->Names.' '.$jefe_directo->Paternal }}</dd>
            @endif
          @endif
          <dt class="col-sm-4">Correo Corporativo: </dt>
          <dd class="col-sm-8">{{ ($contacto->Business_mail == null) ? '---' : $contacto->Business_mail }}</dd>
          <dt class="col-sm-4">Extensión: </dt>
          <dd class="col-sm-8">{{ ($contacto->Extension == null) ? '---' : $contacto->Extension }}</dd>
          <dt class="col-sm-4">Celular: </dt>
          <dd class="col-sm-8">{{ ($contacto->Business_phone == null) ? '---' : $contacto->Business_phone }}</dd>
        </dl>  
      </div> 
    </div>
  </div>
</div>
<div class="card card-tabs">
  <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="mi_equipo-tab" data-toggle="pill" href="#mi_equipo" role="tab" aria-controls="mi_equipo" aria-selected="true">Mi equipo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="vacaciones-tab" data-toggle="pill" href="#vacaciones" role="tab" aria-controls="vacaciones" aria-selected="true">Vacaciones</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="custom-tabs-one-tabContent">
      <div class="tab-pane fade show active" id="mi_equipo" role="tabpanel" aria-labelledby="mi_equipo-tab">
        <table  class="table table-bordered table-hover table-sm">
          @foreach($equipo as $e)
            <tr>
              <td style="text-align: center;">
                 <img src="http://10.0.0.8:8080/Recursos_Humanos/images/Fotografias/{{ $e->Photo }}" class="img-circle img-size-32 mr-2">
              </td>
              <td>{{ $e->Names.' '.$e->Paternal.' '.$e->Maternal }}</td>
              <td>{{ $e->Position_ES }}</td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="tab-pane fade show" id="vacaciones" role="tabpanel" aria-labelledby="vacaciones-tab">
        <a data-toggle="modal" data-target="#Solicitud_Vacaciones" style="cursor: pointer;" class="float-right">
         

 <button class="btn btn-success btn-sm">Solicitud de vacaciones</button>










        </a>
        <br><br>
        <div class="row">
          <div class="col-lg-3"> 
            <center>
                <label class="Datos">Antigüedad:</label><br>
                {{ $antiguedad }}
            </center> 
          </div>
          <div class="col-lg-3"> 
              <center>
                 <label class="Datos">Periodo:</label><br>
                 {{ $periodo_actual }}
              </center> 
          </div>
          






<div class="col-lg-3"> 
              <center>
                 <label class="Datos">Días a disfrutar:</label><br>
                 {{ $dias_disfrutar }}
              </center> 
          </div>
          <div class="col-lg-3"> 
             <center>
                 <label class="Datos">Saldo:</label><br>
                 {{ $saldo }}
             </center> 
          </div>








        

        </div>
        <br>
        <table class="table table-bordered table-hover table-sm" width="100%" cellspacing="0" id="tbl_vacaciones">
          <thead>
            <tr>
              <th>#</th>
                <th>Periodo</th>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Días Solicitados</th>
                <th>Tipo de Vacaciones</th>
            </tr>
          </thead>
          <tbody>	  
            @php
            $i = 0;
            @endphp
            @foreach($coleccion as $vacaciones)
              @php
			  $tip_advanced=$vacaciones->Advanced;
					if($tip_advanced<>3){
                    $i++;
                @endphp
                <tr>
                    <td style="">{{ $i }}</td>
                    <td style="">{{ $vacaciones->Period }}</td>
                    <td style="">{{ Formato($vacaciones->Start_date) }}</td>
                    <td style="">{{ Formato($vacaciones->Ending_date) }}</td>
                    <td style="">{{ $vacaciones->Days }}</td>
                    <td style="">{{ Tipo_Vacacion($vacaciones->Paid, $vacaciones->Advanced)}}</td>      
                </tr>
				@php
					}
				@endphp
            @endforeach
          </tbody>
        </table>
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
              {!! Form::date('date', date('Y-m-d'), ['class' => 'form form-control form-control-sm', 'readOnly' => 'True']) !!}
            </div> 
            <div class="col">
              {!! Form::label('fecha', 'Nómina:') !!}
              {!!  Form::text('Nomina', auth()->user()->Empleado_rrhh->Code, ['class' => 'form form-control form-control-sm', 'readOnly' => 'True']) !!}
            </div>           
          </div>
          <div class="row">
            <div class="col">
              {!!  Form::label('Nombre', 'Nombre:') !!}
              {!!  Form::text('Nombre', nombre(auth()->user()->Empleado_rrhh, 'Completo'), ['class' => 'form form-control form-control-sm', 'readOnly' => 'True']) !!}
              {!!  Form::hidden('id', auth()->user()->Empleado_rrhh->id, []) !!}
              
              {!!  Form::hidden('fecha_ingreso', auth()->user()->Empleado_rrhh->Contrataciones->last()->High_date, []) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              {!! Form::label('fecha', 'Departamento:') !!}
              {!!  Form::text('Departamento', departamento(auth()->user()->Empleado_rrhh, 'Nombre'), ['class' => 'form form-control form-control-sm', 'readOnly' => 'True']) !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('Ingreso', 'Fecha de Ingreso:') !!}
              {!! Form::date('ingreso', auth()->user()->Empleado_rrhh->Contrataciones->last()->High_date, ['class' => 'form form-control form-control-sm', 'required', 'readOnly' => 'True']) !!}
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
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/w/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>
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
  
    $(function () {
      var groupColumn = 1;
    $("#tbl_vacaciones").DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ por página",
        "zeroRecords": "no se encontrarón datos - lo siento",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Buscar",
        "oPaginate": {
              "sFirst":    "<<",
              "sLast":     ">>",
              "sNext":     ">",
              "sPrevious": "<"
          },
      },
      "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
      "order": [[ groupColumn, 'desc' ]],

      "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;
          api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ){
              if ( last !== group ) {
                  $(rows).eq( i ).before(
                      '<tr class="group" ><th colspan="6" style="text-align: center;">'+group+'</th></tr>'
                  );
                  last = group;
              }
          });
      }
    });
  });
  </script>
@endsection