<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tournament extends Model
{
    private $array = array();
    public $timestamps = false;

    public function fixtures(){
        return $this->hasMany('App\Fixture');
    }

    public function getPlayedAttribute(){
        $played = Fixture::where([
            'state' => 'JUGADO',
            'tournament_id' => $this->id
        ])->get();
        return $played;
    }

    public function type(){
        return $this->belongsTo('App\TournamentType');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public function GetFairPlayAttribute(){
        $fair_play = array();
        $teams = Team::all();    
        $categories = Category::all();  
        
        foreach($categories as $category){
            foreach($category->teams as $team){
                $yellow = 0; $red = 0; $green = 0;
                foreach($team->events as $event){
                    if($event->type == 'Amarilla') $yellow++;
                    elseif($event->type == 'Roja') $red++;
                    elseif($event->type == 'Verde') $green++;
                }
                $fair_play[$category->id][$team->id]['Categoria'] = $team->category->name;
                $fair_play[$category->id][$team->id]['Equipo'] = $team->club->name;
                $fair_play[$category->id][$team->id]['Amarilla'] = $yellow;
                $fair_play[$category->id][$team->id]['Roja'] = $red;
                $fair_play[$category->id][$team->id]['Verde'] = $green;
                $fair_play[$category->id][$team->id]['Puntos'] = $yellow + $red*2 - $green;
            }
        }
        return sort_tables($fair_play, 'Puntos');
    }

    public function getGoalMakersAttribute(){
        $query =    'select
                        categories.name,
                        players.last_name,
                        players.first_name,
                        count(events.player_id) as goals,
                        team.image_id
                    from 
                        events
                    join
                        players on events.player_id = players.id
                    join
                        (select
                            teams.id,
                            teams.category_id, 
                            institutions.image_id
                        from 
                            teams, institutions 
                        where 
                            teams.club_id = institutions.id
                        ) as team on players.team_id = team.id
                    join
                        categories on team.category_id = categories.id
                    where 
                        type = "Gol"
                    and
                        events.fixture_id in (select id from fixtures where tournament_id = '.$this->id.')
                    group by 
                        events.player_id
                    order by 
                        goals desc;';
        $goal_makers = DB::select($query);
        t
        return $goal_makers;
    }

    public function getScoreboardAttribute(){
        foreach($this->played as $match){
            if(isset($match->local)) 
                if(!isset($this->array[$match->local->category->id][$match->local_team_id])) 
                    $this->loadTeam($match->local->category->id, $match->local_team_id);
            if(isset($match->visiting))
                if(!isset($this->array[$match->visiting->category->id][$match->visiting_team_id])) 
                    $this->loadTeam($match->visiting->category->id, $match->visiting_team_id);
            
            if($match->local_score > $match->visiting_score){
                $result = 'local';
            }elseif($match->local_score < $match->visiting_score){
                $result = 'away';
            }else{
                $result = 'tie';
            }

            if(isset($match->local)){ //fillTeam($category, $team, $goals_favor, $goals_against, $result)
                $this->fillTeam(
                                $match->local->category->id,
                                $match->local_team_id,
                                $match->local_score,
                                $match->visiting_score,
                                $result,
                                'local'
                            );
            }
            if(isset($match->visiting)){//fillTeam($category, $team, $goals_favor, $goals_against, $result)
                $this->fillTeam(
                                $match->visiting->category->id,
                                $match->visiting_team_id,
                                $match->visiting_score,
                                $match->local_score,
                                $result,
                                'away'
                            ); 
            }
        }
        
        return $this->array;
    }

    private function loadTeam($category, $team){
        $this->array[$category][$team]['name'] = Team::find($team)->club->name;
        $this->array[$category][$team]['wins'] = 0;
        $this->array[$category][$team]['ties'] = 0;
        $this->array[$category][$team]['losses'] = 0;
        $this->array[$category][$team]['goals_favor'] = 0;
        $this->array[$category][$team]['goals_against'] = 0;
        $this->array[$category][$team]['points'] = 0;
    }

    private function fillTeam($category, $team, $goals_favor, $goals_against, $result, $condition){
        if($condition == $result)
            $this->array[$category][$team]['wins']++;
        elseif($result == 'tie')
            $this->array[$category][$team]['ties']++;
        else
            $this->array[$category][$team]['losses']++;

        $this->array[$category][$team]['goals_favor'] += $goals_favor;
        $this->array[$category][$team]['goals_against'] += $goals_against;
        $this->array[$category][$team]['points'] = $this->array[$category][$team]['wins'] * 2 + $this->array[$category][$team]['ties'];
    }

    public function getChallengerAttribute(){
        $scores = array();
        foreach($this->array as $category){
            foreach($category as $team){
                $index = Institution::where('name', $team['name'])->get()[0]->id;
                $scores[$index]['name'] = $team['name'];
                if(array_key_exists('points', $scores[$index])){
                    $scores[$index]['points'] += $team['points'];
                    $scores[$index]['wins'] += $team['wins'];
                    $scores[$index]['ties'] += $team['ties'];
                    $scores[$index]['losses'] += $team['losses'];
                    $scores[$index]['goals_favor'] += $team['goals_favor'];
                    $scores[$index]['goals_against'] += $team['goals_against'];
                }else{
                    $scores[$index]['points'] = $team['points'];
                    $scores[$index]['wins'] = $team['wins'];
                    $scores[$index]['ties'] = $team['ties'];
                    $scores[$index]['losses'] = $team['losses'];
                    $scores[$index]['goals_favor'] = $team['goals_favor'];
                    $scores[$index]['goals_against'] = $team['goals_against'];
                }
            }
        }
        return $scores;
    }
}
