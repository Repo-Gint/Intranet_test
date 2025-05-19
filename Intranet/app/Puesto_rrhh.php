<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'positions';

    //Relación Muchos : Muchos Empleado y Puestos trae el historial de los puestos que ha tenido
    public function empleados_historial(){

    	return $this->belongsToMany('App\Empleado_rrhh', 'employee_position_history', 'Position_id', 'Employee_id')->withTimestamps();
    	
    }

    //Relación Muchos : Muchos Empleado y Puestos trae el puesto actual que tiene el empleado
    public function empleado(){

        return $this->belongsToMany('App\Empleado_rrhh', 'employee_position', 'Position_id', 'Employee_id')->withTimestamps();
        
    }

    //Relación Uno : Muchos Puestos y Departamentos
    public function Departamento(){

        return $this->belongsTo('App\Departamento_rrhh', 'Departament_id');
        
    }

    public function Parent_Puesto(){
        
        return $this->belongsTo('App\Puesto_rrhh', 'Parent_id');
    }
}
