<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestor_Archivo;
use App\Departamento_rrhh;
use App\Gestor_Archivo_Separador;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Gestor_ArchivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Gestor_Archivo.create')->only(['create', 'store']);
        $this->middleware('permissions:Gestor_Archivo.edit')->only(['create', 'update']);
        $this->middleware('permissions:Gestor_Archivo.show')->only(['show']);
        $this->middleware('permissions:Gestor_Archivo.index')->only(['index']);
        $this->middleware('permissions:Gestor_Archivo.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departamentos = Departamento_rrhh::select('id', 'Departament_ES', 'Slug')->get();
        $departamentos_lista = Departamento_rrhh::pluck('Departament_ES', 'id');
        $departamentos_lista->put(1000,'Material Corporativo');
        $separadores = Gestor_Archivo_Separador::get();
        return view('/Gestor_Archivo.index')->with('departamentos',$departamentos)->with('departamentos_lista',$departamentos_lista);
        /*try{
            $archivos = Gestor_Archivo::get();
            $departamentos_lista = Departamento_rrhh::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id');
            $departamentos_lista->put(1000, "Material Corporativo");

            $departamentos = Departamento_rrhh::get();
            return view('Gestor_Archivo.index')->with('archivos', $archivos)->with('departamentos_lista', $departamentos_lista)->with('departamentos', $departamentos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('/Indice');
        }*/
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
                return response()->json($data = ['message' => 'No se seleccionaron archivos.'], $status = 500);
            } 

            if($request->Departament_id == 1000){
                
                $separador = Gestor_Archivo_Separador::find($request->Separator_id);  

                if(!Storage::exists('Gestor_Archivos/Material Corporativo')){
                    Storage::makeDirectory('Gestor_Archivos/Material Corporativo');
                }

                if(!Storage::exists('Gestor_Archivos/Material Corporativo/'.$separador->Name)){
                    Storage::makeDirectory('Gestor_Archivos/Material Corporativo/'.$separador->Name);
                }

                for ($i=0; $i < count($request['Name_file']); $i++) { 
                    $archivo = new Gestor_Archivo();
                    $file = $request->file('Name_file')[$i];
                    $name = $file->getClientOriginalName();
                    //\Storage::disk('local')->put($name,  \File::get($file));
                    Storage::put('Gestor_Archivos/Material Corporativo/'.$separador->Name.'/'.$name,  \File::get($file));
                    $archivo->Name_file = $name;
                    $archivo->Separador()->associate($request['Separator_id']);
                    $archivo->save();
                }
            }else{
                $departamento = Departamento_rrhh::find($request->Departament_id);
                $separador = Gestor_Archivo_Separador::find($request->Separator_id);  

                if(!Storage::exists('Gestor_Archivos/'.$departamento->Departament_ES)){
                    Storage::makeDirectory('Gestor_Archivos/'.$departamento->Departament_ES);
                }

                if(!Storage::exists('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name)){
                    Storage::makeDirectory('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name);
                }

                for ($i=0; $i < count($request['Name_file']); $i++) { 
                    $archivo = new Gestor_Archivo();
                    $file = $request->file('Name_file')[$i];
                    $name = $file->getClientOriginalName();
                    //\Storage::disk('local')->put($name,  \File::get($file));
                    Storage::put('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name.'/'.$name,  \File::get($file));
                    $archivo->Name_file = $name;
                    $archivo->Separador()->associate($request['Separator_id']);
                    $archivo->save();
                }
            }
            

            

            flash('Se subierón con exito los archivos')->success();
        }catch(Exception $e){
           return response()->json($data = ['message' => $e->getMessage()], $status = 500);
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
            $archivo = Gestor_Archivo::find($id);
            $separador = Gestor_Archivo_Separador::find($archivo->Separator_id);
            if($separador->Departament_id == 1000){
                Storage::delete('Gestor_Archivos/Material Corporativo/'.$separador->Name.'/'.$archivo->Name_file);
                $archivo->delete();
            }else{
                $departamento = Departamento_rrhh::find($separador->Departament_id);

                Storage::delete('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name.'/'.$archivo->Name_file);
                $archivo->delete();

            }
            
            flash('Se elimino con exito el archivo ')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Gestor_Archivo.index');
    }

    public function download($id){
       try{
            $archivo = Gestor_Archivo::find($id);
            $separador = Gestor_Archivo_Separador::find($archivo->Separator_id);
            if($separador->Departament_id == 1000){
                 return Storage::download('Gestor_Archivos/Material Corporativo/'.$separador->Name.'/'.$archivo->Name_file);
            }else{
                $departamento = Departamento_rrhh::find($separador->Departament_id);

                return Storage::download('Gestor_Archivos/'.$departamento->Departament_ES.'/'.$separador->Name.'/'.$archivo->Name_file);   
            }
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
    }
}
