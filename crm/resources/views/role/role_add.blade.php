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
    <form action="" method="post" class="layui-form layui-form-pane">
        <!-- 角色名称 -->
        <div class="layui-form-item">
            <label for="r_name" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="r_name" name="r_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 权限名称 -->
        <div class="layui-form-item">
            <label for="r_name" class="layui-form-label">
                <span class="x-red">*</span>权限名称
            </label>
            <div class="layui-input-inline">
                <select name="power_id">
                    <option value="">请选择</option>
                    @foreach($data as $v)
                        <option value="{{$v->power_id}}">{{$v->p_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--<div class="layui-form-item layui-form-text">--}}
            {{--<label for="desc" class="layui-form-label">--}}
                {{--描述--}}
            {{--</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="add">增加</button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //自定义验证规则
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

        form.on('submit(add)', function(data){
            console.log(data);
            $.ajax({
                method:'get',
                url:"/role_add_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.alert('角色添加成功');
                        window.location.href="/role_list";
                    }else{
                        layer.alert('角色添加失败');
                        window.location.href="/role_add";
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