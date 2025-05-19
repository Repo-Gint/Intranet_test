<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento_rrhh extends Model
{
    protected $connection = 'mysql_rrhh';
    protected $table = 'departaments';

    //Relación Uno : Muchos Puestos y Departamentos
    public function Puestos (){

        return $this->hasMany('App\Puesto_rrhh', 'Departament_id');
        
    }

    public function Parent_Dep(){
        
        return $this->belongsTo('App\Departamento_rrhh');
    }

    //Relación Uno : Muchos Puestos y Departamentos
    public function FM_Separador (){

        return $this->hasMany('App\Gestor_Archivo_Separador', 'fm_separator', 'Departament_id');
        
    }
}
