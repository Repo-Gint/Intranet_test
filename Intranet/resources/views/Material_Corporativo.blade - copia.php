@php
  $departamentos = App\Departamento_rrhh::get();
  $empleado = auth()->user()->Empleado_rrhh;
  $puesto = $empleado->Puesto->last();
  $dep = $puesto->Departamento;
@endphp
@extends('layouts.app')
@section('content')
@include('flash::message')
@include('layouts.errors')
<div class="row">
  <div class="col-lg-12">
    <div class="card bg-navidad-seccion shadow">
      <div class="card-header p-0">
        <img src="{{ asset("img/Navidad/material_corporativo.jpg") }}" class="img-fluid m-0 p-0 rounded-top" style="width: 100%; height: 100px;">
      </div>
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-2 col-sm-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              @foreach($departamentos as $departamento)
                @if($departamento->id == $dep->id)
                <a class="nav-link active" id="{{ $departamento->Slug }}-tab" data-toggle="pill" href="#{{ $departamento->Slug }}" role="tab" aria-controls="{{ $departamento->Slug }}" aria-selected="true">{{ $departamento->Departament_ES }}</a>
                @else
                <a class="nav-link" id="{{ $departamento->Slug }}-tab" data-toggle="pill" href="#{{ $departamento->Slug }}" role="tab" aria-controls="{{ $departamento->Slug }}" aria-selected="false">{{ $departamento->Departament_ES }}</a>
                @endif
              @endforeach
            </div>
          </div>
          <div class="col-md-10 col-sm-9" style="overflow-y: auto;">
            <div class="tab-content" id="v-pills-tabContent">
              @foreach($departamentos as $departamento)
              @if($departamento->id == $dep->id)
                <div class="tab-pane fade show active" id="{{ $departamento->Slug }}" role="tabpanel" aria-labelledby="{{ $departamento->Slug }}-tab">
              @else
                <div class="tab-pane fade" id="{{ $departamento->Slug }}" role="tabpanel" aria-labelledby="{{ $departamento->Slug }}-tab">
              @endif
                @php
                  $separadores = App\Gestor_Archivo_Separador::where('Departament_id', $departamento->id)->orderBy('Name', 'ASC')->get();
                @endphp
                <strong><h2>{{ $departamento->Departament_ES }}</h2></strong>
                <table class="table table-bordered table-sm">
                  @foreach($separadores as $separador)
                    <tr style="background-color: #0051CB; color: white;">
                      <td colspan="3"><i class="fa fa-folder"></i> {{ $separador->Name }}</td>
                    </tr>
                    @foreach($separador->Gestor_Archivo()->orderBy('Name_file', 'ASC')->get() as $archivo)
                    <tr>
                      <td style="text-align: center;">{!! tipo_de_documento($archivo->Name_file) !!}</td>
                      <td>{{ $archivo->Name_file }}</td>
                      <td style="text-align: center;">
                        <a href="{{ route('Gestor_Archivo.download', $archivo->id) }}">
                          <button class="btn btn-default badge badge-danger"><i class="fa fa-download"></i></button>
                        </a> 
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



@endsection
@section('javascript')
<script type="text/javascript">
</script>
@endsection
