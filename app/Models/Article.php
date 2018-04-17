<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = ['category_id','title','cover','is_top','content'];
    /**
     * 获取博客文章的评论
     */
    public function comments()
    {
      return $this->hasMany(Comments::Class,'id','article_id');
    }

    public function category()
    {
      //hasOne(关联模型，关联模型值，本models要关联的值)
      return $this->hasOne(Category::Class,'id','category_id');
    }



}
