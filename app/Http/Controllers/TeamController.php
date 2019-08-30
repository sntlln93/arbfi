<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Session::has('userSession')){
            $teams = Team::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.teams.table')->with('teams', $teams);
                                              
    }

    /**
     * Call de pdfcrowd pdf api.
     *
     * @return \Illuminate\Http\Response
     */
    public function htmltopdf($id){
        $players = Team::find($id)->players;
        generatePDF($players);
    }
}
