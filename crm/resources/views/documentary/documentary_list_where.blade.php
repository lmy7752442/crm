<table class="layui-table">
    <thead id="aaa">
    <tr>
        <th>
            <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
        </th>
        <th>编号</th>
        <th>客户名称</th>
        <th>跟单类型</th>
        <th>跟单进度</th>
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
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td><?php echo $num=$num+1;?></td>
            <td>{{$v->c_id}}</td>
            <td>{{$v->dtype_id}}</td>
            <td>{{$v->dprogress_id}}</td>
            <td>{{$v->d_nexttime}}</td>
            <td>{{$v->d_detailed}}</td>
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
    {{ $documentary_data->links() }}
</div>