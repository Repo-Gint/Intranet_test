<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservacion;
use Laracasts\Flash\Flash;
use Exception;
use Redirect;
use File;
use Mail;
use Intervention\Image\ImageManager;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permissions:Calendario.create')->only(['create', 'store']);
        //$this->middleware('permissions:Calendario.edit')->only(['create', 'update']);
        $this->middleware('permissions:Calendario.show')->only(['show']);
        //$this->middleware('permissions:Calendario.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $name = array(
                'Junta Interna' => 'Junta Interna', 
                'Capacitación' => 'Capacitación',
                'Visita de Cliente' => 'Visita de Cliente',
                'Visita de Proveedor' => 'Visita de Proveedor',
            );

            $place = array(
                'Sala de Juntas Edificio 1' => 'Sala de Juntas Edificio 1',
                'Sala de Juntas Edificio 1 - Dirección' => 'Sala de Juntas Edificio 1 - Dirección',
                'Sala de Entrenamiento 1 Edificio 1' => 'Sala de Entrenamiento 1 Edificio 1',
                'Sala de Entrenamiento 2 Edificio 1' => 'Sala de Entrenamiento 2 Edificio 1',
                'Sala de Juntas Edificio 2 - PPL' => 'Sala de Juntas Edificio 2 - PPL'
            );

            $mis_reservaciones = Reservacion::where('Employee_id', auth()->user()->Empleado_rrhh->id)
            ->where('Date', '>=', date('Y-m-d'))
            ->get();
            $reservaciones_hoy = Reservacion::where('Date', date('Y-m-d'))->get();
            $reservaciones = Reservacion::where('Date', '>=', date('Y-m-d'))->orderBy('Date', 'DESC')->get();

            return view('Calendario.index')->with('name', $name)->with('place', $place)->with('reservaciones', $reservaciones)->with('reservaciones_hoy', $reservaciones_hoy)->with('mis_reservaciones', $mis_reservaciones);
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
            //dd(DB::connection('mysql_rrhh')->table('employees')->where('id', $id_empleado)->first(););
            $validacion = Validar_Reservacion($request);
           // dd($validacion);
            if($validacion != 'Exito'){
                throw new Exception($validacion);
            }
            $reservacion = new Reservacion();
            
            $reservacion->Name = $request['Name'];
            //dd($reservacion);
            $reservacion->Description = $request['Description'];
            $reservacion->Place = $request['Place'];

            if($request['Visits'] == 1 ){
                if(empty($request['People']) || $request['People'] == null){
                    throw new Exception("Debe de llenar el campo Personas que visitan.");
                }

                if(empty($request['Visit']) || $request['Visit'] == null){
                    throw new Exception("Debe de llenar el campo Empresa que visita.");
                }
                $reservacion->Visit = $request['Visit'];
                $reservacion->People = $request['People'];
                if($request['Display'] == 1){
                    if(!$request->hasFile('file')){
                        throw new Exception("Debe de seleccionar la imagen del logotipo de la empresa que visita.");
                    }      
                }
                
                if($request['Parking'] == 1){
                    if(empty($request['Estacionamiento']) || $request['Estacionamiento'] == null){
                        throw new Exception("Debe de llenar el campo cajones de estacionamiento.");
                    }
                    $reservacion->Parking = $request['Estacionamiento'];
                }

            }else{
                 $reservacion->People = NULL;
                 $reservacion->Visit = NULL;
                $reservacion->Parking = NULL;
            }


            $supplies = '';
            //dd($request['Supplies']);
            if($request['Supplies'] != null){
                 for ($i=0; $i < count($request['Supplies']); $i++) { 
                    $supplies .= $request['Supplies'][$i].',';
                }
            }else{
                $supplies = 'N/A';
            }

            $system = '';
            if($request['System'] != null){
                 for ($i=0; $i < count($request['System']); $i++) { 
                    $system .= $request['System'][$i].',';
                }
            }else{
                $system = 'N/A';
            }
            
            $reservacion->Supplies = $supplies;
            $reservacion->System = $system;

            $reservacion->Date = $request['Date'];
            $reservacion->Time_start = $request['Time_start'];
            $reservacion->Time_end = $request['Time_end'];
            $reservacion->Employee_id = auth()->user()->Empleado_rrhh->id;
            $reservacion->save();

            if($request->hasFile('file')){
                $intervention = new ImageManager(array('driver' => 'imagick'));
                $file = $request->file('file');
                $name = $request['Visit'].'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                $img = \Image::make($request->file('file'))->save('img/Logos_empresa/'.$name);
            }
            $correos = array('Capital.Humano@grupointerconsult.com', 'Carmen.Reyes@grupointerconsult.com', 'Ana.Estrada@grupointerconsult.com', 'eduardo.saldana@grupointerconsult.com', 'Stefany.Roman@grupointerconsult.com');

            if($system != 'N/A'){
                array_push($correos, 'Ana.Estrada@grupointerconsult.com', 'eduardo.saldana@grupointerconsult.com');
            }

            if($request['Parking'] == 1){
                array_push($correos, 'Encarnacion.Alvirde@grupointerconsult.com');
            }

            if($request['Display'] == 1){
                Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj) use($file, $name, $correos){
                    $msj->subject('Solicitud - Reservación Sala de Juntas');
                    $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                    $msj->cc($correos);
                    $msj->attach('img/Logos_empresa/'.$name, [
                        'as' => $name,
                        'mime' => $file->getMimeType(),
                    ]);
                   
                });
            }else{
                Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj) use($correos){
                    $msj->subject('Solicitud - Reservación Sala de Juntas');
                    $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                    $msj->cc($correos);
                });
            }

            /*if($system != 'N/A'){
                if($request['Display'] == 1){
                    Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj) use($file, $name){
                        $msj->subject('Solicitud - Reservación Sala de Juntas');
                        $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                        $msj->cc([
                            'Ana.Estrada@grupointerconsult.com', 
                            'eduardo.saldana@grupointerconsult.com', 
                            'Capital.Humano@grupointerconsult.com',
                            'Carmen.Reyes@grupointerconsult.com',
                            'Encarnacion.Alvirde@grupointerconsult.com',
                            'Stefany.Roman@grupointerconsult.com'
                        ]);
                        $msj->attach('img/Logos_empresa/'.$name, [
                            'as' => $name,
                            'mime' => $file->getMimeType(),
                        ]);
                    });
                }else{
                    Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj){
                        $msj->subject('Solicitud - Reservación Sala de Juntas');
                        $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                        $msj->cc([
                            'Ana.Estrada@grupointerconsult.com', 
                            'eduardo.saldana@grupointerconsult.com',
                            'Carmen.Reyes@grupointerconsult.com' 
                            'Capital.Humano@grupointerconsult.com',
                            'Stefany.Roman@grupointerconsult.com'
                        ]);
                    });
                }
            }else{
                 if($request['Display'] == 1){
                    Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj) use($file, $name){
                        $msj->subject('Solicitud - Reservación Sala de Juntas');
                        $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                        $msj->cc(['Capital.Humano@grupointerconsult.com', 'eduardo.saldana@grupointerconsult.com', 'Ana.Estrada@grupointerconsult.com', 'Carmen.Reyes@grupointerconsult.com', 'Stefany.Roman@grupointerconsult.com', 'Encarnacion.Alvirde@grupointerconsult.com']);
                        $msj->attach('img/Logos_empresa/'.$name, [
                            'as' => $name,
                            'mime' => $file->getMimeType(),
                        ]);
                    });
                }else{
                    Mail::send('Emails.Sala_juntas', ['reservacion' => $reservacion, 'request'=>$request], function($msj){
                        $msj->subject('Solicitud - Reservación Sala de Juntas');
                        $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                        $msj->cc(['Capital.Humano@grupointerconsult.com', 'Ana.Estrada@grupointerconsult.com', 'eduardo.saldana@grupointerconsult.com', 'Carmen.Reyes@grupointerconsult.com', 'Stefany.Roman@grupointerconsult.com']);
                    });
                }
            }*/
            

            flash('Se genero con exito la reservación.')->success();

        }catch(Exception $e){
           //return response()->json($data = ['message' => $e->getMessage()], $status = 500);
            flash('Error: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Calendario.index');
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
            $reservacion = Reservacion::find($id);
            $reservacion->delete();

            flash("Se elimino con éxito la reservación.", "success");
        }catch(Exception $e){
            flash("Error: ". $e->getMessage(), "danger");
        }
        return redirect()->route('Calendario.index');
    }
}
