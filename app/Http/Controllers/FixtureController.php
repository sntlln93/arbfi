<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Fixture;
use App\Event;
use App\Scoreboard;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Session::has('userSession')){
            $fixtures = Fixture::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.fixtures.table')->with('fixtures', $fixtures);
                                              
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Session::has('userSession')){
            $match = Fixture::find($id);
            
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard/fixtures/edit')->with('match',$match);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Session::has('userSession')){
            $match = Fixture::find($id);
            $score = 0;
            /*$this->validate($request,[
                'local_score' => 'required|integer',
                'visiting_score' => 'required|integer',
            ]);*/
            
            foreach($match->local->players as $player){
                if($request->local_score[$player->id] != 0){
                    $score = $score + $request->local_score[$player->id];
                    for($i = 0; $i < $request->local_score[$player->id]; $i++){
                        $event = new Event;
                        $event->fixture_id = $match->id;
                        $event->player_id =  $player->id;
                        $event->type = "Gol";
                        $event->save();
                    }
                }
                if(isset($request->local_red[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Roja";
                    $event->save();
                }
                if(isset($request->local_yellow[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Amarilla";
                    $event->save();
                }
                if(isset($request->local_green[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Verde";
                    $event->save();
                }
                    
            }
            $match->local_score = $score;
            $score = 0;
            foreach($match->visiting->players as $player){
                if($request->visiting_score[$player->id] != 0){
                    $score = $score + $request->visiting_score[$player->id];
                    for($i = 0; $i < $request->visiting_score[$player->id]; $i++){
                        $event = new Event;
                        $event->fixture_id = $match->id;
                        $event->player_id =  $player->id;
                        $event->type = "Gol";
                        $event->save();
                    }
                }
                
                if(isset($request->visiting_red[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Roja";
                    $event->save();
                } 
                if(isset($request->visiting_yellow[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Amarilla";
                    $event->save();
                }
                if(isset($request->visiting_green[$player->id])){
                    $event = new Event;
                    $event->fixture_id = $match->id;
                    $event->player_id =  $player->id;
                    $event->type = "Verde";
                    $event->save();
                }
            }
            

            $match->visiting_score = $score;
            $match->state = "JUGADO";
            $match->save();

            $local = new Scoreboard;
            $visiting = new Scoreboard;

            $local->tournament_id = $match->tournament_id;
            $visiting->tournament_id = $match->tournament_id;

            $local->team_id = $match->local_team_id;
            $visiting->team_id = $match->visiting_team_id;

            $local->goals_favor = $local->goals_favor + $match->local_score;
            $local->goals_against = $local->goals_against + $match->visiting_score;

            $visiting->goals_favor = $visiting->goals_favor + $match->visiting_score;
            $visiting->goals_against = $visiting->goals_against + $match->local_score;


            if($match->local_score > $match->visiting_score){
                $local->points = $local->points + 3;

                $local->wins = $local->wins + 1;
                $visiting->losses = $local->losses + 1;
            }else if($match->local_score == $match->visiting_score){
                $local->points = $local->points + 1;
                $visiting->points = $visiting->points + 1;

                $local->ties = $local->ties + 1;
                $visiting->ties = $visiting->ties + 1;
            }else{
                $visiting->points = $visiting->points + 3;

                $local->losses = $local->losses + 1;
                $visiting->wins = $local->wins + 1;
            }
            
            $local->save(); $visiting->save();

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/fixtures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
