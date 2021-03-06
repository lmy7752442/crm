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
                <span class="x-red">*</span>订单编号
            </label>
            <div class="layui-input-inline" style="width: 150px">
                <input type="text" id="o_number" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->o_number}}" class="layui-input" disabled>
            </div>
            <label for="username" class="layui-form-label" >
                <span class="x-red">*</span>客户姓名
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <select id="username" name="user" class="valid" lay-filter="username">
                    <option value="">请选择</option>
                    @foreach($user_data as $v)
                        <option value="{{$v->c_id}}" <?php if($order_data->c_id == $v->c_id) echo 'selected';?>>{{$v->c_name}}</option>
                    @endforeach
                </select>
            </div>

            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>手机号--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline" style="width: 100px">--}}
                {{--<input type="text" id="c_phone" name="next_time" required="" lay-verify="required"--}}
                       {{--autocomplete="off" value="{{$user->c_phone}}" class="layui-input">--}}
            {{--</div>--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>备用手机号--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline" style="width: 100px">--}}
                {{--<input type="text" id="other_phone" name="next_time" required="" lay-verify="required"--}}
                       {{--autocomplete="off" value="{{$user->other_phone}}" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="layui-form-item" id="x-city">--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>地址--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline" style="width: 100px">--}}
                {{--<select  name="province" lay-filter="province" id="c_province">--}}
                    {{--<option value="" >请选择省</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<div class="layui-input-inline" style="width: 100px">--}}
                {{--<select name="city" lay-filter="city" id="c_city">--}}
                    {{--<option value="" >请选择市</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<div class="layui-input-inline" style="width: 100px">--}}
                {{--<select name="area" lay-filter="area" id="c_area">--}}
                    {{--<option value="" >请选择县/区</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<label for="username" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>详细地址--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline" style="width: 300px">--}}
                {{--<input type="text" id="address" name="next_time" required="" lay-verify="required"--}}
                       {{--autocomplete="off"    value="{{$user->address}}" class="layui-input">--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>产品
            </label>
            <div class="layui-input-inline" id="product" style="width: 800px">
                @foreach($product as $v)
                <input type="checkbox" @foreach ($order_product as $vv)<?php if($v->product_id == $vv->product_id) echo 'checked';?> @endforeach name="" lay-filter="product" title="{{$v->p_name}}" value="{{$v->product_id}}" lay-skin="primary" style="float:left;">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>业务员
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="admin" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$user->c_name}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>代收
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="instead_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->instead_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="order_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->order_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>优惠金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="discounts_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->discounts_money}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">

            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>优惠方式
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="discounts_type" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->discounts_type}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>实收金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="get_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->get_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>打款金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="put_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->put_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>打款方式
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="order_mode" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->order_mode}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">

            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>交货方式
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="delivery_type" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->delivery_type}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>运费
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="send_type" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$order_data->send_type}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label" >
                <span class="x-red">*</span>订单状态
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <select id="order_type" name="user" class="valid" lay-filter="username">
                    <option value="">请选择</option>
                    @foreach($order_type as $v)
                        <option value="{{$v->id}}" <?php if($order_data->order_type == $v->id) echo 'selected';?>>{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>
<script type="text/javascript" src="crm/js/xcity.js"></script>
<script>
    layui.use(['form','code'], function(){
        form = layui.form;
        layui.code();
        $('#x-city').xcity('{{$user->c_province}}','{{$user->c_city}}','{{$user->c_area}}');
        form.on('select(username)', function(data){
            var uid = data.value;
            $.get('order_user',{
                uid:uid
            },function(data){
                var info = JSON.parse(data);
                $('#c_phone').val(info.user.c_phone);
                $('#admin').val(info.admin);
                $('#other_phone').val(info.user.other_phone);
                $('#address').val(info.user.address);
                $('#x-city').xcity(info.user.c_province,info.user.c_city,info.user.c_area);
            })
        });


    });

</script>
<script>
    layui.use(['form','layer','laydate'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate;
        laydate.render({
            elem: '#start_time',
            type:'datetime'//指定元素
        });
        laydate.render({
            elem: '#next_time',
            type:'datetime'//指定元素
        });
        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 5){
                    return '昵称至少得5个字符啊';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
            // console.log(data);
            var o_number = $('#o_number').val();
            var username = $('#username').val();
            var instead_money = $('#instead_money').val();
            var order_money = $('#order_money').val();
            var discounts_money = $('#discounts_money').val();
            var discounts_type = $('#discounts_type').val();
            var get_money = $('#get_money').val();
            var put_money = $('#put_money').val();
            var order_mode = $('#order_mode').val();
            var delivery_type = $('#delivery_type   ').val();
            var send_type = $('#send_type').val();
            var order_type = $('#order_type').val();
            // console.log(o_number+username+instead_money+order_money+discounts_money+discounts_type+get_money+put_money+order_mode+delivery_type+send_type);
            var product_id = '';
            $.each($('input:checkbox:checked'),function(){
                product_id = $(this).val()+','+product_id;
            });
            $.get('order_save_do',{
                o_number:o_number,
                username:username,
                instead_money:instead_money,
                order_money:order_money,
                discounts_money:discounts_money,
                discounts_type:discounts_type,
                get_money:get_money,
                put_money:put_money,
                order_mode:order_mode,
                delivery_type:delivery_type,
                send_type:send_type,
                order_type:order_type,
                product_id:product_id
            },function(data){
                console.log(data);
                if(data == 1){
                    layer.alert("修改成功", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                        parent.location.reload();
                    })
                }else{
                    layer.alert("修改失败", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                    })
                }
            })
            //发异步，把数据提交给php
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