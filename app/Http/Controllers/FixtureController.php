<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App;
use DB;
use App\Team;
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
            
            $local_aux = DB::table('scoreboards')->select()->where('tournament_id', $match->tournament_id)
                                                           ->Where('team_id', $match->local_team_id)
                                                           ->get();
            $visiting_aux = DB::table('scoreboards')->select()->where('tournament_id', $match->tournament_id)
                                                              ->Where('team_id', $match->local_team_id)
                                                              ->get();
            
            if(sizeof($local_aux)>0) $local = Scoreboard::find($local_aux[0]->id);
            else $local = new Scoreboard;

            if(sizeof($visiting_aux) > 0) $visiting = Scoreboard::find($visiting_aux[0]->id);
            else $visiting = new Scoreboard;

            $local->tournament_id = $match->tournament_id;
            $visiting->tournament_id = $match->tournament_id;

            $local->team_id = $match->local_team_id;
            $visiting->team_id = $match->visiting_team_id;

            $local->goals_favor = $local->goals_favor + $match->local_score;
            $local->goals_against = $local->goals_against + $match->visiting_score;

            $visiting->goals_favor = $visiting->goals_favor + $match->visiting_score;
            $visiting->goals_against = $visiting->goals_against + $match->local_score;


            if($match->local_score > $match->visiting_score){
                $local->points = $local->points + 2;

                $local->wins = $local->wins + 1;
                $visiting->losses = $local->losses + 1;
            }else if($match->local_score == $match->visiting_score){
                $local->points = $local->points + 1;
                $visiting->points = $visiting->points + 1;

                $local->ties = $local->ties + 1;
                $visiting->ties = $visiting->ties + 1;
            }else{
                $visiting->points = $visiting->points + 2;

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

    public function htmlToPdf($id){
        $match = Fixture::find($id);
        $local = DB::table('players')->select('last_name','first_name')->where('team_id',$match->local_team_id)->get();
        $away = DB::table('players')->select('last_name','first_name')->where('team_id',$match->visiting_team_id)->get();
        
        $size = sizeof($away);
        if(sizeof($local) > sizeof($away)) $size = sizeof($local);
        $colspan = 6+$size;
        
        $teamsGrid = $this->generatePlayersGrid($match->id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<table border="1" style="border-collapse:collapse;" width="267mm">
                            <tr style="text-align:center">
                                <td colspan="15"><b>ARBFI<br>Asociación Riojana de Baby Fútbol Infantil</b></td>
                            </tr>
                            <tr style="text-align:center">
                                <th colspan="11">TORNEO "'.$match->tournament->name.'" CATEGORÍA '.$match->local->category->name.'</th>
                                
                                <th colspan="4">Fecha '.$match->fixture_day.'°</th>
                            </tr>
                            <tr style="text-align:center">
                                <td colspan="7">Local: '.$match->local->club->name.'</td>
                                <td rowspan="20"></td>
                                <td colspan="7">Visitante: '.$match->visiting->club->name.'</td>
                            </tr>
                            <tr style="text-align:center">
                                <td>N°</td>
                                <td>Apellido y nombre</td>
                                <td>Firma</td>
                                <td>A</td>
                                <td>R</td>
                                <td>V</td>
                                <td>G</td>

                                <td>N°</td>
                                <td>Apellido y nombre</td>
                                <td>Firma</td>
                                <td>A</td>
                                <td>R</td>
                                <td>V</td>
                                <td>G</td>
                            </tr>
                                '
                                .$teamsGrid.
                                '
                            <tr>
                            <td colspan="3">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td colspan="6">Árbitro:</td>
                            <td></td>
                            <td colspan="6">1° tiempo:</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td colspan="6">Delegado gral:</td>
                            <td></td>
                            <td colspan="6">2° tiempo:</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td colspan="6">Delegado de mesa:</td>
                            <td></td>
                            <td colspan="6">Delegado de mesa:</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td colspan="6">DT:</td>
                            <td></td>
                            <td colspan="6">DT:</td>
                            </tr>
                            <tr>
                            <td colspan="15"><br></td>
                            </tr>
                            <tr>
                            <td colspan="15">Observaciones:<br><br><br></td>
                            </tr>
                        </table>');
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($match->tournament->name.'_fecha_'.$match->fixture_day.'.pdf');
    }

    public function generatePlayersGrid($id){
        $match = Fixture::find($id);
        $local = DB::table('players')->select('last_name','first_name')->where('team_id',$match->local_team_id)->get();
        $away = DB::table('players')->select('last_name','first_name')->where('team_id',$match->visiting_team_id)->get();
        $teamGrid = '';
        
        $limit = sizeof($away);
        if(sizeof($local) > sizeof($away)) $limit = sizeof($local);
        
        for($i = 0; $i < 15; $i++){
            if($i < sizeof($local) AND $i < sizeof($away)){
                
                $teamGrid .= '
                <tr style="text-align:center">
                <td></td>
                <td width="25%">'.$local[$i]->last_name.' '.$local[$i]->first_name.'</td>
                <td width="10%">.....................</td>
                <td></td>
                <td></td>
                <td></td>
                <td width="7%"></td>
                
                <td></td>

                <td width="25%">'.$away[$i]->last_name.' '.$away[$i]->first_name.'</td>
                <td width="10%">.....................</td>
                <td></td>
                <td></td>
                <td></td>
                <td width="7%"></td>
                </tr>';
            }else if($i < sizeof($local) AND $i > sizeof($away) OR $i > sizeof($local) AND $i < sizeof($away)){
                if($i >= sizeof($local)){
                    $teamGrid .= '
                                <tr style="text-align:center">
                                <td></td>
                                <td width="25%"></td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                
                                <td></td>
                                <td width="25%">'.$away[$i]->last_name.' '.$away[$i]->first_name.'</td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                </tr>';
                }else if(!sizeof($local) AND !sizeof($away)){
                    $teamGrid .= '
                                <tr style="text-align:center">
                                <td></td>
                                <td width="25%"></td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                
                                <td></td>
                                <td width="25%"></td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                </tr>';
                }else{
                    $teamGrid .= '
                                <tr style="text-align:center">
                                <td></td>
                                <td width="25%">'.$local[$i]->last_name.' '.$local[$i]->first_name.'</td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                
                                <td></td>
                                <td width="25%"></td>
                                <td width="10%">.....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="7%"></td>
                                </tr>';
                }
            }
        }
        if(sizeof($local)>sizeof($away)) $excess = 14 - sizeof($local);
        else $excess = 14 - sizeof($away);
        
        for ($i = 0; $i < $excess; $i++) {
            $teamGrid .= '
                        <tr style="text-align:center">
                        <td></td>
                        <td width="25%"></td>
                        <td width="10%">......................</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="7%"></td>
                        
                        <td></td>
                        <td width="25%"></td>
                        <td width="10%">.....................</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="7%"></td>
                        </tr>';
        }
        return $teamGrid;
    }    
}
