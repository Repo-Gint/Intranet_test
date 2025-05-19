<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, Sans-serif;">
	<h3>Nueva orden de mantenimiento creada</h3>

	<strong>Orden:</strong> {!! $orden->code!!}<br>
	<strong>Fecha:</strong> {!! $orden->aplication_date !!}<br>
	<strong>Usuario:</strong> {!! obtener_empleado($orden->employee_id) !!}<br>
	<strong>Departamento:</strong> {!! obtener_departamento($orden->departament_id) !!}<br>
	@if($orden->type_order_id <= 2)
	<strong>Máquina:</strong> {!! obtener_maquina($orden->machine_id) !!}<br>
	@endif
	@if($orden->type_order_id == 3)
	<strong>Objeto:</strong> {!! $orden->object !!}<br>
	@endif
	@if($orden->type_order_id == 4)
	<strong>Proyecto:</strong> {!! $orden->object !!}<br>
	@endif
	<strong>Descripción:</strong> {!! $orden->description !!}<br>
</body>
</html>