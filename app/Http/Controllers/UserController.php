<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Session;

class UserController extends Controller
{
    public function index(){
        if(Session::has('adminSession')){
            $datos = user::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
    	return view('models.user.table')->with('datos',$datos);
    }

    public function create(){
        if(!(Session::has('adminSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
    	return view('models.user.create');
    }

    public function store(Request $request){
    	
        if(Session::has('adminSession')){
            $datos = new User;
            $this->validate($request,[
                'username' => 'required',
                'cuil' => 'required|unique:users',
                'apellido' => 'required',
                'nombre' => 'required',
                'password' => 'required',
                'rol' => 'required',
            ]);
            $datos->username = mb_strToUpper($request->username);
            $datos->cuil = $request->cuil;
            $datos->apellido = mb_strToUpper($request->apellido);
            $datos->nombre = mb_strToUpper($request->nombre);
            $datos->password = hash::make($request->password);
            $datos->rol = $request->rol;
            $datos->save();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/usuarios');
    }

    public function destroy($id){
        if(Session::has('adminSession')){
            $item = User::find($id);
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/usuarios/');
    }

    

    public function edit($id){
        if(Session::has('adminSession')){
            $usuario = User::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('models/user/edit')->with('usuario',$usuario);
    }

    public function update(Request $request, $id){
        if($request->has('password_confirmation')){
            if(Session::has('userSession')){
                $datos = User::find($id);
                $this->validate($request,[
                        'password' => 'required|confirmed']);
                $datos->password = Hash::make($request->password);
                $datos->save();
                return redirect('/dashboard');
                }
        }else{
            if(Session::has('adminSession')){
                $datos = User::find($id);
                
                $this->validate($request,[
                    'username' => 'required',
                    'cuil' => 'required',
                    'apellido' => 'required',
                    'nombre' => 'required',
                    'password' => 'required',
                    'rol' => 'required',
                ]);
                $datos->username = mb_strToUpper($request->username);
                $datos->cuil = $request->cuil;
                $datos->apellido = mb_strToUpper($request->apellido);
                $datos->nombre = mb_strToUpper($request->nombre);
                if($request->password != $datos->password){
                    $datos->password = hash::make($request->password);
                }
                $datos->rol = $request->rol;
                $datos->save();
            }else{
                return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
            }        
            return redirect('/usuarios/');
    }
        }
        
}
