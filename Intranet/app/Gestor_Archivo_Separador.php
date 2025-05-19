<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class Gestor_Archivo_Separador extends Model
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
    protected $table = "fm_separator";

    protected $fillable = ['Name', 'Departament_id'];

    //Relación Uno : Muchos Puestos y Departamentos
    public function Departamento(){

        return $this->belongsTo('App\Departamento_rrhh', 'fm_separator', 'Departament_id');
        
    }

    //Relación Uno : Muchos Puestos y Departamentos
    public function Gestor_Archivo (){

        return $this->hasMany('App\Gestor_Archivo', 'Separator_id');
        
    }

    public static function get_separador($id){
        $secciones = DB::table('fm_separator')->select('id','Name')->where('Departament_id', $id)->get();

       /* $secciones_array = array();
        $i = 0;
        foreach ($secciones as $seccion) {

            $secciones_array[$i] = array('id' => $seccion->id, 'Name' => $seccion->Name);
            $i++;
        }
        //dd($seccions_array);
        $coleccion = collect($seccions_array);*/
        
        return $secciones;//Puesto::where('positions.Active', '=', 1)->where('Departament_id','=', $id)->get();
    }
}
