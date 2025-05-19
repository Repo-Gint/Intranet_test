@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Recordatorios y/o Frases')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="card">
  <div class="card-body">
    @can('Recordatorio.index')
    <div style="text-align: right;">
    <a href="{{ route('Recordatorio.create') }}">
      <button class="btn btn-success">Recordatorio</button>
    </a>
    </div><br><br>
    @endcan
    <table class="table table-hover" id="tbl_recordatorios">
      <thead>
        <tr>
          <th>Recordatorio / Frase</th>
          <th>Inicio</th>
          <th>Termino</th>
          <th style="text-align: center;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recordatorios as $recordatorio)
          <tr>
            <td>{!! $recordatorio->Text !!}</td>
            <td>{{ Formato($recordatorio->Publication_date) }}</td>
            <td>{{ Formato($recordatorio->Ending_date) }}</td>
            <td  style="text-align: center;">
              @can('Recordatorio.edit')
              <a href="{{ route('Recordatorio.edit', $recordatorio->id) }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
              </a>
              @endcan
              @can('Recordatorio.destroy')
              <a href="{{ route('Recordatorio.destroy', $recordatorio->id) }}">
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
              </a>
              @endcan
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('javascript')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script type="text/javascript">
    $(function () {
    $("#tbl_recordatorios").DataTable({
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