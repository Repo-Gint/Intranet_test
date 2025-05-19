<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domicilio_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'domicile';

    //Relación Uno : Uno Empleado y Domicilio
    public function Empleado (){

    	return $this->belongsTo('App\Empleado_rrhh', 'Employee_id');

    }
}
