<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogAddProController extends Controller
{
    public function insert(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $centerid_fill = $request->centerid;
           

           
	
            return response(['status'=>200,'msg'=>['Success'],'data'=>$ltype_option]);    
      
        }



        
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }





	
}
   
