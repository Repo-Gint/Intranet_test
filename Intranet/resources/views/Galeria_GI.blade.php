@extends('layouts.app')
@section('content')
@php
  $fechas = fechas_galeria();
  $albums = App\Galeria_Album::orderBy('Publication_date', 'DESC')->get();
@endphp 
@include('flash::message')
@include('layouts.errors')
<div class="card ">
  <div class="card-header p-0">
    <img src="{{ asset("img/galeria.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
  </div>
  <div class="card-body">
    <div class="row d-flex align-items-stretch"> 
      @foreach($albums as $album)
      <div class="col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
        <div class="card">
          @foreach($album->Galeria as $foto)
          @php
            $img = $foto->Name_picture;
            break;
          @endphp
          @endforeach
          @if($img ?? '' != NULL && !empty($img ?? ''))
          <img src="{{ asset('img/Galeria/'.$album->Name.'/thumb/thumb-'.$img ?? '') }}" class="card-img-top" alt="...">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $album->Name }}</h5>
            <p class="card-text">Publicado: {{ Formato($album->Publication_date) }}</p>
          </div>
          <div class="card-footer">
            <a href="{{ route('Galeria_Album.show', $album->id) }}" class="btn btn-primary btn-sm btn-block">Ver Álbum</a>
          </div>
        </div>
      </div>
      @endforeach   
    </div>
  </div>
</div>
@endsection
@section('javascript')
@endsection