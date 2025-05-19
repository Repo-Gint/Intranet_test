<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permisos_Salida;
use App\Empleado_rrhh;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
class Permisos_SalidaController extends Controller
{
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
            $permiso = new Permisos_Salida();
            $permiso->working_hours = $request['working_hours'];
            $permiso->enjoy_salary = $request['enjoy_salary'];
            $permiso->date = $request['date'];
            $permiso->departure_time = $request['departure_time'];

            if($request['return_time'] == 'Sin Retorno'){
               $permiso->return_time = '00:00:00';
            }else{
                $permiso->return_time = $request['return_time'];
            }
            $permiso->reason = $request['reason'];
            $permiso->way_to_pay = $request['way_to_pay'];
            $permiso->Employee_id = $request['id'];

            $permiso->save();

            $pdf = \PDF::loadView('Pdf.Permiso_Salida', ['permiso' => $permiso])->setPaper('letter', 'landscape');

            flash('Se genero con exito el permiso, se descargara enseguida el formato.')->success();
            return $pdf->download('Permiso_de_Salida.pdf');
            //route('salida', $permiso->id);
        }catch(Exception $e){
            return Redirect::back()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
            return redirect('/Indice');
        }
        
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
        //
    }

    public function permiso_salida($id){
        $permiso = Permisos_Salida::where('id', $id)->first();
        $pdf = \PDF::loadView('Pdf.Permiso_Salida', ['permiso' => $permiso])->setPaper('letter', 'landscape');
        return $pdf->download('Permiso_de_Salida.pdf');
    }
}
