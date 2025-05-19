<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado_rrhh;
use Illuminate\Support\Facades\DB;
class DirectorioController extends Controller
{
    public function index(Request $request){
    	//$departamentos = App\Departamento_rrhh::get();
  		//$empleados = App\Empleado_rrhh::orderBy('Names', 'ASC')->where('Active', 1)->get();
  		$name = $request->get('name');
  		$departament = $request->get('departament');
  		$empleados = Empleado_rrhh::select(DB::raw('CONCAT(employees.Names," ",employees.Paternal) AS Name'), 'Photo','Departament_ES', 'Position_ES','Business_mail', 'Extension', 'Business_phone')
  		->join('contacts', 'employees.id', '=', 'contacts.Employee_id')
  		->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
  		->join('positions', 'employee_position.Position_id', '=', 'positions.id')
  		->join('departaments', 'positions.Departament_id', '=', 'departaments.id')
  		->orderBY('Name', 'ASC')
  		->where('employees.Active', 1)
  		->Nombre($name)
  		->Departamento($departament)
  		->get();
  		return view('EquipoGI')->with('empleados', $empleados);
    }
}
