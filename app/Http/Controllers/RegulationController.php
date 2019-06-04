<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Chapter;

class RegulationController extends Controller
{
    public function index(){
        if(Session::has('userSession')){
            $chapters = Chapter::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.regulation.index')->with('chapters', $chapters);
    }
}
