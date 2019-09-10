<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public $timestamps = false;
}
