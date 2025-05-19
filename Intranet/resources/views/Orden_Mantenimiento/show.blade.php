@extends('layouts.app')
@section('content')
<br>
@include('flash::message')
@include('layouts.errors')
<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <div class="card">
      <div class="card-header bg-primary">
        <div class="row">
          <div class="col-md-8">
            Orden de Mantenimiento
          </div>
          <div class="col-md-2">
            <a href="{{ route('Orden_Mantenimiento.index') }}" style="float: right; color: white;"> <i class="fa fa-backspace"></i> Regresar </a>
          </div>
          <div class="col-md-2">
            <a href="{{ route('orden_pdf', [$orden->id, $orden->code]) }}" style="float: right; color: white;" target="_blank">
              Descargar PDF <i class="fa fa-file-pdf"></i>
            </a>
          </div>
        </div>
        
        
        
      </div>
      <div class="card-body">
        <table style="width: 100%;">
          <tr>
            <td style="width: 15%;">
              <strong>N° de Orden:</strong>
            </td>
            <td style="width: 15%;">
              {{ $orden->code }}
            </td>
            <td style="width: 55%;"></td>
            <td style="width: 15%; text-align: right;">
              {{ formato_fecha_hora($orden->aplication_date) }}
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <td class="bg-info disabled" style="width: 15%;">
              <strong>Realizada por:</strong>
            </td>
            <td style="width: 35%;">
              {{ obtener_empleado($orden->employee_id) }}
            </td>
            <td class="bg-info disabled" style="width: 15%;">
              <strong>Departamento:</strong>
            </td>
            <td>
              {{ obtener_departamento($orden->departament_id) }}
            </td>
          </tr>
          <tr>
            @if($orden->type_order_id <= 2)
            <td  class="bg-info disabled">
              <strong>Máquina:</strong>
            </td>
            <td style=" ">
              {{ obtener_maquina($orden->machine_id) }}
            </td>
            @endif
            @if($orden->type_order_id == 3)
            <td class="bg-info disabled" style="">
              <strong>Objeto:</strong>
            </td>
            <td  style=" ">
              {{ $orden->object }}
            </td>
            @endif
            @if($orden->type_order_id == 4)
            <td class="bg-info disabled" class="bg-info disabled" style="">
              <strong>Proyecto:</strong>
            </td>
            <td style=" ">
              {{ $orden->object }}
            </td>
            @endif
            <td class="bg-info disabled" style=" ">
              <strong>Prioridad:</strong>
            </td>
            @if($orden->priority_id != 4)
            <td style=" ">
              {{ obtener_prioridad($orden->priority_id) }}
            </td>
            @else
            <td style="">
              {{ obtener_prioridad($orden->priority_id).' - '.formato_fecha_hora($orden->scheduled_date) }}
            </td>
            @endif
          </tr>
          <tr>
            <td class="bg-info disabled" style="">
              <strong>Tipo de Orden:</strong>
            </td>
            <td style="">
              {{ obtener_tipo_orden($orden->type_order_id) }}
            </td>
            <td class="bg-info disabled" style="">
              <strong>Mantenimiento:</strong>
            </td>
            <td style="">
              {{ obtener_mantenimiento($orden->maintenance_id) }}
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
           <tr>
            <td class="bg-bluee" style="text-align: center;">
              <strong>Descripción breve del problema</strong>
            </td>
           </tr>
           <tr>
            <td>
              {{ $orden->description }}
            </td>
           </tr>    
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <td colspan="2" class="text-center bg-bluee" style="width: 50%;">
              <strong>Condiciones en las que se recibe el equipo: </strong>
            </td>
            <td class="text-center bg-bluee" style="width: 50%;">
              <strong>Evidencia al recibir el equipo: </strong>
            </td>
          </tr>
          <tr>
            <th class="bg-info disabled">Equipo limpio:</th>
            <td>
              @if($orden->received_clean )
                Si
              @else
                @if($orden->received_clean  === 0)
                  No
                @else
                  N/A
                @endif
              @endif
            </td>
            <td rowspan="5" class="text-center"> 
              @if($orden->received_image != null)
              <img src="http://10.0.0.8/Mantenimiento/img/Ordenes_imagenes/{{ $orden->received_image }}" width="70%" height="150">
              @endif
            </td>
          </tr>
          <tr>
            <th class="bg-info disabled">
              Causa de la falla:
            </th>
            <td>
              {{ ($orden->failure_id != null) ? obtener_falla($orden->failure_id) : "" }}
            </td>
          </tr>
          <tr>
            <th class="bg-info disabled">
              Fin de vida:
            </th>
            <td>
              @if($orden->end_life )
                Si
              @else
                @if($orden->end_life  === 0)
                  No
                @else
                  N/A
                @endif
              @endif
            </td>
          </tr>
          <tr>
            <th colspan="2" class="text-center bg-info disabled">
              Comentarios:
            </th>
          </tr>
          <tr>
            <td colspan="2">
              {{ $orden->first_comment }}
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <td colspan="2" class="bg-bluee text-center">
              Recepción por Mantenimiento
            </td>
          </tr>
          <tr>
            <th class="bg-info disabled" style="width: 16.6%;">
              Recibida por: 
            </th>
            <td style="width: 83.4%;">
              {{ obtener_staff($orden->id) }}
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <th class="bg-info disabled" style="width: 16.6%;">
              F. recepción:
            </th>
            <td >
              {{ ($orden->reception_date != null) ? formato_fecha_hora($orden->reception_date) : '--' }}
            </td>
            <th class="bg-info disabled" style="width: 16.6%;">
             F. inicio:
            </th>
            <td>
              {{ ($orden->start_date != null) ? formato_fecha_hora($orden->start_date) : '--' }}
            </td>
            <th class="bg-info disabled" style="width: 16.6%;">
              <strong>F. fin:</strong>
            </th>
            <td>
              {{ ($orden->ending_date != null) ? formato_fecha_hora($orden->ending_date) : '--' }}
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <th class="text-center bg-bluee" style="width: 50%;">
              Descripciones de acciones ejecutadas:
            </th>
            <th class="text-center bg-bluee" style="width: 50%;">
              Evidencia de acciones ejecutadas:
            </th>
          </tr>
          <tr>
            <td class="text-top">
              @php
               $actividades = obtener_lapsos_tiempo($orden->id);
              @endphp
              @foreach($actividades as $actividad)
               @if(formato_fecha($actividad->start_date) == formato_fecha($actividad->ending_date))
               - {{ formato_fecha($actividad->start_date)." ".formato_hora($actividad->start_date)." - ".formato_hora($actividad->ending_date)." ".$actividad->comment}}<br>
               @else
               - {{ formato_fecha_hora($actividad->start_date)." - ".formato_fecha_hora($actividad->ending_date)." ".$actividad->comment}}<br>
               @endif
              @endforeach
            </td>
            <td class="text-center">
              @if($orden->delivered_image != null)
              <img src="http://10.0.0.8/Mantenimiento/img/Ordenes_imagenes/{{ $orden->delivered_image }}" width="70%" height="150">
              @endif
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <th class="text-center bg-bluee" style=" width: 50%;">
              Refacciones:
            </th>
            <th class="text-center bg-bluee" style=" width: 50%;">
              Materiales:
            </th>
          </tr>
          <tr>
            <td class="text-top"> 
              @php
               $refacciones = obtener_refacciones($orden->id);
              @endphp  
              @foreach($refacciones as $refaccion)
               - {{ $refaccion->repair}}<br>
              @endforeach   
            </td>
            <td class="text-top">
              @php
               $materiales= obtener_materiales($orden->id);
              @endphp
              @foreach($materiales as $material)
               - {{ $material->material}}<br>
              @endforeach 
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <th colspan="2" style=" width: 50%;" class="text-center bg-bluee">
              Condiciones en las que se entrega el equipo:
            </th>
            <th style=" width: 50%;" class="text-center bg-bluee">
              Comentarios:
            </th>
          </tr>
          <tr>
            <th class="bg-info disabled">      
              <strong>Con limpieza:</strong>
            </th>
            <td>
              @if($orden->delivered_clean )
                Si
              @else
                @if($orden->delivered_clean  === 0)
                  No
                @else
                  N/A
                @endif
              @endif
            </td>
            <td rowspan="2" class="text-top">
              {{ $orden->second_comment }}
            </td>
          </tr>
          <tr>
            <th class="bg-info disabled">      
              En funcionamiento:
            </th>
            <td>
              @if($orden->functional )
                Si
              @else
                @if($orden->functional  === 0)
                  No
                @else
                  N/A
                @endif
              @endif
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered">
          <tr>
            <th colspan="2" class="text-center bg-bluee">
              Recepción por el departamento generador de la orden:
            </th>
          </tr>
          <tr>
            <th class="bg-info disabled" style="width: 50%;">
              Fecha de entrega de orden:
            </th>
            <td style="width: 50%;">
              {{ ($orden->ending_date != null) ? formato_fecha_hora($orden->ending_date) : "--"}}
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
      </div>
    </div>
  </div>
  <div class="col-lg-1"></div>
</div>



@endsection
@section('scripts')
<script type="text/javascript">
  
</script>
@endsection