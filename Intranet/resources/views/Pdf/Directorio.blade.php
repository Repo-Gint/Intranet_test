<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style>
			table{
			  border: 0.2px solid black;
			  border-spacing: 0;
			  width: 100%;

			}
			th, td {
				border: 0.1px solid #DBDBDB;
			}
			th {
				text-align: center;
			}
			body {
                margin-top: 2.5cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 2cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 1cm;
                right: 1cm;
                height: 1cm;
            }
            footer {
                position: fixed; 
                bottom: -1px; 
                left: 1cm;
                right: 1cm;
                height: 50px; 
                font-size: 9px;
                color: #BFBFBF;
            }
            span{
            	color: #0074BD;
            }
            hr{
            	color: #0074BD;
            }

		</style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 10px;">
	<header>
		<img src="../public/img/img_encabezado.jpg" width="100%" height="85">
	</header>
	<footer>		
		<hr>
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
<br>
@if(!$empleados->isEmpty())
	<table >
		<thead>
			@if($opcion == "Mail")
			<tr style="background-color: #00A2FF; color: white;">
				<th colspan="6" style="text-align: center;">GRUPO INTERCONSULT</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th style="width: 20%;">Nombre</th>
				<th style="width: 14%;">Departamento</th>
				<th style="width: 25%;">Puesto</th>
				<th style="width: 8%;">Extensión</th>
				<th style="width: 8%;">Celular</th>
				<th style="width: 25%;">Correo</th>
    		</tr>
    		@endif
    		@if($opcion == "Sin Mail")
    		<tr style="background-color: #00A2FF; color: white;">
				<th colspan="5" style="text-align: center;">GRUPO INTERCONSULT</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Nombre</th>
				<th>Departamento</th>
				<th>Puesto</th>
				<th>Extensión</th>
				<th>Celular</th>
    		</tr>
    		@endif
		</thead>
		<tbody>
			@php $cnt = 0; @endphp

			@if($opcion == "Mail")
				@foreach($empleados as $empleado)
				@if(!empty($empleado->Business_mail) )
					@php $cnt++; @endphp
					@if($cnt%2 == 0)
					<tr style="background-color: rgb(205,205,205, 0.5);">
					@else
					<tr>
					@endif
						<td>{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</td>
						<td>{{ $empleado->Departament_ES }}</td>
						<td>{{ $empleado->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Extension}}</td>
						<td style="text-align: center;">{{ $empleado->Business_phone}}</td>
						<td>{{ $empleado->Business_mail }}</td>
					</tr>
					@endif
				@endforeach
			@endif

			@if($opcion == "Sin Mail")
				@foreach($empleados as $empleado)
				@if(!empty($empleado->Business_mail) )
					@php $cnt++; @endphp
					@if($cnt%2 == 0)
					<tr style="background-color: rgb(205,205,205, 0.5);">
					@else
					<tr>
					@endif
						<td>{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</td>
						<td>{{ $empleado->Departament_ES }}</td>
						<td>{{ $empleado->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Extension}}</td>
						<td style="text-align: center;">{{ $empleado->Business_phone}}</td>
					</tr>
					@endif
				@endforeach
			@endif
		</tbody>	
	</table>
@else
	<center><h2>No se encontraron registros del departamento, o sucedio un error en la consulta.</h2></center>
@endif
</body>
</html>