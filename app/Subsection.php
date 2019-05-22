<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    public function article(){
        return $this->belongsTo('App\Article');
    }
}
