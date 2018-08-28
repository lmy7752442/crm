<<<<<<< HEAD
<?php
$str = "/login
/login_do
/login_out
/admin_add
/admin_add_do
/admin_list
/admin_update
/admin_update_do
/admin_del
/advince_add
/advince_add_do
/advince_list
/advince_del
/department_add
/department_add_do
/department_list
/department_update
/department_update_do
/department_del
/role_add
/role_add_do
/role_list
/role_update
/role_update_do
/role_del
/power_add
/power_add_do
/power_list
/power_update
/power_update_do
/power_del
/welcome
/documentary_add
/documentary_add_do
/documentary_del
/documentary_save
/documentary_save_do
/documentary_list
/documentary_dtype_list
/documentary_dtype_add
/documentary_dtype_add_do
/documentary_dtype_del
/documentary_dtype_save
/documentary_dtype_save_do
/documentary_dprogress_list
/documentary_dprogress_add
/documentary_dprogress_add_do
/documentary_dprogress_del
/documentary_dprogress_save
/documentary_dprogress_save_do
/order_list
/order_user
/order_add
/order_add_do
/order_mode_list
/order_mode_add
/order_mode_add_do
/order_mode_save
/order_mode_save_do
/order_mode_del
/user_list
/user_add
/user_add_do
/user_del
/user_update
/user_update_do
/ctype_list
/ctype_add
/ctype_add_do
/ctype_del
/ctype_update
/ctype_update_do
/clevel_list
/clevel_add
/clevel_add_do
/clevel_update
/clevel_update_do
/clevel_del
/csource_list
/csource_add
/csource_add_do
/csource_update
/csource_update_do
/csource_del
/contype_list
/contype_add
/contype_add_do
/contype_del
/contype_update
/contype_update_do
/product_list
/product_add
/product_add_do
/product_update
/product_update_do
/product_del
/contract_list
/contract_add
/contract_add_do
/contract_del
/contract_update
/contract_update_do
/seek
/share_add
/share_add_do
/count";

$arr = explode("\r\n",$str);
$val = "(";
foreach($arr as $v){
    $val .= "('{$v}'),";
}
$val .= ")";
echo $val;

//print_r($arr);
=======

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>基于layui的日历记事本</title>
    <link rel="stylesheet" href="http://www.jq22.com/demo/jquerylayuijishiben201806010057/layui/css/layui.css">
    <link rel="stylesheet" href="http://www.jq22.com/demo/jquerylayuijishiben201806010057/css/date.css">
    <script type="text/javascript" src="crm/js/jquery-3.3.1.min.js"></script>
    <script src="crm/lib/layui/layui.js" charset="utf-8"></script>
</head>
<body>

<div class="layui-container" style="padding: 15px;">
    <div class="layui-row">
        <div class="layui-col-md12">
            <blockquote class="layui-elem-quote">基于layui的日历记事本</blockquote>
            <div class="layui-inline" id="test-n2"></div>
        </div>
    </div>
</div>
<script src="layui/layui.js"></script>
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

            $('.laydate-theme-grid table tbody').find('[lay-ymd="'+mm+'"]').removeClass('layui-this');
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
</body>
</html>
>>>>>>> e5c8dc76090908313b29da1f2b326b289ccd0ea4
