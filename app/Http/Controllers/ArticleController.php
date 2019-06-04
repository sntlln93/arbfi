<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

use App\Chapter;
use App\Article;

class ArticleController extends Controller
{
    public function create(){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $chapters = DB::table('chapters')->select()->orderBy('id')->get();
        
        return view('dashboard.regulation.articles.create')->with('chapters', $chapters);
   }
    
    public function store(Request $request){
        if(Session::has('userSession')){
            $article = new Article;
            $this->validate($request,[
                'name' => 'required',
                'body' => 'required',
                'chapter_id' => 'required'
            ]);
            $article->name = mb_strToUpper($request->name);
            $article->body = $request->body;
            $article->chapter_id = $request->chapter_id;
            $article->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }
   
    public function edit($id){
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        $article = Article::find($id);
        return view('dashboard.regulation.articles.edit')->with('article', $article);
    }

    public function update(Request $request, $id)
    {
        if(Session::has('userSession')){
            $article = Article::find($id);
            $this->validate($request,[
                'name' => 'required',
                'body' => 'required'
            ]);
            $article->name = mb_strToUpper($request->name);
            $article->body = $request->body;
            $article->save();   
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/regulation');
    }
}
