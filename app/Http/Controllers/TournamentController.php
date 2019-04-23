<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tournament;
use App\TournamentType;
use App\Category;
use DB;
use App\Fixture;
use Carbon\Carbon;
use App\Institution;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('userSession')){
            $tournaments = Tournament::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.tournament.table')->with('tournaments', $tournaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::has('userSession')){
            $tournament = new Tournament;
            $this->validate($request,[
                'name' => 'required',
                'type_id' => 'required',
            ]);
            $tournament->name = mb_strToUpper($request->name);
            $tournament->type_id = $request->type_id;
            $tournament->save();
            $categories = array();

            for($i = 0; $i < sizeof($request->categories); $i++){
                $category = Category::find($request->categories[$i]);
                $categories[$i][0] = $category->id;
                $categories[$i][1] = $category->name;
            }
            
            if($tournament->type->type == "AAA"){
                foreach($request->categories as $category){
                    $teams = DB::table('teams')->where('category_id', $category)->get();
                    
                    for($i = 0; $i< $teams->count(); $i++){ //fixture_day
                        
                        for($j = $i+1; $j < $teams->count(); $j++){
                            $match = new Fixture;
                            $match->local_team_id = $teams[$i]->id;
                            $match->visiting_team_id = $teams[$j]->id;
                            $match->state = "no jugado";
                            $match->tournament_id = $tournament->id;
                            $match->local_score = 0;
                            $match->visiting_score = 0;
                            $match->location ="A definir";
                            $match->date = null;
                            $match->fixture_day = 0;
                            $match->save();
                        }

                        if($tournament->type->round_trip){
                            for($j = $teams->count()-1; $j > 0; $j--){
                                $match = new Fixture;
                                $match->local_team_id = $teams[$i]->id;
                                $match->visiting_team_id = $teams[$j]->id;
                                $match->state = "no jugado";
                                $match->tournament_id = $tournament->id;
                                $match->local_score = 0;
                                $match->visiting_score = 0;
                                $match->location ="A definir";
                                $match->date = null;
                                $match->fixture_day = 0;
                                $match->save();
                            }
                        }
                        
                    }
                    
                }
                
            }elseif($tournament->type->type == "PVP"){
                $teams = Institution::all();
                return view('dashboard.tournament.playoffs')->with('tournament',$tournament)
                                                            ->with('teams',$teams)
                                                            ->with('categories',$categories);
            }elseif($tournament->type->type == "GF"){
                return view('dashboard.tournament.group');//->with(,);
            }
            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/tournaments');
    }

    public function playoffMaker(Request $request, $id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $tournament = Tournament::find($id);

        for($j = 0; $j < sizeof($request->categories); $j++){
            for ($i = 0; $i < count($request->teams)-1; $i++){
                $match = new Fixture;
                $match->tournament_id = $tournament->id;
                $match->local_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i])->where('category_id', $request->categories[$j])->get()[0]->id;
                $match->visiting_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i+1])->where('category_id', $request->categories[$j])->get()[0]->id;
                $match->state = "no jugado";
                $match->local_score = 0;
                $match->visiting_score = 0;
                $match->location ="A definir";
                $match->date = null;
                if($tournament->roundtrip) $match->fixture_day = "Primera fase | Ida";
                else $match->fixture_day = "Primera fase | Partido único";
                $match->save();
    
                if($tournament->type->round_trip){
                    $match = new Fixture;
                    $match->tournament_id = $tournament->id;
                    $match->local_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i+1])->where('category_id', $request->categories[$j])->get()[0]->id;
                    $match->visiting_team_id = DB::table('teams')->select('id')->where('club_id', $request->teams[$i])->where('category_id', $request->categories[$j])->get()[0]->id;
                    $match->state = "no jugado";
                    $match->local_score = 0;
                    $match->visiting_score = 0;
                    $match->location ="A definir";
                    $match->date = null;
                    $match->fixture_day = "Primera fase | Vuelta";
                    $match->save(); 
                }
            }
        }

        return redirect('/tournaments');
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
            $tournament = Tournament::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard/tournament/edit')->with('tournament',$tournament);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Session::has('userSession')){
            $item = Tournament::find($id);
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/tournaments');
    }

    
}
