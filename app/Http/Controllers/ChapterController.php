<?php

namespace App\Http\Controllers;

use App\Chapter;
use Session;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function create(){
            if(!(Session::has('userSession'))){
                return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
            }
            
            return view('dashboard.regulation.chapters.create');
    }
   
    public function store(Request $request){
        if(Session::has('userSession')){
            $chapter = new Chapter;
            $this->validate($request,[
                'id' => 'required|unique:chapters',
                'title' => 'required'
            ]);
            $chapter->id = $request->id;
            $chapter->name = mb_strToUpper($request->title);
            $chapter->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }

    public function edit($id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $chapter = Chapter::find($id);
        return view('dashboard.regulation.chapters.edit')->with('chapter', $chapter);
    }
   
   public function update(Request $request, $id){
        if(Session::has('userSession')){
            $chapter = Chapter::find($id);
            $this->validate($request,[
                'title' => 'required'
            ]);
            $chapter->name = mb_strToUpper($request->title);
            $chapter->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }
}
