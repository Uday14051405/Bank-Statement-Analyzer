<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProjectListController extends Controller
{
    public function index(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'ibpid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
  
        if($user == 1)
		{
			$data = DB::table('products')->where(['status'=>'Y'])->get(['id','category','name','pro_name'])->toArray();
			$resultArray = json_decode(json_encode($data), true);
  	foreach($resultArray as $key=>$val)
			{
				$categoryname = DB::table('category')->where(['status'=>'Y','id'=>$val['category']])->pluck('name')->toArray();
				$val['categoryname'] = (count($categoryname) > 0 ) ? $categoryname[0]:'';
				$data_arr[] = $val;
			}
				return response(['status'=>200,'msg'=>['Project List Success'],'count'=>count($resultArray),'data'=>$data_arr]);    
        }
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }



	
	
}
   
