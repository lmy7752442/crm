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
        {{--<form class="layui-form" method="get" action="/admin_update_do">--}}
            <input type="hidden" name="a_id" value="{{$res->a_id}}">
            <!-- 账号 -->
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>账号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_account" value="{{$res->a_account}}" name="a_account" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--<span class="x-red">*</span>将会成为您唯一的登入名--}}
                </div>
            </div>
            <!-- 手机 -->
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_phone" value="{{$res->a_phone}}" name="a_phone" required="" lay-verify="phone"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--<span class="x-red">*</span>将会成为您唯一的手机号--}}
                </div>
            </div>
            <!-- 姓名 -->
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>姓名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_name" value="{{$res->a_name}}" name="a_name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--<span class="x-red">*</span>将会成为您唯一的姓名--}}
                </div>
            </div>
            <!-- 生日 -->
            <div class="layui-form-item">
                <label for="a_birthday" class="layui-form-label">
                    <span class="x-red">*</span>生日
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_birthday" value="{{$res->a_birthday}}" name="a_birthday" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--<span class="x-red">*</span>将会成为您唯一的登入名--}}
                </div>
            </div>
            <!-- 邮箱 -->
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>邮箱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_email" value="{{$res->a_email}}" name="a_email" required="" lay-verify="email"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--<span class="x-red">*</span>--}}
                </div>
            </div>
            <!-- 密码 -->
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="a_pwd" value="{{$res->a_pwd}}" name="a_pwd" required="" lay-verify="pass"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--6到16个字符--}}
                </div>
            </div>
            <!-- 地址 -->
            <div class="layui-form-item">
                <label for="a_address" class="layui-form-label">
                    <span class="x-red">*</span>地址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_address" value="{{$res->a_address}}" name="a_address" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--6到16个字符--}}
                </div>
            </div>
            <!-- IDcard -->
            <div class="layui-form-item">
                <label for="a_idcard" class="layui-form-label">
                    <span class="x-red">*</span>IDcard
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_idcard" value="{{$res->a_idcard}}" name="a_idcard" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--6到16个字符--}}
                </div>
            </div>
            <!-- 客户量 -->
            <div class="layui-form-item">
                <label for="a_client_num" class="layui-form-label">
                    <span class="x-red">*</span>客户量
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="a_client_num" value="{{$res->a_client_num}}" name="a_client_num" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    {{--6到16个字符--}}
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

//        //自定义验证规则
//        form.verify({
//            nikename: function(value){
//                if(value.length < 5){
//                    return '昵称至少得5个字符啊';
//                }
//            }
//            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
//            ,repass: function(value){
//                if($('#L_pass').val()!=$('#L_repass').val()){
//                    return '两次密码不一致';
//                }
//            }
//        });

//        //监听提交
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
                url:"/admin_update_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.alert('管理员修改成功');
                        window.location.href="/admin_list";
                    }else if(res == 2) {
                        layer.alert('管理员修改失败');
                        window.location.href = "/admin_list";
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