<?php 
function numero_orden($request){

	if($request['type_order_id'] == 3 || $request['type_order_id'] == 4){
		$ordenes = App\Orden_mantenimiento::where('type_order_id', 3)->orWhere('type_order_id', 4)->orderBy('id', 'ASC')->get();
		$siglas = siglas_num_orden($request['type_order_id'], $request['maintenance_id']);
	}else{
		$ordenes = App\Orden_mantenimiento::where('type_order_id', $request['type_order_id'])->orderBy('id', 'ASC')->get();
		$siglas = siglas_num_orden($request['type_order_id'], 2); //cuando el usuario genera una orden de tipo maquinaria sera siempre correctivo id = 2
	}
	
	if($ordenes->count() > 0){
		$orden = $ordenes->last();
		//dd($orden);
	}else{
		return $siglas."00001";
	}

	$numero = explode("-",$orden->code);

	$numero = ($request['type_order_id'] == 1 || $request['type_order_id'] == 2) ? (int) $numero[2] : (int) $numero[1];

	$digitos = digitos($numero);

	return $siglas.$digitos;



}

Function siglas_num_orden($tipo_orden, $mantenimiento){

	if($tipo_orden == 1){ //maquinaria cnc
		if($mantenimiento == 1){ //preventivo
			return "CNC-P-";
		}
		if($mantenimiento == 2){ //corectivo
			return "CNC-C-";
		}
	}

	if($tipo_orden == 2){ //maquinaria ppl
		if($mantenimiento == 1){ //preventivo
			return "PPL-P-";
		}
		if($mantenimiento == 2){ //corectivo
			return "PPL-C-";
		}
	}

	if($tipo_orden == 3 || $tipo_orden == 4){ //mantenimiento general o proyecto
		return "PL-";
	}

}

function digitos($numero){
	if(($numero>=9999) && ($numero<99999)) {
	    $nuevo = $numero+1; 
	    return $nuevo;
	  }
	  if(($numero>=999) && ($numero<9999)){
	    
	  }
	  if(($numero>=99) && ($numero<999)){
	    $nuevo ="00".($numero+1); 
	    return $nuevo;
	  }
	  if(($numero>=9) && ($numero<99)) {
	    $nuevo ="000".($numero+1); 
	    return $nuevo;
	  }
	  if(($numero>=1) && ($numero<9)){
	    $nuevo ="0000".($numero+1); 
	    return $nuevo;
	  }
}

function crear_registro_costo($orden_id){
    DB::connection('mysql_mantenimiento')->table('order_costs')->insert(
    	[
    		'total' 	=> null, //id del rol Estandar por defecto 
    		'order_id' 	=> $orden_id,
    		'coin_id'	=> null,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
    	]
	);
}

function listado_tipo_orden(){

	$tipos = DB::connection('mysql_mantenimiento')->table('type_orders')->select(DB::raw('CONCAT(type," - ",acronym) AS type_order'), 'id')->pluck('type_order', 'id');
	$departamento = departamento(auth()->user()->Empleado_rrhh, 'Nombre');

	if($departamento == "Manufactura CNC" || $departamento == "Producción Plástico"){
		if($departamento == "Manufactura CNC"){
		 return $tipos->except(['id' => 2]);
		}
		if($departamento == "Producción Plástico"){
		 return $tipos->except(['id' => 1]);
		}
	}else{
		return $tipos->take(-2);
	}
}

function listado_prioridades(){

	$prioridades = DB::connection('mysql_mantenimiento')->table('priorities')->where('enable', 1)->pluck('type', 'id');

	return $prioridades;
}

function obtener_maquina($id){
	$maquina = DB::connection('mysql_mantenimiento')->table('machines')->find($id);

	return $maquina->name;
}

function obtener_mantenimiento($id){
	if($id == null){
		return "";
	}
	$mantenimiento = DB::connection('mysql_mantenimiento')->table('type_maintenances')->find($id);

	return $mantenimiento->type;
}

function obtener_estatus($id){
	$estatus = DB::connection('mysql_mantenimiento')->table('order_status')->find($id);

	return $estatus->type;
}

function obtener_prioridad($id){
	$prioridad = DB::connection('mysql_mantenimiento')->table('priorities')->find($id);

	return $prioridad->type;
}

function obtener_falla($id){
	$falla = DB::connection('mysql_mantenimiento')->table('type_failures')->find($id);

	return $falla->type;
}

function obtener_tipo_orden($id){
	$tipo_orden = DB::connection('mysql_mantenimiento')->table('type_orders')->find($id);

	return $tipo_orden->type;
}

function obtener_empleado($id){
	$empleado = DB::connection('mysql_rrhh')->table('employees')->find($id);

	$nombre_array = explode(' ', $empleado->Names);
	return $nombre_array[0].' '.$empleado->Paternal;
}

function obtener_departamento($id){
	$departamento = DB::connection('mysql_rrhh')->table('departaments')->find($id);

	return $departamento->Departament_ES;
}

function obtener_lapsos_tiempo($orden_id){
	$lapsos = DB::connection('mysql_mantenimiento')->table('time_lapse')->where('order_id',$orden_id)->orderBy('time_lapse.start_date', 'ASC')->get();

	return $lapsos;
}

function obtener_refacciones($orden_id){
	$refacciones = DB::connection('mysql_mantenimiento')->table('spare_parts')->where('order_id',$orden_id)->get();

	return $refacciones;
}

function obtener_materiales($orden_id){
	$materiales = DB::connection('mysql_mantenimiento')->table('materials')->where('order_id',$orden_id)->get();

	return $materiales;
}


function obtener_staff($orden_id){

	$staff = DB::connection('mysql_mantenimiento')->table('staff_orders')->where('order_id', $orden_id)->get();
	$equipo = '';

	if($staff->count() == 0){
		return '';
	}else{
		foreach ($staff as $empleado) {
			$equipo .= obtener_empleado($empleado->employee_id).', ';

		}
	}

}


function formato_fecha_hora($fecha){
	$fecha=date_create($fecha);
	return date_format($fecha, "d.m.Y H:i");
}

function formato_input($fecha){
	if($fecha == null){
		return null;
	}
	$fecha=explode(" ",$fecha);
	return $fecha[0]."T".$fecha[1];
}

function formato_hora($fecha){
	$fecha=date_create($fecha);
	return date_format($fecha, "H:i");
}

function formato_fecha($fecha){
	$fecha=date_create($fecha);
	return date_format($fecha, "d.m.Y");
}


function formato_fecha_numeros($fecha){
	$fecha=date_create($fecha);
	return date_format($fecha, "Ymdhi");
}



 ?>