<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use DB;
use App;
use DateTime;


use Carbon\Carbon;
use App\Blood;
use App\Institution;
use App\Player;
use App\Category;

class PlayerController extends Controller
{
    public function index(){
        if(Session::has('userSession')){
            $players = Player::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.players.table')->with('players', $players);
                                              
    }

    public function htmlToPdf($id){
        $player = Player::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<table style="border:1 black solid; border-collapse:collapse;" width="110mm" height="100mm">
                            <tr style="text-align:center;">
                                <td colspan="2"> <h3>Asociación Riojana de Baby Fútbol Infantil</h3> </td>
                            </tr>
                            <tr>
                                <td rowspan="4" style="text-align:center;"> FOTO </td>
                                <td>Apellido y nombre: '.$player->last_name. ' '.$player->first_name.'</td>                                
                            </tr>
                            <tr>
                                <td>Equipo: '.$player->team->club->name.'</td>
                            </tr>
                            <tr>
                                <td>Categoría: '.$player->team->category->name.'</td>
                            </tr>
                            <tr>
                                <td>Fecha de nacimiento: '.$player->birth_date->format('d/m/Y').'</td>
                            </tr>
                            <tr>
                                <td colspan="2"> <br> </td>
                            </tr>
                        </table>');
        return $pdf->stream();
    }

    public function create(){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $clubs = Institution::all();
        $categories = Category::all();

        return view('dashboard.players.create')->with('categories',$categories)
                                               ->with('clubs', $clubs);
    }

    public function store(Request $request){
        if(Session::has('userSession')){
            $player = new Player;
            $this->validate($request,[
                'last_name' => 'required',
                'first_name' => 'required',
                'dni' => 'required|unique:players|max:9',
                'date_birth' => 'required',
                'institution_id' => 'required',
                'category_name' => 'required',
                'position' => 'required'
            ]);
            $player->last_name = mb_strToUpper($request->last_name);
            $player->first_name = mb_strToUpper($request->first_name);
            $player->position = mb_strToUpper($request->position);
            $player->school = mb_strToUpper($request->school);
            $player->prepaid = mb_strToUpper($request->prepaid);
            $player->dni = $request->dni;
            $player->path_file = 'img/frontend_img/players/0.jpg';
            $player->birth_date = $request->date_birth;
            
            $birth = new DateTime($request->date_birth);
            $daymonth = substr($request->date_birth, 4, 6);
            $category = new DateTime($request->category_name.$daymonth);
            
            if($birth >= $category){
                $category_id = DB::table('categories')->select('id')->where('name', $request->category_name)->get();
                
                
                
                $team = DB::table('teams')->select('id')->where('club_id', '=', (int)$request->institution_id)
                                                        ->where('category_id', '=', $category_id[0]->id)
                                                        ->get();
                $player->team_id = $team[0]->id;
                $player->save();                    
            }else{
                return redirect('/players/create')->with('flash_message_error','La categoría no puede ser mayor al año de nacimiento');
            }

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/players');
    }

    public function destroy($id){
        if(Session::has('userSession')){
            $item = Player::find($id);
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/players');
    }

    public function edit($id){
        if(Session::has('userSession')){
            $player = Player::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard/players/edit')->with('player',$player);
    }

    public function update(Request $request, $id){
        if(Session::has('userSession')){
            $player = Player::find($id);
            $this->validate($request,[
                'last_name' => 'required',
                'first_name' => 'required',
                'dni' => 'required',
                'date_birth' => 'required',
            ]);
            $player->last_name = mb_strToUpper($request->last_name);
            $player->first_name = mb_strToUpper($request->first_name);
            $player->school = mb_strToUpper($request->school);
            $player->position = mb_strToUpper($request->position);
            $player->prepaid = mb_strToUpper($request->prepaid);
            $player->dni = $request->dni;
            $player->path_file = $request->path_file;
            $player->birth_date = $request->date_birth;            
            $player->save();
            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/players');
    }
}
