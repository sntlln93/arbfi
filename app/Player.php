<?php

namespace App;

use DB;
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

    public function getGreenAttribute(){
        //do whatever you want to do
        $query = 'select count(id) as cantidad from events where player_id = '.$this->id.' and type = "Verde"';
        $green = DB::select($query);
        return $green;
    }

    public function getRedAttribute(){
        //do whatever you want to do
        $query = 'select count(id) as cantidad from events where player_id = '.$this->id.' and type = "Roja"';
        $green = DB::select($query);
        return $green;
    }

    public function getYellowAttribute(){
        //do whatever you want to do
        $query = 'select count(id) as cantidad from events where player_id = '.$this->id.' and type = "Amarilla"';
        $green = DB::select($query);
        return $green;
    }

    public function getGoalAttribute(){
        //do whatever you want to do
        $query = 'select count(id) as cantidad from events where player_id = '.$this->id.' and type = "Gol"';
        $green = DB::select($query);
        return $green;
    }

    protected $dates = ['birth_date'];
    public $timestamps = false;
}
