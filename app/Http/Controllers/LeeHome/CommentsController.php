<?php

namespace App\Http\Controllers\LeeHome;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Auth;
use DB;


class CommentsController extends Controller
{

    public function __construct()
    {
       
    }

    public function store(CommentRequest $Request)
    {   
        unset($Request->_token);
        $ip = $_SERVER["REMOTE_ADDR"];
        $getCity = self::getCity($ip);
        $insrt = [
            'article_id'    => $Request->article_id,
            'content'       => $Request->content,
            'ip'            => $ip,
            'city'          => $getCity['city'],
            'created_at'    => date('Y-m-d H:i:s')
        ];
      
        Comments::insert($insrt);

        return back()->with('success','评价成功');
    }

    function getCity($ip = '')//获取地区
    {
        if($ip == ''){
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";//新浪借口获取访问者地区
            $ip=json_decode(file_get_contents($url),true);
            $data = $ip;
        }else{
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;//淘宝借口需要填写ip
            $ip=json_decode(file_get_contents($url));  
            if((string)$ip->code=='1'){
               return false;
            }
            $data = (array)$ip->data;
        }
         
        return $data;  
    }

}
