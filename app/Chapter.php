<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function article(){
        return $this->hasMany('App\Article');
    }
}
