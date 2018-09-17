<?php

namespace App\Http\Controllers;
header("content-type:text/html;charset=utf8");
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class UserController extends CommonController
{
    //客户展示
    public  function user_list(Request $request){
        $a_id = $request->session()->get('a_id');//管理员id
        
        $start = input::get('start');//时间
        $end = input::get('end');
        $c_name = input::get('name');//客户名称
        $where = [];
        if(!empty($start)){
            $start = strtotime($start);
            $where[] = ['ctime','>',$start];
        }
        if(!empty($end)){
            $end = strtotime($end);
            $where[]=['ctime','<',$end];
        }
        if(!empty($c_name)){
            $where[]=['c_name','like','%'.$c_name.'%'];
        }
        $data = DB::table('customer')->where(['status'=>1,'a_id'=>$a_id])->where($where)->orderByRaw('ctime DESC')->paginate(5);
        foreach($data as $k=>$v){
            $ctype = DB::table('ctype')->where(['ctype_id'=>$v->ctype_id,'status'=>1])->first();
            $v->ctype_id = $ctype->ctype_name;
            $clevel = DB::table('clevel')->where(['clevel_id'=>$v->clevel_id,'status'=>1])->first();
            $v->clevel_id = $clevel->clevel_name;
            $csource = DB::table('csource')->where(['csource_id'=>$v->csource_id,'status'=>1])->first();
            $v->csource_id = $csource->csource_name;
        }
//        print_r($data);exit;
        $data1=(array)DB::table('admin')->where(['a_id'=>$a_id])->first();
       $name=$data1['a_name'];
        return view('user.user_list',['data'=>$data])->with('name',$name);
    }

    public function user_info(){
        // print_r(Input::get());
        $user_id = Input::get('c_id');
        $user_info = DB::table('customer')->where('c_id' , $user_id)->first();

        // dd($user_info);
        
        $ctype = DB::table("ctype")->where('ctype_id' , $user_info->ctype_id)->first();
        $clevel = DB::table("clevel")->where('clevel_id' , $user_info->clevel_id)->first();
        $csource = DB::table("csource")->where('csource_id' , $user_info->csource_id)->first();
        $user_info->ctime = date("Y-m-d H:i:s" , $user_info->ctime);
        $user_info->ctype_id = $ctype->ctype_name;
        $user_info->clevel_id = $clevel->clevel_name;
        $user_info->csource_id = $csource->csource_name;
        return view('user.user_info' , ['user_info'=>$user_info]);
        // dd($user_info);

    }

    public function user_archives(){
        $user_id = Input::post('user_id');
        $user_info = DB::table('customer')->where('c_id' , $user_id)->first();

        $ctype = DB::table("ctype")->where('ctype_id' , $user_info->ctype_id)->first();
        $clevel = DB::table("clevel")->where('clevel_id' , $user_info->clevel_id)->first();
        $csource = DB::table("csource")->where('csource_id' , $user_info->csource_id)->first();
        $user_info->ctime = date("Y-m-d H:i:s" , $user_info->ctime);
        $user_info->ctype_id = $ctype->ctype_name;
        $user_info->clevel_id = $clevel->clevel_name;
        $user_info->csource_id = $csource->csource_name;

        // dd($user_info);
        $str = "<tr><td align='left'>基本资料</td><td align='right'>最后更新时间：".$user_info->ctime."</td></tr>";
        $str .= "<tr><td>客户姓名：".$user_info->c_name."</td><td>联系电话：".$user_info->c_phone."</td></tr>";
        $str .= "<tr><td colspan='2'>详细地址：".$user_info->c_province.$user_info->c_city.$user_info->c_area.$user_info->address."</td></tr>";
        $str .="<tr>
                <td>备用电话：".$user_info->other_phone."</td>
                <td>网络：</td>
            </tr>
            <tr>
                <td>客户类型：".$user_info->ctype_id."</td>
                <td>客户等级：".$user_info->clevel_id."</td>
            </tr>
            <tr>
                <td>客户来源：".$user_info->csource_id."</td>
                <td>客户等级：".$user_info->c_other_connect."</td>
            </tr>
            <tr>
                <td colspan='2'>主营项目：</td>
            </tr>
            <tr>
                <td colspan='2'>备注：".$user_info->c_notes."</td>
            </tr>";
        // dd($user_info);
        return $str;
    }

    public function user_add(){
        $ctype = DB::table('ctype')->where(['status'=>1])->get();
        $clevel = DB::table('clevel')->where(['status'=>1])->get();
        $csource = DB::table('csource')->where(['status'=>1])->get();
        return view('user.user_add')->with('ctype',$ctype)->with('clevel',$clevel)->with('csource',$csource);
    }
    public function user_add_do(Request $request){
        $a_id = $request->session()->get('a_id');//管理员id
        $c_name = input::get('c_name');
        $c_phone = input::get('c_phone');
        //客户类型
        $ctype = input::get('ctype');
        //客户等级
        $clevel_id = input::get('clevel_id');
        //客户来源
        $csource_id = input::get('csource_id');
        //其他联系方式
        $c_other_connect = input::get('c_other_connect');
        //备注
        $c_notes = input::get('c_notes');
        $province = input::get('province');
        $city = input::get('city');
        $area = input::get('area');
        $other_phone = input::get('other_phone');
        $address = input::get('address');

        $arr = [
            'c_name'=>$c_name,
            'c_phone'=>$c_phone,
            'other_phone'=>$other_phone,
            'ctype_id'=>$ctype,
            'clevel_id'=>$clevel_id,
            'csource_id'=>$csource_id,
            'c_other_connect'=>$c_other_connect,
            'c_notes'=>$c_notes,
            'c_province'=>$province,
            'c_city'=>$city,
            'c_area'=>$area,
            'address'=>$address,
            'ctime'=>time(),
            'status'=>1,
            'a_id'=>$a_id
        ];
        $res = DB::table('customer')->insertGetId($arr);

        if($res){
            $arr2 = [
                'c_id'=>$res,
                'action'=>'客户添加',
                'data_table'=>'客户表',
                'a_id'=>$a_id,
                'time'=>time(),
                'status'=>1
            ];
            $result = DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //客户删除
    public function user_del(Request $request){
        $id = input::get('id');
        $a_id = $request->session()->get('a_id');
        $res = DB::table('customer')->where(['c_id'=>$id])->update(['status'=>3]);
        if($res){
            $arr2 = [
                'c_id'=>$id,
                'action'=>'客户删除',
                'data_table'=>'客户表',
                'a_id'=>$a_id,
                'time'=>time(),
                'status'=>1
            ];
            $result = DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改客户
    public function user_update(){
        $id = input::get('id');
        $data = DB::table('customer')->where(['c_id'=>$id,'status'=>1])->first();
        $ctype = DB::table('ctype')->where(['status'=>1])->get();
        $clevel = DB::table('clevel')->where(['status'=>1])->get();
        $csource = DB::table('csource')->where(['status'=>1])->get();
        return view('user.user_update')->with('data',$data)->with('ctype',$ctype)->with('clevel',$clevel)->with('csource',$csource);
    }
    public function user_update_do(Request $request){
        $id = input::get('id');
        $c_name = input::get('c_name');
        $c_phone = input::get('c_phone');
        //客户类型
        $ctype = input::get('ctype');
        //客户等级
        $clevel_id = input::get('clevel_id');
        //客户来源
        $csource_id = input::get('csource_id');
        //其他联系方式
        $c_other_connect = input::get('c_other_connect');
        //备注
        $c_notes = input::get('c_notes');
        $province = input::get('province');
        $city = input::get('city');
        $area = input::get('area');
        $address = input::get('address');
        $other_phone = input::get('other_phone');
        $a_id = $request->session()->get('a_id');
        $arr = [
            'c_name'=>$c_name,
            'c_phone'=>$c_phone,
            'ctype_id'=>$ctype,
            'clevel_id'=>$clevel_id,
            'csource_id'=>$csource_id,
            'c_other_connect'=>$c_other_connect,
            'c_notes'=>$c_notes,
            'c_province'=>$province,
            'c_city'=>$city,
            'c_area'=>$area,
            'address'=>$address,
            'other_phone'=>$other_phone,
            'ctime'=>time()
        ];
        $res = DB::table('customer')->where(['c_id'=>$id])->update($arr);
        if($res){
            $arr2 = [
                'c_id'=>$id,
                'action'=>'客户修改',
                'data_table'=>'客户表',
                'a_id'=>$a_id,
                'time'=>time(),
                'status'=>1
            ];
            $result = DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }

    //类型展示
    public function ctype(){
        $data = DB::table('ctype')->where(['status'=>1])->paginate(10);
        return view('user.ctype_list')->with('data',$data);
    }
    //类型添加
    public function ctype_add(){

        return view('user.ctype_add');
    }
    public function ctype_add_do(){
        $ctype = input::get('ctype');
        $arr=[
            'ctype_name'=>$ctype,
            'status'=>1
        ];
        $res = DB::table('ctype')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //类型删除
    public function ctype_del(){
        $id = input::get('id');
        $arr = [
            'ctype_id'=>$id
        ];
        $res = DB::table('ctype')->where($arr)->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改类型
    public function ctype_update(){
        $id = input::get('id');
        $arr = [
            'ctype_id'=>$id
        ];
        $data = DB::table('ctype')->where($arr)->where(['status'=>1])->first();
        return view('user.ctype_update')->with('data',$data);
    }
    public function ctype_update_do(){
        $id = input::get('id');
        $ctype = input::get('ctype');
        $res = DB::table('ctype')->where(['ctype_id'=>$id])->update(['ctype_name'=>$ctype]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //等级展示
    public function clevel_list(){
        $data = DB::table('clevel')->where(['status'=>1])->paginate(10);
        return view('user.clevel_list')->with('data',$data);
    }
    //添加等级
    public function clevel_add(){
        return view('user.clevel_add');
    }
    public function clevel_add_do(){
        $clevel = input::get('clevel');
        $res = DB::table('clevel')->insert(['clevel_name'=>$clevel,'status'=>1]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改等级
    public function clevel_update(){
        $id = input::get('id');
        $arr = [
            'clevel_id'=>$id,
            'status'=>1
        ];
        $data = DB::table('clevel')->where($arr)->first();
        return view('user.clevel_update')->with('data',$data);
    }
    public function clevel_update_do(){
        $id = input::get('id');
        $clevel = input::get('clevel');
        $res = DB::table('clevel')->where(['clevel_id'=>$id])->update(['clevel_name'=>$clevel]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //类型删除
    public function clevel_del(){
        $id = input::get('id');
        $arr = [
            'clevel_id'=>$id,
            'status'=>1
        ];
        $res = DB::table('clevel')->where($arr)->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //客户来源展示
    public function csource_list(){
        $data = DB::table('csource')->where(['status'=>1])->paginate(3);
        return view('user.csource_list')->with('data',$data);
    }
    //客户来源添加
    public function csource_add(){
        return view('user.csource_add');
    }
    public function csource_add_do(){
       $csource = input::get('csource');
        $res = DB::table('csource')->insert(['csource_name'=>$csource,'status'=>1]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //来源修改
    public function csource_update(){
        $id = input::get('id');
        $data = DB::table('csource')->where(['csource_id'=>$id,'status'=>1])->first();
        return view('user.csource_update')->with('data',$data);
    }
    public function csource_update_do(){
        $id = input::get('id');
        $csource = input::get('csource');
        $res = DB::table('csource')->where(['csource_id'=>$id])->update(['csource_name'=>$csource]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //来源删除
    public function csource_del(){
        $id = input::get('id');
        $arr = [
            'csource_id'=>$id,
            'status'=>1
        ];
        $res = DB::table('csource')->where($arr)->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //合同类型列表
    public function contype_list(){
        $data = DB::table('contype')->where(['status'=>1])->paginate(10);
        return view('user.contype_list')->with('data',$data);
    }
    //合同类型添加
    public function contype_add(){
        return view('user.contype_add');
    }
    public function contype_add_do(){
        $contype = input::get('contype');
        $arr = [
            'contype_name'=>$contype,
            'status'=>1
        ];
        $res = DB::table('contype')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //合同类型删除
    public function contype_del(){
        $id = input::get('id');
        $res = DB::table('contype')->where(['contype_id'=>$id])->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //合同类型修改
    public function contype_update(){
        $id = input::get('id');
        $data = DB::table('contype')->where(['contype_id'=>$id,'status'=>1])->first();
        return view('user.contype_update')->with('data',$data);
    }
    public function contype_update_do(){
        $id = input::get('id');
        $contype = input::get('contype');
        $res = DB::table('contype')->where(['contype_id'=>$id])->update(['contype_name'=>$contype]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
////共享页面  展示管理员id
//    public function share_add(Request $request){
////        $c_id = $_GET['c_id'];
//        $a_id = $request->session()->get('a_id');
//        //客户id
//        $c_id = $request->get('c_id');
//        //根据客户id 查关联表    这个客户都分享给哪些管理员
//        $arr = json_decode(DB::table('admin_share') -> where('c_id',$c_id) -> get(),true);//根据要分享的客户的id查数据
//        $data = [];
//        foreach($arr as $k => $v){
//            //把管理员id 放入  data  数组里
//            $data[] = $v['admin_id'];
//        }
//        //把当前管理员  状态  改为3   在退出时状态改为1
//        DB::table('admin')->where(['a_id'=>$a_id])->update(['a_status'=>3]);
//        //取出所有没有分享过该用户的管理员的id
//       $res = DB::table('admin') -> whereNotIn('a_id',$data) ->where(['a_status'=>1])-> get();//查询条件  管理员的id 不在$data中 即为不在已经分享的管理员的id中
//        return view('user.share_add')->with('c_id',$c_id)->with('data',$res);
//    }
///*复选框   点击获取管理员的id  便利的时候给状态  where a_id = luo u_id = zhang*/
//    /** 执行添加  共享 */
//    public function share_add_do(Request $request)
//    {
//        $c_id = $_GET['c_id'];
//        //选中的管理员 id  字符串
//        $admin_data = $_GET['admin_arr'];
//        $admin_data = rtrim($admin_data,',');
//        $admin_data = explode(',',$admin_data);
//        //获取当前管理员id
//        $a_id = $request->session()->get('a_id');
//            //这个管理员把这个客户都共享给哪些管理员
//            $data1 = DB::table('share')->where(['open_a_id' => $a_id, 'c_id' => $c_id])->first();
//            if (!empty($data1)) {
//                $data = DB::table('share')->where(['open_a_id' => $a_id, 'c_id' => $c_id])->get();
//                foreach ($data as $k => $v) {
//                    $arr[] = $v->receive_a_id;
//                }
//                foreach($admin_data as $k=>$v){
//                    if (in_array($v, $arr)) {
//                        echo '该客户已经共享给管理员';
//                        exit;
//                    } else {
//                        $insert_data = [
//                            'open_a_id' => $a_id,
//                            'receive_a_id' => $v,
//                            'c_id' => $c_id
//                        ];
//                        $array = [
//                            'admin_id'=>$v,
//                            'c_id'=>$c_id
//                        ];
//                        DB::table('admin_share')->insert($array);
//                        DB::table('admin')->where(['a_id'=>$a_id])->update(['a_status'=>1]);
//                        $res = DB::table('share')->insert($insert_data);
//                    }
//                }
//            } else {
//                foreach($admin_data as $k=>$v){
//                    $insert_data = [
//                    'open_a_id' => $a_id,
//                    'receive_a_id' => $v,
//                    'c_id' => $c_id
//                ];
//                    $array = [
//                        'admin_id'=>$v,
//                        'c_id'=>$c_id
//                    ];
//                    DB::table('admin_share')->insert($array);
//                    $res = DB::table('share')->insert($insert_data);
//                }
//            }
//            if ($res) {
//                return 1;
//            } else {
//                return 2;
//            }
//    }
//    //共享展示  我的共享
//    public function share_list(Request $request){
//        $a_id = $request->session()->get('a_id');
//        //当前管理员 分享的所有数据
//        $data = DB::table('share')
//            ->where(['open_a_id'=>$a_id])
//            ->join('customer','customer.c_id','=','share.c_id')
//            ->paginate(10);
//        foreach($data as $k=>$v){
//            $ctype = DB::table('ctype')->where(['ctype_id'=>$v->ctype_id,'status'=>1])->first();
//            $v->ctype_id = $ctype->ctype_name;
//            $clevel = DB::table('clevel')->where(['clevel_id'=>$v->clevel_id,'status'=>1])->first();
//            $v->clevel_id = $clevel->clevel_name;
//            $csource = DB::table('csource')->where(['csource_id'=>$v->csource_id,'status'=>1])->first();
//            $v->csource_id = $csource->csource_name;
//            $id = DB::table('admin')->where(['a_id'=>$v->receive_a_id])->first();
//            $v->receive_a_id = $id->a_name;
//        }
//            return view('share.share_list',['data'=>$data]);
//    }
//    //共享给我
//    public function share_list_do(Request $request){
//        $a_id = $request->session()->get('a_id');
//        $data = DB::table('share')
//            ->where(['receive_a_id'=>$a_id])
//            ->join('customer','customer.c_id','=','share.c_id')
//            ->paginate(10);
//        foreach($data as $k=>$v){
//            $ctype = DB::table('ctype')->where(['ctype_id'=>$v->ctype_id,'status'=>1])->first();
//            $v->ctype_id = $ctype->ctype_name;
//            $clevel = DB::table('clevel')->where(['clevel_id'=>$v->clevel_id,'status'=>1])->first();
//            $v->clevel_id = $clevel->clevel_name;
//            $csource = DB::table('csource')->where(['csource_id'=>$v->csource_id,'status'=>1])->first();
//            $v->csource_id = $csource->csource_name;
//            $id = DB::table('admin')->where(['a_id'=>$v->open_a_id])->first();
//            $v->open_a_id = $id->a_name;
//        }
//        return view('share.share_list_do',['data'=>$data]);
//    }
    //产品展示
    public function product_list(){
		$cat=DB::table("cat")->get();
        $data = DB::table('product')->where(['status'=>1])->orderByRaw('ctime DESC')->paginate(10);
        return view('product.product_list',["data"=>$data,"cat"=>$cat]);
    }
    //产品添加
    public function product_add(){
		$cat=DB::table("cat")->get();
        return view('product.product_add',["cat"=>$cat]);
    }

	//产品分类添加
	public function category(){
        return view('product.category');
    }
	//产品分类添加执行

	public function category_add(){
		$cat_name = input::get('p_name');
		$cate=json_decode(DB::table("cat")->where(['cat_name'=>$cat_name])->get(),true);
		//print_r($cate);
		if($cate){
			return 4;
		}

		$res=DB::table("cat")->insert(["cat_name"=>$cat_name]);
		if($res==1){

		return 1;

	}else{
		return 2;
	}
	}
    public function product_add_do(){
        $p_name = input::get('p_name');
        $p_unit = input::get('p_unit');
        $p_price = input::get('p_price');
		$cat_id=input::get("cat_id");
        $arr = [
            'p_name'=>$p_name,
            'p_unit'=>$p_unit,
            'p_price'=>$p_price,
            'ctime'=>time(),
			"cate"=>$cat_id,
            'status'=>1
        ];
        $arr1 = [
            'p_name'=>$p_name,
            'p_unit'=>$p_unit,
            'p_price'=>$p_price,
            'status'=>1
        ];
        $result = DB::table('product')->where($arr1)->first();
        if($result){
            echo '已经添加该数据了';exit;
        }
        $res = DB::table('product')->insert($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //产品删除
    public function product_del(){
        $id = input::get('id');
        $res = DB::table('product')->where(['product_id'=>$id])->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //产品修改
    public function product_update(){
        $id = input::get('id');
        $data = DB::table('product')->where(['product_id'=>$id])->first();
        return view('product.product_update')->with('data',$data);
    }
    public function product_update_do(){
        $id = input::get('id');
        $p_name = input::get('p_name');
        $p_unit = input::get('p_unit');
        $p_price = input::get('p_price');
        $arr = [
            'p_name'=>$p_name,
            'p_unit'=>$p_unit,
            'p_price'=>$p_price
        ];
        $res = DB::table('product')->where(['product_id'=>$id])->update($arr);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //扔入公海
    public function seas_add(){
        //接 客户 id
        $c_id = input::get('id');
        $res = DB::table('customer')->where(['c_id'=>$c_id])->update(['status'=>2,'ctime'=>time()]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }

    }
    //公海展示
    public function seas_list(){
        $data = DB::table('customer')->where(['status'=>2])->orderByRaw('ctime DESC')->paginate(10);
        foreach($data as $k=>$v){
            $ctype = DB::table('ctype')->where(['ctype_id'=>$v->ctype_id,'status'=>1])->first();
            $v->ctype_id = $ctype->ctype_name;
            $clevel = DB::table('clevel')->where(['clevel_id'=>$v->clevel_id,'status'=>1])->first();
            $v->clevel_id = $clevel->clevel_name;
            $csource = DB::table('csource')->where(['csource_id'=>$v->csource_id,'status'=>1])->first();
            $v->csource_id = $csource->csource_name;
        }
        return view('seas.seas_list',['data'=>$data]);
    }
    //删除公海数据
    public function seas_del(Request $request){
        $id = input::get('id');
        $a_id = $request->session()->get('a_id');
        $res = DB::table('customer')->where(['c_id'=>$id])->update(['status'=>3]);
        if($res){
            $arr2 = [
                'c_id'=>$id,
                'action'=>'公海客户删除',
                'data_table'=>'客户表',
                'a_id'=>$a_id,
                'time'=>time(),
                'status'=>1
            ];
            $result = DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改公海数据
    public function seas_update(){
        $id = input::get('id');
        $data = DB::table('customer')->where(['c_id'=>$id,'status'=>2])->first();
        $ctype = DB::table('ctype')->where(['status'=>1])->get();
        $clevel = DB::table('clevel')->where(['status'=>1])->get();
        $csource = DB::table('csource')->where(['status'=>1])->get();
        return view('seas.seas_update')->with('data',$data)->with('ctype',$ctype)->with('clevel',$clevel)->with('csource',$csource);
    }
    public function seas_update_do(Request $request){
        $id = input::get('id');
        $c_name = input::get('c_name');
        $c_phone = input::get('c_phone');
        //客户类型
        $ctype = input::get('ctype');
        //客户等级
        $clevel_id = input::get('clevel_id');
        //客户来源
        $csource_id = input::get('csource_id');
        //其他联系方式
        $c_other_connect = input::get('c_other_connect');
        //备注
        $c_notes = input::get('c_notes');
        $province = input::get('province');
        $city = input::get('city');
        $area = input::get('area');
        $address = input::get('address');
        $other_phone = input::get('other_phone');
        $a_id = $request->session()->get('a_id');
        $arr = [
            'c_name'=>$c_name,
            'c_phone'=>$c_phone,
            'ctype_id'=>$ctype,
            'clevel_id'=>$clevel_id,
            'csource_id'=>$csource_id,
            'c_other_connect'=>$c_other_connect,
            'c_notes'=>$c_notes,
            'c_province'=>$province,
            'c_city'=>$city,
            'c_area'=>$area,
            'address'=>$address,
            'other_phone'=>$other_phone,
            'ctime'=>time()
        ];
        $res = DB::table('customer')->where(['c_id'=>$id])->update($arr);
        if($res){
            $arr2 = [
                'c_id'=>$id,
                'action'=>'公海客户修改',
                'data_table'=>'客户表',
                'a_id'=>$a_id,
                'time'=>time(),
                'status'=>1
            ];
            $result = DB::table('record')->insert($arr2);
            echo 1;
        }else{
            echo 2;
        }
    }
    //操作记录展示
    public function operation_list(){
       //dump($_SERVER);exit;
        $data = DB::table('record')->where(['status'=>1])->orderByRaw('time DESC')->paginate(10);
        foreach($data as $k=>$v){
            $a_id = DB::table('admin')->where(['a_id'=>$v->a_id])->first();
            $v->a_id = $a_id->a_name;
            $c_id = DB::table('customer')->where(['c_id'=>$v->c_id])->first();
            $v->c_id = $c_id->c_name;
        }
        return view('operation.operation_list',['data'=>$data]);
    }
    
    public function user_operation(){
        //dump($_SERVER);exit;
        $user_id = Input::post('user_id');
        $data = DB::table('record')->where(['status'=>1 , 'c_id'=>$user_id])->orderByRaw('time DESC')->paginate(10);
        $str = "<tr><th>管理员名称</th><th>客户名称</th><th>操作记录</th><th>操作表名</th><th>操作时间</th></tr>";
        foreach($data as $k=>$v){
            $a_id = DB::table('admin')->where(['a_id'=>$v->a_id])->first();
            $v->a_id = $a_id->a_name;
            $c_id = DB::table('customer')->where(['c_id'=>$v->c_id])->first();
            $v->c_id = $c_id->c_name;
            $str .= "<tr><td>".$v->a_id."</td><td>".$v->c_id."</td><td>".$v->action."</td><td>".$v->data_table."</td><td>".date('Y-m-d H:i:s',$v->time)."</td></tr>";
        }
        return $str;
        // dd($data);
        //  return view('operation.operation_list',['data'=>$data]);
     }
    //登录日志展示
    public function login_log(){
        $data = DB::table('login_log')->orderByRaw('time DESC')->where(['status'=>1])->paginate(10);
        foreach($data as $k=>$v){
            $arr = DB::table('admin')->where(['a_id'=>$v->a_id])->first();
            $v->time = date('Y-m-d H:i:s',$v->time);
            $v->a_id = $arr->a_name;
        }
        //print_r($data);exit;
        return view('admin.login_log')->with('data',$data);
    }
    //删除 日志
    public function login_log_del(Request $request){
        $id = $request->get('id');
        $res = DB::table('login_log')->where(['id'=>$id])->update(['status'=>3]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //个人中心
    public function personal(Request $request){
        $a_id = $request->session()->get('a_id');
        $admin_arr = DB::table('admin')->where(['a_id'=>$a_id])->first();
        $role = DB::table('role')->where(['role_id'=>$admin_arr->role_id])->first();
       // print_r($role);exit;
        $admin_arr->role_id = $role->r_name;
        return view('user.personal')->with('data',$admin_arr);
    }
    //修改 个人信息
    public function personal_update(Request $request){
        $id = $request->get('id');
        $res = DB::table('admin')->where(['a_id'=>$id])->first();
        $role = DB::table('role')->get();
        return view('user.personal_update')->with('res',$res)->with('role',$role);
    }
    public function admin_update_do(){
        $data = $_GET;
//        print_r($data);exit;
        $update_data = [
            'a_account' => $data['a_account'],
            'role_id' => $data['role_id'],
            'a_phone' => $data['a_phone'],
            'a_name' => $data['a_name'],
            'a_email' => $data['a_email'],
            'a_pwd' => $data['a_pwd'],
            'a_address' => $data['a_address'],
        ];
        $res = DB::table('admin')->where(['a_id'=>$data['a_id']])->update($update_data);
//        print_r($res);exit;
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
//swz查商品
	public function sel_cat(){
		$sel_cat=$_GET['cat'];
		
        $data = DB::table('product')->where(['cate'=>$sel_cat])->orderByRaw('ctime DESC')->get();
        return view('product.product_seo',["data"=>$data]);
	}
//swz查商品
	 public function seo_cat(){
		$sel_cat=$_GET['cat'];
		
        $data = DB::table('product')->where(['cate'=>$sel_cat])->orderByRaw('ctime DESC')->get();
        return view('product.product_sel',["data"=>$data]);
	}
//swa增加商品
	public function add_goods(){
		$cat=DB::table("cat")->get();
		return view("product.add_goods",["cat"=>$cat]);
	}

//swz查商品
	public function seo_goods(){
		$goods=$_GET['goods'];
		$info=(array)DB::table('product')->where(["product_id"=>$goods])->first();
		return $info;
	}

}



