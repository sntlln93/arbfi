<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tournament;
use App\TournamentType;
use App\Category;
use App\Scoreboard;
use App\Fixture;
use Carbon\Carbon;
use App\Institution;
use App\Group;

use DB;
use App;

class TournamentController extends Controller
{

    public function goldCup($id){
        if(! Session::has('userSession')){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $tournament = Tournament::find($id);
        $limit = 2**floor(log($tournament->teams->count(),2)); //la cantidad de llaves es la potencia de 2 más chica e inmediata a la cantidad de equipos dividida en 2
        
        return view('dashboard.tournament.create-gold-cup')->with('tournament', $tournament)->with('teams', $tournament->teams)->with('limit', $limit);

    }
    
    //1st round
    public function makeGoldCup(Request $request, $id){
        
        for($i = 0; $i < sizeof($request->teamsL); $i++){
            $match = new Fixture;
            $match->tournament_id = $id;
            $match->local_team_id = $request->teamsL[$i];
            $match->visiting_team_id = $request->teamsB[$i];
            $match->state = "no jugado";
            $match->local_score = 0;
            $match->visiting_score = 0;
            $match->location ="A definir";
            $match->date = null;
            $match->fixture_day = $i+1;
            $match->save();
        }

        

        return redirect('/tournaments');
    }

    private function powerOff($n){ return 2**floor(log($n,2)); }
    
    //Nst round
    public function makeNRound($id){ //datos que ya tengo-> numero de equipos, la cantidad de rondas (log2(totalteams)), la cantidad de partidos totales (igual a la cantidad de equipos)
        $played = Tournament::find($id)->playedMatches;
        $initialTeams = Tournament::find($id)->teams->count();
        $totalTeams = (int)$this->powerOff($initialTeams);
        
        for($i = 0; $i <= $played->count() / 2; $i+=2){
            $match = new Fixture;
            $match->tournament_id = $id;
            $match->local_team_id = $played[$i]->winnerIs;
            $match->visiting_team_id = $played[$i+1]->winnerIs;
            $match->state = "no jugado";
            $match->local_score = 0;
            $match->visiting_score = 0;
            $match->location ="A definir";
            $match->date = null;
            $match->fixture_day = ($totalTeams / 2) + (int)ceil($played->count() / 2);
            $match->save();
        }

        return redirect()->back();
    }

    public function index(){
        if(Session::has('userSession')){
            $tournaments = Tournament::all();
            if($tournaments->count() < 1) return redirect('tournaments/create');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.tournament.table')->with('tournaments', $tournaments);
    }
    
    public function create()
    {
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $types = TournamentType::all();
        $categories = Category::all();
        return view('dashboard.tournament.create')->with('types',$types)
                                                  ->with('categories',$categories);
    }
    
    public function store(Request $request){
        DB::update('update tournaments set active = false');
        if(Session::has('userSession')){
            $tournament = new Tournament;
            $teams = Institution::all();
            $categories = DB::table('categories')->get();
            $this->validate($request,[
                'name' => 'required',
                'type_id' => 'required',
            ]);
            $tournament->name = mb_strToUpper($request->name);
            $tournament->type_id = $request->type_id;
            $tournament->active = true;
            $tournament->save();

            if($tournament->type == "AAA"){
                $fixture_day = 1;
                if($teams->count()%2 == 0) $free = false; else $free = true;
                return view('dashboard.tournament.league')->with('tournament', $tournament)
                                                          ->with('teams', $teams)
                                                          ->with('categories', $categories)
                                                          ->with('fixture_day', $fixture_day)
                                                          ->with('free', $free);
            }elseif($tournament->type == "PVP"){
                return view('dashboard.tournament.playoffs')->with('tournament', $tournament)
                                                            ->with('teams', $teams)
                                                            ->with('categories', $categories)
                                                            ->with('fase', 1);
            }elseif($tournament->type == "GF"){
                return view('dashboard.tournament.groups')->with('tournament', $tournament)
                                                          ->with('teams', $teams)
                                                          ->with('categories', $categories);                                                         
            }
            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/tournaments');
    }

    public function leagueMaker(Request $request, $id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $fixture_day = $request->fixture_day;
        $categories = DB::table('categories')->whereIn('id', $request->categories)->get();

        
        $tournament = Tournament::find($id);
        $teams = Institution::all();
        if($teams->count()%2 == 0) $free = false; else $free = true;

        for($i = 0; $i < sizeof($request->categories); $i++){
            for($j = 0; $j < sizeof($request->teams)-1; $j+=2){
                $match = new Fixture;
                $match->tournament_id = $tournament->id;
                $match->local_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$j])
                                                                        ->where('category_id', $request->categories[$i])
                                                                        ->get()[0]->id;
                $match->visiting_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$j+1])
                                                                            ->where('category_id', $request->categories[$i])
                                                                            ->get()[0]->id;
                $match->state = "no jugado";
                $match->local_score = 0;
                $match->visiting_score = 0;
                $match->location ="A definir";
                $match->date = null;
                $match->fixture_day = $fixture_day;
                $match->save();

                if($tournament->round){
                    $match = new Fixture;
                    $match->tournament_id = $tournament->id;
                    $match->local_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$j+1])
                                                                            ->where('category_id', $request->categories[$i])
                                                                            ->get()[0]->id;
                    $match->visiting_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$j])
                                                                               ->where('category_id', $request->categories[$i])
                                                                               ->get()[0]->id;
                    $match->state = "no jugado";
                    $match->local_score = 0;
                    $match->visiting_score = 0;
                    $match->location ="A definir";
                    $match->date = null;
                    $match->fixture_day = sizeof($request->teams)+$fixture_day-1;
                    $match->save();
                }

            }
        }
        if(!$free){
            if($fixture_day < sizeof($request->teams)-1){
                $fixture_day++;
                return view('dashboard.tournament.league')->with('tournament', $tournament)
                                                              ->with('teams', $teams)
                                                              ->with('fixture_day', $fixture_day)
                                                              ->with('categories', $categories)
                                                              ->with('free', $free);
            }
        }else{
            if($fixture_day < sizeof($request->teams)){
                $fixture_day++;
                return view('dashboard.tournament.league')->with('tournament', $tournament)
                                                              ->with('teams', $teams)
                                                              ->with('fixture_day', $fixture_day)
                                                              ->with('categories', $categories)
                                                              ->with('free', $free);
            }
        }
        
        return redirect('/tournaments');       
    }

    public function playoffMaker(Request $request, $id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $tournament = Tournament::find($id);
        //dd($request->fase);
        for($j = 0; $j < sizeof($request->categories); $j++){
            for ($i = 0; $i < count($request->teams)-1; $i=$i+2){
                $match = new Fixture;
                $match->tournament_id = $tournament->id;
                $match->local_team_id = DB::table('teams')->select('id')
                                                          ->where('club_id', $request->teams[$i])
                                                          ->where('category_id', $request->categories[$j])
                                                          ->get()[0]->id;
                $match->visiting_team_id = DB::table('teams')->select('id')
                                                             ->where('club_id', $request->teams[$i+1])
                                                             ->where('category_id', $request->categories[$j])
                                                             ->get()[0]->id;
                $match->state = "no jugado";
                $match->local_score = 0;
                $match->visiting_score = 0;
                $match->location ="A definir";
                $match->date = null;
                if(!$tournament->round_trip) $match->fixture_day = $request->fase."° Fase | Ida";
                else $match->fixture_day = $request->fase."° Fase | Partido único";
                $match->save();
    
                if($tournament->round){
                    $match = new Fixture;
                    $match->tournament_id = $tournament->id;
                    $match->local_team_id = DB::table('teams')->select('id')
                                                            ->where('club_id', $request->teams[$i+1])
                                                            ->where('category_id', $request->categories[$j])
                                                            ->get()[0]->id;
                    $match->visiting_team_id = DB::table('teams')->select('id')
                                                                ->where('club_id', $request->teams[$i])
                                                                ->where('category_id', $request->categories[$j])
                                                                ->get()[0]->id;
                    $match->state = "no jugado";
                    $match->local_score = 0;
                    $match->visiting_score = 0;
                    $match->location ="A definir";
                    $match->date = null;
                    $match->fixture_day = $request->fase."° Fase | Vuelta";
                    $match->save(); 
                }
            }
        }

        return redirect('/tournaments');
    }

    public function faseGroupMaker(Request $request, $id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $categories = DB::table('categories')->whereIn('id', $request->categories)->get();
        $tournament = Tournament::find($id);
        $institutions = Institution::all();
        return view('dashboard.tournament.group')->with('tournament', $tournament)
                                                 ->with('quantity_teams', $request->quantity_teams)
                                                 ->with('quantity_groups', $request->quantity_groups)
                                                 ->with('clubs', $institutions)
                                                 ->with('categories', $categories);
    }

    public function groupMaker(Request $request, $id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        $limit = $request->quantity_teams/$request->quantity_groups;
        for($cat = 0; $cat < sizeof($request->categories); $cat++){ //itero categorias
            for($i = 0; $i < $request->quantity_groups; $i++){ //itero grupos 
                
                $group = new Group;
                $group->tournament_id = $id;
                $group->name = chr(65+$i);
                $group->save();
                for($pivot = 0; $pivot < $limit; $pivot++){$day = 1;
                    for($j = $pivot+1; $j < $limit; $j++){
                        if($request->teams[$i][$pivot] != 0 AND $request->teams[$i][$j] != 0){
                            $match = new Fixture;
                            $match->tournament_id = $group->id;
                            $match->local_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i][$pivot])
                                                                                    ->where('category_id', $request->categories[$cat])
                                                                                    ->get()[0]->id;
                            $match->visiting_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i][$j])
                                                                                    ->where('category_id', $request->categories[$cat])
                                                                                    ->get()[0]->id;
                            $match->date = null;
                            $match->fixture_day = $day++;
                            $match->location = "A definir";
                            $match->local_score = 0;
                            $match->visiting_score = 0;
                            $match->state = "no jugado";
                            $match->save();
                        }
                    }
                }
            }
        }

        return redirect('/fixtures');
    }
    
    public function show($id){
        $tournament = Tournament::find($id);
        if($tournament->type == 'AAA') $view = 'dashboard/tournament/showleague';
        elseif($tournament->type == 'GF') $view = 'dashboard/tournament/showgroup';
        else $view = 'dashboard/tournament/showplayoff';

        return view($view)->with('tournament', $tournament);

    }

    public function edit($id){
        if(Session::has('userSession')){
            $tournament = Tournament::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard/tournament/edit')->with('tournament',$tournament);
    }
    
    public function update(Request $request, $id){
        if(Session::has('userSession')){
            $tournament = Tournament::find($id);
            $this->validate($request,[
                'name' => 'required',
            ]);
            $tournament->name = mb_strToUpper($request->name);
            $tournament->save();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/tournaments');
    }
    
    public function destroy($id){
        if(Session::has('userSession')){
            $item = Tournament::find($id);
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/tournaments');
    }

    public function activate($id){
        $tournament = Tournament::find($id);
        DB::update('update tournaments set active = false');
        $tournament->active = true;
        $tournament->save();
        return redirect('/tournaments');
    }
}
