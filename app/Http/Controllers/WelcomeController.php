<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Fixture;
use App\Scoreboard;
use App\Institution;

class WelcomeController extends Controller
{
    public function index(){
        
        $data = DB::table('fixtures')->where('state', '<>', 'no jugado')->get();
        $scoreboard = Scoreboard::all()->sortByDesc('points');
        $institutions = Institution::all();
        $scores = array();
        $i = 0; 
        foreach($institutions as $club){
            
            $points = 0;
            
            foreach($scoreboard as $score){
                if($club->name == $score->team->club->name){
                    $points = $points + $score->points;
                }
            }
            $scores[$i][0] = $club->name;
            $scores[$i][1] = $points;
            $i++;
        }

        

        return view('website.home')->with('fixture', $data)
                           ->with('scores', $scores);
    }
}
