<?php

namespace App\Http\Controllers\LeeAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use DB;
class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //分类管理首页
    public function index()
    {
        $category = Category::all();
        return view('lee_admin/categories/index',['category' => $category]);
    }

    //创建分类
    public function store(CategoryRequest $request)
    {
        Category::insert($request->except(['_token']));
        return redirect()->route('categories.index')->with('success', '添加成功！');
    }

    //更新分类
    public function update(CategoryRequest $request)
    {
        unset($_POST['_token']);
        DB::table('categories')->where('id',$_POST['id'])->update($_POST);
        return redirect()->route('categories.index')->with('success', '更新成功！');
    }

    //删除分类
    public function del($id)
    {
        Category::del($id);
        return redirect()->route('categories.index')->with('success', '删除成功！');
    }

}
