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
        <link rel="stylesheet" href="http://www.jq22.com/demo/jquerylayuijishiben201806010057/layui/css/layui.css">
        <link rel="stylesheet" href="http://www.jq22.com/demo/jquerylayuijishiben201806010057/css/date.css">
        <script type="text/javascript" src="crm/js/jquery-3.3.1.min.js"></script>
        <script src="crm/lib/layui/layui.js" charset="utf-8"></script>
</head>
<body>
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{$admin_data->a_account}}</span>！当前时间:<?php echo date('Y-m-d H:i:s',$time);?></blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>客户数量</h3>
                                            <p>
                                                <cite>{{$user_count}}</cite></p>

                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>跟单数量</h3>
                                            <p>
                                                <cite>{{$documentary_count}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>订单数量</h3>
                                            <p>
                                                <cite>{{$order_count}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>销量</h3>
                                            <p>
                                                <cite>{{$sales}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>删除数量</h3>
                                            <p>
                                                <cite>{{$del_count}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>修改数量</h3>
                                            <p>
                                                <cite>{{$save_count}}</cite></p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>内部公告</legend>
        <div class="layui-field-box">
            <table class="layui-table" lay-skin="line">
                <tbody>
                @foreach($notice_data as $v)
                <tr>
                    <td >
                        <a class="x-a" target="_blank">{{$v->content}}</a>
                    </td>
                    <td style='float:right;'>
                        公告更新时间:<?php echo date('Y-m-d H:i:s',$v->time);?>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </fieldset>
     <fieldset class="layui-elem-field">
            <legend>跟单提醒</legend>
            <div class="layui-field-box">
                <table class="layui-table" lay-skin="line">
                    <tbody>
                    @foreach($user_data as $v)
                    <tr>
                        <td >
                            您的客户<a class="x-a" target="_blank" style="color:red">{{$v->c_name}}</a>距离您上次设置的跟单时间已不足一天请及时跟进
                        </td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </fieldset>
    <div class="layui-container" style="padding: 15px;">
        <div class="layui-row">
            <div class="layui-col-md12">

                <div class="layui-inline" id="test-n2"></div>
            </div>
        </div>
    </div>
    <script>


        layui.use(['layer', 'form','jquery','laydate'], function() {
            var layer = layui.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                form = layui.form;




            //定义json
            var  data={};
            var  dataArr = [];
            var new_date = new Date();
            loding_date(new_date ,data);


            //日历插件调用方法
            function loding_date(date_value,data){

                laydate.render({
                    elem: '#test-n2'
                    ,type: 'date'
                    ,theme: 'grid'
                    ,max: '2099-06-16 23:59:59'
                    ,position: 'static'
                    ,range: false
                    ,value:date_value
                    ,isInitValue: false
                    ,calendar: true
                    ,btns:false
                    ,ready: function(value){
                        //console.log(value);
                        hide_mr(value);
                    }
                    ,done: function(value, date, endDate){
                        //console.log(value); //得到日期生成的值，如：2017-08-18
                        // console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
                        //console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
                        //layer.msg(value)

                        //调用弹出层方法
                        date_chose(value,data);
                    }
                    ,change:function(value,date){
                        hide_mr(date);
                    }
                    , mark:data//重要json！

                });
            }


            function hide_mr(value){
                var mm = value.year+'-'+value.month+'-'+value.date;

                $('.laydate-theme-grid table tbody').find('[lay-ymd="'+mm+'"]').removeClass('layer-this');
                //console.log(value)
            }


            //获取隐藏的弹出层内容
            var date_choebox = $('.date_box').html();

            //定义弹出层方法
            function date_chose(obj_date,data){
                var index = layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    title:'添加记录',
                    area: ['400px', 'auto'], //宽高
                    btn:['确定','撤销','取消'],
                    content: '<div class="text_box">'+
                    '<form class="layui-form" action="">'+
                    '<div class="layui-form-item layui-form-text">'+
                    ' <textarea id="text_book" placeholder="请输入内容"  class="layui-textarea"></textarea>'+
                    '</div>'+
                    '</form>'+
                    '</div>'
                    ,success:function(){
                        $('#text_book').val(data[obj_date])
                    }
                    ,yes:function (){
                        //调用添加/编辑标注方法
                        if($('#text_book').val()!=''){
                            chose_moban(obj_date,data);
                            layer.close(index);
                        }else{
                            layer.msg('不能为空', {icon: 2});
                        }

                    },btn2:function (){
                        chexiao(obj_date,data);
                    }
                });
            }





            //定义添加/编辑标注方法
            function chose_moban(obj_date,markJson){
                //获取弹出层val
                var chose_moban_val = $('#text_book').val();

                $('#test-n2').html('');//重要！由于插件是嵌套指定容器，再次调用前需要清空原日历控件
                //添加属性
                markJson[obj_date] = chose_moban_val;

                data = {
                    time:obj_date,
                    value:chose_moban_val
                }


                //添加修改数值
                for (var i in dataArr) {
                    if(dataArr[i].time==obj_date){
                        dataArr[i].value = chose_moban_val;
                        dataArr.splice(i, 1);
                    }
                }
                dataArr.push(data);

                //按时间正序排序

                dataArr.sort(function(a,b){
                    return Date.parse(a.time) - Date.parse(b.time);//时间正序
                });


                //按时间倒序排列
    //				dataArr.sort(function(a,b){
    //					return Date.parse(b.time) - Date.parse(a.time);//时间正序
    //				});



                //console.log(JSON.stringify(data))
                // console.log(JSON.stringify(markJson));
                console.log(JSON.stringify(dataArr))
                //再次调用日历控件，
                loding_date(obj_date,markJson);//重要！，再标注一个日期后会刷新当前日期变为初始值，所以必须调用当前选定日期。

            }


            //撤销选择
            function chexiao(obj_date,markJson){
                //删除指定日期标注
                delete markJson[obj_date];
                //console.log(JSON.stringify(markJson));
                for (var i in dataArr) {
                    if(dataArr[i].time==obj_date){
                        dataArr.splice(i, 1);
                    }
                }

                console.log(JSON.stringify(dataArr))
                //原理同添加一致
                $('#test-n2').html('');
                loding_date(obj_date,markJson);

            }





        });</script>
</div>
<script>
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