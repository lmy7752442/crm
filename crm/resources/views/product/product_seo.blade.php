
        @foreach($data as $v)
            <tr>
                {{--<td>--}}
                    {{--<div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>--}}
                {{--</td>--}}
                <td>{{$v->p_name}}</td>
                <td>{{$v->p_unit}}</td>
                <td>{{$v->p_price}}</td>
                <td><?php echo date('Y-m-d H:i:s',$v->ctime); ?></td>
                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','product_update?id={{$v->product_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{$v->product_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
    