<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestor_Archivo_Separador; 
use App\Gestor_Archivo; 
use App\Departamento_rrhh;
use Laracasts\Flash\Flash; 
use Exception;
use Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class Gestor_Archivo_SeparadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Gestor_Archivo_Separador.create')->only(['create', 'store']);
        $this->middleware('permissions:Gestor_Archivo_Separador.edit')->only(['create', 'update']);
        $this->middleware('permissions:Gestor_Archivo_Separador.show')->only(['show']);
        $this->middleware('permissions:Gestor_Archivo_Separador.index')->only(['index']);
        $this->middleware('permissions:Gestor_Archivo_Separador.destroy')->only(['destroy']);
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
            $separador = new Gestor_Archivo_Separador();
            $separador->Name = $request->Name;
            $separador->Departament_id = $request->Departament_id;
            $separador->save();
            
            flash('Se creo con exito la nueva sección ')->success();
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Gestor_Archivo.index');
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
        try{    
            $separador = Gestor_Archivo_Separador::find($request['id']);
            $departamento = Departamento_rrhh::find($separador->Departament_id);

            Storage::rename('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name, 'Gestor_Archivos/'.$departamento->Departament_ES.'/'.$request->Name);
            $separador->Name = $request->Name;
            $separador->save();
            
            flash('Se editó con éxito la sección')->success();
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Gestor_Archivo.index');
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
            $separador = Gestor_Archivo_Separador::find($id);
            if($separador->Departament_id == 1000){

                $archivos =  Gestor_Archivo::where("Separator_id", $id)->get();

                foreach ($archivos as $archivo) {
                    Storage::delete('Gestor_Archivos/Material Corporativo/'.$separador->Name.'/'.$archivo->Name_file);
                    $archivo->delete();
                }
                Storage::deleteDirectory('Gestor_Archivos/Material Corporativo/'.$separador->Name);
                $separador->delete();

            }else{
                $departamento = Departamento_rrhh::find($separador->Departament_id);
                $archivos =  Gestor_Archivo::where("Separator_id", $id)->get();

                foreach ($archivos as $archivo) {
                    Storage::delete('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name.'/'.$archivo->Name_file);
                    $archivo->delete();
                }
                Storage::deleteDirectory('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name);
                $separador->delete();
            }
           

            flash('Se elimino con exito la sección ')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Gestor_Archivo.index');
        
    }

    public function Separator_list(Request $request, $id){

        if($request->ajax()){
            return Gestor_Archivo_Separador::select('Name', 'id')->where('Departament_id', $id)->get();

        }
    }


    public function Departament_list(Request $request){

        if($request->ajax()){
            return Departamento_rrhh::select('Departament_ES', 'id')->get();

        }
    }
}
