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
use App\Event;
use App\Player;

class WelcomeController extends Controller
{
    public function index(){
        $clubs = Institution::all();
        $posts = DB::table('posts')->orderByDesc('created_at')->get();
        $recents = Fixture::where('state', 'no jugado')->orderByDesc('id')->get();//DB::table('fixtures')->where('state', '<>', 'no jugado')->get();
        $tocome = Fixture::where('state', 'JUGADO')->orderBy('id')->get();
        $categories = Category::all();
        $scoreboard = $this->categoriesScoreboards();
        $general = $this->challengerScoreboard($scoreboard);
        $goal_makers = $this->goals();
        $fair_play = $this->fairplay();
        

        return view('website.homeTest') ->with('recents', $recents)
                                        ->with('next', $tocome)
                                        ->with('scores', $general)
                                        ->with('posts', $posts)
                                        ->with('categories', $categories)
                                        ->with('scoreboards', $scoreboard)
                                        ->with('goal_makers', $goal_makers)
                                        ->with('fair_play', $fair_play);
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
        $playerEvents = $this->playersTable($id);
        return view('website.team')->with('team', $team)->with('fixtures', $fixtures)->with('playerEvents', $playerEvents);
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
        $categories = Category::all();
        $tables = $this->categoriesScoreboards();
        $scoreboard = $this->sort_tables($tables); 
        $general = $this->challengerScoreboard($scoreboard);

        return view('website.tournament')->with('tables', $scoreboard)
                                         ->with('categories', $categories)
                                         ->with('general', $general);
    }

    public function categoriesScoreboards(){
        $teams = Team::all();
        $tables = array();
        
        foreach($teams as $team){//make scoreboard
            $row = DB::table('fixtures')->select()->where(function ($query) use ($team){
                                                      $query->where('local_team_id', $team->id)
                                                            ->orWhere('visiting_team_id', $team->id);
                                                  })
                                                  ->where('state', 'JUGADO')
                                                  ->get();

            $wins = 0; $losses = 0; $ties = 0; $points = 0; $goals = 0;
            foreach($row as $match){ 
                $tables[$team->category_id][$team->id]['name'] = $team->club->name;
                if(!array_key_exists('points', $tables[$team->category_id][$team->id])){
                    $tables[$team->category_id][$team->id]['goals_favor'] = 0;
                    $tables[$team->category_id][$team->id]['goals_against'] = 0;
                    $tables[$team->category_id][$team->id]['wins'] = 0;
                    $tables[$team->category_id][$team->id]['ties'] = 0;
                    $tables[$team->category_id][$team->id]['losses'] = 0;
                    $tables[$team->category_id][$team->id]['points'] = 0;
                    $tables[$team->category_id][$team->id]['category'] = $team->category_id;
                }
                if($team->id == $match->local_team_id){
                    if($match->local_score > $match->visiting_score){
                        $tables[$team->category_id][$team->id]['wins']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->local_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->visiting_score;
                        $tables[$team->category_id][$team->id]['points'] += 2;
                    }else if($match->local_score < $match->visiting_score){
                        $tables[$team->category_id][$team->id]['losses']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->local_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->visiting_score;
                    }else{
                        $tables[$team->category_id][$team->id]['ties']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->local_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->visiting_score;
                        $tables[$team->category_id][$team->id]['points']++;
                    }
                }else{
                    if($match->local_score > $match->visiting_score){
                        $tables[$team->category_id][$team->id]['losses']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->visiting_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->local_score;
                    }else if($match->local_score < $match->visiting_score){
                        $tables[$team->category_id][$team->id]['wins']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->visiting_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->local_score;
                        $tables[$team->category_id][$team->id]['points'] += 2;
                    }else{
                        $tables[$team->category_id][$team->id]['ties']++;
                        $tables[$team->category_id][$team->id]['goals_favor'] += $match->visiting_score;
                        $tables[$team->category_id][$team->id]['goals_against'] += $match->local_score;
                        $tables[$team->category_id][$team->id]['points']++;
                    }
                }
            }  
        } 
        return $this->sort_tables($tables, 'points');
    }

    public function challengerScoreboard($score){
        $institutions = Institution::all();
        $scores = array();
        $i = 0; 
        
        //making it
        foreach($institutions as $club){    
            $goals_favor = 0;
            $goals_against = 0;
            $wins = 0;
            $ties = 0;
            $losses = 0;
            $points = 0;
            foreach($score as $categories){
                foreach($categories as $row){
                    if($club->name == $row['name']){ //aca deberia sólo debería traer los equipos de la institución para no iterar y comparar tanto
                        $points = $points + $row['points'];
                        $wins = $wins + $row['wins'];
                        $ties = $ties + $row['ties'];
                        $losses = $losses + $row['losses'];
                        $goals_favor = $goals_favor + $row['goals_favor'];
                        $goals_against = $goals_against + $row['goals_against'];
                    }
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

    public function sort_tables($tables, $subkey){
        $c = array();
        foreach($tables as $table){
        array_push($c, $this->sort($table, $subkey));

        }
        return $c;
    }

    public function sort($categories, $subkey){
        foreach($categories as $key=>$value){
            $b[$key] = $value[$subkey];
        }
        arsort($b);
        foreach($b as $key=>$val){
            $c[] = $categories[$key];
        } 
        return $c; 
    }

    public function goals(){
        $query = 'select
                        categories.name,
                        players.last_name,
                        players.first_name,
                        count(events.player_id) as goals,
                        team.path_file
                from 
                        events
                join
                        players on events.player_id = players.id
                join
                        (select
                                teams.id,
                                teams.category_id, 
                                institutions.path_file 
                        from 
                                teams, institutions 
                        where 
                                teams.club_id = institutions.id
                        ) as team on players.team_id = team.id
                join
                        categories on team.category_id = categories.id
                where 
                        type = "Gol"
                group by 
                        events.player_id
                order by 
                        goals desc;';
        $goal_makers = DB::select($query);
        
        return $goal_makers;
    }

    public function playersTable($id){
        $team = Team::find($id);
        $playerEvents = array();
        foreach($team->players as $player){
            $goal = 0;
            $yellow = 0;
            $red = 0;
            $green = 0;
            foreach($player->event as $action){
                if($action->type == 'Gol') $goal++;
                elseif($action->type == 'Amarilla') $yellow++;
                elseif($action->type == 'Roja') $red++;
                elseif($action->type == 'Vede') $green++;
            }
            $playerEvents[$player->id]['Gol'] = $goal;
            $playerEvents[$player->id]['Amarilla'] = $yellow;
            $playerEvents[$player->id]['Roja'] = $red;
            $playerEvents[$player->id]['Verde'] = $green;
        }

    return $playerEvents;
    }

    public function fairplay(){
        $fair_play = array();
        $teams = Team::all();    
        $categories = Category::all();  
        
        foreach($categories as $category){
            foreach($category->teams as $team){
                $yellow = 0; $red = 0; $green = 0;
                foreach($team->events as $event){
                    if($event->type == 'Amarilla') $yellow++;
                    elseif($event->type == 'Roja') $red++;
                    elseif($event->type == 'Verde') $green++;
                }
                $fair_play[$category->id][$team->id]['Categoria'] = $team->category->name;
                $fair_play[$category->id][$team->id]['Equipo'] = $team->club->name;
                $fair_play[$category->id][$team->id]['Amarilla'] = $yellow;
                $fair_play[$category->id][$team->id]['Roja'] = $red;
                $fair_play[$category->id][$team->id]['Verde'] = $green;
                $fair_play[$category->id][$team->id]['Puntos'] = $yellow + $red*2 - $green;
            }
        }
        return $this->sort_tables($fair_play, 'Puntos');
    }

    public function challengerFairplay(){
        
    }
}
