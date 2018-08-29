<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="crm/css/font.css">
    <link rel="stylesheet" href="crm/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="crm/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="crm/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>个人中心</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <div class="layui-row">
        </div>
    </div>
    <xblock>
        {{--<button class="layui-btn" onclick="x_admin_show('添加用户','/user_add')"><i class="layui-icon"></i>添加</button>--}}
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>名称</th>
            <th>姓名</th>
            <th>角色</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>地址</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->a_account}}</td>
                <td>{{$data->a_name}}</td>
                <td>{{$data->role_id}}</td>
                <td>{{$data->a_phone}}</td>
                <td>{{$data->a_email}}</td>
                <td>{{$data->a_address}}</td>
                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','personal_update?id={{$data->a_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="page">
    </div>
</div>

</body>

</html>