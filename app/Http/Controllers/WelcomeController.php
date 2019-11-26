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
        $posts = DB::table('posts')->orderByDesc('created_at')->get(); 
        $tournament = Tournament::where('active', true)->first();
        $clubs = Institution::all();
       
        if($tournament->type == 'AAA'){
            return view('website.homeLeague') 
                    ->with('scoreboards', $tournament->scoreboard) //scoreboard by category
                    ->with('goal_makers', $tournament->goalMakers) //
                    ->with('fair_play', $tournament->fairPlay)
                    ->with('categories', $tournament->categories)
                    ->with('challenger', $tournament->challenger) //general scoreboard
                    ->with('posts', $posts);
        }elseif($tournament->type == 'GF'){
            $teams = array();
            $results = array();
            $totalTeams = 2**floor(log($tournament->teams->count(),2)); 
            for($i = 0; $i < $tournament->fixtures->count(); $i++){
                array_push($teams, [$tournament->fixtures[$i]->local->club->name, $tournament->fixtures[$i]->visiting->club->name]);
            }
            foreach($tournament->fixtures as $match){
                if($match->state == "JUGADO"){
                    array_push($results, [$match->local_score, $match->visiting_score]);
                }
                else{
                    array_push($results, [null, null]);
                }
            }
            return view('website.homeGroup')
                    ->with('tournament', $tournament)
                    ->with('scoreboards', $tournament->scoreboards)
                    ->with('goal_makers', $tournament->goalMakers)
                    ->with('fair_play', $tournament->fairPlay)
                    ->with('posts', $posts)
                    ->with('teams', $teams)
                    ->with('results', $results);
        }

        return view('website.homePVP');
        
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
        
        return view('website.team')->with('team', $team);
    }

    public function regulation(){
        $chapters = Chapter::all()->sortBy('id');
        return view('website.regulation')->with('chapters', $chapters);
    }

    public function fixtures(){
        $fixtures = DB::select('
                    select 
                        (select name from institutions where institutions.id=
                                (select club_id from teams where teams.id=fixtures.local_team_id)) as local,
                        (select name from institutions where institutions.id=
                                (select club_id from teams where teams.id=fixtures.visiting_team_id)) as visiting,
                        (select path from images where images.id=
                                (select image_id from institutions where institutions.id=
                                        (select club_id from teams where teams.id=fixtures.local_team_id))) as local_image,
                        (select path from images where images.id=
                                (select image_id from institutions where institutions.id=
                                        (select club_id from teams where teams.id=fixtures.visiting_team_id))) as visiting_image,
                        fixture_day as date,
                        location,
                        (select name from categories where categories.id=
                                (select category_id from teams where id=fixtures.local_team_id)) as category
                    from fixtures
                    order by category,
                            fixture_day
                        
                    ');
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
        $tournament = Tournament::find($id);
        if($tournament->type == 'AAA'){
            return view('website.league')->with('tables', $tournament->scoreboard)
                                         ->with('categories', $tournament->categories)
                                         ->with('general', $tournament->challenger);
        }elseif($tournament->type == 'PVP'){

        }
        
        return view('website.groups')   ->with('categories', $tournament->categories)
                                        ->with('tournament', $tournament);   
    }

}