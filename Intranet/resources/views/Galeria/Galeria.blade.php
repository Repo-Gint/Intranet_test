@php
  $albums = App\Galeria_Album::get();
  use Illuminate\Support\Facades\Storage;
@endphp

@foreach($albums as $album)
  <!-- start course content container -->
  <div id="album_{{ $album->id }}" class="alb" style="display: none;">
    <div class="mu-course-container mu-course-details" id="{{ $album->id }}">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-latest-course-single">
            <div class="mu-latest-course-single-content">
              <button class="btn btn-primary   btn-xs Editar_Separador" style="float: right; margin: 2px;" id="{{ $album->id }}"><i class="fa fa-edit"></i></button>
                <a href="{{ route('Galeria_Album.destroy', $album->id) }}">
                    <button class="btn btn-danger  btn-xs " onclick="return confirm('¿Seguro de eliminar el album? Al eliminar el album, se eliminara los archivos que se encuentren asociados')" style="float: right; margin: 2px;"><i class="fa fa-trash-o"></i></button>
                </a> 
              <h2><a href="#">Album: {{ $album->Name }}</a></h2>
                <div class="table-responsive">
                <table class="table table-hover">
                  @foreach($album->Galeria as $imagen)
                    <tr>
                      <td style="text-align: center; width: 10%;">
                        <img src="{{ asset('img/Galeria/'.nombre_album($album->id).'/'.$imagen->Name_picture) }}" width="50" height="50">
                      </td>
                      <td style="width: 70%;">{{ $imagen->Name_picture }}</td>
                      <td style="text-align: center; width: 10%;">
                          <a href="{{ route('Galeria.destroy', $imagen->id) }}">
                              <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar el archivo?')"><i class="fa fa-trash-o"></i></button>
                          </a> 
                      </td>
                      
                    </tr>
                  @endforeach
                </table>
                </div>
              
              
              </div>
            </div> 
          </div>                                   
        </div>
      </div>
    </div>
  <!-- end course content container -->
@endforeach

