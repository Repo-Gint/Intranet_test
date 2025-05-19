@section('style')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@extends('layouts.app')
@section('content')
<div class="callout callout-info">
  <h2>{{ $album->Name }}</h2>
  <p>Publicado: {{ Formato($album->Publication_date) }}</p>
</div>
<div class="card">
  <div class="card-body">
    <div class="row justify-content-center">
      @foreach($album->Galeria as $galeria)
        <div class="col-sm-2">
          <div class="card" >
            <div class="card-body" style="padding: 0; margin: 0;">
              <a  href="{{ asset('img/Galeria/'.$album->Name.'/'.$galeria->Name_picture) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                <img src="{{ asset('img/Galeria/'.$album->Name.'/thumb/thumb-'.$galeria->Name_picture) }}" class="img-fluid mb-1" alt="white sample"/>
              </a>
            </div>
            <div class="card-footer" style="padding: 0; margin: 5px; text-align: center;">
              <a href="{{ route('descargar_foto', [$album->Name, $galeria->Name_picture ]) }}">
                <button class="btn success"><i class="fa fa-download"></i></button>
              </a>
            </div>
          </div>
        </div>    
      @endforeach
    </div>
  </div>
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