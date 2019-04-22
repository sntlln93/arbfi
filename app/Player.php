<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function sanction(){
        return $this->hasMany('App\Sanction');
    }

    public function event(){
        return $this->hasMany('App\Event');
    }

    protected $dates = ['birth_date'];
    public $timestamps = false;
}
