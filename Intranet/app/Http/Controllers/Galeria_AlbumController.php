<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria_Album;
use App\Galeria;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use File;
class Galeria_AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Galeria_Album.create')->only(['create', 'store']);
        $this->middleware('permissions:Galeria_Album.edit')->only(['create', 'update']);
        //$this->middleware('permissions:Galeria_Album.show')->only(['show']);
        //$this->middleware('permissions:Galeria_Album.index')->only(['index']);
        $this->middleware('permissions:Galeria_Album.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $album = new Galeria_Album($request->all());
            File::makeDirectory("img/Galeria/".$album->Name);
            File::makeDirectory("img/Galeria/".$album->Name."/thumb");
            $album->save();
            
            flash('Se creó con exito el nuevo album')->success();
            
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
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
        try{
            $fotos = Galeria::where('Album_id', $id)->get();
            $album = Galeria_Album::find($id);
            return view('Galeria.Fotos')->with('fotos', $fotos)->with('album', $album);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Galeria_GI');
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
       try{    
            $album = Galeria_Album::find($request['id']);
            rename("img/Galeria/".$album->Name, "img/Galeria/".$request['Name']);
            $album->fill($request->all());
            $album->save();
            flash('Se editó con éxito el album')->success();
            return redirect()->route('Galeria.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Galeria.index');
        }
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
            $album = Galeria_Album::find($id);
            foreach ($album->Galeria as $imagen) {
                $img = Galeria::find($imagen->id);
                unlink('img/Galeria/'.$album->Name.'/'.$imagen->Name_picture);
                unlink('img/Galeria/'.$album->Name.'/thumb/thumb-'.$imagen->Name_picture);
                $img->delete();
            }
            rmdir("img/Galeria/".$album->Name."/thumb");
            rmdir("img/Galeria/".$album->Name);
            $album->delete();
            flash('Se elimino con éxito el album')->success();
            return redirect()->route('Galeria.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Galeria.index');
        }
    }
}
