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
            <label class="layui-form-label"><span class="x-red">*</span>客户</label>
            <div class="layui-input-block">
                <div class="layui-input-inline">
                    <select name="customer_id" id="customer_id">
                        <option>客户</option>
                        @foreach($data as $v)
                            <option value="{{$v->c_id}} ">{{$v->c_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="contype_id" id="contype_id">
                        <option>合同类型</option>
                        @foreach($arr as $val)
                            <option value="{{$val->contype_id}} ">{{$val->contype_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>定金
            </label>
            <div class="layui-input-inline">
                <input type="number" id="c_deposit" name="c_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>返利
            </label>
            <div class="layui-input-inline">
                <input type="text" id="c_rebate" name="c_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>开始时间
            </label>
            <div class="layui-input-inline">
                <div class="layui-row">
                    <div class="layui-form layui-col-md12 x-so">
                        <input class="layui-input" placeholder="开始日" name="start" id="c_ctime" lay-verify="required"
                               autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>结束时间
            </label>
            <div class="layui-input-inline">
                <div class="layui-row">
                    <div class="layui-form layui-col-md12 x-so">
                        <input class="layui-input" placeholder="截止日" name="end" id="c_utime" lay-verify="required"
                               autocomplete="off">
                    </div>
                </div>
            </div>
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
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#c_ctime' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#c_utime' //指定元素
        });
    });
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
            var customer_id = $('#customer_id').val();
            var contype_id = $('#contype_id').val();
            var c_deposit = $('#c_deposit').val();
            var c_rebate = $('#c_rebate').val();
            var c_ctime = $('#c_ctime').val();
            var c_utime = $('#c_utime').val();
            $.get('/contract_add_do',
                {
                    customer_id:customer_id,
                    contype_id:contype_id,
                    c_deposit:c_deposit,
                    c_rebate:c_rebate,
                    c_ctime:c_ctime,
                    c_utime:c_utime
                },function(data){
                    if(data==1){
                        //发异步，把数据提交给php
                        layer.alert("增加成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            window.parent.location.reload();
                            parent.layer.close(index);
                           // parent.$('.layui-table tr:eq(1)').before(str); //首行后追加
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
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>
</html>