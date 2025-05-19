<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner_Ti;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use File;
use Intervention\Image\ImageManager;

class Banner_TiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Banner_Ti.create')->only(['create', 'store']);
        $this->middleware('permissions:Banner_Ti.edit')->only(['create', 'update']);
        $this->middleware('permissions:Banner_Ti.show')->only(['show']);
        $this->middleware('permissions:Banner_Ti.index')->only(['index']);
        $this->middleware('permissions:Banner_Ti.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $imagenes = Banner_Ti::get();
            return view('Banner_Ti.index')->with('imagenes', $imagenes);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('Indice');
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
            if(empty($request['Name_file'])){
                throw new Exception('No se seleccionaron imagenes.');
            }
            if($request->hasFile('Name_file')){
                $intervention = new ImageManager(array('driver' => 'imagick'));
                for ($i=0; $i < count($request['Name_file']); $i++) { 
                    $banner = new Banner_Ti();
                    $intervention = new ImageManager(array('driver' => 'imagick'));
                    $file = $request->file('Name_file')[$i];
                    $name = $file->getClientOriginalName().'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                    $img = \Image::make($request->file('Name_file')[$i])->resize(960, 720)->save('img/Banner_Ti/'.$name);
                    $banner->Name_file = $name;
                    $banner->save();
                }

                flash('Se subieron con exito las imagenes', 'success');
            }
        }catch(Exception $e){
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Banner_Ti.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            $banner = Banner_Ti::find($id);
            unlink('img/Banner_Ti/'.$banner->Name_file);
            $banner->delete();
            flash('Se elimino la imagen correctamente.')->success();
        }catch(Exception $e){
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Banner_Ti.index');
    }
}
