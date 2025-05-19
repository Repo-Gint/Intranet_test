@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Gestor de Avisos')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="card">
  <div class="card-body">
    @can('Aviso.create')
    <div style="text-align: right;">
      <a href="{{ route('Aviso.create') }}">
        <button class="btn btn-success">Nuevo Aviso</button>
      </a>
    </div><br><br>
    @endcan
    <table class="table table-hover" id="tbl_avisos">
      <thead>
        <tr>
          <th>Publicación</th>
          <th>Aviso</th>
          <th style="text-align: center;"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($avisos as $aviso)
          <tr>
            <td>{{ Formato($aviso->Publication_date) }}</td>
            <td>{{ $aviso->Name }}</td>
            <td  style="text-align: center;">
              @can('Aviso.show')
              <a href="{{ route('Aviso.show', $aviso->Slug) }}">
                <button class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button>
              </a>
              @endcan
              @can('Aviso.edit')
              <a href="{{ route('Aviso.edit', $aviso->Slug) }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
              </a>
              @endcan
              @can('Aviso.destroy')
              <a href="{{ route('Aviso.destroy', $aviso->id) }}">
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
    $("#tbl_avisos").DataTable({
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