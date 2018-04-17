<?php

namespace App\Http\Controllers\LeeAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ArticleRequest;
use Auth;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Article $article)
    {
        $list = $article->with(['category'])->paginate(10);
        return view('lee_admin.articles.index',['list' => $list]);
    }


    public function create(Article $article)
    {
        $categories = Category::all();
        return view('lee_admin.articles.create_and_edit',compact('categories','article'));
    }


    public function store(ArticleRequest $request, ImageUploadHandler $uploader)
    {

      $data = Input::all();

      if (isset($data['cover'])) {
          $result = $uploader->save($data['cover'], 'article/cover', date('Y'), 362);
          if ($result) {
              $data['cover'] = $result['path'];
          }
      }
      $data['created_at'] = date('Y-m-d H:i:s');
      $data['author'] = Auth::user()->name;

      unset($data['_token']);
      Article::insert($data);

      return redirect()->route('articles.index')->with('success', '添加成功！');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('lee_admin.articles.create_and_edit',compact('categories','article'));
    }

    public function update(ArticleRequest $request, ImageUploadHandler $uploader,Article $article)
    {

        $data = Input::all();
        if (isset($data['cover'])) {
            $result = $uploader->save($data['cover'], 'article/cover', date('Y'), 362);
            if ($result) {
                $data['cover'] = $result['path'];
            }
        }

        unset($data['_token']);
        $article->fill($data);
        $article->save();

        return redirect()->route('articles.index')->with('success', '更新成功！');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', '删除成功！');
    }

}
