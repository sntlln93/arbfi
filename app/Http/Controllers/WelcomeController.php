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
        
        $tournament = Tournament::where('active', true)->first();
        $clubs = Institution::all();
        $categories = $tournament->categories;
        $posts = DB::table('posts')->orderByDesc('created_at')->get(); 

        
        return view('website.homeTest') ->with('scoreboards', $tournament->scoreboard)
                                        ->with('goal_makers', $tournament->goalMakers)
                                        ->with('fair_play', $tournament->fairPlay)
                                        ->with('categories', $categories)
                                        ->with('posts', $posts)
                                        ->with('tournament', $tournament);      
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
        $categories = Category::all();
        if($tournament->type->type == 'AAA'){
            $scoreboard = $tournament->scoreboard;
            $general = $tournament->challenger;
            return view('website.league')->with('tables', $scoreboard)
                                         ->with('categories', $categories)
                                         ->with('general', $general);
        }elseif($tournament->type->type == 'PVP'){

        }

        return view('website.groups')   ->with('categories', $categories)
                                        ->with('tournament', $tournament);   
    }

}