<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogInsertPreController extends Controller
{
    public function search_ltype(Request $request){
     
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if($user == 1)
		{
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $centerid_fill = $request->id;
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
     
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if($user == 1)
		{
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $ltype = $request->ltype;
            $centerid_fill = $request->id;
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
                       'Booked' => 'Booked',
                        'Hot' => 'Hot',
                        'Warm' => 'Warm',
                        'Cold' => 'Cold',
                        'EOI' => 'EOI',
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

    public function search_ltypenew(Request $request){
    $user = DB::connection('mysql_second')->table('register')->where(['username'=>$request->username,'id'=>$request->id, 'usertype'=>$request->usertype, 'token' => $request->token])->count();
    if ($user == 1) {
        $mul_proid = $request->mul_proid;
        $lead_id = $request->lead_id;
        $centerid_fill = $request->centerid;
        $data_arr = array();
      //  $l_employee = DB::select("SELECT id FROM npb_lead_create_multi WHERE ltype IN('Site Visits - Done','Revisit - 1','Revisit - 2','Revisit - 3') AND lead_id = " . $lead_id . " AND mul_proid = " . $mul_proid . "");

        $l_employee = DB::connection('mysql_second')->table('npb_lead_create_multi')->select('id', 'ltype')->where(['lead_id' => $lead_id, 'mul_proid' => $mul_proid])->first();

           if (isset($l_employee) && !empty($l_employee)) {    


            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Site Visits - Done' || $l_employee->ltype == 'Revisit - 1 Proposed') {
                $ltype_option = array(
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Revisit - 1 Proposed' => 'Revisit - 1 Proposed',
                    'Revisit - 1' => 'Revisit - 1',
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 1' || $l_employee->ltype == 'Revisit - 2 Proposed') {
                $ltype_option = array(
                    'Revisit - 1' => 'Revisit - 1',
                    'Revisit - 2 Proposed' => 'Revisit - 2 Proposed',
                    'Revisit - 2' => 'Revisit - 2'
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 2' || $l_employee->ltype == 'Revisit - 3 Proposed') {
                $ltype_option = array(
                    'Revisit - 2' => 'Revisit - 2',
                    'Revisit - 3 Proposed' => 'Revisit - 3 Proposed',
                    'Revisit - 3' => 'Revisit - 3'
                    // 'Lost' => 'Lost'
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 3' || $l_employee->ltype == 'Revisit - 4 Proposed') {
                $ltype_option = array(
                    'Revisit - 3' => 'Revisit - 3',
                    'Revisit - 4 Proposed' => 'Revisit - 4 Proposed',
                    'Revisit - 4' => 'Revisit - 4'
                    // 'Lost' => 'Lost'
                );
            }
            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 4' || $l_employee->ltype == 'Revisit - 5 Proposed') {
                $ltype_option = array(
                    'Revisit - 4' => 'Revisit - 4',
                    'Revisit - 5 Proposed' => 'Revisit - 5 Proposed',
                    'Revisit - 5' => 'Revisit - 5',
                    'Lost' => 'Lost'
                );
            }


        } else {

            $ltype_option = array(     

                    'In Followup' => 'In Followup',
                    'Site Visit Schedule' => 'Site Visit Schedule',
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Revisit - 1 Proposed' => 'Revisit - 1 Proposed',
                    'Revisit - 1' => 'Revisit - 1',
                    'Revisit - 2 Proposed' => 'Revisit - 2 Proposed',
                    'Revisit - 2' => 'Revisit - 2',
                    'Revisit - 3 Proposed' => 'Revisit - 3 Proposed',
                    'Revisit - 3' => 'Revisit - 3',
                    'Revisit - 4 Proposed' => 'Revisit - 4 Proposed',
                    'Revisit - 4' => 'Revisit - 4',
                    'Revisit - 5 Proposed' => 'Revisit - 5 Proposed',
                    'Revisit - 5' => 'Revisit - 5',             
                    'Lost' => 'Lost'
            );
        }


        return response(['status' => 200, 'msg' => ['Success'], 'data' => $ltype_option]);
    } else {
        return response(['status' => 404, 'msg' => ['User not login']]);
    }
}



// New API for My Lead Box In Dashboard
public function search_npbltype(Request $request){
    $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    if ($user == 1) {
        $project_society_name = $request->project_society_name;
        $lead_id = $request->lead_id;
        $centerid_fill = $request->centerid;
        $data_arr = array();
      //  $l_employee = DB::select("SELECT id FROM npb_lead_create_multi WHERE ltype IN('Site Visits - Done','Revisit - 1','Revisit - 2','Revisit - 3') AND lead_id = " . $lead_id . " AND mul_proid = " . $mul_proid . "");

        $l_employee = DB::connection('mysql_second')->table('npb_lead_create_multi')->select('id', 'ltype')->where(['lead_id' => $lead_id, 'project_society_name' => $project_society_name])->first();
        $ltype_option='';
        // print_r($l_employee->ltype);
           if (isset($l_employee) && !empty($l_employee)) {    


            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'In Followup' || $l_employee->ltype == 'Site Visit Schedule') {
                $ltype_option = array(
                    'In Followup' => 'In Followup',
                    'Site Visit Schedule' => 'Site Visit Schedule',
                    'Site Visits - Done' => 'Site Visits - Done',
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Site Visits - Done' || $l_employee->ltype == 'Revisit - 1 Proposed') {
                $ltype_option = array(
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Revisit - 1 Proposed' => 'Revisit - 1 Proposed',
                    'Revisit - 1' => 'Revisit - 1',
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 1' || $l_employee->ltype == 'Revisit - 2 Proposed') {
                $ltype_option = array(
                    'Revisit - 1' => 'Revisit - 1',
                    'Revisit - 2 Proposed' => 'Revisit - 2 Proposed',
                    'Revisit - 2' => 'Revisit - 2'
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 2' || $l_employee->ltype == 'Revisit - 3 Proposed') {
                $ltype_option = array(
                    'Revisit - 2' => 'Revisit - 2',
                    'Revisit - 3 Proposed' => 'Revisit - 3 Proposed',
                    'Revisit - 3' => 'Revisit - 3'
                    // 'Lost' => 'Lost'
                );
            }

            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 3' || $l_employee->ltype == 'Revisit - 4 Proposed') {
                $ltype_option = array(
                    'Revisit - 3' => 'Revisit - 3',
                    'Revisit - 4 Proposed' => 'Revisit - 4 Proposed',
                    'Revisit - 4' => 'Revisit - 4'
                    // 'Lost' => 'Lost'
                );
            }
            if (isset($l_employee->ltype) && !empty($l_employee->ltype) && $l_employee->ltype == 'Revisit - 4' || $l_employee->ltype == 'Revisit - 5 Proposed') {
                $ltype_option = array(
                    'Revisit - 4' => 'Revisit - 4',
                    'Revisit - 5 Proposed' => 'Revisit - 5 Proposed',
                    'Revisit - 5' => 'Revisit - 5',
                    'Lost' => 'Lost'
                );
            }
            if (empty($l_employee->ltype) && $l_employee->ltype == '') {
                  
                $ltype_option = array( 
                    'In Followup' => 'In Followup',
                       'Site Visit Schedule' => 'Site Visit Schedule',
                       'Site Visits - Done' => 'Site Visits - Done',
                
               );
            }

        } else {
            // print_r('hello');

            $ltype_option = array( 
                 'In Followup' => 'In Followup',
                    'Site Visit Schedule' => 'Site Visit Schedule',
                    'Site Visits - Done' => 'Site Visits - Done',
                    'Revisit - 1 Proposed' => 'Revisit - 1 Proposed',
                    'Revisit - 1' => 'Revisit - 1',
                    'Revisit - 2 Proposed' => 'Revisit - 2 Proposed',
                    'Revisit - 2' => 'Revisit - 2',
                    'Revisit - 3 Proposed' => 'Revisit - 3 Proposed',
                    'Revisit - 3' => 'Revisit - 3',
                    'Revisit - 4 Proposed' => 'Revisit - 4 Proposed',
                    'Revisit - 4' => 'Revisit - 4',
                    'Revisit - 5 Proposed' => 'Revisit - 5 Proposed',
                    'Revisit - 5' => 'Revisit - 5',             
                    'Lost' => 'Lost'
            );
        }


        return response(['status' => 200, 'msg' => ['Success'], 'data' => $ltype_option]);
    } else {
        return response(['status' => 404, 'msg' => ['User not login']]);
    }
}




public function search_npbctype(Request $request){
     
    $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    if($user == 1)
    {
        $project_society_name = $request->project_society_name;
        $lead_id = $request->lead_id;
         $ltype = $request->ltype;
        $centerid_fill = $request->centerid;
        $data_arr = array();
        $l_employee = DB::select("SELECT ctype FROM npb_lead_create_multi WHERE ctype IN('Booked') AND lead_id = ".$lead_id." AND project_society_name = '".$project_society_name."'");
    
        if(count($l_employee) > 0 )
        {
            $ltype_option = array(
               # '' => 'Select Status',
                'Booked' => 'Booked'
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
           
                    'Hot' => 'Hot',
                    'Warm' => 'Warm',
                    'Cold' => 'Cold',
                    'Booked' => 'Booked',
                    'EOI' => 'EOI',
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
   
