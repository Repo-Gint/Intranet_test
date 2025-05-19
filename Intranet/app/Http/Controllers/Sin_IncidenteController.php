<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sin_Incidente;
class Sin_IncidenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Sin_Incidente.create')->only(['create', 'store']);
        $this->middleware('permissions:Sin_Incidente.edit')->only(['create', 'update']);
        $this->middleware('permissions:Sin_Incidente.show')->only(['show']);
        $this->middleware('permissions:Sin_Incidente.index')->only(['index']);
        $this->middleware('permissions:Sin_Incidente.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidentes = Sin_Incidente::orderBy('Incident_day', 'DESC')->get();
        //dd($incidentes);
        return view('Incidencias.index')->with('incidentes', $incidentes);
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
            $incidente = new Sin_Incidente();
            $incidente->Incident_day = $request['Incident_day'];
            $incidente->Reason = $request['Reason'];
            $incidente->save();

            flash('Se guardo conexito el registro.', 'success');

        }catch(Exception $e){
             return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Sin_Incidente.index');
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
            $incidente = Sin_Incidente::find($request['id']);
            $incidente->Incident_day = $request['Incident_day'];
            $incidente->Reason = $request['Reason'];
            $incidente->save();

            flash('Se editó con éxito el registro', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Sin_Incidente.index');
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
            $incidente = Sin_Incidente::find($id);
            $incidente->delete();
        flash('Se elimino con éxito el registro', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Sin_Incidente.index');
    }
}
