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
<div class="x-body">
    <div class="layui-form">
        {{--<form class="layui-form" method="get" action="/admin_add_do">--}}
        <!-- 部门名称 -->
        <div class="layui-form-item">
            <label for="d_name" class="layui-form-label">
                <span class="x-red">*</span>部门名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="d_name" name="d_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 管理员 -->
        <div class="layui-form-item">
            <label for="a_id" class="layui-form-label">
                <span class="x-red">*</span>管理员
            </label>
            <div class="layui-input-inline">
                <select name="a_id">
                    <option value="">请选择</option>
                    @foreach($admin as $v)
                        <option value="{{$v->a_id}}">{{$v->a_account}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- 角色名称 -->
        <div class="layui-form-item">
            <label for="role_id" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <select name="role_id">
                    <option value="">请选择</option>
                    @foreach($role as $v)
                        <option value="{{$v->role_id}}">{{$v->r_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- 增加 -->
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
        {{--</form>--}}
    </div>
</div>
<script>
    layui.use(['form','layer','laydate'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer
                ,laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#a_birthday' //指定元素
        });

        form.on('submit(add)', function(data){
            console.log(data);
            $.ajax({
                method:'get',
                url:"/department_add_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.msg("部门添加成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            window.parent.location.reload();
                        });
                    }else if(res == 2){
                        layer.msg('部门添加失败', {icon: 5})
                        layer.close(layer.index);
                    }
                }
            });
            return false;
        });

    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>