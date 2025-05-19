@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('content')
@include('flash::message')
@include('layouts.errors')
@php
$cnt=1;
@endphp
<div class="card">
  <div class="card-header  bg-gradient-primary">
    Ordenes de Mantenimiento
  </div>
  <div class="card-body ">
    @can('Orden_Mantenimiento.create')

      <a href="{{ route('Orden_Mantenimiento.create') }}" class="float-right">
        <button class="btn btn-success ">Nueva Orden</button>
      </a>

    @endcan
    <table class="table table-sm table-responsive" id="tbl_ordenes">
      <thead>
        <tr>
          <th>#</th>
          <th>Orden</th>
          <th>Fecha</th>
          <th>Solicitante</th>
          <th>Máquina/Objeto</th>
          <th>T. de Mantenimiento</th>
          <th>Descripción</th>
          <th>Estatus</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach($ordenes as $orden)
        <tr>
          <td>{{ $cnt++ }}</td>
          <td>{{ $orden->code }}</td>
          <td>
            <span style="display: none;">{{ formato_fecha_numeros($orden->aplication_date) }}</span>
            {{ formato_fecha_hora($orden->aplication_date) }}
          </td>
          <td>{{ obtener_empleado($orden->employee_id) }}</td>
          <td>{{ ($orden->object == null) ? obtener_maquina($orden->machine_id) : $orden->object }}</td>
          <td>{{ ($orden->maintenance_id == null) ? ' ' : obtener_mantenimiento($orden->maintenance_id) }}</td>
          <td>{{ $orden->description }}</td>
          <td >
            {{ obtener_estatus($orden->status_id) }}
          </td>
          <td class="text-center">
            <a href="{{ route('Orden_Mantenimiento.show', $orden->code) }}">
              <i class="fa fa-eye" style="color: gray;"></i>
            </a>
          </td>
        </tr>
      @endforeach 
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr class="bg-gradient-primary">
              <th style="width: 15%;">Estatus</th>
              <th style="width: 75%;">Descripción</th>
            </tr>
          </thead>
          <tbody>
          @php
          $estatus = DB::connection('mysql_mantenimiento')->table('order_status')->where('enable', 1)->get();
          @endphp
          @foreach($estatus as $status)
            <tr>
              <td>{{ $status->type }}</td>
              <td>{{ $status->description }}</td>
            </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr class="bg-gradient-primary">
              <th style="width: 15%;">Prioridad</th>
              <th style="width: 75%;">Descripción</th>
            </tr>
          </thead>
          <tbody>
          @php
          $prioridades = DB::connection('mysql_mantenimiento')->table('priorities')->where('enable', 1)->get();
          @endphp
          @foreach($prioridades as $prioridad)
            <tr>
              <td>{{ $prioridad->type }}</td>
              <td>{{ $prioridad->description }}</td>
            </tr>
          @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script type="text/javascript">
    $(function () {
    $("#tbl_ordenes").DataTable({
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
  </script>
@endsection