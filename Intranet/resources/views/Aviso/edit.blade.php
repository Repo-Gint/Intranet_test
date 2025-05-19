@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
@include('flash::message')
@include('layouts.errors')
<div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['Aviso.update', $aviso->id], 'method' => 'PUT',  'files' => true]) !!}
      <br>
      <div class="form-group row">
        <div class="col-lg-4">
          {!!  Form::label('Tipo de Noticia', 'Tipo de Noticia/Aviso: ', ['class' => 'col-form-label']) !!}
          {!!  Form::select('Type', [1 => 'Local', 2 => 'Externa'], $aviso->Type, ['class' => 'form-control', 'placeholder' => 'Selecciona una opción', 'id' => 'type', 'value'=> old('Type') ]) !!}
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-6">
          {!!  Form::label('Titulo', 'Titulo: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('Name', $aviso->Name, ['class' => 'form-control', 'autocomplete' => 'off', 'value'=> old('Name')]) !!}
        </div>
        <div class="col-lg-3">
          {!!  Form::label('Publicacion', 'F. de Publicación: ', ['class' => 'col-form-label', 'value'=> old('Publication_date')]) !!}
          {!!  Form::date('Publication_date', $aviso->Publication_date, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
          {!!  Form::label('Expiracion', 'F. de Expiración: ', ['class' => 'col-form-label', 'value'=> old('End_date')]) !!}
          {!!  Form::date('End_date', $aviso->End_date, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group row text-center">
          <div class="col-lg-4">
            {!!  Form::label('Imagen', 'Imagen (Portada): ', ['class' => 'col-form-label']) !!}<br>
            {!!  Form::file('Image', [ 'accept' => '.jpg, .jpeg, .png', 'style' => 'font-size: 13px;']) !!}
          </div>
      </div>
      <!--Form para noticia externa Inicio-->
      <div id="externa" style="display: none;">
        <div class="form-group row">
          <div class="col-lg-12">
            {!!  Form::label('Link', 'Link: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('Link', $aviso->Link, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
          </div>
        </div>
      </div>
      <!--Form para noticia externa Fin-->

      <!--Form para noticia local Inicio-->
      <div id="local" style="display: none;">
        <div class="form-group row">
          <div class="col-lg-12">
            {!!  Form::label('Descripción', 'Descripción: ', ['class' => 'col-form-label']) !!}
            <div class="mb-3">
              <textarea class="textarea" name="Description" placeholder="Place some text here" value="{{ $aviso->Description }}"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group row text-center">
            <div class="col-lg-4">
              {!!  Form::label('Archivos', 'Archivos: ', ['class' => 'col-form-label']) !!} <br>
              {!!  Form::file('Name_file[]', [ 'accept' => '.docx, .pptx, .xlsx, .pdf', 'multiple','style' => 'font-size: 13px;']) !!}
              <br><br>
              <ul style="font-size: 12px;">
              @foreach($archivos as $archivo)
                <li> 
                  <strong>{{ $archivo->Name_file }}</strong> 
                  <a href="{{ route('Aviso.eliminar_archivo', $archivo->id) }}" style="color: red;">
                    <span class="badge badge-danger"><i class="fa fa-trash"></i></span>
                  </a>
                </li>
              @endforeach
              </ul>
            </div>
            <div class="col-lg-4">
              {!!  Form::label('Archivos', 'Imagenes: ', ['class' => 'col-form-label']) !!} <br>
              {!!  Form::file('Name_image[]', [ 'accept' => '.jpg, .png, .jpeg', 'multiple','style' => 'font-size: 13px;']) !!}
              <br><br>
              <ul style="font-size: 12px;">
              @foreach($imagenes as $imagen)
                <li> 
                  <strong>{{ $imagen->Name_image }}</strong>
                  <a href="{{ route('Aviso.eliminar_imagen', $imagen->id) }}" style="color: red;">
                    <span class="badge badge-danger"><i class="fa fa-trash"></i></span>
                  </a>
                </li>
              @endforeach
              </ul>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                {!!  Form::label('Ubicación', 'Ubicación ( iframe ): ', ['class' => 'col-form-label']) !!}
                {!!  Form::textarea('Maps', $aviso->Maps, ['class' => 'form-control', 'autocomplete' => 'off']) !!}<br>
            </div>
        </div>
      </div>
      <div id="boton" style="display: none;" class="form-group row">
        <div class="col-lg-12">
            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']) !!} 
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
  $(document).ready(function(){
  
    if($("#type").val() == 1 ){

      $("#local").show();
      $("#externa").hide();
      $("#boton").show();

    }
  
    if($("#type").val() == null ){

      $("#local").hide();
      $("#externa").hide();
      $("#boton").hide();
      
    }

    if($("#type").val() == 2 ){

      $("#local").hide();
      $("#externa").show();
      $("#boton").show();

    }
    $("#type").change(function(event){

      if($("#type").val() == 1 ){
        $("#local").show();
        $("#externa").hide();
        $("#boton").show();
      }else{
        $("#local").hide();
        $("#externa").show();
        $("#boton").show();
      }

    });

    $('.textarea').eq(0).html('{{ $aviso->Description }}');

    $('.textarea').summernote({
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
      ],
      tooltip: false,
    });

  });
</script>
@endsection