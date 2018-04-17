<?php

namespace App\Http\Controllers\LeeAdmin;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mysqli=DB::select('SELECT VERSION() as mysql_version ');
    
        $system_info = array(
            //'dn_version' => DN_VERSION . ' RELEASE '. DN_RELEASE,
            'server_domain' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            'server_os' => PHP_OS,
            'web_server' => $_SERVER["SERVER_SOFTWARE"],
            'php_version' => PHP_VERSION,
            'mysql_version' => $mysqli[0]->mysql_version,
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'max_execution_time' => ini_get('max_execution_time') . '秒',
            'safe_mode' => (boolean) ini_get('safe_mode') ?  '是' : '否',
            'zlib' => function_exists('gzclose') ?  '是' : '否',
            'curl' => function_exists("curl_getinfo") ? '是' : '否',
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no')
        );
        return view('lee_admin/pages/home',['system_info' => $system_info]);
    }
}
