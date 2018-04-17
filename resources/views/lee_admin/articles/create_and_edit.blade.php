@extends('layouts.leeAdmin')

@section('content')

<div class="col-md-12">
    <h4 class="page-header">新增文章</h1>
</div>
    <div class="panel panel-default col-md-12 ">

        @include('common._error')
        <div class="panel-body">

          @if(isset($article->id))
            <form action="{{ route('articles.update',$article->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT">
          @else
            <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
          @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="category-field">分类</label>
                    <select class="form-control" name="category_id">
                      @foreach($categories as $v)
                        <option value="{{ $v->id }}" {{ $article->category_id == $v->id ? 'selected' : '' }} >{{ $v->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title-field">标题</label>
                    <input class="form-control"  type="text" name="title" id="email-field" value="{{ old('title', $article->title ) }}" />
                </div>
                <div class="form-group">
                    <label for="title-field">简介</label>
                    <input class="form-control"  type="text" name="phrase"  value="{{ old('phrase', $article->phrase ) }}" />
                </div>
                <div class="form-group">
                    <label for="content-field">内容</label>
                    <!-- 编辑器容器 -->
                    <script id="ue-container" name="content" type="text/plain">{!! old('content', $article->content ) !!}</script>
                </div>

                <div class="form-group">
                    <label for="content-field">是否置顶</label>
                    <select class="form-control" name="is_top">
                        <option value="1" {{ $article->is_top == 1 ? 'selected' : '' }}>是</option>
                        <option value="0" {{ $article->is_top == 0 ? 'selected' : '' }}>否</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="avatar-label">封面图</label>
                    <input type="file" name="cover">

                    @if($article->cover)
                        <br>
                        <img class="thumbnail img-responsive" src="{{ $article->cover }}" width="200" />
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>



            </form>
        </div>
    </div>
    <!-- ueditor-mz 配置文件 -->
    <script type="text/javascript" src="{{asset('vendor/ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('vendor/ueditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('ue-container');
        ue.ready(function(){
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>


@endsection
