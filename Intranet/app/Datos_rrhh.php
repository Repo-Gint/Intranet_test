<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'datas';

    //Relación Uno : Uno Empleado y Datos
    public function Empleado (){

    	return $this->belongsTo('App\Empleado_rrhh','Employee_id');

    }
}
