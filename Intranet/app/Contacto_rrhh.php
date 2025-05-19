<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'contacts';

    //Relación Uno : Uno Empleado y Contactos
    public function Empleado(){

    	return $this->belongsTo('App\Empleado_rrh', 'Employee_id');	
    }
}
