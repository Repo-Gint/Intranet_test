@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Usuarios / Nuevo Rol')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="row">
    <div class="col-lg-12"> 
        <div class="card card-success">
            <div class="card-header with-border">
              <h3 class="card-title">Nuevo Rol</h3>
            </div>
            {!! Form::open(['route' => 'Rol.store', 'method' => 'POST' ]) !!}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Rol', 'Rol: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Descripcion', 'Descripción: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('description', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <center>
                        <h5>Permiso Especial</h3>
                        <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
                        <label>{{ Form::radio('special', 'personalizado') }} Personalizado</label>
                        <label>{{ Form::radio('special', 'no-access') }} Ningún Acceso</label>
                        </center>
                    </div>
                </div>
                <div id="permisos" style="display: none;">
                    <div class="row">
                        @foreach($grupos as $grupo)
                            <div class="col-md-4">
                              <div class="card card-outline card-primary collapsed-card">
                                <div class="card-header">
                                  <h3 class="card-title">{{ $grupo->group }}</h3>

                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  @foreach($permisos as $permission)
                                      @if($permission->group == $grupo->group)
                                          {{ Form::checkbox('permission[]', $permission->id, null) }}
                                          <strong>{{ $permission->name }}</strong>
                                          ({{ $permission->description ?: 'Sin descripción'}})<br>
                                      @endif    
                                    @endforeach
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Rol.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
            </div>
            
          </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
@endsection
@section('javascript')

<script type="text/javascript">
$("input[name=special]").click(function () {  
    if($('input:radio[name=special]:checked').val() == 'personalizado'){
        $("#permisos").show();
    }else{
        $("#permisos").hide();
    }
});
</script>
@endsection