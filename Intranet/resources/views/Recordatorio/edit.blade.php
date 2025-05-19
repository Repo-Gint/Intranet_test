@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="card">
  <div class="card-header bg-gradient-primary">
    Editar registro
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['Recordatorio.update', $recordatorio->id], 'method' => 'PUT']) !!}
      <br>
      <div class="form-group row">
          <div class="col-lg-3"></div>
           <div class="col-lg-6">
              {!!  Form::label('Por', 'Por: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('By', $recordatorio->By, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
          </div>
          <div class="col-lg-3"></div>
      </div>
      <div class="form-group row">
          <div class="col-lg-3"></div>
           <div class="col-lg-6">
              {!!  Form::label('Texto', 'Texto: ', ['class' => 'col-form-label']) !!}
              <div class="mb-3">
              <textarea class="textarea" name="Text"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
              
          </div>
          <div class="col-lg-3"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
          {!!  Form::label('Publicacion', 'F. de Publicación: ', ['class' => 'col-form-label']) !!}
            {!!  Form::date('Publication_date', $recordatorio->Publication_date, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
          {!!  Form::label('Expiracion', 'F. de Expiración: ', ['class' => 'col-form-label']) !!}
            {!!  Form::date('Ending_date', $recordatorio->Ending_date, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']) !!} 
        </div>
        <div class="col-lg-3"></div>
      </div>

      {!! Form::close() !!}
  </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').eq(0).html('{{$recordatorio->Text}}');
    $('.textarea').summernote({
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
        ],
         tooltip: false,
      }

    );
  })
</script>
@endsection