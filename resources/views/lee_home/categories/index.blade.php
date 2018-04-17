@extends('layouts.leeAdmin')

@section('content')
<style type="text/css">
  * {
    padding: 0;
    margin: 0;
    font-family: "microsoft yahei";
  }

  ul li {
    list-style-type: none;
  }

  .box {
    width: 200px;
    /*border: 1px solid red;*/
  }

  .menuUl {
    margin-left: 20px;
    /*border: 1px solid blue;*/
  }

  .menuUl li {
    margin: 10px 0;
  }

  .menuUl li span:hover {
    text-decoration: underline;
    cursor: pointer;
  }

  .menuUl li i { margin-right: 10px; top: 0px; cursor: pointer; color: #161616; 			}
</style>
<div class="col-md-12">
    <h4 class="page-header">文章分类（点击分类名查看分类备注）</h1>
</div>
@include('common._error')
<body>
  <button class="btn btn-info btn-sm" name='add_category' data-id="0">添加顶级分类</button>
  <div class="innerUl">

  </div>

<!-- 模态框（新增） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">新增分类</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal"  id='add_form' method="POST" accept-charset="UTF-8" action="{{ route('categories.store') }}">
                {{ csrf_field() }}
              	<div class="form-group">
              		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
              		<div class="col-sm-10">
              			<input type="text" class="form-control" name='name'
              				   placeholder="请输入分类名称">
              		</div>
              	</div>
              	<div class="form-group">
              		<label for="lastname" class="col-sm-2 control-label">分类备注</label>
              		<div class="col-sm-10">
              			<input type="text" class="form-control" name='description'
              				   placeholder="请输入分类备注">
              		</div>
              	</div>

                <input type="hidden" value="" name='pid'>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="$('#add_form').submit()">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<!-- 模态框（修改） -->
<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">修改分类</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal"  id='edit_form' method="POST" accept-charset="UTF-8" action="categories/update">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">分类名称</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name='name'
                       placeholder="请输入分类名称">
                </div>
              </div>
              <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">分类备注</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name='description'
                       placeholder="请输入分类备注">
                </div>
              </div>

              <input type="hidden" value="" name='id'>
            </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-primary" onclick="$('#edit_form').submit()">提交更改</button>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>
</body>


<script src="{{ asset('proTree/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('proTree/js/proTree.js') }}" ></script>
<script type="text/javascript">
  //后台传入的 分页列表
  var arr = {!! $category !!} ;

      //标题的图标是集成bootstrap 的图标  更改 请参考bootstrap的字体图标替换自己想要的图标
  $(".innerUl").ProTree({
    arr: arr,
    simIcon: "fa fa-stop",//单个标题字体图标 不传默认glyphicon-file
    mouIconOpen: "fa fa-minus-square",//含多个标题的打开字体图标  不传默认glyphicon-folder-open
    mouIconClose:"fa fa-plus-square",//含多个标题的关闭的字体图标  不传默认glyphicon-folder-close
    callback: function(id,name,description) {
      alert('该分类备注：'+ description);
    }
  })

  //新增分类弹框
  $('[name=add_category]').click(function(){
    $('[name=pid]').val($(this).attr('data-id'))
    $('#myModal').modal('show');
  })

  //修改分类弹框
  $('[name=edit_category]').click(function(){
    $('[name=id]').val($(this).attr('data-id'))
    $('[name=name]').val($(this).attr('data-name'))
    var des = $(this).attr('data-des') == 'null' ? '' : $(this).attr('data-des');
    $('[name=description]').val(des)
    $('#edit_category').modal('show');
  })

  $('[name=del_category]').click(function(){

    if(!confirm('是否删除？')){
      return false;
    }

    location = "del/"+$(this).attr('data-id');
  })

</script>
<!-- jQuery -->

@endsection
