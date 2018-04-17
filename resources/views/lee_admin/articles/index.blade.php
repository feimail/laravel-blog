@extends('layouts.leeAdmin')

@section('content')

<div class="col-md-12">
    <h4 class="page-header">文章列表</h1>
</div>
    <div class="panel panel-default col-md-12 ">

        @include('common._error')
        <div class="panel-body">
          <div class="well">
              <a class="btn btn-default btn-lg btn-block"  href="{{ route('articles.create') }}">添加文章</a>
          </div>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>标题</th>
                        <th>分类</th>
                        <th>封面图</th>
                        <th>内容</th>
                        <th>点击数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($list as $k=>$v)
                    <tr class="odd gradeX">
                        <td>{{ $k+1 }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->category->name }}</td>
                        <td><img src="{{ $v->cover }}" width="30" height="20"></td>
                        <td><a href="" class="btn btn-info btn-xs" data="{{ $v->content }}">详情</a></td>
                        <td>{{ $v->click }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-4">
                              <form action="{{ route('articles.destroy', $v->id) }}"  method="post" style="width:20px">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit"  class="btn btn-warning btn-xs" value="删除">
                              </form>
                            </div>
                            <a href="{{ route('articles.edit',$v->id) }}" class="btn btn-danger btn-xs" >编辑</a>
                            <a href="{{ route('index',$v->id) }}" class="btn btn-info btn-xs" >评论</a>
                          </div>
                        </td>


                    </tr>
                    @endforeach


                </tbody>
            </table>

            <!-- /.table-responsive -->
        </div>

    </div>
    {!! $list->links() !!}

@endsection
