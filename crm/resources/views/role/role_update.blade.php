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
        <input type="hidden" name="role_id" value="{{$res->role_id}}">
        <div class="layui-form-item">
            <label for="r_name" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="r_name" value="{{$res->r_name}}" name="r_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <!-- 管理员 -->
        <div class="layui-form-item">
            <label for="a_id" class="layui-form-label">
                <span class="x-red">*</span>管理员
            </label>
            <div class="layui-input-inline">
                <select name="a_id">
                    <option value="">请选择</option>
                    @foreach($admin as $v)
                        <option value="{{$v->a_id}}" @if($v->a_id == $res->a_id) selected @endif>{{$v->a_account}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- 权限名称 -->
        <div class="layui-form-item">
            <label for="power_id" class="layui-form-label">
                <span class="x-red">*</span>权限名称
            </label>
            <div class="layui-input-inline">
                <select name="power_id">
                    <option value="">请选择</option>
                    @foreach($power as $v)
                        <option value="{{$v->power_id}}" @if($v->power_id == $res->power_id) selected @endif>{{$v->p_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{--描述--}}
        {{--</label>--}}
        {{--<div class="layui-input-block">--}}
        {{--<textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="update">修改</button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        form.on('submit(update)', function(data){
            console.log(data);
            $.ajax({
                method:'get',
                url:"/role_update_do",
                data:data.field,
                success:function(res){
                    console.log(res);
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.msg("角色修改成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            window.parent.location.reload();
                        });
                    }else{
                        layer.msg('角色修改失败', {icon: 5})
                        layer.close(layer.index);
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