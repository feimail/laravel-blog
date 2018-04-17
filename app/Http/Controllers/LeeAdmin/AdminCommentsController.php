<?php

namespace App\Http\Controllers\LeeAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Auth;
use DB;


class AdminCommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
      $comments = Comments::with(['Comment'])->where('article_id',$id)->get()->toArray();

      //$comments = Comments::getThisAll($data);
      return view('lee_admin.comments.index',compact('comments'));
    }


    public function destroy($id)
    {   

        Comments::destroy($id);
        return redirect()->route('articles.index')->with('success', '删除成功！');
    }

}
