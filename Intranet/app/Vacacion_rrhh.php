<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacacion_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'holidays';

   //Relación Uno : Muchos Empleado y Vacaciones
    public function Empleado (){

    	return $this->belongsTo('App\Empleado');
    	
    }
}
