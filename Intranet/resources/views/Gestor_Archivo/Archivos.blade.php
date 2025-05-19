@php
  $departamentos = App\Departamento_rrhh::get();
@endphp

@foreach($departamentos as $departamento)
  <!-- start course content container -->
  <div id="departamento_{{ $departamento->id }}" class="dep" style="display: none;">
    <div class="mu-course-container mu-course-details" id="{{ $departamento->id }}">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-latest-course-single">
            <div class="mu-latest-course-single-content">
              <h2><a href="#">Departamento: {{ $departamento->Departament_ES }}</a></h2>
              @php
                $separadores = App\Gestor_Archivo_Separador::where('Departament_id', $departamento->id)->get();     
              @endphp
              @foreach($separadores as $separador)
                <button class="btn btn-primary   btn-xs Editar_Separador" style="float: right; margin: 2px;" id="{{ $separador->id }}"><i class="fa fa-edit"></i></button>
                <a href="{{ route('Gestor_Archivo_Separador.destroy', $separador->id) }}">
                    <button class="btn btn-danger  btn-xs " onclick="return confirm('¿Seguro de eliminar la sección? Al eliminar la sección, se eliminara los archivos que se encuentren asociados')" style="float: right; margin: 2px;"><i class="fa fa-trash-o"></i></button>
                </a> 
                <h4>{{ $separador->Name }}</h4>
                <div style="display: none;">
                  {{ $separador->id }}
                </div>
                <div class="table-responsive">
                <table class="table table-hover">
                  @foreach($separador->Gestor_Archivo as $archivo)
                    <tr>
                      <td style="text-align: center; width: 10%;">
                        <img src="{{ asset('img/'.elegir_icon($archivo->Name_file)) }}" width="25" height="25">
                      </td>
                      <td style="width: 70%;">{{ $archivo->Name_file }}</td>
                      <td style="text-align: center; width: 10%;">
                          <a href="{{ route('Gestor_Archivo.destroy', $archivo->id) }}">
                              <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar el archivo?')"><i class="fa fa-trash-o"></i></button>
                          </a> 
                      </td>
                      <td style="text-align: center; width: 10%;">
                          <a href="{{ route('descargar_archivo', $archivo->Name_file) }}">
                              <button class="btn btn-default" ><i class="fa fa-download"></i></button>
                          </a> 
                      </td>
                    </tr>
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
  <!-- end course content container -->
@endforeach
<!-- start course content container -->
  <div id="departamento_1000" class="dep">
    <div class="mu-course-container mu-course-details" id="1000">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-latest-course-single">
            <div class="mu-latest-course-single-content">
              <h2><a href="#">Material Corporativo</a></h2> 
              @php
                $separadores = App\Gestor_Archivo_Separador::where('Departament_id', 1000)->get();     
              @endphp
              @foreach($separadores as $separador)      
                <button class="btn btn-primary btn-xs Editar_Separador" style="float: right; margin: 2px;" id="{{ $separador->id }}"><i class="fa fa-edit"></i></button>
                <a href="{{ route('Gestor_Archivo_Separador.destroy', $separador->id) }}">
                    <button class="btn btn-danger  btn-xs " onclick="return confirm('¿Seguro de eliminar la sección? Al eliminar la sección, se eliminara los archivos que se encuentren asociados')" style="float: right; margin: 2px;"><i class="fa fa-trash-o"></i></button>
                </a> 
                <h4>{{ $separador->Name }}</h4>
                <div class="table-responsive">
                <table class="table table-hover">
                  @foreach($separador->Gestor_Archivo as $archivo)
                    <tr>
                      <td style="text-align: center; width: 10%;">
                        <img src="{{ asset('img/'.elegir_icon($archivo->Name_file)) }}" width="25" height="25">
                      </td>
                      <td style="width: 70%;">{{ $archivo->Name_file }}</td>
                      <td style="text-align: center; width: 10%;">
                          <a href="{{ route('Gestor_Archivo.destroy', $archivo->id) }}">
                              <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar el archivo?')"><i class="fa fa-trash-o"></i></button>
                          </a> 
                      </td>
                      <td style="text-align: center; width: 10%;">
                          <a href="{{ route('descargar_archivo', $archivo->Name_file) }}">
                              <button class="btn btn-default" ><i class="fa fa-download"></i></button>
                          </a> 
                      </td>
                    </tr>
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
  <!-- end course content container -->
