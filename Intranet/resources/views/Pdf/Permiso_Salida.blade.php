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
            hr{
            	color: #0074BD;
            }

		</style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 12px;">
@for($i=0; $i < 2; $i++)
	<table style="width: 100%; border-spacing: 0;">
            <tr style=" border: 1px solid #333;">
                <td style="width: 20%; border: 1px solid #333; text-align: center;">
                    <img src="../public/img/logo.png" width="120" height="60">
                </td>
                <td style="width: 60%; border: 1px solid #333; margin: 0; padding: 0;">
                	<table style="width: 100%; border-spacing: 0; ">
                		<tr style="font-size: 16px;">
                			<td style="border-right: none; border-left: none; border-top: none; text-align: center;">
                				<br><STRONG>Solicitud de Permiso</STRONG><br><br>
                			</td>
                		</tr>
                		<tr>
                			<td style="border-top: 1px solid black; text-align: center;">
                			 	<strong>Responsable: </strong> Recursos Humanos
                			</td>
                		</tr>
                	</table>
                </td>
                <td style="width: 20%; border: 1px solid #333; padding: 0;">
                	<table style="width: 100%; border-spacing: 0;">
                		<tr>
                			<td style="border-bottom: 1px solid black;">Código: FO.RHH.021</td>
                		</tr>
                		<tr>
                			<td style="border-bottom: 1px solid black;">Versión: 2</td>
                		</tr>
                		<tr>
                			<td style="border-bottom: 1px solid black;">Edición: 07.11.2019</td>
                		</tr>
                		<tr>
                			<td >Página 1 de 1</td>
                		</tr>
                	</table>
                </td>
            </tr>
        </table> <br>
		<table style="width: 100%; ">
			<tr >
				<td style="width: 20%;"></td>

                <td style="width: 5%;  text-align:center; border: 1px solid black;">{{ ($request['enjoy_salary'] == 0) ? 'X' : ''}}</td>
				<td style="width: 20%; text-align:center;">
					Sin goce de sueldo
				</td>

                <td style="width: 10%;"></td>

                <td style="width: 5%;  text-align:center; border: 1px solid black;">{{ ($request['enjoy_salary'] == 1) ? 'X' : ''}}</td>
				<td style="width: 20%; text-align:center;">
            		 Con goce de sueldo
            	</td>
                <td style="width: 20%;"></td>
			</tr>
        </table><br>

        <table style="width: 100%;">
			<tr >
				<td style="width: 5%;">
					Fecha:
				</td>
				<td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
					{{ date('d.m.Y') }}
				</td>
                <td style="width: 35%;"></td>
				<td style="width: 15%;">
            		No.- Nómina:
            	</td>
            	<td style="width: 20%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Nomina'] }}
            	</td>
			</tr>
        </table>

        <table style="width: 100%;">
			<tr >
				<td style="width: 25%;">
					Nombre del trabajador:
				</td>
				<td style="width: 75%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Nombre'] }}
				</td>
			</tr>
        </table>
        <table style="width: 100%;">
			<tr >
				<td style="width: 10%;">
					Área:
				</td>
				<td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Departamento'] }}
				</td>
                <td style="width: 15%;"></td>
				<td style="width: 25%; text-align: right;">
            		Horario laboral:
            	</td>
            	<td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
            		{{ $request['working_hours'] }}
            	</td>
			</tr>
        </table>
        <table style="width: 100%;">
			<tr >
				<td style="width: 10%;">
					El Día(s):
				</td>
				<td style="width: 30%; border-bottom: 1px solid #333; text-align: center;">
					{{ Formato($request['date']) }}
				</td>
				<td style="width: 10%; text-align: center;">
            		De las:
            	</td>
            	<td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
            		{{ $request['departure_time'] }}
            	</td>
            	<td style="width: 10%; text-align: center;">
            		a las:
            	</td>
            	<td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
            		{{ $request['return_time'] }}
            	</td>
			</tr>
        </table>
        <table style="width: 100%;">
			<tr >
				<td style="width: 10%;">
					Motivo:
				</td>
				<td style="width: 90%; border-bottom: 1px solid #333; text-align: center;">
					{{ $request['reason'] }}
				</td>
			</tr>
        </table>
        <br>
        *En caso de ser <strong>CON GOCE DE SUELDO</strong> se <strong>PAGARA</strong> con:  <br><br>
        <table style="width: 100%;">
			<tr >
                <td style="width: 20%;"></td>

                <td style="width: 5%;  text-align:center; border: 1px solid black;">{{ ($request['way_to_pay'] == 'tiempoxtiempo') ? 'X' : ''}}</td>
                <td style="width: 20%; text-align:center;">
                    Tiempo por tiempo
                </td>

                <td style="width: 10%;"></td>

                <td style="width: 5%;  text-align:center; border: 1px solid black;">{{ ($request['way_to_pay'] == 'n/a') ? 'X' : ''}}</td>
                <td style="width: 20%; text-align:center;">
                    N/A
                </td>
                <td style="width: 20%;"></td>
            </tr>
        </table>
        <br><br><br><br>
        <table style="width: 100%;">
            <tr >
                <td style="width: 30%; border-bottom: 1px solid black;"></td>
                <td style="width: 5%;"></td>
                <td style="width: 30%; border-bottom: 1px solid black;"></td>
                <td style="width: 5%;"></td>
                <td style="width: 30%; border-bottom: 1px solid black;"></td>
            </tr>
            <tr style="text-align: center;">
                <td>FIRMA DEL TRABAJADOR</td>
                <td style="width: 5%;"></td>
                <td>NOMBRE Y FIRMA JEFE INMEDIATO</td>
                <td style="width: 5%;"></td>
                <td>RRHH</td>
            </tr>
        </table>
        <br>		
		<hr>
        <div style="font-size: 9px;">
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
        </div><br>

        @if($i == 0)
        <hr style="color: black;">
        <br>
        @endif

@endfor


</body>
</html>