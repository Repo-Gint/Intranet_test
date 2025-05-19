<?php  

function total_empleados(){
	$empleados = DB::connection('mysql_rrhh')->table('employees')->where('Active', '=', 1)->get();

	return $empleados->count();
}

function total_empleados_departamento($id){

	$empleados = DB::connection('mysql_rrhh')->table('employees')
	->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
	->join('positions', 'employee_position.Position_id', '=', 'positions.id')
	->where('Departament_id', '=', $id)
	->where('employees.Active', '=', 1)
	->get();
	
	return $empleados->count();
	
}
function total_empleados_cumple($dato){
	$mes = ''.date('m').'';
	$empleados = DB::connection('mysql_rrhh')->table('employees')
	->join('datas', 'employees.id', '=', 'datas.Employee_id')
	->whereMonth('Birthdate', $mes)
	->where('Active', '=', 1)
	->orderByRaw('DAY(Birthdate)', 'ASC')
	->get();

	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_empleados_mes($dato){

	$inicio = new DateTime();
	$inicio->modify('first day of this month');
	$inicio = $inicio->format('Y-m-d');

	$fin = new DateTime();
	$fin->modify('last day of this month');
	$fin = $fin->format('Y-m-d');

	$empleados = DB::connection('mysql_rrhh')->table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Active', '=', 1)
	->whereBetween('High_date', [$inicio, $fin])
	->get();
	
	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_empleados_trayectoria(){
	$inicio = new DateTime();
	$inicio->modify('first day of this month');
	$inicio = $inicio->format('Y-m-d');

	$fin = new DateTime();
	$fin->modify('last day of this month');
	$fin = $fin->format('Y-m-d');

	$empleados = DB::connection('mysql_rrhh')->table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Active', '=', 1)
	->whereMonth('High_date', date('m'))
	->whereYear('High_date', '<', date('Y'))
	->where('Low_date', null)
	->get();

	return $empleados;

}

function avisos(){
	$avisos = App\Aviso::orderBy('Publication_date', 'ASC')->get();
	return $avisos;

}

function reducir_descripcion($text){
	$nuevo_texto = "";
	if(strlen($text) < 80){
		return $text.' ...';
	}
	for($i = 0; $i < 80; $i++){
		$nuevo_texto .= $text[$i];
	}

	return $nuevo_texto.' ...';
}

function recordatorios(){
	$recordatorios = App\Recordatorio::where('Publication_date', '<=', date('Y-m-d'))->where('Ending_date', '>=', date('Y-m-d'))->get();

	return $recordatorios;
}

/*** Funciones para el modulo de incidencias **/
function dias_sin_incidentes(){
	$ultimo_incidente = App\Sin_Incidente::orderBy('Incident_day', 'DESC')->get();

	$fecha1= new DateTime($ultimo_incidente->first()->Incident_day);
	$fecha2= new DateTime(date('Y-m-d'));
	$diff = $fecha1->diff($fecha2);

	return $diff->days;
}

function record_sin_incidentes(){
	$fechas = App\Sin_Incidente::select('Incident_day')->orderBy('Incident_day', 'DESC')->get();
	$fechas->toArray();
	$record = 0;
	$texto = "";
	for ($i=0; $i < count($fechas)-1; $i++) { 
		//dd($fechas[$i]['Incident_day']);
		$fecha1= new DateTime($fechas[$i]['Incident_day']);
		$fecha2= new DateTime($fechas[$i+1]['Incident_day']);
		$diff = $fecha1->diff($fecha2);

		if($diff->days > $record){
			$record = $diff->days;
			$texto = Formato($fechas[$i+1]['Incident_day'])." - ".Formato($fechas[$i]['Incident_day']);
		}
	}

	$dias_actuales = dias_sin_incidentes();

	if($record < $dias_actuales){
		$dias = array('dias' => $dias_actuales, 'texto' => Formato($fechas->first()->Incident_day). ' - actualidad');
	}else{
		$dias = array('dias' => $record, 'texto' => $texto);
	}

    


	return $dias;
}
/*** Funciones para el modulo de incidencias (FIN)**/
function mi_equipo($puesto){
	$id = $puesto->Departamento->id;

	$empleados = DB::connection('mysql_rrhh')->table('employees')
	->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
	->join('positions', 'employee_position.Position_id', '=', 'positions.id')
	->where('Departament_id', '=', $id)
	->where('employees.Active', '=', 1)
	->get();

	return $empleados;

}
function mes_espanol($m){
	switch ($m) {
		case '01':
			return "Enero";
			break;
		case '02':
			return "Febrero";
			break;
		case '03':
			return "Marzo";
			break;
		case '04':
			return "Abril";
			break;
		case '05':
			return "Mayo";
			break;
		case '06':
			return "Junio";
			break;
		case '07':
			return "Julio";
			break;
		case '08':
			return "Agosto";
			break;
		case '09':
			return "Septiembre";
			break;
		case '10':
			return "Octubre";
			break;
		case '11':
			return "Noviembre";
			break;
		case '12':
			return "Diciembre";
			break;

	}

}
function consulta_empleado($id_empleado){
	$empleado = DB::connection('mysql_rrhh')->table('employees')->where('id', $id_empleado)->first();

		return nombre ($empleado, 'Mostrar');
}
function nombre ($empleado, $funcion){
	if($funcion == 'Mostrar'){
		$nombre_array = explode(' ', $empleado->Names);
		return $nombre_array[0].' '.$empleado->Paternal;
	}

	if($funcion == 'Completo'){
		return $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal;
	}


}
function correo ($correo, $funcion){
	if($funcion == 'Mostrar'){
		$correo_array = explode('@', $correo);
		return $correo_array[0]."@";
	}


}
function elegir_icon($archivo){
	$array = explode(".", $archivo);

	for ($i=0; $i < count($array) ; $i++) { 
		if($array[$i] == "pdf"){
			return "icon-pdf.png";
		}
		if($array[$i] == "docx"){
			return "icon-word.png";
		}
		if($array[$i] == "pptx"){
			return "icon-power.png";
		}
		if($array[$i] == "xlsx"){
			return "icon-excel.png";
		}
	}
}
/** Funciones para el organigrama general departamental**/

/** Funciones para el organigrama general departamental**/

function nombre_album($id){
	$album = DB::table('gallery_albums')->where('id', $id)->first();
	//dd($album->Name);
	return $album->Name;
}

function fechas_galeria(){
	$albums = App\Galeria_Album::orderBy('Publication_date', 'DESC')->get();
	$fechas = array();
	$i = 0;
	foreach($albums as $album){
		$explode = explode('-', $album->Publication_date);
		if(empty($fechas)){
			$fechas[$i] = array('id'=> $i, 'mes_num' => $explode[1], 'mes' => mes_espanol($explode[1]), 'year' => $explode[0], 'contador' => 1);
			$i++;
		}else{
			if(!existe_fecha($explode[1], $explode[0], $fechas)){
				$fechas[$i] = array('id'=> $i, 'mes_num' => $explode[1], 'mes' => mes_espanol($explode[1]), 'year' => $explode[0], 'contador' => 1);
				$i++;
			}else{
				$fechas = contador_album($explode[1], $explode[0], $fechas);
			}
		}

	}


	return $fechas;
}

function existe_fecha($mes, $year, $array){
	$ban = false;
	for ($i=0; $i < count($array); $i++) { 
		if($array[$i]['year'] == $year && $array[$i]['mes_num'] == $mes){
			$ban = true;
			break;
		}
	}

	return $ban;
}

function contador_album($mes, $year, $array){
	for ($i=0; $i < count($array); $i++) { 
		if($array[$i]['year'] == $year && $array[$i]['mes_num'] == $mes){
			$array[$i]['contador'] += 1;
			break;
		}
	}

	return $array;
}

function hora_de_salida($opcion){
	if($opcion == "Salida"){
		$array = array(
			'8:00' => '8:00',
			'8:05' => '8:05',
			'8:10' => '8:10',
			'8:15' => '8:15',
			'8:20' => '8:20',
			'8:25' => '8:25',
			'8:30' => '8:30',
			'8:35' => '8:35',
			'8:40' => '8:40',
			'8:45' => '8:45',
			'8:50' => '8:50',
			'8:55' => '8:55',
			'9:00' => '9:00',
			'9:05' => '9:05',
			'9:10' => '9:10',
			'9:15' => '9:15',
			'9:20' => '9:20',
			'9:25' => '9:25',
			'9:30' => '9:30',
			'9:35' => '9:35',
			'9:40' => '9:40',
			'9:45' => '9:45', 
			'9:50' => '9:50',
			'9:55' => '9:55',
			'10:00' => '10:00',
			'10:05' => '10:05',
			'10:10' => '10:10',
			'10:15' => '10:15', 
			'10:20' => '10:20',
			'10:25' => '10:25', 
			'10:30' => '10:30',
			'10:35' => '10:35',  
			'10:40' => '10:40',
			'10:45' => '10:45',
			'10:50' => '10:50',
			'10:55' => '10:55', 
			'11:00' => '11:00',
			'11:05' => '11:05',
			'11:10' => '11:10',
			'11:15' => '11:15',
			'11:20' => '11:20',
			'11:25' => '11:25', 
			'11:30' => '11:30',
			'11:35' => '11:35',
			'11:40' => '11:40',
			'11:45' => '11:45',
			'11:50' => '11:50',
			'11:55' => '11:55',
			'12:00' => '12:00',
			'12:05' => '12:05',
			'12:10' => '12:10',
			'12:15' => '12:15',
			'12:20' => '12:20',
			'12:25' => '12:25', 
			'12:30' => '12:30',
			'12:35' => '12:35',
			'12:40' => '12:40',
			'12:45' => '12:45',
			'12:50' => '12:50',
			'12:55' => '12:55',
			'13:00' => '13:00',
			'13:05' => '13:05',
			'13:10' => '13:10',
			'13:15' => '13:15',
			'13:20' => '13:20',
			'13:25' => '13:25', 
			'13:30' => '13:30',
			'13:35' => '13:35',
			'13:40' => '13:40',
			'13:45' => '13:45',
			'13:50' => '13:50',
			'13:55' => '13:55',
			'14:00' => '14:00',
			'14:05' => '14:05',
			'14:10' => '14:10',
			'14:15' => '14:15',
			'14:20' => '14:20',
			'14:25' => '14:25', 
			'14:30' => '14:30',
			'14:35' => '14:35',
			'14:40' => '14:40',
			'14:45' => '14:45',
			'14:50' => '14:50',
			'14:55' => '14:55',
			'15:00' => '15:00',
			'15:05' => '15:05',
			'15:10' => '15:10',
			'15:15' => '15:15',
			'15:20' => '15:20',
			'15:25' => '15:25', 
			'15:30' => '15:30',
			'15:35' => '15:35',
			'15:40' => '15:40',
			'15:45' => '15:45',
			'15:50' => '15:50',
			'15:55' => '15:55',
			'16:00' => '16:00',
			'16:05' => '16:05',
			'16:10' => '16:10',
			'16:15' => '16:15',
			'16:20' => '16:20',
			'16:25' => '16:25', 
			'16:30' => '16:30',
			'16:35' => '16:35',
			'16:40' => '16:40',
			'16:45' => '16:45',
			'16:50' => '16:50',
			'16:55' => '16:55',
			'17:00' => '17:00',
			'17:05' => '17:05',
			'17:10' => '17:10',
			'17:15' => '17:15',
			'17:20' => '17:20',
			'17:25' => '17:25',
			'17:30' => '17:30',
			'17:35' => '17:35',
			'17:40' => '17:40',
			'17:45' => '17:45',
			'17:50' => '17:50',
			'17:55' => '17:55'
		);
	}
	
	if($opcion == "Regreso"){
		$array = array( 
			'8:05' => '8:05',
			'8:10' => '8:10',
			'8:15' => '8:15',
			'8:20' => '8:20',
			'8:25' => '8:25',
			'8:30' => '8:30',
			'8:35' => '8:35',
			'8:40' => '8:40',
			'8:45' => '8:45',
			'8:50' => '8:50',
			'8:55' => '8:55',
			'9:00' => '9:00',
			'9:05' => '9:05',
			'9:10' => '9:10',
			'9:15' => '9:15',
			'9:20' => '9:20',
			'9:25' => '9:25',
			'9:30' => '9:30',
			'9:35' => '9:35',
			'9:40' => '9:40',
			'9:45' => '9:45', 
			'9:50' => '9:50',
			'9:55' => '9:55',
			'10:00' => '10:00',
			'10:05' => '10:05',
			'10:10' => '10:10',
			'10:15' => '10:15', 
			'10:20' => '10:20',
			'10:25' => '10:25', 
			'10:30' => '10:30',
			'10:35' => '10:35',  
			'10:40' => '10:40',
			'10:45' => '10:45',
			'10:50' => '10:50',
			'10:55' => '10:55', 
			'11:00' => '11:00',
			'11:05' => '11:05',
			'11:10' => '11:10',
			'11:15' => '11:15',
			'11:20' => '11:20',
			'11:25' => '11:25', 
			'11:30' => '11:30',
			'11:35' => '11:35',
			'11:40' => '11:40',
			'11:45' => '11:45',
			'11:50' => '11:50',
			'11:55' => '11:55',
			'12:00' => '12:00',
			'12:05' => '12:05',
			'12:10' => '12:10',
			'12:15' => '12:15',
			'12:20' => '12:20',
			'12:25' => '12:25', 
			'12:30' => '12:30',
			'12:35' => '12:35',
			'12:40' => '12:40',
			'12:45' => '12:45',
			'12:50' => '12:50',
			'12:55' => '12:55',
			'13:00' => '13:00',
			'13:05' => '13:05',
			'13:10' => '13:10',
			'13:15' => '13:15',
			'13:20' => '13:20',
			'13:25' => '13:25', 
			'13:30' => '13:30',
			'13:35' => '13:35',
			'13:40' => '13:40',
			'13:45' => '13:45',
			'13:50' => '13:50',
			'13:55' => '13:55',
			'14:00' => '14:00',
			'14:05' => '14:05',
			'14:10' => '14:10',
			'14:15' => '14:15',
			'14:20' => '14:20',
			'14:25' => '14:25', 
			'14:30' => '14:30',
			'14:35' => '14:35',
			'14:40' => '14:40',
			'14:45' => '14:45',
			'14:50' => '14:50',
			'14:55' => '14:55',
			'15:00' => '15:00',
			'15:05' => '15:05',
			'15:10' => '15:10',
			'15:15' => '15:15',
			'15:20' => '15:20',
			'15:25' => '15:25', 
			'15:30' => '15:30',
			'15:35' => '15:35',
			'15:40' => '15:40',
			'15:45' => '15:45',
			'15:50' => '15:50',
			'15:55' => '15:55',
			'16:00' => '16:00',
			'16:05' => '16:05',
			'16:10' => '16:10',
			'16:15' => '16:15',
			'16:20' => '16:20',
			'16:25' => '16:25', 
			'16:30' => '16:30',
			'16:35' => '16:35',
			'16:40' => '16:40',
			'16:45' => '16:45',
			'16:50' => '16:50',
			'16:55' => '16:55',
			'17:00' => '17:00',
			'17:05' => '17:05',
			'17:10' => '17:10',
			'17:15' => '17:15',
			'17:20' => '17:20',
			'17:25' => '17:25',
			'17:30' => '17:30',
			'17:35' => '17:35',
			'17:40' => '17:40',
			'17:45' => '17:45',
			'17:50' => '17:50',
			'17:55' => '17:55',
			'Sin Retorno' => 'Sin Retorno',
			'--' => '--'
			);
	}

	return $array;
}
function departamento($empleado, $opcion){

	$puesto = $empleado->Puesto->last();
	if($opcion == 'Nombre'){
		return $puesto->Departamento->Departament_ES;
	}
	if($opcion = 'Id'){
		return $puesto->Departamento->id;
	}
	
}

function Formato($date){
	$date=date_create($date);
	return date_format($date, "d.m.Y");
}

function Formato_Tiempo($time){
	$time=date_create($time);
	return date_format($time, "H:i");
}


function horario_laboral(){
	$array = array('Mixta' => 'Mixta', 'Diurna' => 'Diurna', 'Nocturna' => 'Nocturna');
	return $array;
}

function Antiguedad($date){
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	return Year($diferencia->y)."".Month($diferencia->m)."".Days($diferencia->d);

}
function years($date){
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	$exp = explode("-", $date);

	if($exp[2] > date('d')){
		return Year($diferencia->y+1);
	}

	return Year($diferencia->y);

}

function empleado_duracion($start_date, $end_date){
	$F_Ingreso = new DateTime($start_date);
	$F_Actual = new Datetime($end_date);

	$diferencia= $F_Ingreso->diff($F_Actual);

	return Year($diferencia->y)."".Month($diferencia->m)."".Days($diferencia->d);

}
function Year ($year){
	if($year == 0){
		return "";
	}else{
		if($year == 1){
			return $year." año ";
		}else{
			if($year > 1){
				return $year." años ";
			}
		}
	}
}

function Month ($month){
	if($month == 0){
		return "";
	}else{
		if($month == 1){
			return $month." mes ";
		}else{
			if($month > 1){
				return $month." meses ";
			}
		}
	}
}

function Days ($days){
	if($days == 0){
		return "";
	}else{
		if($days == 1){
			return $days." día ";
		}else{
			if($days > 1){
				return $days." días ";
			}
		}
	}
}

function Periodo_actual($fecha_ingreso){

	$array_fecha_ingreso = explode('-', $fecha_ingreso);
	$array_fecha_actual = explode('-', date('Y-m-d'));

	if($array_fecha_actual[0] == $array_fecha_ingreso[0]){
		$fecha_fin_perido = date("Y-m-d",strtotime($fecha_ingreso."+ 1 year"));
		$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
		$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
		return $array_fecha_ingreso[2].'.'.$array_fecha_ingreso[1].'.'.$array_fecha_ingreso[0].' - '.Formato($fecha_fin_perido);
	}else{
		if($array_fecha_actual[0] > $array_fecha_ingreso[0]){
			$fecha = $array_fecha_actual[0].'-'.$array_fecha_ingreso[1].'-'.$array_fecha_ingreso[2];
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha."+ 1 year"));
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
			$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
			return Formato($fecha).' - '.Formato($fecha_fin_perido);
		}else{
			return 'Error';
		}
	}


}

function Dias_Disfrutar($date, $tipo_empleado){
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);
	if($tipo_empleado == 1 || $tipo_empleado == 2){
		if($diferencia->days < 365){
			return 0;
		}else{
			//1 año = 12 dias
			if($diferencia->days >= 365 && $diferencia->days < 730){
				return 12;
			}
			//2 años a 9 años = 15 dias
			if($diferencia->days >= 730 && $diferencia->days < 3285){
				return 15;
			}
			//10 años a 14 años = 16 dias
			if($diferencia->days >= 3285 && $diferencia->days < 5110){
				return 16;
			}
			//15 años a 19 años = 18 dias
			if($diferencia->days >= 5110 && $diferencia->days < 6935){
				return 18;
			}
			//20 años a 24 años = 20 dias
			if($diferencia->days >= 6935 && $diferencia->days < 8760){
				return 20;
			}
			//25 años a 29 años = 22 dias
			if($diferencia->days >=  8760 && $diferencia->days < 10585){
				return 22;
			}

		}
	}else{
		if($diferencia->days < 365){
			return 0;
		}else{
			if($diferencia->days >= 365){
				return 12;
			}

		}
	}
}

function Saldo($date, $disfrutados){
	/*
	*	1 año = 12 días
	*	2 años a 9 años = 15 días
	*	10 años a 14 años = 16 días
	*	15 años a 19 años = 18 dias
	*	20 años a 24 años = 20 dias
	*	25 años a 29 años = 22 días
	*/
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	if($diferencia->y == 0){
		return 0 - $disfrutados;
	}

	if($diferencia->y == 1){
		return 12 - $disfrutados;
	}

	//2 años * 15 dias = 30 dias - 5 dias = 25 dias acumulados a los 2 años
	if($diferencia->y >= 2 && $diferencia->y <= 9){
		$saldo_tmp = (($diferencia->y*15) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

	//10 años * 16 dias = 160 dias - 14 dias = 146 dias acumulados a los 10 años
	if($diferencia->y >= 10 && $diferencia->y <= 14){
		$saldo_tmp = (($diferencia->y*16) - 14) ;
		return $saldo_tmp - $disfrutados; 
	}
	//15 años * 18 dias = 270 dias - 42 dias = 228 dias acumulados a los 15 años
	if($diferencia->y >= 15 && $diferencia->y <= 19){
		$saldo_tmp = (($diferencia->y*18) - 42) ;
		return $saldo_tmp - $disfrutados; 
	}

	//20 años * 20 dias = 400 dias - 80 dias = 320 dias acumulados a los 20 años
	if($diferencia->y >= 20 && $diferencia->y <= 24){
		$saldo_tmp = (($diferencia->y*20) - 80) ;
		return $saldo_tmp - $disfrutados; 
	}

	//25 años * 22 dias = 550 dias - 128 dias = 422 dias acumulados a los 25 años
	if($diferencia->y >= 25 && $diferencia->y <= 29){
		$saldo_tmp = (($diferencia->y*22) - 128) ;
		return $saldo_tmp - $disfrutados; 
	}
}

function Dias($inicio, $fin){
	$F1= strtotime($inicio);
	$F2= strtotime($fin);

	$diferencia= abs($F1-$F2); 
	
	$dias=floor(((($diferencia/60)/60)/24));
    return $diferencia->d + 1;
}

function Dias_disfrutados($contratacion, $empleado){
	$dias_disfrutados = 0;
	
	foreach($empleado->Vacaciones as $vacaciones){
        $dias_disfrutados = $dias_disfrutados + $vacaciones->Days;
    }

    return $dias_disfrutados;
}

function Periodos_historial($empleado){

	$vacaciones = $empleado->Vacaciones()->orderBy('Period', 'DESC')->get();
	$array = array();
	$i = 0;
	foreach ($vacaciones as $periodo) {
	   $array[$i] = $periodo->Period;
	   $i++;
	   
	}
	$coleccion = array_values(array_unique($array));
	return $coleccion;

}

function Tipo_Vacacion($pagadas, $adelantadas){
	if($pagadas == 0 && $adelantadas == 0){
		return "Disfrutadas";
	}else{
		if($pagadas == 1){
			return "Pagadas";
		}else{
			if($adelantadas == 1){
				return "Adelantadas";

			}
		}
	}
}

function tipo_de_documento($nombre){
	$arreglo = explode('.', $nombre);
	for($i = 0; $i < count($arreglo); $i++){
		if($arreglo[$i] == 'xlsx' || $arreglo[$i] == 'xls' || $arreglo[$i] == 'xlsm' || $arreglo[$i] == 'XLS'){
			return '<i class="fa fa-file-excel" style="color: green;"></i>';
			break;
		}
		if($arreglo[$i] == 'docx' || $arreglo[$i] == 'doc'){
			return '<i class="fa fa-file-word" style="color: blue;"></i>';
			break;
		}
		if($arreglo[$i] == 'pdf'){
			return '<i class="fa fa-file-pdf" style="color: red;"></i>';
			break;
		}
		if($arreglo[$i] == 'pptx'){
			return '<i class="fa fa-file-powerpoint" style="color: orange;"></i>';
			break;
		}
	}

	return '<i class="fa fa-file"></i>';
}



/*	Funciones para Calendario/Reservaciones */
function Validar_Reservacion($request){
	$consulta = App\Reservacion::where('Date', $request['Date'])
	->where('Place', $request['Place'])
	->get();

 	$error = '';
 	foreach ($consulta as $reservacion) {
 		if($request['Time_start'].':00' >= $reservacion->Time_start && $request['Time_start'].':00' <= $reservacion->Time_end){
 			return $error = "Ya existe una reservación dentro del periodo que usted quiere reservar. ";
 		}

 		if($request['Time_end'].':00' >= $reservacion->Time_start && $request['Time_end'].':00' <= $reservacion->Time_end){
 			return $error = "Ya existe una reservación dentro del periodo que usted quiere reservar. ";
 		}
 	}
if( $request['Date'] == date('Y-m-d') ){
 		if($request['Time_start'] <= date('H:i:s')){
 			return $error = "No se puede registrar porque la hora de inicio ingresada es menor ".$request['Time_start']." a la hora actual.";
 		}		
 	}

 	return $error = "Exito";
}

function generar_eventos_calendario(){
	$eventos = "";
	$reservaciones = App\Reservacion::get();
	$id = 1;
	foreach ($reservaciones as $reservacion) {
		$color_random = random_color();
		$concat_inicio = $reservacion->Date.' '.$reservacion->Time_start;
		$concat_fin = $reservacion->Date.' '.$reservacion->Time_end;
		$eventos .= "{
			id             : '".$id."',
		    title          : '".$reservacion->Place.' : '.$reservacion->Name.' ('.consulta_empleado($reservacion->Employee_id).')'."',
		    start          : new Date('".$concat_inicio."'),
		    end            : new Date('".$concat_fin."'),
		    backgroundColor: '#00BBF1',
		    borderColor    : '#00BBF1'
		},";
		$id++;
	}
	return $eventos;
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

/*	Funciones para Calendario/Reservaciones (FIN)*/


?>