@extends('layouts.leeHome')

@section('content')

@foreach($articles as $v)
<article class="post">
  <div class="post-head">
    <h1 class="post-title"><a href="{{ route('homeArticles.show',$v->id) }}">{{ $v->title }}</a></h1>
    <div class="post-meta"><span class="author">作者：{{ $v->author }}</span> • <time class="post-date" datetime="February 8, 2018 2:33 AM" title="February 8, 2018 2:33 AM">{{ $v->created_at->diffForHumans() }}</time></div></div>
    <div class="featured-media"><a href="{{ route('homeArticles.show',$v->id) }}"><img src="{{ $v->cover }}" alt="Laravel 5.6 版本正式发布"></a></div>
    <div class="post-content"><p></p><p>{!! $v->phrase !!}</p><p></p></div>
    <div class="post-permalink"><a href="{{ route('homeArticles.show',$v->id) }}" class="btn btn-default">阅读全文</a></div><footer class="post-footer clearfix"></footer>
</article>
@endforeach
{{ $articles->render() }}

@endsection
