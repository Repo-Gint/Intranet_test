@section('style')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Módulos de Usuario / Gestor de Galeria')
@section('content')
@include('flash::message')
@include('layouts.errors')
<div class="row justify-content-center">
  @can('Galeria.create')
  <div class="col-lg-3 col-md-4">
    <div class="row">
      @can('Galeria_Album.create')
      <div class="col">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Apartados</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['route' => 'Galeria_Album.store', 'method' => 'POST']) !!}
              {!!  Form::label('Album', 'Álbum: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
              {!!  Form::label('Fecha de publicación', 'Fecha de publicación: ', ['class' => 'col-form-label']) !!}
              {!!  Form::date('Publication_date', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
          </div>
          <div class="card-footer">
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
            {!! Form::open(['route' => 'Galeria.store', 'method' => 'POST', 'files' => true]) !!}
              {!!  Form::label('Album', 'Álbum: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('Album_id', $albums_lista, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un album', 'required']) !!}
              {!!  Form::label('Archivos', 'Selecciona tus archivos: ', ['class' => 'col-form-label']) !!}
              {!!  Form::file('Name_picture[]', [ 'accept' => '.jpg, .jpeg, .png', 'multiple', 'style' => 'font-size: 13px;', 'required']) !!} 
          </div>
          <div class="card-footer">
            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']) !!} 
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @endcan
  <div class="col-lg-9 col-md-8">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Álbums</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              @foreach($albums as $album)
                <a class="nav-link" id="{{ $album->Slug }}-tab" data-toggle="pill" href="#{{ $album->Slug }}" role="tab" aria-controls="{{ $album->Slug }}" aria-selected="false">
                  {{ $album->Name }}
                </a>
                
              @endforeach
            </div>
          </div>
          <div class="col-8">
            <div class="tab-content" id="v-pills-tabContent">
              @foreach($albums as $album)
              <div class="tab-pane fade" id="{{ $album->Slug }}" role="tabpanel" aria-labelledby="{{ $album->Slug }}-tab">

                <div class="row justify-content-center">
                  @can('Galeria_Album.edit')
                  <div class="col-lg-6">
                    <button class="btn btn-primary btn-sm btn-block Editar_Album" data-toggle="modal" data-target="#Editar_Album" id="{{ $album->id }}">Editar Album</button>
                  </div>
                  @endcan
                  @can('Galeria_Album.destroy')
                  <div class="col-lg-6">
                    <a href="{{ route('Galeria_Album.destroy', $album->id) }}">
                      <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('¿Seguro de eliminar el album? Al eliminar el album, se eliminarán sus fotos.')">Eliminar Album</button>
                    </a>
                  </div>
                  @endcan
                </div>
                <br>
                <div class="row">
                  @foreach($album->Galeria as $galeria)
                    <div class="col-lg-2 col-md-6 col-sm-6">
                      <div class="card" >
                        <div class="card-body" style="padding: 0; margin: 0;">
                          <a href="{{ asset('img/Galeria/'.$album->Name.'/'.$galeria->Name_picture) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                            <img src="{{ asset('img/Galeria/'.$album->Name.'/thumb/thumb-'.$galeria->Name_picture) }}" class="img-fluid mb-1" alt="white sample"/>
                          </a>
                        </div>
                        <div class="card-footer" style="padding: 0; margin: 5px; text-align: center;">
                          {{-- <button class="btn btn-danger btn-sm badge badge-danger" onclick="Eliminar_Foto({{ $galeria->id }})"><i class="fa fa-trash"></i></button>--}}
                           @can('Galeria.destroy')
                          <a href="{{ route('Galeria.destroy', $galeria->id) }}">
                            <button class="btn btn-danger btn-sm badge badge-danger"><i class="fa fa-trash"></i></button>
                          </a>
                          @endcan
                          @can('Galeria.download')
                          <a href="{{ route('descargar_foto', [$album->Name, $galeria->Name_picture ]) }}">
                            <button class="btn btn-default btn-sm badge badge-default"><i class="fa fa-download"></i></button>
                          </a>
                          @endcan
                        </div>
                      </div>
                    </div>    
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Editar_Album" tabindex="-1" role="dialog" aria-labelledby="Editar_AlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Editar_AlbumLabel">Editar Album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => array('Galeria_Album.update', 0), 'method' => 'PUT']) !!}
          {!!  Form::label('Album', 'Album: ', ['class' => 'col-form-label']) !!}
          {!!  Form::hidden('id', null, ['id' => 'id_album']) !!}<br>
          {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}<br>
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
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.Editar_Album').click(function(){
        var id = $(this).attr("id");
        $('#id_album').val(id);
    });
  })


function Eliminar_Foto (id){
    if( ! confirm("¿Esta seguro de eliminar la foto?"+id)){
      return false;
    }

 }


  
</script>
@endsection