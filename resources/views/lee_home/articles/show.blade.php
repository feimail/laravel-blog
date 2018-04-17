@extends('layouts.leeHome')

@section('content')


<article class="post">
  <div class="post-head">
    <h1 class="post-title"><a href="{{ route('homeArticles.show',$article->id) }}">{{ $article->title }}</a></h1>
    <div class="post-meta"><span class="author">作者：{{ $article->author }}</span> • <time class="post-date"  title="{{ $article->created_at }}">{{ $article->created_at->diffForHumans() }}</time></div></div>
    <div class="featured-media"><a href="{{ route('homeArticles.show',$article->id) }}"><img src="{{ $article->cover }}" alt="{{ $article->title }}"></a></div>
    <div class="post-content"><p></p><p>{!! $article->content !!}</p><p></p></div>
    <footer class="post-footer clearfix">
      <div class="btn-group">
        <a class='btn btn-default'>赞! </a>
        <a class='btn btn-default' onclick="$('#pl').attr('class','row block')">评论</a>
      </div>
    </footer>
</article>


<div  style="background:#fff;padding: 15px;width: 100%">
  <div class="row">
    <div class="col-sm-12">
      <div class="widget">
        <h4 class="title">评论</h4>
        @include('common._error')

        
        <div class="row hidden" id='pl'>
          <form action="{{ route('comments.store') }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="article_id" value="{{ $article->id }}">

            <div class="col-sm-10">
              <div class="form-group">
                <textarea class="form-control"  placeholder="评论" name='content' style='resize: none'></textarea>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="submit"  class='btn btn-default'>提交</button>
            </div>
          </form>
        </div>
        
        <div class="content recent-post">

          @foreach ($comments as $v)

            <div class="recent-single-post">
              <div class='row'>
                <div class="col-sm-1">
                  <img src="{{ asset('img/default/default.jpg') }}" class='img-circle' style="width: 60px">
                </div>
                <div class="col-sm-10">
                   
                  <div  style="line-height: 50px;margin-left:15px">{!! $v->content !!}</div>
                  <div style="font-size: 10px;margin-left: 15px;margin-top: 10px">ip:**{{ substr($v->ip,2,6) }}**  {{ $v->city }}  &nbsp; {{ $v->created_at }}</div>
               
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
<br>
<footer  style="background:#fff;padding: 15px">

    <div class="row">
      <div class="col-sm-12">
      <div class="widget">
      <h4 class="title">最新文章</h4>

        <div class="content recent-post">

          @foreach ($newsArticle as $v)
            <div class="recent-single-post">
              <a href="{{ route('homeArticles.show',$v->id) }}" class="post-title">{{ $v->title }}</a>
              <div class="date">{{ $v->created_at }}</div>
            </div>
          @endforeach

        </div>
      </div>
    </div>

    <!--<div class="col-sm-6">
      <div class="widget">
        <h4 class="title">标签云</h4>
        <div class="content tag-cloud">
          <a href="http://www.golaravel.com/tag-cloud/">...</a>
        </div>
      </div>
    </div>-->

</div>

</footer>

@endsection
