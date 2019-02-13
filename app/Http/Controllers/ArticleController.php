<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->is_admin){
            return view('article');
        }else{
            return abort(404);
        }
    }

    public function create(Request $request)
    {
        if(!$request->user()->is_admin){
            return abort(404);
        }
        $data = $request->only('title','content','category_id');
        $article = new Article;
        $article->content=$data['content'];
        $article->title=$data['title'];
        $article->user_id=$request->user()->id;
        $article->category_id=$data['category_id'];
        $article->save();
        return redirect('article');
    }

}
