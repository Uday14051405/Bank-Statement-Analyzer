<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogInsertPreController extends Controller
{
    public function search_ltype(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $centerid_fill = $request->centerid;
            $data_arr = array();
            $l_employee = DB::select("SELECT id FROM lead_create_multi WHERE ltype IN('Site Visits - Done','Revisit - 1','Revisit - 2','Revisit - 3') AND lead_id = ".$lead_id." AND mul_proid = ".$mul_proid."");
        
            if(count($l_employee) > 0 )
            {
                $ltype_option = array(
                    #'' => 'Select Followup Status',
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Revisit - 1' => 'Revisit - 1',
                    'Revisit - 2' => 'Revisit - 2',
                    'Revisit - 3' => 'Revisit - 3'
                    );
               
            }
            else
            {
               
                $ltype_option = array(
                   # '' => 'Select Followup Status',
                    'In Followu' => 'In Followu',
                    'Site Visits - Prospect' => 'Site Visits - Prospect',
                    'Site Visit Schedule' => 'Site Visit Schedule',
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Virtual Site Visits - Done' => 'Virtual Site Visits - Done',
                    'Ringing' => 'Ringing',
                    'Invalid Number' => 'Invalid Number',
                    'Out Of Network' => 'Out Of Network',
                    'Lost' => 'Lost'
                    );
            }

           
	
            return response(['status'=>200,'msg'=>['Success'],'data'=>$ltype_option]);    
      
        }
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }


    public function search_ctype(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $ltype = $request->ltype;
            $centerid_fill = $request->centerid;
            $data_arr = array();
            $l_employee = DB::select("SELECT ctype FROM lead_create_multi WHERE ctype IN('Sale') AND lead_id = ".$lead_id." AND mul_proid = ".$mul_proid."");
        
            if(count($l_employee) > 0 )
            {
                $ltype_option = array(
                   # '' => 'Select Status',
                    'Sale' => 'Sale'
                    );
               
            }
            else
            {
                if($ltype == 'Lost' )
                {
                   // echo 'hello2';
                   
                    $ltype_option = array(
                       # '' => 'Select Status',
                        'Lost' => 'Lost'
                        );
                }
                else {
                    $ltype_option = array(
                       # '' => 'Select Status',
                        'Sale' => 'Sale',
                        'Interested' => 'Interested',
                        'Hot' => 'Hot',
                        'Warm' => 'Warm',
                        'Cold' => 'Cold',
                        'Lost' => 'Lost'
                        );
               }
              
            }

        return response(['status'=>200,'msg'=>['Success'],'data'=>$ltype_option]);    
      
        }
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }




	
}
   
