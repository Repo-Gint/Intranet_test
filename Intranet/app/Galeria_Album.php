<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Galeria_Album extends Model
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
    protected $table = "gallery_albums";

    protected $fillable = ['Name', 'Publication_date'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Galeria (){

        return $this->hasMany('App\Galeria', 'Album_id');
        
    }
}
