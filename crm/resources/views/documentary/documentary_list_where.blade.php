@foreach($documentary_data as $v)
    <tr>
        <td>
            <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
        </td>
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
            <a title="编辑"  onclick="x_admin_show('编辑','admin-edit.html')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
            </a>
            <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
            </a>
        </td>
    </tr>
@endforeach