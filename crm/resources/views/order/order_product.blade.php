<!DOCTYPE>
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
		<input type="hidden" id=""/>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label" >
                <span class="x-red">*</span>客户姓名
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="other_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['c_name']}}">
            </div>

            <label for="username" class="layui-form-label">
               电话
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['c_phone']}}">
			   
            </div>
			<div class="layui-input-inline" style="width: 100px">
				 <input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['other_phone']}}">
			</div>
			<label for="username" class="layui-form-label" >
                <span class="x-red">*</span>代收金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="other_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['instead_money']}}">
            </div>
        </div>
        <div class="layui-form-item" id="x-city">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>地址
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <?php echo $res['c_province'].$res['c_city'].$res['c_area']?>
            </div>
			 <label for="username" class="layui-form-label">
                <span class="x-red">*</span>运费
            </label>
            <div class="layui-input-inline" style="width: 100px">
			<input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['send_type']}}">
            </div>
			 <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单编号
            </label>
            <div class="layui-input-inline" style="width: 150px">
                <input type="text" id="o_number" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$res['o_number']}}" class="layui-input">
            </div>
        </div>
		<div class="layui-form-item layui-form-text">
              <label for="desc" class="layui-form-label">
                  <span class="x-red">*</span>商品
              </label>
              <div class="layui-input-block">
			  
                  <table class="layui-table" id="test">
				  <tr>
				    <td>序号</td>
					<td>商品名</td>
					<td>单位</td>
					<td>数量</td>
					<td>单价</td>
					
					<td>金额</td>
				  </tr>
                    <tbody>
					@foreach($product as $k=>$v)
                      <tr>
					  <td>{{$v['xulie']}}</td>
                        <td>
						{{$v['p_name']}}
							</td>
						
							<td>
							{{$v['p_unit']}}
							</td>
							<td>{{$v['num']}}</td>
							
							<td>{{$v['p_price']}}</td> 
							<td><?php echo($v['num']*$v['p_price'])?></td>
                      </tr>
                    @endforeach 
                    </tbody>
                  </table>
				
				
				
              </div>
          </div>
		  <div class="layui-form-item">
            <label for="username" class="layui-form-label" >
                <span class="x-red">*</span>订单金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="other_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['order_money']}}">
            </div>

            <label for="username" class="layui-form-label">
               优惠金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['discounts_money']}}">
			   
            </div>
			<label for="username" class="layui-form-label">
               优惠方式
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['discounts_type']}}">
			   
            </div>
			<label for="username" class="layui-form-label">
               实收金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['get_money']}}">
			   
            </div>
        </div>
        <div class="layui-form-item" id="x-city">
			 <label for="username" class="layui-form-label">
                <span class="x-red">*</span>打款金额
            </label>
            <div class="layui-input-inline" style="width: 100px">
			<input type="text" id="c_phone" name="next_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$res['put_money']}}">
            </div>
			 <label for="username" class="layui-form-label">
                <span class="x-red">*</span>支付方式
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="o_number" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="{{$res['order_mode']}}" class="layui-input">
            </div>
			 <label for="username" class="layui-form-label">
                <span class="x-red">*</span>业务
            </label>
            <div class="layui-input-inline" style="width: 100px">
                <input type="text" id="o_number" name="next_time" required="" lay-verify="required"
                       autocomplete="off" value="<?php echo $admin[$res['a_id']];?>" class="layui-input">
            </div>
        </div>

</form>
</div>
<script type="text/javascript" src="crm/js/xcity.js"></script>
<script>
    layui.use(['form','code'], function(){
        form = layui.form;
        layui.code();
        $('#x-city').xcity();
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

			var info=data.field;
			//alert(info);return false;
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
          
            $.get('order_add_do',{
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
				info:info
            },function(data){
                console.log(data);
                if(data == 1){
                    layer.alert("增加成功", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                        parent.location.reload();
                    })
                }else if(data == 2){
                    layer.alert("请勿重复提交", {icon: 6},function () {
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
	 //选择分类
	 form.on('select(cat)', function(data){
			
			var cat=$('.cat').val();
			//alert(cat);return false;
			//$(".cat").attr("id","ccat");
			
			$.get("seo_cat",{cat:cat},function(datas){
				
				$(".ass").html(datas);
				//$("#ass").attr("id","cass");
				form.render();
				
			});
			//alert(12);
			//var rid=document.getElementById("test").rowIndex
			
			
        });
	//选择商品
	  	 form.on('select(goods)', function(data){
			var goods=data.value;
			//$(".ass").attr("id","cass");
			
			$.get("seo_goods",{goods:goods},function(datas){
				
				//$("#ass").html(datas);
				//$("#ass").attr("id","cass");
				//$("#nature").html(datas);
				//$("#nature").attr("bnature");
				$(".unit").val(datas.p_unit);	
				$(".price").val(datas.p_price);
			});
			//alert(12);
			//var rid=document.getElementById("test").rowIndex
			
			
        });

	//统计价格

			
		

	  




	  $("#addgoods").on("click",function(){
			$.get("/add_goods",{},function(data){
				//修改class
				$(".num").addClass("nn").removeClass("num");
			$(".unit").addClass("uu").removeClass("unit");
			$(".price").addClass("pp").removeClass("price");
			$(".money").addClass("mm").removeClass("money");
			$(".cat").addClass("bb").removeClass("cat");
			$(".ass").addClass("cc").removeClass("ass");
				$(".layui-table").append(data);
				form.render();
			})
			
			
		})
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
<script type="text/javascript">
	   	function tomtt(){

			var total=0;
		   var num=parseFloat($(".num").val());
			var price=$(".price").val();
			total=num*price;
			//alert(total);
			$(".money").val(total);
			
			
			
		}
</script>
