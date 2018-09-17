<style>
.ulstyle ul li {
    float: left;
    cursor: pointer;
    text-align: center;
    padding: 0;
    background-image: url(../images/repeat.gif);
    background-repeat: no-repeat;
    background-position: left -155px;
    height: 30px;
    line-height: 30px;
}

a{ text-decoration:none;}
a:hover{ text-decoration:underline;text-decoration: none;color:#000}
.ulstyle ul li{
    width:10%;
    height:30px;
    border:1px;
    background:#fff;
    border:1px solid #e6e6e6;

}
.ulstyle ul li span a{
    color:#000;
}

#active{
    background-color: #e6e6e6;
}
.ulstyle ul li:hover{
    background:#e6e6e6;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.tr_t {
    background-color: #336699;
    border-bottom: 1px solid #afc0c9;
    height: 35px;
    line-height: 35px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
}
.td_l_l {
    text-align: left;
    border-right: 1px solid #ccc;
    border-top: 1px solid #ccc;
    line-height: 35px;
    line-height: 20px\0;
    height: 35px;
    padding-left: 10px;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
    height:40px;
}
</style>
<link rel="stylesheet" href="/crm/lib/layui/css/layui.css">
<div style="width:100%;height:500px;">
    <hr />
    <div style="height:25px; margin-top:10px;margin-left:14px;">
        客户名称：<span>{{$user_info->c_name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        电话：<span>{{$user_info->c_phone}}</span>
    </div>
    <hr />
    <div class="ulstyle" style="margin: 10px 10px 10px 25px; height:20px;width:100%;">
        <ul style="margin: 0;padding: 0px;padding-left: 10px;list-style:none;">
            <li onclick="user_archives(this,{{$user_info->c_id}})"><span><a href="javascript:;">客户档案</a></span></li>
            <li onclick="gendan(this,{{$user_info->c_id}})"><span><a href="javascript:;">跟单记录</a></span></li>
            <li onclick="dingdan(this,{{$user_info->c_id}})"><span><a href="javascript:;" >订单记录</a></span></li>
            <li onclick="hetong(this,{{$user_info->c_id}})"><span><a href="javascript:;" >合同记录</a></span></li>
            <li onclick="fujia(this,{{$user_info->c_id}})"><span><a href="javascript:;">附加记录</a></span></li>
            <li onclick="operation(this,{{$user_info->c_id}})"><span><a href="javascript:;">操作记录</a></span></li>
        </ul>
    </div>
    @csrf
    <br>
    <table class="layui-table" border="1" width="800px" align="center">
        <tbody id="tbody">
            <tr>
                <td >基本资料</td>
                <td align="right">最后更新时间：{{$user_info->ctime}}</td>
            </tr>
            <tr>
                <td>客户姓名：{{$user_info->c_name}}</td>
                <td>联系电话：{{$user_info->c_phone}}</td>
            </tr>
            <tr>
                <td colspan="2">详细地址：{{$user_info->c_province}}{{$user_info->c_city}}{{$user_info->c_area}}{{$user_info->address}}</td>
            </tr>
            <tr>
                <td>备用电话：{{$user_info->other_phone}}</td>
                <td>网络：</td>
            </tr>
            <tr>
                <td>客户类型：{{$user_info->ctype_id}}</td>
                <td>客户等级：{{$user_info->clevel_id}}</td>
            </tr>
            <tr>
                <td>客户来源：{{$user_info->csource_id}}</td>
                <td>客户等级：{{$user_info->c_other_connect}}</td>
            </tr>
            <tr>
                <td colspan="2">主营项目：</td>
            </tr>
            <tr>
                <td colspan="2">备注：{{$user_info->c_notes}}</td>
            </tr>
        </tbody>
    </table>
</div>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
    var token = $("input[name=_token]").val();
    function user_archives(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_archives",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);
            }
        });
    }

    function gendan(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_documentary",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);

                $('#tbody').append("<a href=\"/documentary_add\" class=\"layui-btn\">添加</a>");
            }
        });
    }
    function dingdan(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_order",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);
            }
        })
    }

    function hetong(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_contract",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);
                // $(obj).css('background' , '#e9f0f1');
            }
        })
    }

    function operation(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_operation",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);
            }
        })
    }

    function fujia(obj,user_id){
        $.ajax({
            type:"post",
            url:"user_advince",
            data:{
                _token:token,
                user_id:user_id,
            },
            async:false,
            cache:false,
            success:function (data){
                $("#tbody").html(data);
            }
        })
    }

    $('li').click(function(){
        $('li').each(function(k){
            $(this).attr('id',null);
        });
        $(this).attr('id','active');
    });

    // user_archives({{$user_info->c_id}});
</script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>

<script>


    function gendan_del(obj,id){
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

</script>
