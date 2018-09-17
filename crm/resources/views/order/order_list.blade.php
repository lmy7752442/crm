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
        <div class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            {{--<div class="layui-input-inline">--}}
                {{--<select name="contrller">--}}
                    {{--<option>支付状态</option>--}}
                    {{--<option>已支付</option>--}}
                    {{--<option>未支付</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<select name="contrller">--}}
                    {{--<option>支付方式</option>--}}
                    {{--<option>支付宝</option>--}}
                    {{--<option>微信</option>--}}
                    {{--<option>货到付款</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            <div class="layui-input-inline">
                <select name="contrller" id="order_type">
                    <option value="">订单状态</option>
                    @foreach($order_type as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="text" name="username" id="order_number" placeholder="请输入订单号" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach" id="sreach"><i class="layui-icon">&#xe615;</i></button>
        </div>
    </div>
    <script>
        $('#sreach').click(function(){
            var start_time = $('#start').val();
            var end_time = $('#end').val();
            var order_type = $('#order_type').val();
            var order_number = $('#order_number').val();
            location.href = 'order_list?start_time='+start_time+'&end_time='+end_time+'&order_type='+order_type+'&order_number='+order_number;
                // $.get('documentary_list',{
                //     start_time:start_time,
                //     end_time:end_time,
                //     username:username
                // },function(data){
                //     $('#zong').html(data)
                // })

        })
    </script>
    <xblock>
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
        <button class="layui-btn" onclick="x_admin_show('添加用户','order_add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>编号</th>
            {{--<th>--}}
                {{--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>--}}
            {{--</th>--}}
            <th>订单编号</th>
            <th>收货人</th>
            <th>订单金额</th>
            <!-- <th>优惠金额</th> -->
            <!-- <th>优惠方式</th> -->
            <th>实收金额</th>
            <th>订单状态</th>
            <th>打款方式</th>
            
           
            <th>物流</th>
            <!-- <th>运费</th> -->
            <th>下单时间</th>
             <th>业务员</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $num=0;?>
        @foreach($order_data as $v)
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
			<td><?php echo $num=$num+1;?></td>
            <td><a title="查看详情" href="/order_view?id={{$v->o_number}}">{{$v->o_number}}</td>
            
            <td>{{$v->c_id}}</td>
            <td>{{$v->order_money}}</td>
            <!-- <td>{{$v->discounts_money}}</td> -->
            <!-- <td>{{$v->discounts_type}}</td> -->
            <td>{{$v->get_money}}</td>
                 <td>{{$v->order_type}}</td>
            <td>{{$v->order_mode}}</td>
       
           
            <td>申通物流</td>
            <!-- <td>{{$v->send_type}}</td> --> 
            <td><?php echo date('Y-m-d H:i:s',$v->time)?></td>
             <td>{{$v->a_id}}</td>
            <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('编辑','order_save?id={{$v->order_id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$v->order_id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>

				<a title="出货"  onclick="x_admin_show('出货单','/order_product?order_number={{$v->o_number}}')" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        {{$order_data->appends(['order_number'=>$order_number,'end_time'=>$end_time,'start_time'=>$start_time,'order_type'=>$order_type])->links()}}
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
            $.get('order_del',{
                id:id
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

</html>