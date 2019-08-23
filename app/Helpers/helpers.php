<?php

function newImage($request, $where){
    if($request->has('image')){
        $image = new App\Image;
        $image->path = $request->image->store($where, 'public');
        $image->save();
    }
    return $image->id;
}

function getImage($model, $where){
    if(isset($model->image)){
        return 'storage/'.$model->image->path;
    }
    return 'img/frontend_img/'.$where.'/0.jpg';
}

function sort_tables($tables, $subkey){                 //$this->array[$category][$team]['name'] = Team::find($team)->club->name;
    $c = array();                                       //$this->array[$category][$team]['wins'] = 0;
    foreach($tables as $table){                         //$this->array[$category][$team]['ties'] = 0;
        array_push($c, sorting($table, $subkey));       //$this->array[$category][$team]['losses'] = 0;
    }                                                   //$this->array[$category][$team]['goals_favor'] = 0;
    return $c;                                          //$this->array[$category][$team]['goals_against'] = 0;
}                                                       //$this->array[$category][$team]['points'] = 0;

function sorting($categories, $subkey){
    foreach($categories as $key=>$value){
        $b[$key] = $value[$subkey];
    }
    arsort($b);
    foreach($b as $key=>$val){
        $c[] = $categories[$key];
    } 
    return $c; 
}



