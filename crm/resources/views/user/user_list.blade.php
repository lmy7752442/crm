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
        <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so">
                <input class="layui-input" placeholder="添加时间" name="start" id="start">
                <input class="layui-input" placeholder="截止日" name="end" id="end">
                <input type="text" name="username" id="name"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                <div class="layui-btn"  lay-submit="" lay-filter="sreach" id="seek"><i class="layui-icon">&#xe615;</i></div>
            </form>
        </div>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/user_add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>客户名称</th>
            <th>手机号</th>
            <th>备用手机号</th>
            <th>客户类型</th>
            <th>客户等级</th>
            <th>客户来源</th>
            <th>其他联系方式</th>
            <th>备注</th>
            <th>省</th>
            <th>市</th>
            <th>县</th>
            <td>详细地址</td>
            <th>添加时间</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><a onclick="x_admin_show('客户共享','/share_add?c_id={{$v->c_id}}')" style="color:blue;" href="javascript:;">{{$v->c_name}}</a></td>
            <td>{{$v->c_phone}}</td>
            <td>{{$v->other_phone}}</td>
            <td>{{$v->ctype_id}}</td>
            <td>{{$v->clevel_id}}</td>
            <td>{{$v->csource_id}}</td>
            <td>{{$v->c_other_connect}}</td>
            <td>{{$v->c_notes}}</td>
            <td>{{$v->c_province}}</td>
            <td>{{$v->c_city}}</td>
            <td>{{$v->c_area}}</td>
            <td>{{$v->address}}</td>
            <td><?php echo date('Y-m-d H:i:s',$v->ctime); ?></td>
            <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('编辑','user_update?id={{$v->c_id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
                <a titel="扔入公海" href="javascript:;" onclick="member_seas(this,'{{$v->c_id}}')">
                    <i class="layui-icon">公海</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$v->c_id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>

            </td>
        </tr>
         @endforeach
        </tbody>
    </table>
    <div class="page">
       {{$data->links()}}
    </div>
</div>
<script>
    $('#seek').on('click',function(){
        var start = $('#start').val();
        var name  = $('#name').val();
        var end = $('#end').val();
        location.href = 'user_list?start='+start+'&name='+name+'&end='+end;
       // alert(1)
       //  $.get('user_seek',
       //      {
       //          start:start,
       //          end:end,
       //          name:name
       //      },function(data){
       //         var str = '';
       //         for(i in data){
       //             str +="<tr>"
       //                 + "<td>"+"<div class='layui-unselect layui-form-checkbox' lay-skin='primary' data-id='2'><i class='layui-icon'>&#xe605;</i></div>"+"</td>"
       //                 + "<td>"+"<a onclick='x_admin_show('客户共享','/share_add?c_id="+data[i]['c_id']+"')' style='color:blue;' href='javascript:;'>"+data[i]['c_name']+"</a>"+"</td>"
       //                 + "<td>"+data[i]['c_phone']+"</td>"
       //                 + "<td>"+data[i]['other_phone']+"</td>"
       //                 + "<td>"+data[i]['ctype_id']+"</td>"
       //                 + "<td>"+data[i]['clevel_id']+"</td>"
       //                 + "<td>"+data[i]['cspurce_id']+"</td>"
       //                 + "<td>"+data[i]['c_other_connect']+"</td>"
       //                 + "<td>"+data[i]['c_notes']+"</td>"
       //                 + "<td>"+data[i]['c_province']+"</td>"
       //                 + "<td>"+data[i]['c_city']+"</td>"
       //                 + "<td>"+data[i]['c_area']+"</td>"
       //                 + "<td>"+data[i]['address']+"</td>"
       //                 + "<td>"+data[i]['ctime']+"</td>"
       //                 + "<td>"+"<a title='查看'  onclick="+"x_admin_show('编辑','user_update?id="+data[i]['c_id']+"')"+ "href='javascript:;'><i class='layui-icon'>&#xe63c;</i></a><a titel='扔入公海' href='javascript:;' onclick='member_seas(this,'"+data[i]['c_id']+"')'><i class='layui-icon'>公海</i></a><a title='删除' onclick='member_del(this,'"+data[i]['c_id']+"')' href='javascript:;'><i class='layui-icon'>&#xe640;</i></a>"+"</td>"
       //                 +"</tr>"
       //         }
       //
       //      })
    })
</script>
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
            //发异步删除数据
            $.get('user_del',
                {
                    id:id
                },function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                        // parent.$('.layui-table tr:eq(1)').before(strve()); //删除指定行
                    }else{
                        $(obj).parents("tr").remove();
                        layer.msg('删除失败!',{icon:1,time:1000});
                    }
                })

        });
    }
    function member_seas(obj,id){
        layer.confirm('确认要扔入公海吗？',function(index){
            $.get('seas_add',
                {
                    id:id
                },function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已扔进公海!',{icon:1,time:1000});
                        // parent.$('.layui-table tr:eq(1)').before(strve()); //删除指定行
                    }else{
                        $(obj).parents("tr").remove();
                        layer.msg('扔入失败!',{icon:1,time:1000});
                    }
                })
        })
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

</html>