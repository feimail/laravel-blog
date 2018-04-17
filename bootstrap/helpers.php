<?php

use App\Models\Category;
//此方法会将当前请求的路由名称转换为 CSS 类名称，作用是允许我们针对某个页面做页面样式定制
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

//无限级导航栏
function categories(){
    
  if(!session('categories')){
    $categories = Category::all();
    session(['categories' => $categories]);
  }

}

function k($msg){
    print_r($msg);exit;
}
?>
