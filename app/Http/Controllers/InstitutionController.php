<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Institution;
use App\Category;
use App\Team;
use DB;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('userSession')){
            $clubs = Institution::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.institutions.table')->with('clubs', $clubs);
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

        return view('dashboard.institutions.create');
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
            $club = new Institution;
            $this->validate($request,[
                'name' => 'required',
                'responsable' => 'required',
                'stadium' => 'required',
                'image' => 'required|file|image|max:5000',
            ]);
            $club->name = mb_strToUpper($request->name);
            $club->responsable = mb_strToUpper($request->responsable);
            $club->stadium = mb_strToUpper($request->stadium);
            $club->image_id = newImage($request, 'clubs');
            $club->save();
            
            

            $categories = Category::all();
            
            foreach($categories as $category){
                $team = new Team;
                $team->club_id = $club->id;
                $team->category_id = $category->id;
                $team->manager_id = 1;
                $team->save();
            }

            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/institutions');
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
            $club = Institution::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard.institutions.edit')->with('club', $club);
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
            
            $club = Institution::find($id);
            $this->validate($request,[
                'name' => 'required',
                'responsable' => 'required',
                'stadium' => 'required',
            ]);
            $club->name = mb_strToUpper($request->name);
            $club->responsable = mb_strToUpper($request->responsable);
            $club->stadium = mb_strToUpper($request->stadium);  
            if($request->has('image')){
                $club->image_id = newImage($request, 'clubs');
            }
            $club->save();
            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/institutions');
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
            $item = Institution::find($id);
            $teams = Team::all();
            //$teams = DB::table('teams')->select('id')->where('club_id',$id)->get();
            foreach($teams as $team){
                if($team->club_id == $id){
                    foreach($team->players as $player){
                        $player->delete();
                    }
                    $team->delete();
                }
            }
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/institutions');
    }
}
