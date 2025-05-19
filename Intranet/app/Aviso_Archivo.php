<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso_Archivo extends Model
{
    protected $table = "file_notices";

    protected $fillable = ['Name_file', 'Notice_id'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Aviso(){

        return $this->belongsTo('App\Aviso', 'Notice_id');
        
    }
}
