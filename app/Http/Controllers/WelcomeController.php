<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Tournament;
use App\Post;
use App\Fixture;
use App\Scoreboard;
use App\Institution;
use App\Category;
use App\Team;

class WelcomeController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->orderByDesc('created_at')->get();
        $recents = Fixture::where('state', 'no jugado')->orderByDesc('id')->get();//DB::table('fixtures')->where('state', '<>', 'no jugado')->get();
        $tocome = Fixture::where('state', 'JUGADO')->orderBy('id')->get();
        $scoreboard = Scoreboard::all()->sortByDesc('points');
        $institutions = Institution::all();
        $scores = array();
        $i = 0; 

        //making it
        foreach($institutions as $club){    
            $points = 0;
            foreach($scoreboard as $score){
                if($club->name == $score->team->club->name){ //aca deberia sólo debería traer los equipos de la institución para no iterar y comparar tanto
                    $points = $points + $score->points;
                }
            }
            $scores[$i][0] = $club->name;
            $scores[$i][1] = $points;
            $i++;
        }

        //sorting
        $aux = array();
        for($i = 0; $i < count($scores)-1; $i++){
            for($j = 0; $j < count($scores)-1; $j++){
                if($scores[$j][1] < $scores[$j+1][1]){
                    $aux = $scores[$j];
                    $scores[$j] = $scores[$j+1];
                    $scores[$j+1] = $aux;
                }
            }
        }
        
        return view('website.homeTest')->with('recents', $recents)
                                   ->with('next', $tocome)
                                   ->with('scores', $scores)
                                   ->with('posts', $posts);
    }

    public function galery(){
        return view('website.galery');
    }

    public function teams(){
        $categories = Category::all();
        return view('website.teams')->with('categories', $categories);
    }

    public function team($id){
        $team = Team::find($id);
        $fixtures = Fixture::where('local_team_id', $id)->orWhere('visiting_team_id', $id)->get();
        
        return view('website.team')->with('team', $team)->with('fixtures', $fixtures);
    }

    public function regulation(){
        return view('website.regulation');
    }

    public function fixtures(){
        $fixtures = Fixture::all();
        return view('website.fixtures')->with('fixtures', $fixtures);
    }

    public function contact(){
        return view('website.contact');
    }

    public function board(){
        return view('website.board');
    }
    public function partners(){
        return view('website.partners');
    }
    public function tournament($id){
        $scoreboard = tournament::find($id)->scoreboards;// DB::table('scoreboards')->select()->where('tournament_id', $id)->orderByDesc('points')->orderBy('goals_favor')->get();
        $categories = Category::all();


        return view('website.tournament')->with('scoreboard', $scoreboard)
                                         ->with('categories', $categories);
    }
}
