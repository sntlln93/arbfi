<?php

namespace App;

use App\Team;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function teams(){
        return $this->hasMany('App\Team');
    }
    public $timestamps = false;
}
