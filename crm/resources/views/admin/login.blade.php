<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.0</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="crm/css/font.css">
    <link rel="stylesheet" href="crm/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="crm/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="crm/js/xadmin.js"></script>
    <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>


</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">x-admin2.0-管理登录</div>
    <div id="darkbannerwrap"></div>
    <div class="layui-form">
        <input name="a_account" id="a_account" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="a_pwd" lay-verify="required" placeholder="密码" id="a_pwd" type="password" class="layui-input">
        <input type="hidden" value="returnCitySN['cip']" name="ip">
        <hr class="hr15">
        <button class="layui-btn" lay-submit="" lay-filter="login">登录</button>
        <hr class="hr20" >
    </div>
</div>

<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        form.on('submit(login)', function(data){
                var a_account = $('#a_account').val();
                var a_pwd = $('#a_pwd').val();
                // alert(a_account);
                // alert(a_pwd);
                // alert(returnCitySN['cip'])
            $.ajax({
                method:'get',
                url:"/login_do",
                data:{ip:returnCitySN['cip'],a_account:a_account,a_pwd:a_pwd},
                //data:data.field,
                success:function(res){
                    console.log(res);
                    // return false;
//                    layer.msg(res.msg,{icon:res.code});
                    if(res == 1) {
                        layer.msg('登录成功');
                        //alert(returnCitySN['cip'] );
                        window.location.href="/";
                    }else{
                        layer.msg('登录失败');
                        window.location.href="/login";
                    }
                }
            });
            return false;
        });
    });

</script>


<!-- 底部结束 -->
<script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>