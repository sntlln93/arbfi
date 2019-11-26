<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Institution;

class Tournament extends Model
{
    private $scoreboard = array();
    public $timestamps = false;

    public function fixtures(){
        return $this->hasMany('App\Fixture');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public function getClubsAttribute(){
        $arr = array();
        foreach($this->teams as $team){
            array_push($arr, $team->club_id);
        }
        return Institution::whereIn('id', $arr)->get();
    }

    public function getCategoriesAttribute(){
        $arr = array();
        foreach($this->teams as $team){
            array_push($arr, $team->category_id);
        }
        return Category::whereIn('id', $arr)->get();
    }

    public function getTeamsAttribute(){
        if($this->type == "AAA") 
            $query = "select id from teams 
            where id in 
                (select local_team_id from fixtures where tournament_id = ".$this->id.") 
            or id in 
                (select visiting_team_id from fixtures where tournament_id = ".$this->id.")";
        elseif($this->type == "GF") 
            $query = "select id from teams 
            where id in 
                (select local_team_id from fixtures where tournament_id in (select id from groups where tournament_id = ".$this->id.")) 
            or id in 
                (select visiting_team_id from fixtures where tournament_id in (select id from groups where tournament_id = ".$this->id."))";
        $arr = array();
        
        $teams_id = DB::select($query); 
        foreach($teams_id as $key => $value){
            array_push($arr, $value->id);
        }
        $teams = Team::whereIn('id', $arr)->get();
        
        return $teams;
    }

    public function getGroupsFixtureAttribute(){
        $query = "select * from fixtures where tournament_id in (select id from groups where tournament_id = ".$this->groups.")";
        $fixture = DB::select($query);
        return $fixture->get(); 
    }

    public function getTypeAttribute(){
        $query = "select type from tournament_types where id = ".$this->type_id;

        return DB::select($query)[0]->type;
    }

    public function getRoundAttribute(){
        $query = "select round_trip from tournament_types where id = ".$this->type_id;

        return DB::select($query)[0]->round_trip;
    }

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
        if($this->type == "AAA") $subquery = 'select id from fixtures where tournament_id = '.$this->id;
        elseif($this->type == "GF") $subquery = 'select id from fixtures where tournament_id in (select id from groups where tournament_id = '.$this->id.')';
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
                        events.fixture_id in ('.$subquery.')
                    group by 
                        events.player_id
                    order by 
                        goals desc;';
        $goal_makers = DB::select($query);
        
        return $goal_makers;
    }

    public function getScoreboardAttribute(){
        $this->initializeTeamStats();
        $this->writeScoreboard();
        $tablePoint = array();
        
        foreach($this->scoreboard as $key => $value){
            $zone = new GroupStats($value, $this->name);
            $tablePoint[$key] = $zone->sortScoreboards;
        }
        return $tablePoint;
    }

    public function getChallengerAttribute(){
        $arr = array();

        foreach($this->teams as $team){
            $club = $team->club_id;
            $arr[$club]['name'] = $team->club->name;
            $arr[$club]['wins'] = 0;
            $arr[$club]['ties'] = 0;
            $arr[$club]['losses'] = 0;
            $arr[$club]['goals_favor'] = 0;
            $arr[$club]['goals_against'] = 0;
            $arr[$club]['points'] = 0;
        }
        foreach($this->scoreboard as $category){
            foreach ($category as $team) {
                $club = Institution::where('name', $team['name'])->get()[0]->id;
                
                $arr[$club]['wins'] += $team['wins'];
                $arr[$club]['ties'] += $team['ties'];
                $arr[$club]['losses'] += $team['losses'];
                $arr[$club]['goals_favor'] += $team['goals_favor'];
                $arr[$club]['goals_against'] += $team['goals_against'];
                $arr[$club]['points'] += $team['points'];
            }
        }
        $zone = new GroupStats($arr, 'Copa Challenger');
        return $zone->sortScoreboards;
    }

    private function writeScoreboard(){
        foreach($this->playedMatches as $match){
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
                $this->scoreboard[$category][$team->id]['points'] += 2;
            }elseif($result == 'away'){
                $this->scoreboard[$category][$team->id]['losses'] ++;
            }else{
                $this->scoreboard[$category][$team->id]['ties'] ++;
                $this->scoreboard[$category][$team->id]['points'] ++;
            }
            $this->scoreboard[$category][$team->id]['goals_favor'] += $match->local_score;
            $this->scoreboard[$category][$team->id]['goals_against'] += $match->visiting_score;
        }else{
            if($result == 'away'){
                $this->scoreboard[$category][$team->id]['wins'] ++;
                $this->scoreboard[$category][$team->id]['points'] += 2;
            }elseif($result == 'local'){
                $this->scoreboard[$category][$team->id]['losses'] ++;
            }else{
                $this->scoreboard[$category][$team->id]['ties'] ++;
                $this->scoreboard[$category][$team->id]['points'] ++;
            }
            $this->scoreboard[$category][$team->id]['goals_favor'] += $match->visiting_score;
            $this->scoreboard[$category][$team->id]['goals_against'] += $match->local_score;
        }
    }

    private function initializeTeamStats(){
        foreach ($this->teams as $team) {
            $this->scoreboard[$team->category_id][$team->id]['name'] = $team->club->name;
            $this->scoreboard[$team->category_id][$team->id]['wins'] = 0;
            $this->scoreboard[$team->category_id][$team->id]['ties'] = 0;
            $this->scoreboard[$team->category_id][$team->id]['losses'] = 0;
            $this->scoreboard[$team->category_id][$team->id]['goals_favor'] = 0;
            $this->scoreboard[$team->category_id][$team->id]['goals_against'] = 0;
            $this->scoreboard[$team->category_id][$team->id]['points'] = 0;
        }
    }

}
