<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use App\Galeria_Album;
use Laracasts\Flash\Flash;
use Intervention\Image\ImageManager;
use Exception;
use Redirect;
use File;

class GaleriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Galeria.create')->only(['create', 'store']);
        $this->middleware('permissions:Galeria.edit')->only(['create', 'update']);
        $this->middleware('permissions:Galeria.show')->only(['show']);
        $this->middleware('permissions:Galeria.index')->only(['index']);
        $this->middleware('permissions:Galeria.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $galeria = Galeria::get();
            $albums_lista = Galeria_Album::orderBy('Publication_date', 'DESC')->pluck('Name', 'id');
            $albums = Galeria_Album::orderBy('Publication_date', 'DESC')->get();
            $meses = array(
                'Enero'=>'Enero', 
                'Febrero'=>'Febrero',
                'Marzo'=>'Marzo',
                'Abril'=>'Abril',
                'Mayo'=>'Mayo',
                'Junio'=>'Junio',
                'Julio'=>'Julio',
                'Agosto'=>'Agosto',
                'Septiembre'=>'Septiembre',
                'Octubre'=>'Octubre',
                'Noviembre'=>'Noviembre',
                'Diciembre'=>'Diciembre'
            );
            
            $y = (int) date('Y');
            $year = array(2000 => 2000);
            for ($i=2001; $i <= $y ; $i++) { 
                $v = ((int)$y) - $i;
                array_push($year, $i);
            }
            arsort($year);
            return view('Galeria.index')->with('galeria', $galeria)->with('albums_lista', $albums_lista)->with('albums', $albums)->with('meses', $meses)->with('year', $year);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect('/Indice');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if(empty($request['Name_picture'])){
                throw new Exception('No se seleccionaron los archivos.');
            }
            if($request->hasFile('Name_picture')){
                for ($i=0; $i < count($request['Name_picture']); $i++) { 
                    $galeria = new Galeria();
                    $intervention = new ImageManager(array('driver' => 'imagick'));
                    $file = $request->file('Name_picture')[$i];
                    $name = date('Y.m.d').'-'.time().'_'.$i.'.'.$file->getClientOriginalExtension();
                    $name_thumb = "thumb-".date('Y.m.d').'-'.time().'_'.$i.'.'.$file->getClientOriginalExtension();

                    $tamano = getimagesize($file);
                    //$tamano[0] = Ancho, $tamano[1]= Alto
                    if($tamano[0] > $tamano[1]){ //landscape
                        $img = \Image::make($request->file('Name_picture')[$i])->fit(1920, 1394, function ($constraint) {
                                    $constraint->upsize();
                                })->save('img/Galeria/'.nombre_album($request['Album_id']).'/'.$name);
                        $img_thumb = \Image::make($request->file('Name_picture')[$i])->fit(370, 220, function ($constraint) {
                                    $constraint->upsize();
                                })->save('img/Galeria/'.nombre_album($request['Album_id']).'/thumb/'.$name_thumb);
                    }

                    if($tamano[0] < $tamano[1]){ //portrait
                        $img = \Image::make($request->file('Name_picture')[$i])->fit(1394, 1920, function ($constraint) {
                                    $constraint->upsize();
                                })->save('img/Galeria/'.nombre_album($request['Album_id']).'/'.$name);
                        $img_thumb = \Image::make($request->file('Name_picture')[$i])->fit(370, 220, function ($constraint) {
                                    $constraint->upsize();
                                })->save('img/Galeria/'.nombre_album($request['Album_id']).'/thumb/'.$name_thumb);
                    }
                    
                    $galeria->Name_picture = $name;
                    $galeria->Album()->associate($request['Album_id']);
                    $galeria->save();
                }

                flash('Se subieron con exito los archivos', 'success');
            }
        }catch(Exception $e){
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Galeria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $imagen = Galeria::find($id);
            unlink('img/Galeria/'.nombre_album($imagen->Album->id).'/'.$imagen->Name_picture);
            unlink('img/Galeria/'.nombre_album($imagen->Album->id).'/thumb/thumb-'.$imagen->Name_picture);
            $imagen->delete();

            flash('Se elimino con exito el archivo ')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Galeria.index');
    }
}
