<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden_mantenimiento;


use Laracasts\Flash\Flash;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect;
use Mail;

class Orden_mantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        try{
            $ordenes = Orden_mantenimiento::where('departament_id', departamento(auth()->user()->Empleado_rrhh, 'Id'))->orderBy('aplication_date', 'DESC')->get();
            return view('Orden_Mantenimiento.index')->with('ordenes', $ordenes);
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
        return view('Orden_Mantenimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $correos = array();
        try{

            if($request['type_order_id'] <= 2 && $request['machine_id'] == null){
                throw new Exception("Al seleccionar el tipo de orden maquinaria, es obligatorio seleccionar alguna máquina.");                    
            }
            if($request['type_order_id'] == 3  && $request['object'] == null){
                throw new Exception("Al seleccionar el tipo de orden Mant. General, es obligatorio llenar el campo objeto.");                    
            }
            if($request['type_order_id'] == 4 && $request['proyect'] == null){
                throw new Exception("Al seleccionar el tipo de orden proyecto, es obligatorio llenar el campo proyecto.");                    
            }
            if($request['priority_id'] == 4 && $request['scheduled_date'] == null){
                throw new Exception("Al seleccionar la prioridad programada, es obligatorio llenar el campo de F. programada.");                    
            }
            if($request['type_order_id'] <= 3 && $request['received_image'] == null){
                throw new Exception("Al seleccionar el tipo de orden Maquinaria o Mant. General, es obligatorio subir imagen de la falla o el problema.");                    
            }
            $orden = new Orden_mantenimiento();
            $numero_orden = numero_orden($request);
            $orden->code = $numero_orden;

            if($request['type_order_id'] <= 2){
                $orden->object = null;
                $orden->machine_id = $request['machine_id'];
            }else{

                if($request['type_order_id'] == 3){
                    $orden->object = $request['object'];
                }else{
                    $orden->object = $request['proyect'];
                }
                
                $orden->machine_id = null;
            }
            
            $orden->description = $request['description'];
            $orden->aplication_date = date('Y-m-d H:i:s');

            if($request['priority_id'] == 4){
                $orden->scheduled_date = $request['scheduled_date'];
            }else{
                $orden->scheduled_date = null;
            }

            $orden->reception_date = null;
            $orden->ending_date = null;
            $orden->delivery_date = null;
            $orden->received_clean = null;
            $orden->delivered_clean = null;
            $orden->start_date = null;
            $orden->end_life = null;
            $orden->functional = null;
            $orden->first_comment = null;
            $orden->second_comment = null;
            if($request['type_order_id'] <= 3){

                if($request->hasFile('received_image')){
                    $intervention = new ImageManager(array('driver' => 'imagick'));
                    $file = $request->file('received_image');
                    $name_img = $numero_orden.'_'.date('Y-m-d').time().'.'.$file->getClientOriginalExtension();
                    $img = \Image::make($request->file('received_image'))->resize(750, 500)->save('C:/xampp/Mantenimiento/public/img/Ordenes_imagenes/'.$name_img);
                    $orden->received_image = $name_img;     
                }
            }else{
                $orden->received_image = null;
            }
            $orden->delivered_image = null;
            $orden->departament_id = $request['departament_id'];
            $orden->employee_id = $request['employee_id'];
            if($request['type_order_id'] < 3){
                $orden->maintenance_id = 2; //si orden es de maquinaria la orden que genera el usuario sera correctivo id = 2
           }else{
                $orden->maintenance_id = null; // si orden es proyecto o general el mantenimiento se queda nulo.
           }
            

            $orden->type_order_id = $request['type_order_id'];
            $orden->priority_id = $request['priority_id'];
            $orden->failure_id = null;
            $orden->status_id = 1;
            $orden->save();

            crear_registro_costo($orden->id);

            $correos = array('Maintenance@grupointerconsult.com', 'Alvaro.Velasquez@grupointerconsult.com', 'Carmen.Reyes@grupointerconsult.com');
            Mail::send('Emails.Orden_Mantenimiento', ['orden' => $orden, 'request'=>$request], function($msj) use($correos){
                $msj->subject('Nueva Orden de Mantenimiento');
               //$msj->to('Ana.Estrada@grupointerconsult.com');
                $msj->to(auth()->user()->Empleado_rrhh->Contactos->Business_mail);
                $msj->cc($correos);
                $msj->bcc('Ana.Estrada@grupointerconsult.com');
            });

            flash('Se creó con éxito la orden con el número '.$orden->code)->success();
        }catch(Exception $e){
             return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Orden_Mantenimiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $orden = Orden_mantenimiento::where('code', $code)->first();

        return view('Orden_Mantenimiento.show')->with('orden', $orden);
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

    function get_machines($id){
        //$id = id del tipo de orden
        if($id == 1){ //maquinaria cnc
            $maquinas = DB::connection('mysql_mantenimiento')->table('machines')->select(DB::raw('CONCAT(name," ",serial," ",year) AS name'), 'id')->where('area_id', 1)->get();
        }
        if($id == 2){ //maquinaria ppl
            $maquinas = DB::connection('mysql_mantenimiento')->table('machines')->select(DB::raw('CONCAT(name," ",serial," ",year) AS name'), 'id')->where('area_id', 2)->get();
        }
        return response()->json($maquinas);
    }
}
