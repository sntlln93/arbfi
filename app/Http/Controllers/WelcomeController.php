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
        
        $data = Fixture::all()->where('state', '<>', 'no jugado');
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

        $fixture = array();
        $i = 0;
        foreach ($data as $match){
            $fixture[$i][0] = $match->tournament->name;
            $fixture[$i][1] = $match->local->category->name;
            $fixture[$i][2] = $match->date;
            $fixture[$i][3] = $match->local->club->name;
            $fixture[$i][4] = $match->local_score;
            $fixture[$i][5] = $match->visiting->club->name;
            $fixture[$i][6] = $match->visiting_score;
            if($i++ >3) break;

        }

        
        return view('website.home')->with('fixture', $fixture)
                           ->with('scores', $scores);
    }
}
