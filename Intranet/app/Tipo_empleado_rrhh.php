<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_empleado_rrhh extends Model
{
	protected $connection = 'mysql_rrhh';
    protected $table = 'type_employees';

   //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Empleados (){

    	return $this->belongsToMany('App\Empleado', 'employee_typeemployee', 'Typeemployee_id', 'Employee_id' )->withTimestamps();
    	
    }
}
