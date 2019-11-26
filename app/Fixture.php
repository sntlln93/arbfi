<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    public function getWinnerIsAttribute(){
        if($this->local_score > $this->visiting_score)
            return $this->local_team_id;
        elseif($this->visiting_score > $this->local_score)
            return $this->visiting_team_id;
        
        return 0;
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    public function local(){
        return $this->belongsTo('App\Team', 'local_team_id');
    }

    public function visiting(){
        return $this->belongsTo('App\Team', 'visiting_team_id');
    }

    public function event(){
        return $this->hasMany('App\Event');
    }

    public function group(){
        return $this->belongsTo('App\Group', 'tournament_id');
    }

    public function getTournamentNameAttribute(){ 
        
        $isLeague = false; 
        if( isset($this->tournament) )
            $isLeague = ( new \ReflectionClass($this->tournament) )->getShortName() == 'Tournament' ;
                
        $parent =  $isLeague ? $this->tournament : $this->group;

        if($isLeague)
            $name = $parent->name;
        else
            $name = $parent->tournament->name.'" Grupo: "'.$parent->name;        
        
        return $name;
    }

    public $timestamps = false;
}
