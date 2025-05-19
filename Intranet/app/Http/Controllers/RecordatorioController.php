<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recordatorio;

class RecordatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Recordatorio.create')->only(['create', 'store']);
        $this->middleware('permissions:Recordatorio.edit')->only(['create', 'update']);
        $this->middleware('permissions:Recordatorio.show')->only(['show']);
        $this->middleware('permissions:Recordatorio.index')->only(['index']);
        $this->middleware('permissions:Recordatorio.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recordatorios = Recordatorio::get();

        return view('Recordatorio.index')->with('recordatorios', $recordatorios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Recordatorio.create');
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
            $recordatorio = new Recordatorio();
            $recordatorio->Text = $request['Text'];
            $recordatorio->By = $request['By'];
            $recordatorio->Publication_date = $request['Publication_date'];
            $recordatorio->Ending_date = $request['Ending_date'];

            $recordatorio->save();

            flash('Se ha agregado con exito el nuevo registro', 'success');
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
            
        }

        return view('Recordatorio.create');
        
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
        $recordatorio = Recordatorio::find($id);

        return view('Recordatorio.edit')->with('recordatorio', $recordatorio);
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
            $recordatorio = Recordatorio::find($id);
            $recordatorio->Text = $request['Text'];
            $recordatorio->By = $request['By'];
            $recordatorio->Publication_date = $request['Publication_date'];
            $recordatorio->Ending_date = $request['Ending_date'];

            $recordatorio->save();

            flash('Se ha editado con exito el nuevo registro', 'success');
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
            
        }

        return redirect()->route('Recordatorio.index');
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
            $recordatorio = Recordatorio::find($id);
            $recordatorio->delete();            

            flash('Se ha editado con exito el nuevo registro', 'success');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }

         return redirect()->route('Recordatorio.index');
    }
}
