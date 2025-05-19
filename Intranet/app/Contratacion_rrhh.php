<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratacion_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'contracts';

    //Relación Empleado y Contratacion
    public function Empleado (){

    	return $this->belongsTo('App\Empleado_rrhh', 'Employee_id');

    }
}
