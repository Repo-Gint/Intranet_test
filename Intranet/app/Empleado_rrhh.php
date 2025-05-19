<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'employees';

    //Relación Uno : Uno Empleado y Datos
    public function Datos (){

        return $this->hasOne('App\Datos_rrhh', 'Employee_id');

    }

    //Relación Muchos : Muchos Empleado y Puestos trae el historial de los puestos que ha tenido
    public function Puestos_historial (){

    	return $this->belongsToMany('App\Puesto_rrhh', 'employee_position_history', 'Employee_id', 'Position_id')->withPivot('Start_date', 'Ending_date');
    	
    }

    //Relación Muchos : Muchos Empleado y Puestos trae el puesto actual que tiene el empleado
    public function Puesto(){ 

        return $this->belongsToMany('App\Puesto_rrhh', 'employee_position', 'Employee_id', 'Position_id');
        
    }

    //Relación Uno : Uno Empleado y Contactos
    public function Contactos (){

        return $this->hasOne('App\Contacto_rrhh', 'Employee_id');
        
    }
    //Relación Uno : Uno Empleado y Usuarios
    public function User (){

        return $this->hasOne('App\User', 'Employee_id');
        
    }

    //Relación Uno : Uno Empleado y Domicilio
    public function Domicilio (){

        return $this->hasOne('App\Domicilio_rrhh', 'Employee_id');

    }

    //Relación Uno : Muchos Empleado y Contratos
    public function Contrataciones (){

        return $this->hasMany('App\Contratacion_rrhh', 'Employee_id');

    }

     //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Tipo_empleado(){

        return $this->belongsToMany('App\Tipo_empleado_rrhh', 'employee_typeemployee', 'Employee_id', 'Typeemployee_id');
        
    }

   //Relación Uno : Muchos Empleado y Vacaciones
    public function Vacaciones (){

        return $this->hasMany('App\Vacacion_rrhh', 'Employee_id');
        
    }


    //Relación Uno : Muchos Empleado y Contratos
    public function Permisos_Salidas (){

        return $this->hasMany('App\Permiso_Salida', 'Employee_id');

    }

    public function scopeNombre($query, $name){
        if($name){
            return $query->where('Names', 'LIKE', "%$name%")->orWhere('Paternal', 'LIKE', "%$name%");
        }
    }

    public function scopeDepartamento($query, $departament){
        if($departament){
            return $query->where('Departament_ES', 'LIKE', "%$departament%");
        }
    }
}
