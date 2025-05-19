@section('style')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@extends('layouts.app')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <div class="callout callout-info">
      <h2>{{ $aviso->Name }}</h2>
      <p>
        Fecha de Publicación: <strong>{{ Formato($aviso->Publication_date) }}</strong> al <strong>{{ Formato($aviso->End_date) }}</strong>
      </p>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
              {!! $aviso->Description !!}
          </div>
          <div class="col-lg-6">
            <img src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image) }}" class="rounded mx-auto d-block img-fluid">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-1"></div>
          <div class="col-lg-10" style="text-align: center;">
            @if($archivos != null || $imagenes =! null)
            <hr>
            <h4>Archivos Adjuntos:</h4>
            <div class="row justify-content-center">
              @if($imagenes->isNotEmpty())
              <div class="col-lg-6">
                @foreach($imagenes as $imagen)
                  <a href="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$imagen->Name_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                    <img src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$imagen->Name_image) }}" class="img-fluid mb-5" alt="" width="20%" />
                  </a>
                @endforeach
              </div>
              @endif
              @if($archivos->isNotEmpty())
              <div class="col-lg-6">
                <ul style="outline-style: none; list-style: none;">
                  @foreach($archivos as $archivo)
                    <li>
                      {{ $archivo->Name_file }} 
                      <a href="{{ route('Aviso.download', $archivo->id) }}">
                        <span class="badge badge-light"><i class="fa fa-download"></i></span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            @endif
            @if($aviso->Maps != null)
            <hr>
            <h4>Ubicación:</h4>
            {!! $aviso->Maps !!}
            @endif
          </div>
          <div class="col-lg-1"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-1"></div>
</div>

@endsection
@section('javascript')
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
})
</script>
@endsection