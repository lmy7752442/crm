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
        <input type="hidden" id="wuliu_id" value="{{$data->id}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单编号
            </label>
            <div class="layui-input-inline" style="width: 200px">
                <select id="o_number" name="user" class="valid" lay-filter="o_number">
                    <option value="">请选择</option>
                    @foreach($order_data as $v)
                        <option value="{{$v->order_id}}" <?php if($v->order_id == $data->order_id) echo 'selected';?>>{{$v->o_number}}</option>
                    @endforeach
                </select>
            </div>
            <label for="username" class="layui-form-label" >
                <span class="x-red">*</span>客户姓名
            </label>
            <div class="layui-input-inline" style="width: 150px">
                <input type="text" id="username" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->username}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>物流状态
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <select id="wuliu_status" name="user" class="valid" lay-filter="username">
                    <option value="">请选择</option>
                    @foreach($wuliustatus_data as $v)
                        <option value="{{$v->id}}" <?php if($v->id == $data->wuliustatus) echo 'selected';?>>{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item" id="x-city">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>地址
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <select  name="province" lay-filter="province" id="sheng">
                    <option value="" >请选择省</option>
                </select>
            </div>
            <div class="layui-input-inline" style="width: 100px">
                <select name="city" lay-filter="city" id="shi">
                    <option value="" >请选择市</option>
                </select>
            </div>
            <div class="layui-input-inline" style="width: 100px">
                <select name="area" lay-filter="area"  id="xian">
                    <option value="">请选择县/区</option>
                </select>
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>详细地址
            </label>
            <div class="layui-input-inline" style="width: 300px">
                <input type="text" id="address" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->address}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>物流编号
            </label>
            <div class="layui-input-inline" style="width: 150px">
                <input type="text" id="wuliu_number" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->odd_number}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>业务员
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="admin" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value='{{$data->admin}}' class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>代收
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="number" id="instead_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->instead_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>物流
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <select id="wuliu_type" name="user" class="valid" lay-filter="username">
                    <option value="">请选择</option>
                    @foreach($wuliutype_data as $v)
                        <option value="{{$v->id}}" <?php if($v->id == $data->wuliu_id) echo 'selected';?>>{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>运费
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="number" id="send_money" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->send_money}}" class="layui-input">
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>备注
            </label>
            <div class="layui-input-inline" style="width: 600px">
                <input type="text" id="notes" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$data->notes}}" class="layui-input">
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
        $('#x-city').xcity('{{$data->province}}','{{$data->city}}','{{$data->area}}');
        form.on('select(o_number)', function(data){
            var order_id = data.value;
            $.get('wuliu_order',{
                order_id:order_id
            },function(info){
                console.log(info);
                $('#username').val(info.username);
                $('#admin').val(info.admin);
                $('#instead_money').val(info.instead_money);
                $('#address').val(info.address);
                $('#wuliu_status').val(info.wuliustatus);
                $('#x-city').xcity(info.province,info.city,info.area);
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
            var province = $('#sheng').val();
            var city = $('#shi').val();
            var area = $('#xian').val();
            var address = $('#address').val();
            var wuliu_number = $('#wuliu_number').val();
            var instead_money = $('#instead_money').val();
            var admin = $('#admin').val();
            var send_money = $('#send_money').val();
            var wuliu_type = $('#wuliu_type').val();
            var notes = $('#notes').val();
            var wuliu_status = $('#wuliu_status').val();
            var id = $('#wuliu_id').val();
            // console.log(o_number+username+province+city+area+address+wuliu_number+instead_money+admin+send_money+wuliu_type);
            // return false;
            $.get('wuliu_save_do',{
                id:id,
                o_number:o_number,
                username:username,
                province:province,
                city:city,
                area:area,
                address:address,
                wuliu_number:wuliu_number,
                instead_money:instead_money,
                admin:admin,
                send_money:send_money,
                wuliu_type:wuliu_type,
                wuliu_status:wuliu_status,
                notes:notes
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