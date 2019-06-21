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
        $pdf->loadHTML($this->render($player));
        return $pdf->download();
    }

    public function render($player){
        $background = "{{ asset('/img/backend_img/background1.png') }}";
        $logo = "{{ asset('/img/front_end/logo-light.png') }}";
        

        $html = '<table style="width: 86mm;
        height: 53,8mm;
        background-image: url('."''".');
        background-repeat: no-repeat;
        background-position: center;"><tr><th rowspan="2"><img src="'.asset('img/frontend_img/logo-light').'" class="logo"></th><th style="font-family: Arial,serif;
        font-size: 5.0px;
        color: rgb(0,0,0);
        font-weight: bold;
        font-style: normal;
        text-decoration: none;
        text-align: left;" colspan="2">ASOCIACIÓN RIOJANA DE BABY FÚTBOL INFANTIL</th>
        </tr>
        <tr>
          <td style="font-family:Arial,serif;
          font-size:5.0px;
          color:rgb(0,0,0);
          font-weight:normal;
          font-style:normal;
          text-decoration: none" colspan="2">Carnet Identificador de Jugador</td>
        </tr><tr>
        <td colspan="2" rowspan="12"></td>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Apellido</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">SANTILLÁN</td>
      </tr>
      <tr>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Nombre</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">MATÍAS OSCAR</td>
      </tr>
      <tr>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Institución</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">CENTRO VECINAL 3 DE FEBRERO</td>
      </tr>
      <tr>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Fecha de nacimiento</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">10 de octubre de 2006</td>
      </tr>
      <tr>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Fecha de emisión</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">10 de octubre de 2019</td>
      </tr>
      <tr>
        <td style="titlfont-family:Arial,serif;
        font-size:4.6px;
        color:rgb(0,0,0);
        font-weight: normal;
        font-style: normal;
        text-decoration: none;
        padding-bottom: 1mm;">Categoría</td>
      </tr>
      <tr>
        <td style="font-family: Arial,serif;
        font-size: 7.4px;
        color: rgb(0,0,0);
        font-weight: normal;
        font-style: normal; 
        text-decoration: none;
        padding-bottom: 1mm;">2006</td>
      </tr>
      <tr>
        <td font-family:Arial,serif;
        font-size:11.5px;
        color:rgb(0,0,0);
        font-weight:normal;
        font-style:normal;
        text-decoration: none;
        text-align: center; colspan="2">99.999.999</td>
        <td></td>
      </tr>
    </table>';
        
        

        $html .= "</body></html>";
        return $html;
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
