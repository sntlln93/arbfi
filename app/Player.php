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

    public function blood(){
        return $this->belongsTo('App\Blood');
    }

    protected $dates = ['birth_date'];
    public $timestamps = false;
}
