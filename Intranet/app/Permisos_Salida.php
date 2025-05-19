<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos_Salida extends Model
{
    protected $table = "exit_permits";

    protected $fillable = ['working_hours', 'enjoy_salary', 'date', 'departure_time', 'return_time', 'reason', 'approved', 'comments','way_to_pay','Employee_id'];



    //Relación Empleado y Salida
    public function Empleado (){

    	return $this->belongsTo('App\Empleado_rrhh', 'Employee_id');

    }
}
