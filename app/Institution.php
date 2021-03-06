<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public function teams(){
        return $this->hasMany('App\Team', 'club_id');
    }
    public function image(){
        return $this->belongsTo('App\Image');
    }
    public $timestamps = false;
}
