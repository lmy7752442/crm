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
                <span class="x-red">*</span>登录名
            </label>
            <div class="layui-input-inline">
                <input type="hidden" id="hi" value="{{$data->c_id}}">
                <input type="text" id="username" name="c_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$data->c_name}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="c_phone" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input" value="{{$data->c_phone}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>备用手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="other_phone" name="c_phone" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input" value="{{$data->other_phone}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>客户</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="ctype_id" id="ctype">
                        <option>客户类型</option>
                        @foreach($ctype as $v)
                            <option value="{{$v->ctype_id}}" <?php if($data->ctype_id == $v->ctype_id){ echo 'selected'; }?> >{{$v->ctype_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="csource_id" id="csource_id">
                        <option>客户来源</option>
                        @foreach($csource as $val)
                            <option value="{{$val->csource_id}}" <?php if($data->csource_id == $val->csource_id){ echo 'selected'; }?>>{{$val->csource_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="clevel_id" id="clevel_id">
                        <option>客户等级</option>
                        @foreach($clevel as $value)
                            <option value="{{$value->clevel_id}}" <?php if($data->clevel_id == $value->clevel_id){ echo 'selected'; }?>>{{$value->clevel_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                其他联系方式
            </label>
            <div class="layui-input-inline">
                <input type="text" id="c_other_connect" name="content" required="" lay-verify="pass"
                       autocomplete="off" class="layui-input" value="{{$data->c_other_connect}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
                <span class="x-red"></span>备注
            </label>
            <div class="layui-input-inline">
                <input type="text" id="c_notes" name="c_notes" required="" lay-verify="repass"
                       autocomplete="off" class="layui-input" value="{{$data->c_notes}}">
            </div>
        </div>

        <div class="x-body">
            <div class="layui-row">
                {{--<form class="layui-form layui-col-md12  layui-form-pane">--}}
                <div class="layui-form-item" id="x-city">
                    <label class="layui-form-label">城市联动</label>
                    <div class="layui-input-inline">
                        <select name="province" lay-filter="province"id="province">
                            <option value="">请选择省</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="city" lay-filter="city"id="city">
                            <option value="">请选择市</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="area" lay-filter="area"id="area">
                            <option value="">请选择县/区</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                详细地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="address" name="content" required="" lay-verify="pass"
                       autocomplete="off" class="layui-input" value="{{$data->address}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="" id="button">
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

        $('#x-city').xcity('{{$data->c_province}}','{{$data->c_city}}','{{$data->c_area}}');

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
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 5){
                    return '昵称至少得5个字符啊';
                }
            }
        });

        // //监听提交
        form.on('submit(add)', function(data){
            var id = $('#hi').val();
            var c_name = $('#username').val();
            var c_phone = $('#phone').val();
            var ctype = $('#ctype').val();
            var clevel_id = $('#clevel_id').val();
            var csource_id = $('#csource_id').val();
            var c_other_connect = $('#c_other_connect').val();
            var c_notes = $('#c_notes').val();
            var province = $('#province').val();
            var city = $('#city').val();
            var area = $('#area').val();
            var other_phone = $('#other_phone').val();
            var address = $('#address').val();
            $.get('/user_update_do',
                {
                    id:id,
                    c_name:c_name,
                    c_phone:c_phone,
                    ctype:ctype,
                    clevel_id:clevel_id,
                    csource_id:csource_id,
                    c_other_connect:c_other_connect,
                    c_notes:c_notes,
                    province:province,
                    city:city,
                    area:area,
                    other_phone:other_phone,
                    address:address
                },function(data){
                    if(data==1){
                        //发异步，把数据提交给php
                        layer.alert("修改成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            window.parent.location.reload();
                            parent.layer.close(index);
                        });
                    }else{
                        //发异步，把数据提交给php
                        layer.alert("修改失败", {icon: 6},function () {
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