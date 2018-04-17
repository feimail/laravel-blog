<?php

namespace App\Handlers;


class TreeHandler
{
    public function getTree($data) {

      $items = [];
      foreach ($data as $key => $value) {
        $items[$key+1] = $value;
      }
      $tree = array(); //格式化好的树
        foreach ($items as $item)
          if (isset($items[$item['pid']]))
              $items[$item['pid']]['son'][] = &$items[$item['id']];
          else
              $tree[] = &$items[$item['id']];

        return $tree;
    }
}
