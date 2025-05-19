<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $this->validate(request(), [
            'name' => 'required|alpha_spaces',
            'password' => 'required'
        ]);

        $user = User::where('name', '=', $credentials['name'])->first();
            
           //dd($user->roles->last());
        if($user==null){
            return redirect('/')
            ->withErrors(['password' => 'Whoops !! Los datos que ingresaste no existen en nuestros registros'])
            ->withInput(request(['password']));
        }
       
        $rol = $user->roles->last();
        if($rol->special == 'no-access'){
            return back()
            ->withErrors(['password' => 'Whoops !! No tiene acceso al sistema.'])
            ->withInput(request(['paswword']));
                
        }
        
        if(Auth::attempt($credentials)){
            //dd(auth()->user()->Empleado->Photo);

            session()->put('Usuario_Intranet', 'value');
            return redirect('/Indice');
        }else{
            return redirect('/')
            ->withErrors(['password' => 'Whoops !! La contraseña es incorrecta, intenta de nuevo'])
            ->withInput(request(['name']));
        }
        
        
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
