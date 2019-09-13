<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
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
