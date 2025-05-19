@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Incidencias')
@section('content')
@include('flash::message')
@include('layouts.errors')
<div class="row justify-content-center">
  @can('Sin_Incidente.create')
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        {!! Form::open(['route' => 'Sin_Incidente.store', 'method' => 'POST']) !!}
          {!!  Form::label('Dia del incidente', 'Dia del incidente: ', ['class' => 'col-form-label']) !!}
          {!!  Form::date('Incident_day', null, ['class' => 'form-control', 'required']) !!}
          {!!  Form::label('Razón', 'Razón: ', ['class' => 'col-form-label']) !!}
          {!!  Form::textarea('Reason', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
      </div>
      <div class="card-footer">
        {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']) !!} 
      </div>

      {!! Form::close() !!}
      </div>
  </div>
  @endcan
  <div class="col-lg-9">
    <div class="card">
      <div class="card-body">
        <table class="table table-hover" id="tbl_incidencias">
          <thead>
            <tr>
              <th>Dia</th>
              <th>Razón</th>
              <th style="text-align: center;">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($incidentes as $incidente)
              <tr>
                <td>{{ Formato($incidente->Incident_day) }}</td>
                <td>{{ $incidente->Reason }}</td>
                <td  style="text-align: center;">
                  @can('Sin_Incidente.edit')
                  <button class="btn btn-primary btn-sm Editar_Incidencia" data-toggle="modal" data-target="#Editar_Incidencia" id="{{ $incidente->id }}">
                    <i class="fa fa-edit"></i>
                  </button>
                  @endcan
                  @can('Sin_Incidente.destroy')
                  <a href="{{ route('Sin_Incidente.destroy', $incidente->id) }}">
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar el registro?')">
                      <i class="fa fa-trash"></i>
                    </button>
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

<div class="modal fade" id="Editar_Incidencia" tabindex="-1" role="dialog" aria-labelledby="Editar_AlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Editar_AlbumLabel">Editar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => array('Sin_Incidente.update', 0), 'method' => 'PUT']) !!}
          {!!  Form::hidden('id', null, ['id' => 'id_incidente']) !!}<br>
          {!!  Form::label('Dia del incidente', 'Dia del incidente: ', ['class' => 'col-form-label']) !!}
          {!!  Form::date('Incident_day', null, ['class' => 'form-control', 'required']) !!}
          {!!  Form::label('Razón', 'Razón: ', ['class' => 'col-form-label']) !!}
          {!!  Form::textarea('Reason', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
         {!!  Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
        {!! Form::close() !!}
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
    $('.Editar_Incidencia').click(function(){
        var id = $(this).attr("id");
        $('#id_incidente').val(id);
    });
  })

    $(function () {
    $("#tbl_incidencias").DataTable({
      "aaSorting": [],
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