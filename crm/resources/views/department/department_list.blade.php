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
        <a href="/">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加部门','/department_add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>部门编号</th>
            <th>部门名称</th>
            <th>部门添加时间</th>
            <th>管理员账号</th>
            <th>角色名称</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($new as $v)
            <tr>
                <td>{{$v->department_id}}</td>
                <td>{{$v->d_name}}</td>
                <td>{{$v->d_time}}</td>
                <td>{{$v->a_account}}</td>
                <td>{{$v->r_name}}</td>
                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','/department_update?department_id={{$v->department_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{$v->department_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- 分页 -->
    <div class="page">
        {{$new -> links()}}
    </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*部门-删除*/
    function member_del(obj,id){
//        console.log(obj);
//        console.log(id);
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
//            $(obj).parents("tr").remove();
//            layer.msg('已删除!',{icon:1,time:1000});
            $.ajax({
                method:'get',
                url:"/department_del",
                data:{department_id:id},
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.msg("部门删除成功", {icon: 6});
                        window.location.href="/department_list";
                    }else if(res == 2) {
                        layer.msg('部门删除失败', {icon: 5})
                        layer.close(layer.index);
                    }else{
                        layer.msg('还有不同角色的员工在此部门下，暂时不能删除', {icon: 5})
                        layer.close(layer.index);
                    }
                }
            });
            return false;

        });
    }


    /* 批删 */
    function delAll (argument) {

        var data = tableCheck.getData();
//        console.log(data);
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>