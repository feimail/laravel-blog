<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'kuner') - 奔跑的小蜗牛</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style type="text/css">
.dropdown-submenu > .dropdown-menu{
    top:15;
    left:100%;
    margin-top:15px;
    margin-left:-1px;

}

.dropdown-submenu:hover > .dropdown-menu{
    display:block;
}

.dropdown-submenu > a:after{
    display:block;
    content:" ";
    float:right;
    width:0;
    height:0;
    border-color:transparent;
    border-style:solid;
    border-width:5px 0 5px 5px;
    border-left-color:#cccccc;
    margin-top:5px;
    margin-right:-10px;
}
</style>
<body>




    <div id="app" class="{{ route_class() }}-page">

      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    首页
                </a>

                <ul class="nav navbar-nav" id='nav'>

                </ul>
            </div>
          </div>

      </nav>


        <div class="container">
            @include('common._message')
            <div class="panel-body">
            <div class="container">
              <div class="row">
                <main class="col-md-8 main-content">
                  @yield('content')
                </main>
                <aside class="col-md-4 sidebar">
                  <div class="widget"><h4 class="title">联系</h4><div class="content community"><p>QQ：396123904</p><p></p></div></div>
                  <div class="widget"><h4 class="title">下载</h4><div class="content download"><a href="/download/" class="btn btn-default btn-block" onclick="_hmt.push(['_trackEvent', 'big-button', 'click', '下载 Laravel &amp; Lumen'])">Laravel &amp; Lumen 一键安装包下载</a></div></div>
                  <div class="widget"><h4 class="title">友链</h4>
                    <a href="https://laravel-china.org/" class="btn btn-default btn-block" target="_blank">laravel china</a>
    
                  </div>
                </aside>
                </div>
              </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    由 <a href="http://weibo.com/u/1837553744?is_hot=1" target="_blank">地板油当喇叭</a> 设计和编码 <span style="color: #e27575;font-size: 14px;">❤</span>
                </p>

                <p class="pull-right"><a href="mailto:name@email.com">联系我们</a></p>
            </div>
        </footer>

    </div>
    <?php categories(); ?>
    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
</body>
</html>
<script src="{{ asset('proTree/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('proTree/js/nvaTree.js') }}" ></script>
<script type="text/javascript">
  //无限级 导航栏
  var arr = {!! session('categories') !!} ;

  $(".navbar-nav").ProTree({
    arr: arr,
  })

  //初始化导航样式
  $('[top=0]').css('margin-top','50px')
  $('[top=0]').css('margin-left','-100%')
</script>
