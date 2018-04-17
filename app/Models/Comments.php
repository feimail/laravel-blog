<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    function comment(){
        return $this->hasMany(Article::class,'id','article_id');
    }


    static function getThisAll($items) {
        $newData = [];
        foreach ($items as $key => $value) {
            $newData[$key+1] = $value;
        }

        $tree = array(); //格式化好的树
        foreach ($newData as $item)
            if (isset($newData[$item['parent_id']]))
                $newData[$item['parent_id']]['son'][] = &$newData[$item['id']];
            else
                $tree[] = &$newData[$item['id']];
        return $tree;
    }
}
