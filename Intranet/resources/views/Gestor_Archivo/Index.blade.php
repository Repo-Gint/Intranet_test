@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Gestor de archivos')
@section('barra')
  <li class="breadcrumb-item"><a href="{{ url('/Indice') }}">Panel</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/Usuario') }}">Usuario</a></li>
  <li class="breadcrumb-item active">Gestor de archivos</li>
@endsection
@section('content')
@include('flash::message')
@include('layouts.errors')


<div class="row justify-content-center">
  @can('Gestor_Archivo.create')
  <div class="col-lg-3 col-md-4 col-sm-12">
    <div class="row">
      @can('Gestor_Archivo_Separador.create')
      <div class="col">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Apartados</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['route' => 'Gestor_Archivo_Separador.store', 'method' => 'POST']) !!}
              {!!  Form::label('Departamento', 'Departamento: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('Departament_id', $departamentos_lista, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un departamento', 'required']) !!}
              {!!  Form::label('Seccion', 'Sección: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}<br>
              {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      @endcan
      <div class="col">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Subir Archivos</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['route' => 'Gestor_Archivo.store', 'method' => 'POST', 'files' => true]) !!}
              {!!  Form::label('Departamento', 'Departamento: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('Departament_id', $departamentos_lista, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un departamento', 'id'=>'departamento', 'required']) !!}
              {!!  Form::label('Seccion', 'Sección: ', ['class' => 'col-form-label']) !!}
              <select name="Separator_id" placeholder="Selecciona una seección" id="seccion" class='form-control', required="true"> </select>
              {!!  Form::label('Archivos', 'Selecciona tus archivos: ', ['class' => 'col-form-label']) !!}
              {!!  Form::file('Name_file[]', [ 'accept' => '.docx, .doc,.pptx, .xlsx, .xlsm, .pdf, .xls', 'multiple', 'style' => 'font-size: 13px;', 'required']) !!}<br><br>
              {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']) !!} 
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @endcan
  <div class="col-lg-9 col-md-8 col-sm-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Departamentos</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link" id="1000-tab" data-toggle="pill" href="#material-corporativo" role="tab" aria-controls="material-corporativo" aria-selected="false">Material Corporativo</a>
              @foreach($departamentos as $departamento)
                <a class="nav-link" id="{{ $departamento->Slug }}-tab" data-toggle="pill" href="#{{ $departamento->Slug }}" role="tab" aria-controls="{{ $departamento->Slug }}" aria-selected="false">{{ $departamento->Departament_ES }}</a>
              @endforeach
            </div>
          </div>
          <div class="col-8">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade" id="material-corporativo" role="tabpanel" aria-labelledby="material-corporativo-tab">
                @php
                  $separadores = App\Gestor_Archivo_Separador::where('Departament_id', 1000)->orderBy('Name', 'ASC')->get();
                @endphp
                <table class="table table-bordered table-sm" style="font-size: 13px;">
                  @foreach($separadores as $separador)
                    <tr style="background-color: #0051CB; color: white;">
                      <td>{{ $separador->Name }}</td>
                      <td style="text-align: center;">
                        @can('Gestor_Archivo_Separador.edit')
                        <button type="button" class="btn btn-primary badge badge-primary Editar_Separador" data-toggle="modal" data-target="#Editar_Separador"
                        id="{{ $separador->id }}"><i class="fa fa-edit"></i></button>
                        @endcan
                      </td>
                      <td style="text-align: center;">
                        @can('Gestor_Archivo_Separador.destroy')
                        <a href="{{ route('Gestor_Archivo_Separador.destroy', $separador->id) }}">
                          <button class="btn btn-danger badge badge-danger" onclick="return confirm('¿Seguro de eliminar el separador? Al eliminar el separador, se eliminarán sus archivos.')"><i class="fa fa-trash"></i></button>
                        </a> 
                        @endcan
                      </td>
                    </tr>
                    @foreach($separador->Gestor_Archivo()->orderBy('Name_file', 'ASC')->get() as $archivo)
                    <tr>
                      <td>{{ $archivo->Name_file }}</td>
                      <td>
                        @can('Gestor_Archivo.download')
                        <a href="{{ route('Gestor_Archivo.download', $archivo->id) }}">
                          <button type="button" class="btn btn-default badge badge-deafult">
                            <i class="fa fa-download"></i>
                          </button>
                        </a>
                        @endcan
                      </td>
                      <td>
                        @can('Gestor_Archivo.destroy')
                        <a href="{{ route('Gestor_Archivo.destroy', $archivo->id) }}">
                          <button type="button" class="btn btn-danger badge badge-danger">
                            <i class="fa fa-trash"></i>
                          </button>
                        </a>
                        @endcan
                      </td>
                    </tr>
                    @endforeach
                  @endforeach
                </table>
              </div>
              @foreach($departamentos as $departamento)
              <div class="tab-pane fade" id="{{ $departamento->Slug }}" role="tabpanel" aria-labelledby="{{ $departamento->Slug }}-tab">
                @php
                  $separadores = App\Gestor_Archivo_Separador::where('Departament_id', $departamento->id)->orderBy('Name', 'ASC')->get();
                @endphp
                <table class="table table-bordered table-sm" style="font-size: 13px;">
                  @foreach($separadores as $separador)
                    <tr style="background-color: #0051CB; color: white;">
                      <td>{{ $separador->Name }}</td>
                      <td style="text-align: center;">
                        @can('Gestor_Archivo_Separador.edit')
                        <button type="button" class="btn btn-primary badge badge-primary Editar_Separador" data-toggle="modal" data-target="#Editar_Separador"
                        id="{{ $separador->id }}"><i class="fa fa-edit"></i></button>
                        @endcan
                      </td>
                      <td style="text-align: center;">
                        @can('Gestor_Archivo_Separador.destroy')
                        <a href="{{ route('Gestor_Archivo_Separador.destroy', $separador->id) }}">
                          <button class="btn btn-danger badge badge-danger" onclick="return confirm('¿Seguro de eliminar el separador? Al eliminar el separador, se eliminarán sus archivos.')"><i class="fa fa-trash"></i></button>
                        </a> 
                        @endcan
                      </td>
                    </tr>
                    @foreach($separador->Gestor_Archivo()->orderBy('Name_file', 'ASC')->get() as $archivo)
                    <tr>
                      <td>{{ $archivo->Name_file }}</td>
                      <td>
                        @can('Gestor_Archivo.download')
                        <a href="{{ route('Gestor_Archivo.download', $archivo->id) }}">
                          <button type="button" class="btn btn-default badge badge-deafult">
                            <i class="fa fa-download"></i>
                          </button>
                        </a>
                        @endcan
                      </td>
                      <td>
                        @can('Gestor_Archivo.destroy')
                        <a href="{{ route('Gestor_Archivo.destroy', $archivo->id) }}">
                          <button type="button" class="btn btn-danger badge badge-danger">
                            <i class="fa fa-trash"></i>
                          </button>
                        </a>
                        @endcan
                      </td>
                    </tr>
                    @endforeach
                  @endforeach
                </table>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Editar_Separador" tabindex="-1" role="dialog" aria-labelledby="Editar_SeparadorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Editar_SeparadorLabel">Editar Separador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['route' => array('Gestor_Archivo_Separador.update', 0), 'method' => 'PUT']) !!}
      <div class="modal-body">
          {!!  Form::label('Seccion', 'Sección: ', ['class' => 'col-form-label']) !!}
          {!!  Form::hidden('id', null, ['id' => 'id']) !!}<br>
          {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}<br>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-lg-6">
            {!!  Form::submit('Guardar', ['class' => 'btn btn-primary btn-block']); !!}
            {!! Form::close() !!}
          </div>
          <div class="col-lg-6">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){
     $("#departamento").change(function(event){

        $.get("../../Usuario/Modulos/Gestor_Archivo_Separador/"+event.target.value+"/Separator_list", function(response,success){
            $('#seccion').empty();
            $('#seccion').append('<option value="">Selecciona una seccion</option>');
            for(i=0; i<response.length; i++){
                $('#seccion').append('<option value="'+response[i].id+'">'+response[i].Name+'</option>');
            }
        });
    });
  });

  $(function(){
    $('.Editar_Separador').click(function(){
        var id = $(this).attr("id");
        $('#id').val(id);
    });
  });

</script>
@endsection
