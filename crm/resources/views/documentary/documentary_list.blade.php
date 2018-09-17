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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <div  class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" id="username" name="username"  placeholder="请输入客户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach" id="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
    </div>
    <script>
        $('#sreach').click(function(){
            var start_time = $('#start').val();
            var end_time = $('#end').val();
            var username = $('#username').val();
            if(start_time!='' || end_time!='' || username!=''){
                location.href = 'documentary_list?start_time='+start_time+'&end_time='+end_time+'&username='+username;
                // $.get('documentary_list',{
                //     start_time:start_time,
                //     end_time:end_time,
                //     username:username
                // },function(data){
                //     $('#zong').html(data)
                // })
            }
        })
    </script>
    <style>
        .demo {display: inline-block;*display: inline;*zoom: 1;width: 140px;height: 20px;line-height: 20px;font-size: 12px;overflow: hidden;-ms-text-overflow: ellipsis;text-overflow: ellipsis;white-space: nowrap;}
        .demo:hover {height: auto;white-space: normal;}
    </style>
    <script>
        function MouseOver(obj)
        {
            obj.style.backgroundColor = "red";
        }

        function MouseOut(obj)
        {
            obj.style.backgroundColor = "green";
        }
    </script>
    <xblock>
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
        <button class="layui-btn" onclick="x_admin_show('添加客户','documentary_add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <div id="zong">
    <table class="layui-table">
        <thead id="aaa">
        <tr>
            {{--<th>--}}
                {{--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>--}}
            {{--</th>--}}
            <th>编号</th>
            <th>客户名称</th>
            <th>地址</th>
            <th>跟单类型</th>
            <th>联系进度</th>
            <th>下次联系</th>
            <th>详细内容</th>
            <th>业务员</th>
            <th>录入时间</th>
            <th>管理</th>
        </thead>
        <tbody id = 'data'>
        <?php $num=0;?>
        @foreach($documentary_data as $v)
        <tr>
            {{--<td>--}}
                {{--<div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>--}}
            {{--</td>--}}
            <td><?php echo $num=$num+1;?></td>
            <td>{{$v->c_id}}</td>
             <td>
                 <a href="javascript:;" target="_blank" class="demo">{{$v->address}}</a>
             </td>
            <td>{{$v->dtype_id}}</td>
            <td>{{$v->dprogress_id}}</td>
            <td>{{$v->d_nexttime}}</td>
            <td>
<!--                --><?php
//                    if(mb_strlen($v->d_detailed)>8){
//                        echo mb_substr($v->d_detailed,0,8).'...';
//                    }else{
//                        echo $v->d_detailed;
//                    }
//                ?>
                <a href="javascript:;" target="_blank" class="demo">{{$v->d_detailed}}</a>
            </td>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->d_time}}</td>
            {{--<td class="td-status">--}}
                {{--<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>--}}
            {{--<td class="td-manage">--}}
                {{--<a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">--}}
                    {{--<i class="layui-icon">&#xe601;</i>--}}
                {{--</a>--}}
            <td>
                <a title="编辑"  onclick="x_admin_show('编辑','documentary_save?id={{$v->documentary_id}}&num=<?php echo $num;?>')" href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$v->documentary_id}}')"  href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        {{ $documentary_data->render()}}
    </div>
    </div>
</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var documentary_id = id;
            $.get('documentary_del',{
                documentary_id:documentary_id
            },function(data){
               if(data == 1){
                   //发异步删除数据
                   $(obj).parents("tr").remove();
                   layer.msg('已删除!',{icon:1,time:1000});
               }
            })
        });
    }


    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>
<input type="hidden" id="aaabbb" value="0">
</html>