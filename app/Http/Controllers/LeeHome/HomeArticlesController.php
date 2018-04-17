<?php

namespace App\Http\Controllers\LeeHome;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comments;
use App\Http\Requests\CategoryRequest;


class HomeArticlesController extends Controller
{
    //分类全部文章
    public function articleIndex($id){
        $article = Category::find($id)->articles()->orderBy('created_at','desc')->paginate(10);
        return view('lee_home.articles.index',['articles' => $article]);
    }
    public function index()
    {
        $article = Article::orderBy('created_at','desc')->paginate(10);
        return view('lee_home.articles.index',['articles' => $article]);
    }

    public function show($id)
    {
        $article = Article::find($id);
        $newsArticle = Article::orderBy('created_at','desc')->paginate(5);
        $comments = Comments::where('article_id',$id)->orderBy('created_at','desc')->get();
        return view('lee_home.articles.show',compact('article','newsArticle','comments'));
    }




}
