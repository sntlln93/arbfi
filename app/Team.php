<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Team extends Model
{
    public function events(){
        return $this->hasManyThrough('App\Event', 'App\Player');
    }
    
    public function club(){
        return $this->belongsTo('App\Institution', 'club_id');
    }

    public function getLogoAttribute(){
        return $this->club->image->path;
    }

    public function manager(){
        return $this->belongsTo('App\Manager');
    }

    public function players(){
        return $this->hasMany('App\Player');
    }

    public function fixtureLocal(){
        return $this->hasMany('App\Fixture', 'local_team_id');
    }

    public function fixtureVisiting(){
        return $this->hasMany('App\Fixture', 'visiting_team_id');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function scoreboard(){
        return $this->hasMany('App\Scoreboard');
    }

    public function getPlayedAttribute(){
        $arr = array();
        $query = "select id from fixtures where state = 'JUGADO' and (local_team_id = ".$this->id." or visiting_team_id = ".$this->id.");";
        $matches_id = DB::select($query);

        foreach($matches_id as $key => $value){
            array_push($arr, $value->id);
        }

        return Fixture::findMany($arr);
    }

    public function getPendingAttribute(){
        $arr = array();
        $query = "select id from fixtures where state = 'no jugado' and (local_team_id = ".$this->id." or visiting_team_id = ".$this->id.");";
        $matches_id = DB::select($query);
        
        foreach($matches_id as $key => $value){
            array_push($arr, $value->id);
        }

        return Fixture::findMany($arr);
    }

    public $timestamps = false;
}
