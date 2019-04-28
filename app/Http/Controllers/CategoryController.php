<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('userSession')){
            $categories = Category::all();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.categories.table')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function enable($id){
        $category = Category::find($id);
        if($category->enabled) $category->enabled = false;
        else $category->enabled = true;
        $category->save();
        return redirect('/categories');
    }
    public function create()
    {
        if(!(Session::has('userSession'))){
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::has('userSession')){
            $category = new Category;
            $this->validate($request,[
                'name' => 'required|max:4|unique:categories'
            ]);
            $category->name = $request->name;
            $category->save();
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Session::has('userSession')){
            $category = Category::find($id);
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return view('dashboard/categories/edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Session::has('userSession')){
            $category = Category::find($id);
            $this->validate($request,[
                'name' => 'required|max:4|unique:categories'
            ]);
            $category->name = $request->name;
            $category->save();
        }
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Session::has('userSession')){
            $item = Category::find($id);
            $item->delete();
            session()->flash('message','Eliminado correctamente');
        }else{
            return redirect('/')->with('flash_message_error','No tienes permiso para ver esta página');
        }
        return redirect('/categories');
    }
}
