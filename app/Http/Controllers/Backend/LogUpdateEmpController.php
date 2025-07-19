<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogUpdateEmpController extends Controller
{
    public function update_dst(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'centerid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
            $pre_property_dst = $request->project_id;
            $lead_no_dst = $request->lead_id;
            $row_lead_id = $request->lead_id;
            $l_employee_dst = $request->emp_dst;
            $centerid = $request->emp_dst;
            $centerid_fill = $request->centerid;

            $res_pro = DB::table('products')->where(['id'=>$pre_property_dst])->first(['id','mul_procode','pro_name']);
            $res_pro_ = json_decode(json_encode($res_pro),True);
            $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
            $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] :0);
            $l_prodt = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] :0);

            $res_user = DB::table('user')->where(['centerid'=>$centerid,'type'=>'c'])->first(['id','user_name']);
            $res_user_ = json_decode(json_encode($res_user),True);
            $sm_user = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
            $user_name = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
            
            $res_user1 = DB::table('user')->where(['centerid'=>$centerid_fill,'type'=>'c'])->first(['id','user_name']);
            $res_user1_ = json_decode(json_encode($res_user1),True);
            $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            #dd($res_user1_);
            $res_headcenter = DB::table('headcenter')->where(['id'=>$l_employee_dst])->first(['role']);
            $res_headcenter1_ = json_decode(json_encode($res_headcenter),True);
            $role = (isset($res_headcenter1_['role']) ? $res_headcenter1_['role'] :0);
            
            if($role == 'DST')
            {
                $centeridaa = $centerid_fill;
                $centerid_dst = $centerid;
                #$centerid = $sm;
                $centerid = '';
                $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated OR Updated.';
            }
            else
            {
                $centerid_dst = '';
                $centerid = $centerid;
                $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated OR Updated.';
            }
            
            if($role == 'DST')
	{

        $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype)SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid_dst', admin_id, rece_id, cp_id,'$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."' ORDER BY id DESC  limit 1");
		

	}
	else
	{
        $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype) 
        SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid', admin_id, rece_id, '$ibpid','$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'    ORDER BY id DESC  limit 1");
	}

    $date12 = date('Y-m-d H:i:s');
    $lead_update = DB::update("update lead_create set r_employee = '".$centerid_dst."' where id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");

    $leadmulti_update = DB::update("update lead_create_multi set r_employee = '".$centerid_dst."',mul_dst = '".$centerid_dst."',l_pc_multi = '".$date12."' where lead_id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");


		if($leadmulti_update)
        {
            return response(['status'=>200,'msg'=>['Update Success']]);    
        }
        else
        {
            return response(['status'=>404,'msg'=>['Something Wrong']]);
        }  
        }
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }


////Started CPSM
public function update_sm(Request $request){
     
    $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
    if($user == 1)
    {
        $pre_property_dst = $request->project_id;
        $lead_no_dst = $request->lead_id;
        $row_lead_id = $request->lead_id;
        $l_employee_dst = $request->emp_dst;
        $centerid = $request->emp_dst;
        $centerid_fill = $request->centerid;

        $res_pro = DB::table('products')->where(['id'=>$pre_property_dst])->first(['id','mul_procode','pro_name']);
        $res_pro_ = json_decode(json_encode($res_pro),True);
        $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
        $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] :0);
        $l_prodt = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] :0);

        $res_user = DB::table('user')->where(['centerid'=>$centerid,'type'=>'c'])->first(['id','user_name']);
        $res_user_ = json_decode(json_encode($res_user),True);
        $sm_user = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
        $user_name = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
        
        $res_user1 = DB::table('user')->where(['centerid'=>$centerid_fill,'type'=>'c'])->first(['id','user_name']);
        $res_user1_ = json_decode(json_encode($res_user1),True);
        $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
        $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
        $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
        #dd($res_user1_);
        $res_headcenter = DB::table('headcenter')->where(['id'=>$l_employee_dst])->first(['role']);
        $res_headcenter1_ = json_decode(json_encode($res_headcenter),True);
        $role = (isset($res_headcenter1_['role']) ? $res_headcenter1_['role'] :0);
        
        if($role == 'DST')
        {
            $centeridaa = $centerid_fill;
            $centerid_dst = $centerid;
            #$centerid = $sm;
            $centerid = '';
            $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated OR Updated.';
        }
        else
        {
            $centerid_dst = '';
            $centerid = $centerid;
            $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated OR Updated.';
        }
        
        if($role == 'DST')
{

    $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype) 
    SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid_dst', admin_id, rece_id, cp_id,'$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'   ORDER BY id DESC  limit 1");
    

}
else
{
    $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype) 
    SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid', admin_id, rece_id, cp_id,'$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'    ORDER BY id DESC  limit 1");
}

$date12 = date('Y-m-d H:i:s');
$lead_update = DB::update("update lead_create set l_employee = '".$centerid."' where id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");

$leadmulti_update = DB::update("update lead_create_multi set l_employee = '".$centerid."',presales = 'N',mul_cpsm = '".$centerid."',l_pc_multi = '".$date12."' where lead_id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");


    if($leadmulti_update)
    {
        return response(['status'=>200,'msg'=>['Update Success']]);    
    }
    else
    {
        return response(['status'=>404,'msg'=>['Something Wrong']]);
    }  
    }
    else
    {
        return response(['status'=>404,'msg'=>['User not login']]);
    }
            

}
////End SM


///Started CP
public function update_cp(Request $request){
     
    $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
    if($user == 1)
    {
        $pre_property_dst = $request->project_id;
        $lead_no_dst = $request->lead_id;
        $row_lead_id = $request->lead_id;
        #$l_employee_dst = $request->emp_dst;
        #$centerid = $request->emp_dst;
        $pre_cp_cp = $request->emp_dst;
        $cp_id = $request->emp_dst;
        $centerid_fill = $request->centerid;

        $res_ibp = DB::table('ibp')->where(['id'=>$pre_cp_cp])->first(['id','sm','iname']);
        $res_ibp_ = json_decode(json_encode($res_ibp),True);
        dd(res_ibp_);
        $ibpid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
        $centerid = (isset($res_pro_['sm']) ? $res_pro_['sm'] :0);
        $l_employee_dst = (isset($res_pro_['sm']) ? $res_pro_['sm'] :0);
        $ibpname = (isset($res_pro_['iname']) ? $res_pro_['iname'] :0);

        $res_pro = DB::table('products')->where(['id'=>$pre_property_dst])->first(['id','mul_procode','pro_name']);
        $res_pro_ = json_decode(json_encode($res_pro),True);
        $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
        $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] :0);
        $l_prodt = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] :0);

        $res_user = DB::table('user')->where(['centerid'=>$centerid,'type'=>'c'])->first(['id','user_name']);
        $res_user_ = json_decode(json_encode($res_user),True);
        $sm_user = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
        $user_name = (isset($res_user_['user_name']) ? $res_user_['user_name'] :0);
        
        $res_user1 = DB::table('user')->where(['centerid'=>$centerid_fill,'type'=>'c'])->first(['id','user_name']);
        $res_user1_ = json_decode(json_encode($res_user1),True);
        $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
        $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
        $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
        #dd($res_user1_);
        $res_headcenter = DB::table('headcenter')->where(['id'=>$l_employee_dst])->first(['role']);
        $res_headcenter1_ = json_decode(json_encode($res_headcenter),True);
        $role = (isset($res_headcenter1_['role']) ? $res_headcenter1_['role'] :0);
        
        if($role == 'DST')
        {
            $centeridaa = $centerid_fill;
            $centerid_dst = $centerid;
            $centerid = $sm;
            #$centerid = '';
            $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated OR Updated.';
        }
        else
        {
            $centerid_dst = '';
            $centerid = $centerid;
            $ll_details = 'On this lead For Project '.$l_prodt.' CP '.$ibpname.' AND CPSM  '.$sm_user.' is been allocated OR Updated.';
	
        }
        
        if($role == 'DST')
{

    $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype) 
    SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid_dst', admin_id, rece_id, '$cp_id','$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'   ORDER BY id DESC  limit 1");
    

}
else
{
    $hla_presales1 = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode, Date, Time, dtime, ltype, ctype) 
    SELECT sub, '$ll_details', '$sm_user_fill', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid', admin_id, rece_id, '$cp_id','$row_proid_proid','$l_prodt','$mul_procode', Date, Time, dtime, ltype, ctype FROM lead_log WHERE ll_leadid='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'    ORDER BY id DESC  limit 1");
}

$date12 = date('Y-m-d H:i:s');
$lead_update = DB::update("update lead_create set l_employee = '".$centerid."',ibpid = '".$cp_id."' where id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");

$lead_date= date("Y-m-d");
  $lead_date15 =  date('Y-m-d', strtotime(' + 15 days')); 
  $lead_date30 =  date('Y-m-d', strtotime(' + 30 days')); 
  $lead_date45 =  date('Y-m-d', strtotime(' + 45 days')); 
  $lead_date60 =  date('Y-m-d', strtotime(' + 60 days')); 
  $lead_date75 =  date('Y-m-d', strtotime(' + 75 days')); 
  $lead_date90 =  date('Y-m-d', strtotime(' + 90 days')); 
  $lead_date105 =  date('Y-m-d', strtotime(' + 105 days')); 
  

$leadmulti_update = DB::update("update lead_create_multi set lead_date = '".$lead_date."',lead_date15 = '".$lead_date15."',lead_date30 = '".$lead_date30."',lead_date45 = '".$lead_date45."',lead_date60 = '".$lead_date60."',lead_date75 = '".$lead_date75."',lead_date90 = '".$lead_date90."',lead_date105 = '".$lead_date105."',l_employee = '".$centerid."',mul_cpsm = '".$centerid."',mul_cp = '".$cp_id."',ibpid = '".$cp_id."',l_pc_multi = '".$date12."' where lead_id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");


    if($leadmulti_update)
    {
        return response(['status'=>200,'msg'=>['Update Success']]);    
    }
    else
    {
        return response(['status'=>404,'msg'=>['Something Wrong']]);
    }  
    }
    else
    {
        return response(['status'=>404,'msg'=>['User not login']]);
    }
            

}

///Ended Cp

	
}
   
