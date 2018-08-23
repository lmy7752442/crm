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
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>等级
            </label>
            <div class="layui-input-inline">
                <input type="text" id="ctype" name="c_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的登入名
            </div>
        </div>
        <div>
        {{--<div class="layui-form-item">--}}
            {{--<label for="phone" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>手机--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="phone" name="c_phone" required="" lay-verify="phone"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
            {{--<div class="layui-form-mid layui-word-aux">--}}
                {{--<span class="x-red">*</span>将会成为您唯一的登入名--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label class="layui-form-label"><span class="x-red">*</span>客户</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<select name="ctype_id" id="ctype">--}}
                        {{--<option>客户类型</option>--}}
                        {{--<option value="1">QQ</option>--}}
                        {{--<option value="2 ">微信</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<select name="clevel_id" id="clevel_id">--}}
                        {{--<option>客户来源</option>--}}
                        {{--<option value="1">走访</option>--}}
                        {{--<option value="2">电话</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<select name="csource_id" id="csource_id">--}}
                        {{--<option>客户等级</option>--}}
                        {{--<option value="1">1级</option>--}}
                        {{--<option value="2">2级</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="layui-form-item">--}}
            {{--<label for="L_pass" class="layui-form-label">--}}
                {{--其他联系方式--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="c_other_connect" name="content" required="" lay-verify="pass"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
            {{--<div class="layui-form-mid layui-word-aux">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item">--}}
            {{--<label for="L_repass" class="layui-form-label">--}}
                {{--<span class="x-red"></span>备注--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="c_notes" name="c_notes" required="" lay-verify="repass"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="x-body">--}}
            {{--<div class="layui-row">--}}
                {{--<form class="layui-form layui-col-md12  layui-form-pane">--}}
                {{--<div class="layui-form-item" id="x-city">--}}
                    {{--<label class="layui-form-label">城市联动</label>--}}
                    {{--<div class="layui-input-inline">--}}
                        {{--<select name="province" lay-filter="province"id="province">--}}
                            {{--<option value="">请选择省</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="layui-input-inline">--}}
                        {{--<select name="city" lay-filter="city"id="city">--}}
                            {{--<option value="">请选择市</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="layui-input-inline">--}}
                        {{--<select name="area" lay-filter="area"id="area">--}}
                            {{--<option value="">请选择县/区</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="" id="button">
                增加
            </button>
        </div>
    </form>
</div>
<script type="text/javascript" src="crm/js/xcity.js"></script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
        // //监听提交
        form.on('submit(add)', function(data){
            var ctype = $('#ctype').val();

            $.get('/ctype_add_do',
                {
                    ctype:ctype
                },function(data){
                    if(data==1){
                        //发异步，把数据提交给php
                        layer.alert("增加成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            parent.layer.close(index);
                        });
                    }else{
                        //发异步，把数据提交给php
                        layer.alert("增加失败", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            parent.layer.close(index);
                        });
                    }
                });
            return false;
        });


    });
</script>

</body>
</html>