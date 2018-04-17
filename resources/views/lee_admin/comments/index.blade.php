@extends('layouts.leeAdmin')

@section('content')

<div class="col-md-12">
    <h4 class="page-header">文章列表</h1>
</div>
    <div class="panel panel-default col-md-12 ">

        @include('common._error')
        <div class="panel-body">

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>文章标题</th>
                        <th>分类</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($comments as $k=>$v)
                    <tr class="odd gradeX">
                        <td>{{ $k+1 }}</td>
                        <td>{{ $v['comment'][0]['title'] }}</td>
                        <td>{{ $v['content'] }}</td>
                        <td>
                            <form action="{{ route('AdminComments.destroy', $v['id']) }}"  method="post" style="width:20px">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit"  class="btn btn-warning btn-xs" value="删除">
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

            <!-- /.table-responsive -->
        </div>

    </div>


@endsection
