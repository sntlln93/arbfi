<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Chapter;
use App\Article;
use App\Subsection;
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
        $clubs = Institution::all();
        $posts = DB::table('posts')->orderByDesc('created_at')->get();
        $recents = Fixture::where('state', 'no jugado')->orderByDesc('id')->get();//DB::table('fixtures')->where('state', '<>', 'no jugado')->get();
        $tocome = Fixture::where('state', 'JUGADO')->orderBy('id')->get();
        $scoreboard = Scoreboard::all()->sortByDesc('points');
        $categories = Category::all();
        $scores = $this->challengerScoreboard();
        
        return view('website.homeTest') ->with('recents', $recents)
                                        ->with('next', $tocome)
                                        ->with('scores', $scores)
                                        ->with('posts', $posts)
                                        ->with('categories', $categories)
                                        ->with('scoreboards', $scoreboard);
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
        $chapters = Chapter::all()->sortBy('id');
        return view('website.regulation')->with('chapters', $chapters);
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
        $general = $this->challengerScoreboard();

        return view('website.tournament')->with('scoreboard', $scoreboard)
                                         ->with('categories', $categories)
                                         ->with('general', $general);
    }

    public function challengerScoreboard(){
        $institutions = Institution::all();
        $scores = array();
        $scoreboard = Scoreboard::all()->sortByDesc('points');
        $i = 0; 
        
        //making it
        foreach($institutions as $club){    
            $goals_favor = 0;
            $goals_against = 0;
            $wins = 0;
            $ties = 0;
            $losses = 0;
            $points = 0;
            foreach($scoreboard as $score){
                if($club->name == $score->team->club->name){ //aca deberia sólo debería traer los equipos de la institución para no iterar y comparar tanto
                    $points = $points + $score->points;
                    $wins = $wins + $score->wins;
                    $ties = $ties + $score->ties;
                    $losses = $losses + $score->losses;
                    $goals_favor = $goals_favor + $score->goals_favor;
                    $goals_against = $goals_against + $score->goals_against;
                }
            }
            $scores[$i][0] = $club->name;
            $scores[$i][1] = $points;
            $scores[$i][2] = $wins;
            $scores[$i][3] = $ties;
            $scores[$i][4] = $losses;
            $scores[$i][5] = $goals_favor;
            $scores[$i][6] = $goals_against;
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
        
        return $scores;
    }
}
