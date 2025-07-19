<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PreLeadController extends Controller
{
    public function index(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){
          
		  
		  
		  
           return response(['status'=>200,'msg'=>['Dashboard Success'],'data'=>$arr]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
   
}
