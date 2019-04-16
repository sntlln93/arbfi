<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Session::has('userSession')){
            return redirect('/dashboard');
        }else{
            if ($request->isMethod('post')){
                $data = $request->input();
                
                if(Auth::attempt(['username'=>$data['username'], 'password'=>$data['password']])){
                    Session::put('userSession',$data['username']);
                    return redirect('dashboard');
                }else{
                    return redirect('/user')->with('flash_message_error','Usuario o contraseña incorrectos');
                }
            }
        }
        
        return view('auth/user_login');
    }

    public function logout(){
        Session::flush();
        return Redirect('/')->with('flash_message_success','Adiós');
    }

    public function index(){
        if(Session::has('userSession')){
            return view('dashboard/panel');
        }else{
           return redirect('/user')->with('flash_message_error','No tienes permiso para ver esta página. Coloca tus credenciales de acceso.');
       }
    }

    public function change(){
        if(Session::has('userSession')){
            return view('auth/change');
        }else{
           return redirect('/user')->with('flash_message_error','No tienes permiso para ver esta página. Coloca tus credenciales de acceso.');
       }
    }
}
