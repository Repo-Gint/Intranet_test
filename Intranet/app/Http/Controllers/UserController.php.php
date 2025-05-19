<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:User.create')->only(['create', 'store']);
        $this->middleware('permissions:User.edit')->only(['create', 'update']);
        $this->middleware('permissions:User.show')->only(['show']);
        $this->middleware('permissions:User.index')->only(['index']);
        $this->middleware('permissions:User.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::get();
        $roles = Role::get();
        $lista_roles = $roles->pluck('name', 'id');
        $lista_roles->put('Sin Rol', 'Sin Rol');

        return view('Usuario.index')->with('usuarios', $usuarios)->with('roles', $roles)->with('lista_roles', $lista_roles);
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
        //
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

    public function roles (Request $request, $id){
        try{

            $user = User::find($request['id']);

            if($request->get('roles') == 'Sin Rol'){
                $user->roles()->detach();
                flash('Se elimino el rol con exito al usuario.', 'success');
            }else{
                $user->roles()->sync($request->get('roles'));
                flash('Se coloco correctamente el rol', 'success');
            }
            
        }catch(Exception $e){
             flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Usuarios.index');
    }
}
