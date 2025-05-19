@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Usuarios')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="card">
  <div class="card-body">
    <table class="table table-hover table-sm" id="tbl_usuarios">
      <thead>
        <tr>
          <th>Empleado</th>
          <th>Usuario</th>
          <th>Rol</th>
          <th style="text-align: center;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->Empleado_rrhh->Names }}</td>
            <td>{{ $usuario->name }}</td>
            <td>
              @foreach($usuario->roles as $rol)
              <span class="badge badge-success ">{{ $rol->name }}</span>
              @endforeach
            </td>
            <td  style="text-align: center;">
              @can('User.edit')
              <button class="btn btn-primary btn-sm Rol" data-toggle="modal" data-target="#Rol" id="{{ $usuario->id }}">Rol</button>
              @endcan
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-body">
    @can('Rol.create')
    <div style="text-align: right;">
    <a href="{{ route('Rol.create') }}">
      <button class="btn btn-success btn-sm">Crear Rol</button>
    </a>
    </div><br><br>
    @endcan
    <table class="table table-hover table-sm" id="tbl_roles">
      <thead>
        <tr>
          <th>Rol</th> 
          <th>Descripción</th>         
          <th style="text-align: center;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $rol)
          <tr>
            <td>{{ $rol->name }}</td>
            <td>{{ $rol->description }}</td>
            <td style="text-align: center;">
              @can('Rol.edit')
              <a href="{{ route('Rol.edit', $rol->slug) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i>
              </a>
              @endcan
              @can('Rol.destroy')
              <a href="{{ route('Rol.destroy', $rol->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar el rol?')">
                <i class="fa fa-trash"></i>
              </a>
              @endcan
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade" id="Rol" tabindex="-1" role="dialog" aria-labelledby="RolLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RolLabel">Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => array('Usuario.roles', 0), 'method' => 'PUT']) !!}
        {!!  Form::hidden('id', null, ['id' => 'id']) !!}
          {!!  Form::label('Rol', 'Rol: ', ['class' => 'col-form-label']) !!}
          
          {!!  Form::select('roles', $lista_roles, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un rol']) !!}<br>
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

    $('.Rol').click(function(){
        var id = $(this).attr("id");
        $('#id').val(id);
    });
  });

    $(function () {
    $("#tbl_usuarios").DataTable({
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
    $(function () {
    $("#tbl_roles").DataTable({
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