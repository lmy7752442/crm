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
        <!-- 主题 -->
        <div class="layui-form-item">
            <label for="a_main" class="layui-form-label">
                <span class="x-red">*</span>主题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="a_main" name="a_main" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 建议 -->
        <div class="layui-form-item">
            <label for="a_advince" class="layui-form-label">
                <span class="x-red">*</span>建议
            </label>
            <div class="layui-input-inline">
                <input type="text" id="a_advince" name="a_advince" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 客户 -->
        <div class="layui-form-item">
            <label for="c_id" class="layui-form-label">
                <span class="x-red">*</span>客户
            </label>
            <div class="layui-input-inline">
                <select name="c_id">
                    <option value="">请选择</option>
                    @foreach($data as $v)
                        <option value="{{$v->c_id}}">{{$v->c_name}}</option>
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
                url:"/advince_add_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.alert('客户建议添加成功');
                        window.location.href="/advince_list";
                    }else{
                        layer.alert('客户建议添加失败');
                        window.location.href="/advince_add";
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