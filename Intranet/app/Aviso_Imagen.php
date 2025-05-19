<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso_Imagen extends Model
{
    protected $table = "image_notice";

    protected $fillable = ['Name_image', 'Notice_id'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Aviso(){

        return $this->belongsTo('App\Aviso', 'Notice_id');
        
    }
}
