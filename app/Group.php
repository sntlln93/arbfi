<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Team;
use App\Category;
use App\Table;
use App\GroupStats;

class Group extends Model
{   
    private $scoreboard = array();

    public function getPlayedMatchesAttribute(){
        $played = Fixture::where([
            'state' => 'JUGADO',
            'tournament_id' => $this->id
        ])->get();
        return $played;
    }      
    
    public function getPendingMatchesAttribute(){
        $played = Fixture::where([
            'state' => 'no jugado',
            'tournament_id' => $this->id
        ])->get();
        return $played;
    }

    public function fixture(){
        return $this->hasMany('App\Fixture', 'tournament_id');
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    public function getScoreboardAttribute(){
        $this->writeScoreboard();
        $tablePoint = array();
        
        foreach($this->scoreboard as $key => $value){
                $zone = new GroupStats($value, $this->name);
                $tablePoint[$key][$this->id] = $zone->sortScoreboards;
        }
        
        return $tablePoint;
    }

    private function writeScoreboard(){
        foreach($this->playedMatches as $match){
            
            if(! isset($match->local_team_id, $scoreboard[$match->local->category->id][$match->local_team_id]))
                $this->initializeTeamStats($match->local_team_id);
        
            if(! isset($match->visiting_team_id, $scoreboard[$match->visiting->category->id][$match->visiting_team_id]))
                $this->initializeTeamStats($match->visiting_team_id);
                
            $this->checkForWinner($match);
        }
        return $this->scoreboard;
    }

    private function checkForWinner($match){
        $result = 'tie';
        if($match->local_score > $match->visiting_score)
            $result = 'local';
        elseif($match->local_score < $match->visiting_score)
            $result = 'away';
        
        $this->loadTeamStats($match, $result, true);
        $this->loadTeamStats($match, $result, false); 
    }

    private function loadTeamStats($match, $result, $local){
        $team = $local ? $match->local : $match->visiting;
        $category = $team->category_id;
        if($local){
            if($result == 'local'){
                $this->scoreboard[$category][$team->id]['wins'] ++;
                $this->scoreboard[$category][$team->id]['points'] += 3;
            }elseif($result == 'away'){
                $this->scoreboard[$category][$team->id]['losses'] ++;
            }else{
                $this->scoreboard[$category][$team->id]['ties'] ++;
                $this->scoreboard[$category][$team->id]['points'] += 3;
            }
            $this->scoreboard[$category][$team->id]['goals_favor'] += $match->local_score;
            $this->scoreboard[$category][$team->id]['goals_against'] += $match->visiting_score;
        }else{
            if($result == 'away'){
                $this->scoreboard[$category][$team->id]['wins'] ++;
                $this->scoreboard[$category][$team->id]['points'] += 3;
            }elseif($result == 'local'){
                $this->scoreboard[$category][$team->id]['losses'] ++;
            }else{
                $this->scoreboard[$category][$team->id]['ties'] ++;
                $this->scoreboard[$category][$team->id]['points'] += 3;
            }
            $this->scoreboard[$category][$team->id]['goals_favor'] += $match->visiting_score;
            $this->scoreboard[$category][$team->id]['goals_against'] += $match->local_score;
        }
    }

    private function initializeTeamStats($id){
        $team = Team::find($id);
        $this->scoreboard[$team->category_id][$team->id]['name'] = $team->club->name;
        $this->scoreboard[$team->category_id][$team->id]['wins'] = 0;
        $this->scoreboard[$team->category_id][$team->id]['ties'] = 0;
        $this->scoreboard[$team->category_id][$team->id]['losses'] = 0;
        $this->scoreboard[$team->category_id][$team->id]['goals_favor'] = 0;
        $this->scoreboard[$team->category_id][$team->id]['goals_against'] = 0;
        $this->scoreboard[$team->category_id][$team->id]['points'] = 0;
    }
}
