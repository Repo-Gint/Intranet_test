<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_contrato_rrhh extends Model
{
	protected $connection = 'mysql_rrhh';
    protected $table = 'type_contracts';

    //Relación Uno : Muchos Contratos y Tipo Contratos
    public function Contrato (){

        return $this->hasMany('App\Contratacion');
    }
}
