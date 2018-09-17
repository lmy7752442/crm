  <select name="pname[]" lay-filter="goods">
					
                    <option>请选择</option>
					@foreach($data as $k=>$v)
					<option value="{{$v->product_id}}">{{$v->p_name}}</option>
					@endforeach
                </select>