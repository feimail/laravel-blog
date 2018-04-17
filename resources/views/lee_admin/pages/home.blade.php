@extends('layouts.leeAdmin')

@section('content')
<!-- Main content -->
<section class="content">

  <!-- Default box -->
    <div class="col-sm-10">
        <div class="box box-solid">
            <div class="box-header with-border">


                <h3 class="box-title"><i class="fa fa-dashboard"></i>控制台</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-striped table-bordered table-hover">
                    <tbody id='system'>
                    <tr>
                        <td>版本：</td>
                        <td>1.0.0.0</td>
                        <td>服务器域名/IP：</td>
                        <td>{{ $system_info['server_domain'] }}</td>
                    </tr>
                    <tr>
                        <td>操作系统：</td>
                        <td>{{ $system_info['server_os'] }}</td>
                        <td>Web 服务器：</td>
                        <td>{{ $system_info['web_server'] }}</td>
                    </tr>
                    <tr>
                        <td>PHP 版本：</td>
                        <td>{{ $system_info['php_version'] }}</td>
                        <td>MySQL 版本：</td>
                        <td>{{ $system_info['mysql_version'] }}</td>
                    </tr>
                    <tr>
                        <td>文件上传限制：</td>
                        <td>{{ $system_info['upload_max_filesize'] }}</td>
                        <td>执行时间限制：</td>
                        <td>{{ $system_info['max_execution_time'] }}</td>
                    </tr>
                    <tr>
                        <td>安全模式：</td>
                        <td>{{ $system_info['safe_mode'] }}</td>
                        <td>Zlib 支持：</td>
                        <td>{{ $system_info['zlib'] }}</td>
                    </tr>
                    <tr>
                        <td>CURL 支持：</td>
                        <td>{{ $system_info['curl'] }}</td>
                        <td>时区设置：</td>
                        <td>{{ $system_info['timezone'] }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
  <!-- /.box -->

</section>
@endsection
