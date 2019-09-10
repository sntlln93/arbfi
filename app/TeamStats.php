<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamStats extends Model
{
    public $name;
    public $wins;
    public $ties;
    public $losses;
    public $goals_favor;
    public $goals_against;
    public $points;

    public function __construct($team){
        $this->name = $team['name'];
        $this->wins = $team['wins'];
        $this->ties = $team['ties'];
        $this->losses = $team['losses'];
        $this->goals_favor = $team['goals_favor'];
        $this->goals_against = $team['goals_against'];
        $this->points = $team['points'];
    }
}
