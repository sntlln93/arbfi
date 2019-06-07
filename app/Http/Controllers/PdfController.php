<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use DB;
use App;

class PdfController extends Controller
{
    public function htmlToPdf(Request $request, $id){
        $fixtures = Fixture::all();
        $pdf = App::make('dompdf.wrapper');
        $table = '';
        foreach($fixtures as $match){
            if($request->fixture_day == $match->fixture_day){
                $teamsGrid = $this->generatePlayersGrid($match->id);
                $table .= '<table border="1" style="border-collapse:collapse;" width="267mm">
                            <tr style="text-align:center">
                                <td colspan="15"><b>ARBFI<br>Asociación Riojana de Baby Fútbol Infantil</b></td>
                            </tr>
                            <tr style="text-align:center">
                                <th colspan="11">TORNEO "'.$match->tournament->name.'" CATEGORÍA '.$match->local->category->name.'</th>
                                
                                <th colspan="4">Fecha '.$match->fixture_day.'°</th>
                            </tr>
                            <tr style="text-align:center">
                                <td colspan="7">Local: '.$match->local->club->name.'</td>
                                <td rowspan="21"></td>
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
                        </table>
                        <div style="page-break-before: always;"></div>';
            }         
        }
        $pdf->loadHTML($table);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($match->tournament->name.'_fecha_'.$match->fixture_day.'.pdf');
    }

    public function generatePlayersGrid($id){
        $match = Fixture::find($id);
        $local = DB::table('players')->select('last_name','first_name')->where('team_id',$match->local_team_id)->get();
        $away = DB::table('players')->select('last_name','first_name')->where('team_id',$match->visiting_team_id)->get();
        $teamGrid = '';
        
        if(sizeof($local) > sizeof($away)){
            $limit = sizeof($local);
            $exceed = 14 - sizeof($local);
        }elseif(sizeof($local) < sizeof($away)){
            $limit = sizeof($away);
            $exceed = 14 - sizeof($away);
        }else{
            $limit = sizeof($local);
            $exceed = 14 - $limit;
        }
        
        for($i = 0; $i < $limit; $i++){
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
            }elseif($i >= sizeof($away)){
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
            }elseif($i >= sizeof($local)){
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
            }
        }
        for($i = 0; $i < $exceed; $i++){
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
        }
        return $teamGrid;
    }    
}
