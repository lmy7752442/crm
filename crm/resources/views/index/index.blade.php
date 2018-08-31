<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="crm/css/font.css">
	<link rel="stylesheet" href="crm/css/xadmin.css">
    <script type="text/javascript" src="crm/js/jquery-3.3.1.min.js"></script>
    <script src="crm/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="crm/js/xadmin.js"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="./index.html">X-admin v2.0</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">{{$data}}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('个人信息','personal')">个人信息</a></dd>
<<<<<<< HEAD
              {{--<dd><a onclick="x_admin_show('切换帐号','login_out')">切换帐号</a></dd>--}}
                <dd><a href="javascript:;" id="out">切换账号</a></dd>
=======
              <dd><a id="qie">切换帐号</a></dd>
>>>>>>> e0fe83f4619f1bfd174060cc6237d080b058c741
              <dd><a href="javascript:;" id="out">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
        </ul>
        
    </div>
    <script>
        layui.use(['layer'], function(){
            $ = layui.jquery;
            var layer = layui.layer;

            $("#out").click(function(){
                $.ajax({
                    url:"/login_out",
                    success:function(res){
                        console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                        if(res == 1) {
                            layer.msg('退出成功');
                            window.location.href="/login";
                        }else if(res == 2){
                            layer.msg('退出失败');
                            window.location.href="/";
                        }
                    }
                });
                return false;
            })
            $("#qie").click(function(){
                $.ajax({
                    url:"/login_out",
                    success:function(res){
                        console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                        if(res == 1) {
                            layer.msg('切换成功');
                            window.location.href="/login";
                        }else if(res == 2){
                            layer.msg('切换失败');
                            window.location.href="/";
                        }
                    }
                });
                return false;
            })

        });
    </script>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/role_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/department_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>部门管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/power_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>跟单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="documentary_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>跟单列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="documentary_dtype_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>跟单类型列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="documentary_dprogress_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>跟单进度列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>

                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="order_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="order_mode_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单方式列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="order_type_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单状态列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>产品管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="product_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>产品列表</cite>
                        </a>
                    </li >
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>客户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="user_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="share_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>共享客户列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="ctype_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户类型管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="clevel_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户等级管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="csource_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户来源管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/advince_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客户建议</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>合同管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="contype_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>合同类型</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="contract_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>合同展示</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
                    <cite>系统统计</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/count_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>统计</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>功能插件</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="publicnotice_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>内部公告</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="seas_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>公海</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="operation_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>操作记录</cite>
                        </a>
                    </li >
                    <li>

                        <a _href="wuliu_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>物流列表</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="login_log">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>登录日志</cite>
                        </a>
                    </li >
                </ul>
            </li>
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='welcome' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 x-admin v2.3 All Rights Reserved</div>  
    </div>
    <!-- 底部结束 -->
    
</body>
</html>