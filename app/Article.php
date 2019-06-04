<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function subsections(){
        return $this->hasMany('App\Subsection');
    }

    public function chapter(){
        return $this->belongsTo('App\Chapter');
    }
}
