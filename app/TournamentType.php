<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentType extends Model
{
    public function tournament(){
        return $this->hasMany('App\Tournament');
    }
}
