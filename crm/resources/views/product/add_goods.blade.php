 <tr>
                        <td>
							<div class="layui-form-item" id="x-city">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>商品名
            </label>
            <div class="layui-input-inline" style="width: 120px">
                <select  name="province" lay-filter="cat" class="cat">
					<option value="">商品分类</option>	
					@foreach($cat as $k=>$v)
                    <option  value="{{$v->cat_id}}">{{$v->cat_name}}</option>	
					@endforeach
                </select>
            </div>
            <div class="layui-input-inline ass" style="width: 120px" class="ass">
                <select name="pname[]" lay-filter="city">
					
                    <option>商品名</option>
					
                </select>
            </div>
           
        </div>
						</div></td>
                       <td>
								<!-- <input type="button" value="-" class="jian" style="backgrount-color:green;width:20px;height:20px;">
								<em >0</em>
								
								<input type="button" value="+" class="jia" style="backgrount-color:green;width:20px;height:20px;"> -->
								<input type="number" style="width:60px;height:20px;" name="num[]" class="num" onclick="tomtt()"/>
								<input type="text" style="width:30px;height:20px;" name="unit[]" placeholder="单位" class="unit"/>
							</td>
							<td><input type="text" style="width:60px;height:20px;" name="price[]" class="price"/></td>
							
							<td><input type="text" style="width:60px;height:20px;" name="money[]" class="money"/></td>
                      </tr>
