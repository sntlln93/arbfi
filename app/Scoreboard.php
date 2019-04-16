<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoreboard extends Model
{
    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }
    public $timestamps = false;

}
