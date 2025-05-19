<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, Sans-serif;">
	<h3>Solicitud de Sala de Juntas</h3>

	<strong>Tipo de Reunión:</strong> {!! $reservacion->Name !!}<br>
	<strong>Reservado por:</strong> {!! consulta_empleado($reservacion->Employee_id) !!}<br>
	<strong>Descripción:</strong> {!! $reservacion->Description !!}<br>
	
	<strong>Fecha:</strong> {!! Formato($reservacion->Date) !!} <strong>de</strong> {!! $reservacion->Time_start !!} <strong>a</strong> {!! $reservacion->Time_end !!}<br>
	@if($reservacion->Supplies != null)
	<strong>Insumos:</strong>
	<ul>
		@php
			$exp = explode(',', $reservacion->Supplies);
		@endphp
		@for($i = 0; $i < count($exp) - 1; $i++)
		<li>{!! $exp[$i] !!}</li>
		@endfor
	</ul>
	@else
	<strong>Insumos:</strong> N/A <br>
	@endif

	@if($reservacion->System != null)
	<strong>Equipo:</strong>
	<ul>
		@php
			$exp1 = explode(',', $reservacion->System);
		@endphp
		@for($i = 0; $i < count($exp1) - 1; $i++)
		<li>{!! $exp1[$i] !!}</li>
		@endfor
	</ul>
	@else
	<strong>Equipo:</strong> N/A <br>
	@endif

	<strong>Ubicación:</strong> {!! $reservacion->Place !!}<br><br>



	@if($request['Visits'] == 1)
	<strong>Personas que vistan:</strong> {!! $reservacion->People !!}<br>
		@if($request['Display'] == 1)
		<br>
		<strong> Se requiere pantalla de bienvenida</strong> <br>
		<strong>Empresa:</strong> {!! $reservacion->Visit !!}<br>
		@endif

		@if($request['Parking'] == 1)
		<br>
		<strong> Se requiere cajones de estacionamiento</strong> <br>
		<strong>Cajones: </strong> {{ $request['Estacionamiento'] }}<br>
		@endif
	
	@endif

	<h5>Nota: Para cancelar la reservación tendrá hasta una hora antes del horario propuesto, de lo contrario no podrá cancelarla y tendrá que notificar por medio de correo electrónico a Stefany.Roman@grupointerconsult.com y Capital.Humano@grupointerconsult.com </h5>

</body>
</html>