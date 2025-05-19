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
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
            }
            footer {
                position: fixed; 
                bottom: -1px; 
                left: 0cm;
                right: 0cm;
                height: 50px; 
                font-size: 9px;
                color: #BFBFBF;
            }

        </style>
    </head>
<body style="font-family: Arial, Sans-serif; ">
    <footer>
        Sistema de Gestión de la Calidad – Copia Controlada 
        <center>
         Información propiedad de Grupo Interconsult, S.A. de C.V. Prohibido el uso sin el consentimiento de la organización
         </center>
        <hr>
        <div style="font-size: 9px;">
        <center>
            Isaac Newton No. 102 - Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – 50220 – Toluca - Estado de México
            Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span>
        </center>
        </div><br>
    </footer>

    <table style="width: 100%; border-spacing: 0;">
            <tr style=" border: 1px solid #333;">
                <td style="width: 20%; border: 1px solid #333; text-align: center;">
                    <img src="../public/img/logo.png" width="120" height="60">
                </td>
                <td style="width: 60%; border: 1px solid #333; margin: 0; padding: 0;">
                    <table style="width: 100%; border-spacing: 0; ">
                        <tr style="font-size: 12pt;">
                            <td style="border-right: none; border-left: none; border-top: none; text-align: center; font-size: 12pt;">
                                <br><STRONG>Solicitud de Vacaciones o Permiso Especial</STRONG><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid black; text-align: center; font-size: 11pt;">
                                <strong>Responsable: </strong> Recursos Humanos
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 20%; border: 1px solid #333; padding: 0;">
                    <table style="width: 100%; border-spacing: 0; font-size: 8pt;">
                        <tr>
                            <td style="border-bottom: 1px solid black;">Código: FO.RHH.020</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black;">Versión: 4</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black;">Edición: 29.09.2023</td>
                        </tr>
                        <tr>
                            <td >Página 1 de 1</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> <br>


        <table style="width: 100%; font-size: 10pt;">
            <tr >
                <td style="width: 5%;">
                    Fecha:
                </td>
                <td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
                    {{ date('d.m.Y') }}
                </td>
                <td style="width: 35%;"></td>
                <td style="width: 15%;">
                    No. Nómina:
                </td>
                <td style="width: 20%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Nomina'] }}
                </td>
            </tr>
        </table><br>

        <table style="width: 100%; font-size: 10pt;">
            <tr >
                <td style="width: 25%;">
                    Nombre del trabajador:
                </td>
                <td style="width: 75%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Nombre'] }}
                </td>
            </tr>
        </table><br>
        <table style="width: 100%; font-size: 10pt;">
            <tr >
                <td style="width: 10%;">
                    Área:
                </td>
                <td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
                    {{ $request['Departamento'] }}
                </td>
                <td style="width: 15%;"></td>
                <td style="width: 25%; text-align: right;">
                    Fecha de ingreso:
                </td>
                <td style="width: 25%; border-bottom: 1px solid #333; text-align: center;">
                    {{ Formato($request['fecha_ingreso']) }}
                </td>
            </tr>
        </table><br>

        <table style="width: 100%;">
            <tr>
                <td style="width: 8%;  text-align:center; border: 1px solid black;">{{ ($request['permiso'] == 1) ? 'X' : '         '}}</td>
                <td style="width: 92%; margin-left: 0.5em;">
                  <strong style="font-size: 11pt;">Solicitud de Vacaciones (VA)</strong>
                    <hr style="color: black; ">
                   <div style="font-size: 8pt;">
                    Por medio de la presente solicito a la empresa, sean consideradas la programación de mis vacaciones como a continuación describo:
                   </div> 
                </td>
            </tr>
        </table><br>

        <table style="width: 100%; font-size: 10pt;">
            <tr >
                <td style="width: 35%;">
                    Días <strong>Disponibles</strong> de Vacaciones
                </td>
                <td style="width: 12.5%; border-bottom: 1px solid #333; text-align: center;">
                    {{ (empty($request['saldo_actual'] )) ? '--' : $request['saldo_actual'] }}
                </td>
                <td style="width: 5%;"></td>
                <td style="width: 35%;">
                    Días de vacaciones <strong>a Disfrutar</strong>
                </td>
                <td style="width: 12.5%; border-bottom: 1px solid #333; text-align: center;">
                    {{ (empty($request['dias_disfrutar'] )) ? '--' : $request['dias_disfrutar']  }}
                </td>
            </tr>
            <tr >
                <td style="">
                    Fecha inicio de Vacaciones
                </td>
                <td style=" border-bottom: 1px solid #333; text-align: center;">
                    {{ (empty($request['fecha_inicio'])) ? '--' : Formato($request['fecha_inicio']) }}
                </td>
                <td></td>
                <td style="">
                    Fecha termino Vacaciones
                </td>
                <td style=" border-bottom: 1px solid #333; text-align: center;">
                    {{ (empty($request['fecha_fin'])) ? '--' : Formato($request['fecha_fin']) }}
                </td>
            </tr>
            <tr >
                <td style="">
                    Fecha Regreso Laboral
                </td>
                <td style=" border-bottom: 1px solid #333; text-align: center;">
                    {{ (empty($request['fecha_regreso'])) ? '--' : Formato($request['fecha_regreso']) }}
                </td>
                <td></td>
                <td style="">
                    Saldo Restante de Vacaciones
                </td>
                <td style="border-bottom: 1px solid #333; text-align: center;">
                    {{  (empty($request['saldo_restante'] )) ? '--' : $request['saldo_restante']  }}
                </td>
            </tr>
        </table><br>

        <table style="width: 100%;">
            <tr>
                <td style="width: 8%;  text-align:center; border: 1px solid black;">{{ ($request['permiso'] == 0) ? 'X' : '         '}}</td>
                <td style="width: 92%; margin-left: 0.5em;">
                  <strong style="font-size: 11pt;">Permiso Especial (PC)</strong>
                    <hr style="color: black; ">
                   <div style="font-size: 8pt;">
                    *Se deberá emtregar a Recursos Humanos copia que ampare el permiso especial en un plazo no mayor a 5 días.
                   </div> 
                </td>
            </tr>
        </table><br>


        <table style="width: 100%; text-align: center;">
            <tr>
                <td style=" width: 3%;"></td>
                <td style=" width: 25%;"></td>
                <td style="font-size: 10pt; width: 45%;" colspan="4">Fecha a partir del: </td>
                <td style=" width: 7%;"></td>
                <td style="font-size: 10pt; width: 20%;">Fecha de Regreso Laboral: </td>
            </tr>
            <tr>
                <td style="font-size: 7pt; text-align:center; border: 1px solid black;">{{ ($request['motivo'] == 'Matrimonio') ? 'X' : ' '}}</td>
                <td  style="font-size: 9.5pt; text-align: left;"><strong>Matrimonio</strong></td>


                <td style="width: 2%; font-size: 10pt;">Del</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Matrimonio') ? Formato($request['fecha_inicio_e']) : '--'}}</td>
                <td style="width: 2%; font-size: 10pt;">al</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Matrimonio') ? Formato($request['fecha_fin_e']) : '--'}}</td>
                <td></td>
                <td style="font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Matrimonio') ? Formato($request['fecha_regreso_e']) : '--'}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="6" style="font-size: 8pt; text-align:left;">Días autorizados: 3 hábiles <br><br></td>
                
            </tr>
            <tr>
                <td style="font-size: 7pt; text-align:center; border: 1px solid black;">{{ ($request['motivo'] == 'Nacimiento') ? 'X' : ' '}}</td>
                <td style="font-size: 9.5pt; text-align: left;"><strong>Nacimiento de hijo</strong></td>

                <td style="width: 2%; font-size: 10pt;">Del</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Nacimiento') ? Formato($request['fecha_inicio_e']) : '--'}}</td>
                <td style="width: 2%; font-size: 10pt;">al</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Nacimiento') ? Formato($request['fecha_fin_e']) : '--'}}</td>
                <td></td>
                <td style="font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Nacimiento') ? Formato($request['fecha_regreso_e']) : '--'}}</td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: 7pt; text-align: left;">Exclusivo empleados varones <br><br><br></td>
                <td colspan="6"  style="font-size: 8pt; text-align:left;">Días autorizados: 5 hábiles <br><br></td>}
            </tr>
            <tr>
                <td style="font-size: 7pt; text-align:center; border: 1px solid black;">{{ ($request['motivo'] == 'Fallecimiento') ? 'X' : ' '}}</td>
                <td style="font-size: 9.5pt; text-align: left;"><strong>Fallecimiento de familiar</strong></td>

                <td style="width: 2%; font-size: 10pt;">Del</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Fallecimiento') ? Formato($request['fecha_inicio_e']) : '--'}}</td>
                <td style="width: 2%; font-size: 10pt;">al</td>
                <td style="width: 20.5%; font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Fallecimiento') ? Formato($request['fecha_fin_e']) : '--'}}</td>
                <td></td>
                <td style="font-size: 10pt; border-bottom: 1px solid black;">{{ ($request['motivo'] == 'Fallecimiento') ? Formato($request['fecha_regreso_e']) : '--'}}</td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: 7pt; text-align: left;"><strong>Directo</strong>: Papás, hijos, hermanos o conyuge <br> <strong>Indirectos</strong>: Abuelos <br><br><br></td>
                <td colspan="6"  style="font-size: 8pt; text-align:left;">Días autorizados: 2 naturales <br><br> Días autorizados: 1 natural<br><br><br></td>
            </tr>
        </table>
        
        <br>
        <table style="width: 100%; font-size: 10pt;">
            <tr >
                <td style="width: 45%; border-bottom: 1px solid black;"></td>
                <td style="width: 10%;"></td>
                <td style="width: 45%; border-bottom: 1px solid black;"></td>

            </tr>
             <tr style="text-align: center; font-size: 8;">
                <td>Solicita</td>
                <td style="width: 10%;"></td>
                <td>Nombre, Firma y Fecha</td>
            </tr>
            <tr style="text-align: center;">
                <td><strong>Firma del Empleado</strong></td>
                <td style="width: 10%;"></td>
                <td><strong>Autoriza (Jefe inmeditato)</strong></td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; font-size: 10pt;">
            <tr>
                <td style="width: 45%; border-bottom: 1px solid black;"></td>
                <td style="width: 10%;"></td>
                <td style="height: 90px; width: 45%; border: 1px solid black; text-align: center;">
                    <strong>Para uso exclusivo de capital humano</strong>
                    <table style="width: 100%; text-align: center;">
                        <tr>
                            <td style="width: 10%;"></td>
                            <td style="width: 20%; font-size: 7pt; text-align:center; border: 1px solid black;"></td>
                            <td style="width: 70%; font-size: 10pt; text-align: left;">Sistema RRHH</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;"></td>
                            <td style="width: 20%; font-size: 7pt; text-align:center; border: 1px solid black;"></td>
                            <td style="width: 70%; font-size: 10pt; text-align: left;">Pensus</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;"></td>
                            <td style="width: 20%; font-size: 7pt; text-align:center; border: 1px solid black;"></td>
                            <td style="width: 70%; font-size: 10pt; text-align: left;">ContPaq</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="text-align: center; font-size: 8;">
                <td>Nombre, Firma y Fecha</td>
            </tr>
            <tr style="text-align: center;">
                <td><strong>Capital Humano</strong></td>
            </tr>
        </table>
        <br>
</body>
</html>