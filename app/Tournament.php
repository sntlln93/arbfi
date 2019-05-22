<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function scoreboards(){
        return $this->hasMany('App\Scoreboard')->orderByDesc('points');
    }

    public function fixtures(){
        return $this->hasMany('App\Fixture');
    }

    public function type(){
        return $this->belongsTo('App\TournamentType');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }
    public $timestamps = false;
}
