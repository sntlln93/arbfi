<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public function teams(){
        return $this->hasMany('App\Team');
    }
    public $timestamps = false;
}
