<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function match(){
        return $this->belongsTo('App\Fixture', 'match_id');
    }

    public function player(){
        return $this->belongsTo('App\Player');
    }
    public $timestamps = false;
}
