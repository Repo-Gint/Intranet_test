<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use File;
use Intervention\Image\ImageManager;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Banner.create')->only(['create', 'store']);
        $this->middleware('permissions:Banner.edit')->only(['create', 'update']);
        $this->middleware('permissions:Banner.show')->only(['show']);
        $this->middleware('permissions:Banner.index')->only(['index']);
        $this->middleware('permissions:Banner.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $imagenes = Banner::get();
            return view('Banner.index')->with('imagenes', $imagenes);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('/Indice');
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
                    $banner = new Banner();
                    $intervention = new ImageManager(array('driver' => 'imagick'));
                    $file = $request->file('Name_file')[$i];
                    $name = $file->getClientOriginalName().'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                    $img = \Image::make($request->file('Name_file')[$i])->resize(1920, 500)->save('img/Banner/'.$name);
                    $banner->Name_file = $name;
                    $banner->save();
                }

                     flash('Se subieron con exito las imagenes', 'success');
            }
        }catch(Exception $e){
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Banner.index');
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
            $banner = Banner::find($id);
            unlink('img/Banner/'.$banner->Name_file);
            $banner->delete();
            flash('Se elimino la imagen correctamente.')->success();
        }catch(Exception $e){
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Banner.index');
    }
}
