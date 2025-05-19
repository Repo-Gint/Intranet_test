<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Aviso extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'Slug' => [
                'source' => 'Name'
            ]
        ];
    }

    protected $table = "notices";

    protected $fillable = ['Type', 'Name', 'Description', 'Link','Image', 'Maps', 'Publication_date', 'End_date'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Archivos (){

        return $this->hasMany('App\Aviso_Archivo', 'Notice_id');
        
    }

    //Relación Uno : Muchos Puestos y Departamentos
    public function Imagenes (){

        return $this->hasMany('App\Aviso_Imagen', 'Notice_id');
        
    }
    
}
