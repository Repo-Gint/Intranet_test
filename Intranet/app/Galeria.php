<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = "gallery";

    protected $fillable = ['Name_picture','Album_id'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Album(){

        return $this->belongsTo('App\Galeria_Album', 'Album_id');
        
    }
}
