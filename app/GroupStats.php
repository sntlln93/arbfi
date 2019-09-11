<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\TeamStats;

class GroupStats extends Model
{   
    private $name;
    private $teams = array();

    public function __construct($group, $name){
        $this->name = $name;
        foreach($group as $team){
            $t = new TeamStats($team);
            array_push($this->teams, $t);
        }
    }

    public function getSortScoreboardsAttribute(){
        $stats = array();
        $stats = Arr::sort($this->teams, function($team){
                return $team->points;
            });
        return array_reverse($stats, true);
    }
}
