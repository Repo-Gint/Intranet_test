@section('style')
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-bootstrap/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('content')
@include('flash::message')
@include('layouts.errors')
<div class="card">
  <div class="card-header p-0">
    <img src="{{ asset("img/calendario.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-sm-12 col-12">
    <div class="card shadow">
      <div class="card-header">
        Mis reservaciones. <br>
      </div>
      <div class="card-body ">
        @if($mis_reservaciones == null || $mis_reservaciones->isEmpty())
          No tienes reservaciones disponibles.
        @else
        @foreach($mis_reservaciones as  $mireservacion)
        <div class="card bg-gradient-info ">
          <div class="card-body p-2">
            <h6><strong>{{ $mireservacion->Name }}</strong></h6>
            <div style="font-size: 13px;">
            {{ $mireservacion->Description }}<br>
            <strong>Fecha:</strong> {{ Formato($mireservacion->Date) }} de {{ Formato_Tiempo($mireservacion->Time_start) }} a {{ Formato_Tiempo($mireservacion->Time_end) }}<br>
            <strong>Lugar:</strong> {{ $mireservacion->Place }}<br>
            <strong>Insumos:</strong> {{ ($mireservacion->Supplies != null) ? $mireservacion->Supplies : 'N/A'}}<br>
            <strong>Equipo:</strong> {{ ($mireservacion->System != null) ? $mireservacion->System : 'N/A'}}<br>
            </div>
          </div>
          <div class="card-footer" style="text-align: center; font-size: 13px;">
           <a href="{{ route('Calendario.destroy', $mireservacion->id) }}" style="color: white;">
              <i class="fa fa-trash"></i> Eliminar
              </a> 
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>     
  </div>
  <div class="col-md-8 col-sm-12 col-12">
    <div class="card card-primary">
      <div class="card-body p-0">
        <div id="calendar"></div>
      </div>
    </div>
    @can('Reservacion.destroy')
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-sm table-responsive-lg" id="tbl_reuniones">
          <thead>
            <tr>
              <th>Reunión</th>
              <th>Fecha</th>
              <th>Usuario</th>
              <th></th>
            </tr>
          </thead>
          @foreach($reservaciones as  $reservacion)
          <tr>
            <td>
              {{ $reservacion->Name }}
              <a  data-toggle="collapse" href="#r{{ $reservacion->id }}" aria-expanded="false" aria-controls="r{{ $reservacion->id }}">
                Ver más ...
              </a>
              <div class="collapse" id="r{{ $reservacion->id }}">
                {{ $reservacion->Description }}<br>
                <strong>Horario:</strong>{{ Formato_Tiempo($reservacion->Time_start) }} a {{ Formato_Tiempo($reservacion->Time_end) }}<br>
                <strong>Lugar:</strong> {{ $reservacion->Place }}<br>
                <strong>Insumos:</strong> {{ ($reservacion->Supplies != null) ? $reservacion->Supplies : 'N/A'}}<br>
                <strong>Equipo:</strong> {{ ($reservacion->System != null) ? $reservacion->System : 'N/A'}}<br>
              </div>
            </td>
            <td>
              {{ Formato($reservacion->Date) }}
            </td>
            <td>
              {{ consulta_empleado($reservacion->Employee_id) }}
            </td>
            <td style="text-align: center;">
              <a href="{{ route('Calendario.destroy', $reservacion->id) }}">
              <button class="btn btn-danger badge badge-danger"><i class="fa fa-trash"></i></button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    @endcan
  </div>
</div>

<div class="modal fade" id="ModalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reservación de sala de juntas.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          {!! Form::open(['route' => 'Calendario.store', 'method' => 'POST', 'files' => true]) !!}
          <div class="form-row">
            
          <div class="col-sm-4">
              {!!  Form::label('Fecha', 'Fecha: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('Date', null, ['class' => 'form-control form-control-sm', 'id' => 'date','readOnly' => 'true']) !!}
            </div>
            <div class="col-sm-4">
              {!!  Form::label('Inicio', 'Inicio: ', ['class' => 'col-form-label']) !!}
              {!!  Form::time('Time_start', null, ['class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'required']) !!}
            </div>
            <div class="col-sm-4">
              {!!  Form::label('Fin', 'Fin: ', ['class' => 'col-form-label']) !!}
              {!!  Form::time('Time_end', null, ['class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'required']) !!}
            </div>
          </div>

          <div class="form-row mt-1">
            <div class="col-sm-6">
              {!!  Form::label('Tipo de Reunión', 'Tipo de Reunión: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('Name', $name, null, ['class' => 'form-control form-control-sm','placeholder' => 'Selecciona una opción', 'required']) !!}
            </div>
            <div class="col-sm-6">
              {!!  Form::label('Sala a ocupar', 'Sala a ocupar: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('Place', $place, null, ['class' => 'form-control form-control-sm','placeholder' => 'Selecciona una opción', 'required']) !!}
            </div>
          </div>

          {!!  Form::label('Motivo', 'Motivo: ', ['class' => 'col-form-label']) !!}
          {!!  Form::text('Description', null, ['class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'required']) !!}
          <hr>
          
          <div class="form-row mt-1">
            <div class="col-sm-6">
              {!! Form::label('Requiere pantalla de bienvenida', '¿Requiere pantalla de bienvenida?') !!}
            </div>
            <div class="col-sm-6">
              {!! Form::label('Si', 'Si') !!}
              {!! Form::radio('Display', '1', false, array('id' => 'OpcionSi2')) !!}
              {!! Form::label('No', 'No') !!}
              {!! Form::radio('Display', '0', false, array('id' => 'OpcionNo2')) !!}
            </div>
          </div>
          <div id="Datos_Adicionales2" style="display: none;">
            <div class="form-row mt-1">
              <div class="col-sm-6">
                {!!  Form::label('Empresa que visita', 'Empresa que visita: ', ['class' => 'col-form-label']) !!}
                {!!  Form::text('Visit', null, ['class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}<br>
              </div>
              <div class="col-sm-6">
                {!!  Form::label('Nombre de personas que visitan', 'Personas que visitan: ', ['class' => 'col-form-label']) !!}
                {!!  Form::text('People', null, ['class' => 'form-control form-control-sm', 'autocomplete' => 'off']) !!}<br>
              </div>
            </div>
            {!!  Form::label('Logo de empresa', 'Logo de empresa: ', ['class' => 'col-form-label']) !!}
            {!!  Form::file('file', [ 'accept' => '.jpg, .jpeg', 'style' => 'font-size: 13px;']) !!}<br>
            <div class="form-row mt-1">
              <div class="col-sm-6">
                {!! Form::label('Requiere estacionamiento', '¿Requiere cajón de estacionamiento? ¿Cuántos?') !!}
              </div>
              <div class="col-sm-6">
                {!!  Form::number('Estacionamiento', 0, ['class' => 'form-control form-control-sm', 'min'=> 0]) !!}
              </div>
            </div>
          </div>

          <hr>

          <div class="form-row mt-1">
            <div class="col-sm-6">
              {!! Form::label('Insumos', 'Insumos:') !!}<br>
              {!! Form::checkbox('Supplies[]', 'Galletas') !!}
              {!! Form::label('Galletas', 'Galletas') !!}
              <br>
              {!! Form::checkbox('Supplies[]', 'Agua') !!}
              {!! Form::label('Agua', 'Agua') !!}
              <br>
              {!! Form::checkbox('Supplies[]', 'Café') !!}
              {!! Form::label('Café', 'Café') !!}
              <br>
              {!! Form::checkbox('Supplies[]', 'Refresco') !!}
              {!! Form::label('Refresco', 'Refresco') !!}
              <br>
              {!! Form::checkbox('Supplies[]', 'Fruta') !!}
              {!! Form::label('Fruta', 'Fruta') !!}
            </div>
            <div class="col-sm-6">
              {!! Form::label('Equipo', 'Equipo:') !!}<br>
              {!! Form::checkbox('System[]', 'Video') !!}
              {!! Form::label('Video', 'Video') !!}<br>
              
              {!! Form::checkbox('System[]', 'Audio') !!}
              {!! Form::label('Audio', 'Audio') !!}<br>
              
              {!! Form::checkbox('System[]', 'Adaptadores') !!}
              {!! Form::label('Adaptadores', 'Adaptadores') !!}<br>
              
              {!! Form::checkbox('System[]', 'Laptop') !!}
              {!! Form::label('Laptop', 'Laptop') !!}<br>

              {!! Form::checkbox('System[]', 'Sis. Conferencia') !!}
              {!! Form::label('Sis. Conferencia', 'Sis. de Conferencia') !!}<br>
              
            </div>
          </div>

          <div class="modal-footer">
              {!!  Form::submit('Reservar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ModalShow">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Evento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>

@endsection
@section('javascript')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/locales-all.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>


<script type="text/javascript">
   $(function () {
    $("#tbl_reuniones").DataTable({
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
      }
    });
  });

  $("#OpcionSi").click(function(){
      $("#Datos_Adicionales").show();

  });
  $("#OpcionNo").click(function(){
      $("#Datos_Adicionales").hide();

  });

  $("#OpcionSi2").click(function(){
      $("#Datos_Adicionales2").show();

  });
  $("#OpcionNo2").click(function(){
      $("#Datos_Adicionales2").hide();

  });

  function hola(){
    alert('Hola');
  }

  $(function () {



    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;

    var calendarEl = document.getElementById('calendar');



    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        language: 'es',
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'dia'
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      windowResize: true,
      locale: 'es',
      dateClick: function(info) { 
        var today = moment(new Date()).format('YYYY-MM-DD');
        var date_click = moment(info.dateStr).format('YYYY-MM-DD');
        if(date_click >= today){
           $('#ModalAdd #date').val(moment(info.dateStr).format('YYYY-MM-DD'));
            $('#ModalAdd').modal('show');
        }
       
          /*alert('Clicked on: ' + info.dateStr);
          alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          alert('Current view: ' + info.view.type);
          // change the day's background color just for fun
          info.dayEl.style.backgroundColor = 'red';*/
      },
      //Random default events
      events    : [
        {!! generar_eventos_calendario() !!}
      ]
       
    });

    calendar.render();
    // $('#calendar').fullCalendar()


  })
</script>
@endsection