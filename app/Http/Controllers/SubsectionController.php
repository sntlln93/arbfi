<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use App\Article;
use App\Subsection;

class SubsectionController extends Controller
{
    public function create(){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $articles = Article::all()->sortBy('name');
        
        return view('dashboard.regulation.subsections.create')->with('articles', $articles);
   }
    
    public function store(Request $request){
        if(Session::has('userSession')){
            $subsection = new Subsection;
            $this->validate($request,[
                'name' => 'required',
                'body' => 'required',
                'article_id' => 'required'
            ]);
            $subsection->name = mb_strToUpper($request->name);
            $subsection->body = $request->body;
            $subsection->article_id = $request->article_id;
            $subsection->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }
   
    public function edit($id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $subsection = Subsection::find($id);
        return view('dashboard.regulation.subsections.edit')->with('subsection', $subsection);
    }

    public function update(Request $request, $id)
    {
        if(Session::has('userSession')){
            $subsection = Subsection::find($id);
            $this->validate($request,[
                'name' => 'required',
                'body' => 'required'
            ]);
            $subsection->name = mb_strToUpper($request->name);
            $subsection->body = $request->body;
            $subsection->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }
}
