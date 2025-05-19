<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style>
			body {
        margin-top: 0cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;
      }
      span{
      	color: #0074BD;
      }
		</style>
	</head>
<body style="font-family: Arial, Sans-serif;">
  <table style="width: 100%; border-spacing: 0;">
    <tr style=" border: 1px solid #333;">
      <td style="width: 20%; border: 1px solid #333; text-align: center;">
        <img src="../public/img/logo.png" width="120" height="60">
      </td>
        <td style="width: 60%; border: 1px solid #333; margin: 0; padding: 0;">
            <table style="width: 100%; border-spacing: 0; ">
                <tr>
                  <td style="border-right: none; border-left: none; border-top: none; text-align: center; font-size: 12pt;">
                    <STRONG>Orden de Mantenimiento</STRONG><br><br>
                  </td>
                </tr>
                <tr>
                  <td style="border-top: 1px solid black; text-align: center; font-size: 10pt;">
                    <strong>Responsable: </strong> Mantenimiento
                  </td>
                </tr>
            </table>
        </td>
      <td style="width: 20%; border: 1px solid #333; padding: 0; font-size: 8pt;">
        <table style="width: 100%; border-spacing: 0;">
          <tr>
            <td style="border-bottom: 1px solid black;">Código: FO.MAN.001</td>
          </tr>
          <tr>
            <td style="border-bottom: 1px solid black;">Versión: 1</td>
          </tr>
          <tr>
            <td style="border-bottom: 1px solid black;">Edición: 04.09.2017</td>
          </tr>
          <tr>
            <td >Página 1 de 1</td>
          </tr>
        </table>
      </td>
    </tr>
  </table><br>
  <table style=" width: 100%; font-size: 9pt;">
    <tr>  
       <td style="width: 15%; text-align: right;">
        {{ formato_fecha_hora($orden->aplication_date) }}
      </td>
      <td style="width: 55%;"></td>
       <td style="width: 15%;">
          <strong>N° de Orden:</strong>
        </td>
        <td style="width: 15%;">
          {{ $orden->code }}
        </td>
    </tr>
  </table>
  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      @if($orden->type_order_id <= 2)
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Máquina:</strong>
      </td>
      <td style=" border: 0.5px solid #333;">
        {{ obtener_maquina($orden->machine_id) }}
      </td>
      @endif
      @if($orden->type_order_id == 3)
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Objeto:</strong>
      </td>
      <td style=" border: 0.5px solid #333;">
        {{ $orden->object }}
      </td>
      @endif
      @if($orden->type_order_id == 4)
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Proyecto:</strong>
      </td>
      <td style=" border: 0.5px solid #333;">
        {{ $orden->object }}
      </td>
      @endif
      <td style=" border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Prioridad:</strong>
      </td>
      @if($orden->priority_id != 4)
      <td style=" border: 0.5px solid #333;">
        {{ obtener_prioridad($orden->priority_id) }}
      </td>
      @else
      <td style="border: 0.5px solid #333;">
        {{ obtener_prioridad($orden->priority_id).' - '.formato_fecha_hora($orden->scheduled_date) }}
      </td>
      @endif
    </tr>
     <tr>
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Tipo de Orden:</strong>
      </td>
      <td style="border: 0.5px solid #333;">
        {{ obtener_tipo_orden($orden->type_order_id) }}
      </td>
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Mantenimiento:</strong>
      </td>
      <td style="border: 0.5px solid #333;">
        {{ obtener_mantenimiento($orden->maintenance_id) }}
      </td>
    </tr>
    <tr>
      <td style="width: 15%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Realizada por:</strong>
      </td>
      <td style="width: 35%; border: 0.5px solid #333;">
        {{ obtener_empleado($orden->employee_id) }}
      </td>
      <td style="width: 15%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Departamento:</strong>
      </td>
      <td style="width: 35%; border: 0.5px solid #333;">
        {{ obtener_departamento($orden->departament_id) }}
      </td>
    </tr>
  </table>

  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
     <tr>
      <td style="border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Descripción breve del problema</strong>
      </td>
     </tr>
     <tr>
      <td style="border: 0.5px solid #333;">
        {{ $orden->description }}
      </td>
     </tr>    
  </table>

  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
     <tr>
      <td style="width:50%; border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Condiciones en las que se recibe el equipo: </strong>
      </td>
      <td style="width:50%; border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Evidencia al recibir el equipo: </strong>
      </td>
     </tr>
     <tr>
      <td style=" border: 0.5px solid #333; vertical-align: text-top;">
        <table style="border-spacing: 0; width: 100%; font-size: 9pt; ">
          <tr>
            <td style="width: 35%; border: 0.5px solid #333; border-top: none; border-left: none; background-color: #A6F1FF;">
              <strong>Equipo limpio:</strong>
            </td>
            <td style="width: 75%; border: 0.5px solid #333; border-top: none; border-right: none;">
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
           </tr>
          <tr>
            <td style="border: 0.5px solid #333; border-left: none; background-color: #A6F1FF;">
              <strong>Causa de la falla:</strong>
            </td>
            <td style="border: 0.5px solid #333; border-right: none;">
              {{ ($orden->failure_id != null) ? obtener_falla($orden->failure_id) : "" }}
            </td>
           </tr>
           <tr>
            <td style="border: 0.5px solid #333; border-left: none; background-color: #A6F1FF;">
              <strong>Fin de vida:</strong>
            </td>
            <td style="border: 0.5px solid #333; border-right: none;">
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
            <td colspan="2" style="border: 0.5px solid #333; border-left: none; border-right: none; text-align: center; background-color: #A6F1FF;">
              <strong>Comentarios:</strong>
            </td>
           </tr>    
           <tr>
            <td colspan="2" style="border: 0.5px solid #333; vertical-align: text-top; height: 70px; border-right: none; border-bottom: none;border-left: none;">
              {{ $orden->first_comment }}
            </td>
           </tr>
        </table>
      </td>
      <td style="border: 0.5px solid #333; text-align:center;">
        @if($orden->received_image != null)
        <img src="http://localhost/Mantenimiento/img/Ordenes_imagenes/{{ $orden->received_image }}"  height="150">
        @endif
      </td>
     </tr>     
  </table>
  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td style="width:16.6%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Recibida por: </strong>
      </td>
      <td style="width:83.4%; border: 0.5px solid #333;">
        {{ obtener_staff($orden->id) }}
      </td>
    </tr>
  </table>
  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td style=" width: 16.6%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>F. recepción:</strong>
      </td>
      <td style=" width: 16.6%; ;border: 0.5px solid #333; text-align: center;">
        {{ ($orden->reception_date != null) ? formato_fecha_hora($orden->reception_date) : '--' }}
      </td>
      <td style=" width: 16.6%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>F. inicio:</strong>
      </td>
      <td style=" width: 16.6%; ;border: 0.5px solid #333; text-align: center;">
        {{ ($orden->start_date != null) ? formato_fecha_hora($orden->start_date) : '--' }}
      </td>
      <td style=" width: 16.6%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>F. fin:</strong>
      </td>
      <td style=" width: 16.6%; ;border: 0.5px solid #333; text-align: center;">
        {{ ($orden->ending_date != null) ? formato_fecha_hora($orden->ending_date) : '--' }}
      </td>
    </tr>
  </table>

  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td style=" width: 50%; border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Descripciones de acciones ejecutadas:</strong>
      </td>
      <td style=" width: 50%; ;border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Evidencia de acciones ejecutadas:</strong>
      </td>
    </tr>
    <tr>
      <td style="border: 0.5px solid #333;height: 150px; vertical-align: text-top;">
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
      <td style="border: 0.5px solid #333; text-align: center;">
        @if($orden->delivered_image != null)
        <img src="http://localhost/Mantenimiento/img/Ordenes_imagenes/{{ $orden->delivered_image }}" width="40%" height="150">
        @endif
      </td>
    </tr>
  </table>
  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td style=" width: 50%; border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Refacciones:</strong>
      </td>
      <td style=" width: 50%; ;border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Materiales:</strong>
      </td>
    </tr>
    <tr>
      <td style="border: 0.5px solid #333; vertical-align: text-top; height: 110px;">   
        @php
         $refacciones = obtener_refacciones($orden->id);
        @endphp  
        @foreach($refacciones as $refaccion)
         - {{ $refaccion->repair}}<br>
        @endforeach   
      </td>
      <td style="border: 0.5px solid #333; vertical-align: text-top;">
        @php
         $materiales= obtener_materiales($orden->id);
        @endphp
        @foreach($materiales as $material)
         - {{ $material->material}}<br>
        @endforeach 
      </td>
    </tr>
  </table>

  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td colspan="2" style=" width: 50%; border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Condiciones en las que se entrega el equipo:</strong>
      </td>
      <td style=" width: 50%; ;border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Comentarios:</strong>
      </td>
    </tr>
    <tr>
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">      
        <strong>Con limpieza:</strong>
      </td>
      <td style="border: 0.5px solid #333;">
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
      <td rowspan="2" style="border: 0.5px solid #333; vertical-align: text-top; height: 50px;">
        {{ $orden->second_comment }}
      </td>
    </tr>
    <tr>
      <td style="border: 0.5px solid #333; background-color: #A6F1FF;">      
        <strong>En funcionamiento:</strong>
      </td>
      <td style="border: 0.5px solid #333;">
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
  <table style="border-spacing: 0; width: 100%; font-size: 9pt;">
    <tr>
      <td colspan="2" style="border: 0.5px solid #333; text-align: center;  background-color: #003389; color: white;">
        <strong>Recepción por el departamento generador de la orden:</strong>
      </td>
    </tr>
    <tr>
      <td style="width: 25%; border: 0.5px solid #333; background-color: #A6F1FF;">
        <strong>Fecha de entrega de orden:</strong>
      </td>
      <td style="width: 75%; border: 0.5px solid #333;">
        {{ ($orden->ending_date != null) ? formato_fecha_hora($orden->delivery_date) : '--' }}
      </td>
    </tr>
  </table>

  <table style="border-spacing: 0; width: 100%; font-size: 9pt;  text-align: center;">
    <tr>
      <td colspan="2" style="border: 0.5px solid #333;  background-color: #003389; color: white;">
        <strong>Vo. Bo.</strong>
      </td>
    </tr>
    <tr>
      <td style="width: 50%; border: 0.5px solid #333; height: 50px;">
        {{ obtener_empleado($orden->employee_id) }}
      </td>
      <td style="width: 50%; border: 0.5px solid #333;">
        
      </td>
    </tr>
    <tr>
      <td style="border: 0.5px solid #333; font-size: 8pt;">
        <strong>Solicitante <br>
        Nombre y Firma</strong>
      </td>
      <td style="border: 0.5px solid #333; font-size: 8pt;">
        <strong>Mantenimiento <br>
        Nombre y Firma</strong>
      </td>
    </tr>
  </table>
</body>
</html>