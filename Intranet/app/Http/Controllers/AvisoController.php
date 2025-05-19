<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aviso;
use App\Aviso_Archivo;
use App\Aviso_Imagen;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use File;
use Intervention\Image\ImageManager;

class AvisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Aviso.create')->only(['create', 'store']);
        $this->middleware('permissions:Aviso.edit')->only(['edit', 'update']);
        $this->middleware('permissions:Aviso.show')->only(['show']);
        $this->middleware('permissions:Aviso.index')->only(['index']);
        $this->middleware('permissions:Aviso.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $avisos = Aviso::orderBy('Publication_date', 'DESC')->get();
            return view('Aviso.index')->with('avisos', $avisos);
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
        return view('Aviso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Type' => 'required',
            'Name' => 'required',
            'Publication_date' => 'required',
            'End_date' => 'required|after:Publication_date'
        ]);
        if($request['Type'] == 1){
            $request->validate([
                'Image' => 'required',
                'Description' => 'required'
            ]);
        }else{
            $request->validate([
                'Image' => 'required',
                'Link' => 'required'
            ]);
        }
        
        try{
            $aviso = new Aviso($request->all());

            File::makeDirectory("Avisos/".$request['Name']."_".$request['Publication_date']);
            if($request->hasFile('Image')){

                $intervention = new ImageManager(array('driver' => 'imagick'));
                $file = $request->file('Image');
                $name_img = date('Y-m-d').time().'.'.$file->getClientOriginalExtension();
                $img = \Image::make($request->file('Image'))->resize(750, 500)->save('Avisos/'.$request['Name'].'_'.$request['Publication_date'].'/'.$name_img);
                $aviso->Image = $name_img;     

            }

            $aviso->save();

            if($request->hasFile('Name_file')){
                for ($i=0; $i < count($request['Name_file']); $i++) { 

                    $file = $request->file('Name_file')[$i];
                    $name_file = date('Ymd').time().$i.'_'.$file->getClientOriginalName();

                    $file->move('Avisos/'.$request['Name'].'_'.$request['Publication_date'], $name_file);

                    $archivo = new Aviso_Archivo();
                    $archivo->Name_file = $name_file;
                    $archivo->Aviso()->associate($aviso->id);
                    $archivo->save();

                }
            }

            if($request->hasFile('Name_image')){

                for ($i=0; $i < count($request['Name_image']); $i++) { 

                    $image = $request->file('Name_image')[$i];
                    $name = date('Ymd').time().$i.'_'.$image->getClientOriginalName();
                    $image->move('Avisos/'.$request['Name'].'_'.$request['Publication_date'], $name);
                    $imagen = new Aviso_Imagen();
                    $imagen->Name_image = $name;
                    $imagen->Aviso()->associate($aviso->id);
                    $imagen->save();

                }

            }
            
            flash('Se guardo con éxito el nuevo aviso')->success();
            
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Aviso.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try{
            $aviso = Aviso::whereSlug($slug)->firstOrFail(); 

            $archivos = $aviso->Archivos;
            $imagenes = $aviso->Imagenes;

            return view('Aviso.show')->with('aviso', $aviso)->with('archivos', $archivos)->with('imagenes', $imagenes);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Aviso.index');
        } 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        try{
            $aviso = Aviso::whereSlug($slug)->firstOrFail(); 

            $archivos = $aviso->Archivos;
            $imagenes = $aviso->Imagenes;

            return view('Aviso.edit')->with('aviso', $aviso)->with('archivos', $archivos)->with('imagenes', $imagenes);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Aviso.index');
        }
        
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
        $aviso = Aviso::find($id);
//dd($request->Name_file);
        if($aviso->Name != $request['Name'] || $aviso->Publication_date != $request['Publication_date'] ){
            rename("Avisos/".$aviso->Name."_".$aviso->Publication_date, "Avisos/".$request['Name']."_".$request['Publication_date']);
            $aviso->Name = $request['Name'];
            $aviso->Slug = $request['Name'];
            $aviso->Publication_date = $request['Publication_date'];
        }
        if($request->hasFile('Image')){
            if($aviso->Image != null || !empty($aviso->Image)){
                unlink('Avisos/'.$request['Name'].'_'.$request['Publication_date'].'/'.$aviso->Image);
            }
            $intervention = new ImageManager(array('driver' => 'imagick'));
            $file = $request->file('Image');
            $name_img = date('Y-m-d').time().'.'.$file->getClientOriginalExtension();
            $img = \Image::make($request->file('Image'))->resize(750, 500)->save('Avisos/'.$request['Name'].'_'.$request['Publication_date'].'/'.$name_img);
            $aviso->Image = $name_img;     
        }

        if($request->hasFile('Name_file')){
            for ($i=0; $i < count($request['Name_file']); $i++) { 

                $file = $request->file('Name_file')[$i];
                $name = date('Ymd').time().$i.'_'.$file->getClientOriginalName();
                $file->move('Avisos/'.$request['Name'].'_'.$request['Publication_date'], $name);

                $archivo = new Aviso_Archivo();
                $archivo->Name_file = $name;
                $archivo->Aviso()->associate($aviso->id);
                $archivo->save();
            }
        }

        if($request->hasFile('Name_image')){
            for ($i=0; $i < count($request['Name_image']); $i++) { 
                $image = $request->file('Name_image')[$i];
                $name = date('Ymd').time().$i.'_'.$image->getClientOriginalName();
                $image->move('Avisos/'.$request['Name'].'_'.$request['Publication_date'], $name);

                $imagen = new Aviso_Imagen();
                $imagen->Name_image = $name;
                $imagen->Aviso()->associate($aviso->id);
                $imagen->save();
            }
        }


        $aviso->Description = $request['Description'];
        $aviso->Maps = $request['Maps'];
        $aviso->End_date = $request['End_date'];
        $aviso->save();
        flash('Se edito con exito el aviso', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Aviso.edit', $aviso->Slug);
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
            $aviso = Aviso::find($id);
            $archivos = $aviso->Archivos;
            $imagenes = $aviso->Imagenes;
            foreach ($archivos as $archivo) {
                 unlink('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$archivo->Name_file);
                 $archivo->delete();
            }
            foreach ($imagenes as $imagen) {
                 unlink('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$imagen->Name_image);
                 $imagen->delete();
            }
            unlink('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image);
            rmdir("Avisos/".$aviso->Name.'_'.$aviso->Publication_date);
            $aviso->delete();
            flash('Se elimino con exito el aviso', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Aviso.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar_archivo($id)
    {
        try{

            $archivo = Aviso_Archivo::find($id);
            $aviso = $archivo->Aviso;
            unlink('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$archivo->Name_file);
            $archivo->delete();
            flash('Se elimino con exito el archivo', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Aviso.edit', $aviso->Slug);
    }


    public function eliminar_imagen($id)
    {
        try{

            $imagen = Aviso_Imagen::find($id);
            $aviso = $imagen->Aviso;
            unlink('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$imagen->Name_image);
            $imagen->delete();
            flash('Se elimino con exito el imagen', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Aviso.edit', $aviso->Slug);
    }

    public function download($id){
        try{
            $archivo = Aviso_Archivo::find($id);
            $aviso = Aviso::find($archivo->Notice_id);
            return response()->download(public_path('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$archivo->Name_file));


        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ver($slug)
    {
        try{
            $aviso = Aviso::whereSlug($slug)->firstOrFail(); 

            $archivos = $aviso->Archivos;
            $imagenes = $aviso->Imagenes;

            return view('/Aviso')->with('aviso', $aviso)->with('archivos', $archivos)->with('imagenes', $imagenes);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('/Indice');
        } 

    }

    public function avisos()
    {
        try{
            $avisos = Aviso::orderBy('Publication_date', 'DESC')->paginate(10);
            return view('/Avisos')->with('avisos', $avisos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('Indice');
        }
    }
}
