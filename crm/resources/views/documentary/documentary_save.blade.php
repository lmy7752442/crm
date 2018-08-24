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
        <input type="hidden" id="documentary_id" value="{{$documentary_data->documentary_id}}">
        <input type="hidden" id="num" value="{{$num}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>客户姓名
            </label>
            <div class="layui-input-inline">
                <select id="user" name="user" class="valid">
                    <option value="">请选择</option>
                    @foreach($admin_data as $v)
                        <option value="{{$v->c_id}}" <?php if($documentary_data->c_id == $v->c_id){ echo 'selected';} ?> >{{$v->c_name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>跟单类型
            </label>
            <div class="layui-input-inline">
                <select id="dtype" name="dtype" class="valid">
                    <option value="">请选择</option>
                    @foreach($dtype_data as $v)
                        <option value="{{$v->dtype_id}}" <?php if($documentary_data->dtype_id == $v->dtype_id){ echo 'selected';} ?> >{{$v->dtype_name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>跟单进度
            </label>
            <div class="layui-input-inline">
                <select id="dprogress" name="dprogress" class="valid">
                    <option value="">请选择</option>
                    @foreach($dprogress_data as $v)
                        <option value="{{$v->dprogress_id}}" <?php if($documentary_data->dprogress_id == $v->dprogress_id ){ echo 'selected';} ?> >{{$v->dprogress_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                详细内容
            </label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="content" name="desc" class="layui-textarea">{{$documentary_data->d_detailed}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>下次联系时间
            </label>
            <div class="layui-input-inline">
                <input type="text" id="next_time" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="<?php echo date('Y-m-d H:i:s',$documentary_data->d_time);?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>提前
            </label>
            <div class="layui-input-inline" style="width: 50px;">
                <input type="number" id="warn" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$documentary_data->warn}}">
            </div>
            <label for="username" class="layui-form-label" style="margin-left: -40px">
                天提醒
            </label>
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
            var id = $('#documentary_id').val();
            var user = $('#user').val();
            var dtype = $('#dtype').val();
            var dprogress = $('#dprogress').val();
            var content = $('#content').val();
            var next_time = $('#next_time').val();
            var warn = $('#warn').val();
            var num = $('#num').val();
            $.get('documentary_save_do',{
                user:user,
                dtype:dtype,
                dprogress:dprogress,
                content:content,
                next_time:next_time,
                warn:warn,
                id:id,
                num:num
            },function(data){
                console.log(data);
                if(data.status == 1){
                    layer.alert("修改成功", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                        //parent.$("table tr").eq(data.num).remove();
                        //parent.$('.layui-table tr:eq('+data.num+1+').remoable tr:eq('+data.num+1+')');
                        //parent.$('.layui-table tr:eq('+parseInt(data.num)-1+')').after(data.data)
                       // parent.$("table tr").eq(data.num).html(data.data);
                        //parent.$('.layui-table tr:eq(1)').remoable tr:eq(1)').before(strve();
                    });
                }else{
                    layer.alert("修改失败", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                    });
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