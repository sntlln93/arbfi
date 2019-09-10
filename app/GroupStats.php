<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TeamStats;

class GroupStats extends Model
{
    private $name;
    private $teams = array();

    public function __construct($teams, $name){
        $this->name = $name;
        foreach($teams as $team){
            $t = new TeamStats($team);
            $teams = array_push($t);
        }
    }

    public function sortScoreboards(){
        $stats = array();
        $stats = Arr::sort($teams, function($team){
                return $team->points;
            });
        return $stats;
    }
}
