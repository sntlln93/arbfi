<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use DB;
use App;
use DateTime;
use PDF;


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
        $players = Player::all();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->render($players));
        return $pdf->download();
    }

    public function render($players){
        $html = '<html><head>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <style>body{
          font-family: "Roboto", sans-serif;
      }

  .fila{
      padding-top: 1.5cm;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      display:grid;
      grid-template-columns: 8.6cm 8.6cm;
      grid-template-rows: 5.38cm;
      grid-gap: 0.8cm;
      
  }  
  .carnet{
      background-image: url("/img/backend_img/background1.svg");        
      border-style: solid;   
      display:grid;
  }
  .cabecera{
      display: grid;
      grid-template-columns: 1cm 6cm;
      padding-left: 0.3cm;
      padding-top: 0.1cm;
  }

  .titulos .titulo{
      font-size: 9px;
      font-weight: bold;
      text-transform: uppercase;
  }
  .titulos .subtitulo{
      font-size: 8px;
      font-weight: normal;
      text-transform: uppercase;
  }
  .logo img{
      width: 25px;
      height: auto;
      
  }
  .foto{
      margin-left: auto;
      margin-right: auto;
      align-content: center;
  }
  .foto img{
      padding-top:2mm;
      height: 30mm;
      width: auto;            
  }
  .foto h3{
      padding-top: 0mm;
      font-size: 15px;
      font-weight: bold;
      text-align: center;
  }
  .foto p{
      padding-top: 0mm;
      font-size: 5px;
      text-align: center;
  }
  .row{
      display: grid;
      grid-template-columns: 35mm 50mm;
  }

  .info{

  }

  .info .titulo{
      font-size: 7px;
      text-transform: uppercase;
      padding-top: 1.2mm;
  }
  .info .subtitulo{
      font-size: 9px;
      text-transform: uppercase;
      font-weight: bold;
      text-shadow: 1px 1px 1px blanchedalmond;
  }
  </style><body><div class="fila">';

        foreach($players as $player){
        $html .='<div class="carnet">
            <div class="row">
                <div class="cabecera">
                    <div class="logo">
                        <img src="'.asset('/img/frontend_img/logo-light.png').'" alt="">
                    </div>
                    <div class="titulos">
                        <div class="titulo">Asociación Riojana de Baby Fútbol Infantil</div>
                        <div class="subtitulo">Carnet identificador de jugador</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="foto">
                    <img src="'.getImage($player).'" alt="">
                    <p>Número de documento</p>
                    <h3>'. $player->dni .'</h3>
                </div>
                <div class="info">
                    
                    <div class="titulo">Apellidos</div>
                    <div class="subtitulo">'. $player->last_name .'</div>
                    <div class="titulo">Nombres</div>
                    <div class="subtitulo">'. $player->first_name .'</div>
                    <div class="titulo">Club</div>
                    <div class="subtitulo">'. $player->team->club->name .'</div>
                    <div class="titulo">Fecha de nacimiento</div>
                    <div class="subtitulo">'. $player->birth_date->format('d/m/Y') .'</div>
                    <div class="titulo">Fecha de emisión</div>
                    <div class="subtitulo">'. Carbon::now()->format('d/m/Y') .'</div>
                    <div class="titulo">Categoría</div>
                    <div class="subtitulo">'. $player->team->category->name .'</div>
                    <div class="barcode"></div>
                </div>
            </div>
        </div>';
    }
        $html .= '</div>';
        
        

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
                'position' => 'required',
                'image' => 'required|file|image|max:5000',
            ]);
            $player->last_name = mb_strToUpper($request->last_name);
            $player->first_name = mb_strToUpper($request->first_name);
            $player->position = mb_strToUpper($request->position);
            $player->school = mb_strToUpper($request->school);
            $player->prepaid = mb_strToUpper($request->prepaid);
            $player->dni = $request->dni;
            $player->image_id = newImage($request, 'players');
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
            $player->birth_date = $request->date_birth;       
            if($request->has('image')){
                $player->image_id = newImage($request, 'players');
            }
            $player->save();
            

        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/players');
    }
}
