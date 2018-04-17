<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    function articles()
    {
        return $this->hasMany(Article::Class);
    }

    static function del($id)
    {
      $arr[] = $id;
      $ids = self::getIds($id,$arr);
      Category::whereIn('id',$ids)->delete();
    }

    //递归获取该分类下所以id
    static function getIds($id,$arr)
    {

      $id = is_array($id) ? $id :[$id];
      $ids = Category::whereIn('pid',$id)->get()->toArray();

      if(!empty($ids)){
        foreach ($ids as $k => $v) {
          $arr[] = $v['id'];
          $del_id[] = $v['id'];
        }
        return self::getIds($del_id,$arr);
      }else{
        return $arr;
      }
    }



}
