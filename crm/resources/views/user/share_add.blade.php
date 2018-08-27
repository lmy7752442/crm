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
        <input type="hidden" name="c_id" value="{{$c_id}}">
        <!-- 是否开共享 -->
        <div class="layui-form-item">
            <label for="share" class="layui-form-label">
                <span class="x-red">*</span>是否共享
            </label>
            <div class="layui-input-inline">
                <input type="radio" name="share" lay-filter="erweima" value="1" title="是">
                <input type="radio" name="share" lay-filter="erweima" value="2" title="否">
            </div>
        </div>
        <!-- 管理员 -->
        <div class="layui-form-item">
            <label for="a_id" class="layui-form-label">
                <span class="x-red">*</span>管理员
            </label>
            <div class="layui-input-inline">
                @foreach($data as $v)
                    <input type="checkbox" name="a_id" lay-skin="primary" title="{{$v->a_name}}" value="{{$v->a_id}}">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-btn" lay-submit="" lay-filter="add">确认</div>
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
            //获取radio[name='share']的值
            var share_arr = '';
            $("input:radio[name=share]:checked").each(function(i){
                share_arr = $(this).val();
            });
            data.field.share = share_arr;//将数组合并成字符串
            //获取checkbox[name='a_id']的值
            var admin_arr = new Array();
            $("input:checkbox[name=a_id]:checked").each(function(i){
                admin_arr[i] = $(this).val();
            });
            data.field.a_id = admin_arr.join(",");//将数组合并成字符串
            //获取input[name='c_id']的值
            var c_id = "";
            var c_id = $("[name=c_id]").val();
            $.ajax({
                method:'get',
                url:"/share_add_do",
                data:{share_arr:share_arr,admin_arr:admin_arr,c_id:c_id},
                success:function(res){
                    console.log(res);
////                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.alert('客户共享成功');
                        window.parent.location.reload();
                    }else if(res=2){
                        layer.alert('客户共享失败');
                        window.parent.location.reload();
                    }else{
                        alert(res)
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