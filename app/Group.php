<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function fixture(){
        return $this->hasMany('App\Fixture');
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }
}
