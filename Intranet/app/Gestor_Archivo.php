<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor_Archivo extends Model
{
     protected $table = "file_manager";

    protected $fillable = ['Name_file', 'Separator_id'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Separador(){

        return $this->belongsTo('App\Gestor_Archivo_Separador', 'Separator_id');
        
    }
}
