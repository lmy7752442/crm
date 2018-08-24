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
        <input type="hidden" name="department_id" value="{{$res->department_id}}">
        <!-- 部门名称 -->
        <div class="layui-form-item">
            <label for="d_name" class="layui-form-label">
                <span class="x-red">*</span>部门名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="d_name" value="{{$res->d_name}}" name="d_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 修改 -->
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="update" lay-submit="">
                修改
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

        //自定义验证规则
//        form.verify({
//            a_account: function(value){
//                if(value.length < 5){
//                    return '昵称至少得5个字符啊';
//                }
//            }
//            a_pwd: [/(.+){6,12}$/, '密码必须6到12位']
//            ,a_repwd: function(value){
//                if($('#a_pwd').val()!=$('#a_repwd').val()){
//                    return '两次密码不一致';
//                }
//            }
//        });

        //监听提交
//        form.on('submit(add)', function(data){
//            console.log(data);
//            //发异步，把数据提交给php
//            layer.alert("增加成功", {icon: 6},function () {
//                // 获得frame索引
//                var index = parent.layer.getFrameIndex(window.name);
//                //关闭当前frame
//                parent.layer.close(index);
//            });
//            return false;
//        });

        form.on('submit(update)', function(data){
            console.log(data);
            $.ajax({
                method:'get',
                url:"/department_update_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.alert('部门修改成功');
                        window.location.href="/department_list";
                    }else if(res == 2){
                        layer.alert('部门修改失败');
                        window.location.href="/department_list";
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