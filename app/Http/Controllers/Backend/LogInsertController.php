<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogInsertController extends Controller
{
    public function log_insert(Request $request){
        $sub = '';
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'centerid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
           /* echo "<pre>";
            print_r($request->all());
            echo "</pre>";
            die();*/
            $mul_proid = $request->mul_proid;
            $lead_id = $request->lead_id;
            $leadid = $request->lead_id;
            $leadcode = $request->lead_id;
            $ivoter = $request->username;
            $la_lc1 = $request->lead_id;
            $followup_mediumid = $request->followup_mediumid;
            $dead_enquiry_reasons_id = $request->dead_enquiry_reasons_id;
            $Time = $request->ftime;
            $iadd = $request->comment;
            $Date = $request->fdate;
            $ltype = $request->ltype;
            $ltype_re = $request->ltype_re;
            $ctype = $request->ctype;
            $centerid_fill = $request->centerid;
            $date12 = date('Y-m-d H:i:s');
            $data_arr = array();

            $res_pro = DB::table('products')->where(['id'=>$mul_proid])->first(['id','mul_procode','pro_name']);
            $res_pro_ = json_decode(json_encode($res_pro),True);
            $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
            $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] :0);
            $mul_proname = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] :0);

            $res_lead_multi = DB::table('lead_create_multi')->where(['lead_id'=>$lead_id,'mul_proid'=>$mul_proid])->first(['ctype','mul_proname','mul_procode','mul_proid','mul_cp','mul_cpsm','mul_dst','r_employee','stype1','mul_source','mul_vendor']);
            $res_lead_multi_ = json_decode(json_encode($res_lead_multi),True);
            $sm_id = (isset($res_lead_multi_['mul_cpsm']) ? $res_lead_multi_['mul_cpsm'] :0);
            $csm_id = (isset($res_lead_multi_['mul_dst']) ? $res_lead_multi_['mul_dst'] :0);
            $mul_cp = (isset($res_lead_multi_['mul_cp']) ? $res_lead_multi_['mul_cp'] :0);
            $mul_cpsm = (isset($res_lead_multi_['mul_cpsm']) ? $res_lead_multi_['mul_cpsm'] :0);
            $mul_dst = (isset($res_lead_multi_['mul_dst']) ? $res_lead_multi_['mul_dst'] :0);
            $mul_ctype = (isset($res_lead_multi_['ctype']) ? $res_lead_multi_['ctype'] :0);
            $stype1stype1 = (isset($res_lead_multi_['stype1']) ? $res_lead_multi_['stype1'] :0);
            $mul_procode1 = (isset($res_lead_multi_['mul_procode']) ? $res_lead_multi_['mul_procode'] :0);
            $mul_proid1 = (isset($res_lead_multi_['mul_proid']) ? $res_lead_multi_['mul_proid'] :0);
            $mul_proname1 = (isset($res_lead_multi_['mul_proname']) ? $res_lead_multi_['mul_proname'] :0);
            $mul_source = (isset($res_lead_multi_['mul_source']) ? $res_lead_multi_['mul_source'] :0);
            $mul_vendor = (isset($res_lead_multi_['mul_vendor']) ? $res_lead_multi_['mul_vendor'] :0);

            if($mul_ctype == 'Sale')
            {
            $ctype = 'Sale';
            }
            $res_user1 = DB::table('user')->where(['centerid'=>$centerid_fill,'type'=>'c'])->first(['id','user_name']);
            $res_user1_ = json_decode(json_encode($res_user1),True);
            $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $user_table_id = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $self_table_id = $centerid_fill;
            $sm_user = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $user_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $user_table_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);

            $l_employee = DB::select("select * from lead_log where (ltype = 'Site Visits - Done')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
        
            if(count($l_employee) > 0 )
            {
                if($ltype == 'Site Visits - Done')
                {  
                    $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',site_update_date = '".$date12."',stype = 'Site Visits - Done', ltype = '".$ltype."',fDate = '".$Date."', fTime = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");

                    $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',site_update_date = '".$date12."',stype = 'Site Visits - Done', ltype = '".$ltype."',fDate = '".$Date."', fTime = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
                    
                    $l_schedule = DB::select("select * from lead_visit_schedule where lead_id='".$leadid."' AND mul_proid='".$mul_proid."' AND status != 'Done' order by id DESC limit 1");
        
                    if(count($l_schedule) > 0 )
                    {
                        $l_visitschedule = DB::select("select * from lead_log where (ltype = 'Site Visits - Done')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
                        if(count($l_visitschedule) == 0 )
                        {
                            $date12_visit = date('Y-m-d');
	                        $date12t_visit = date(' H:i');
                            $hla_presales1 = DB::insert("INSERT INTO lead_visit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$date12_visit."','".$date12t_visit."','Done','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."')");
                        }
                        else
                        {
                            
                        }
                        }
                        else
                        {
                             $date12_visit = date('Y-m-d');
                            $date12t_visit = date(' H:i');
                            $leadmulti_update = DB::update("update lead_visit_schedule set site_visit_date = '".$date12_visit."',site_visit_time = '".$date12t_visit."',update_date1 = '".$date12."',update_userid = '".$user_table_id."', update_username = '".$user_table_name."',status = 'Done' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."' AND status != 'Done' order by id DESC limit 1");
                    
                        }
                    }
////ENded Site visit

elseif($ltype == 'Site Visit Schedule')
	{  
        $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',visit_schedule_date1 = '".$date12."', ltype = '".$ltype."',fDate = '".$Date."', fTime = '".$Time."',visit_schedule_date = '".$Date."', visit_schedule_time = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', visit_schedule_userid = '".$user_table_id."', visit_schedule_username = '".$user_table_name."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");

        $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',visit_schedule_date1 = '".$date12."', ltype = '".$ltype."',fDate = '".$Date."', fTime = '".$Time."',visit_schedule_date = '".$Date."', visit_schedule_time = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', visit_schedule_userid = '".$user_table_id."', visit_schedule_username = '".$user_table_name."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
        
        $leadmulti_update = DB::insert("INSERT INTO lead_visit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$Date."','".$Time."','Pending','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."'");
                    

    }

///Ended Site Visit Schedule


elseif($ltype == 'Site Visit Schedule')
	{  
        $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ltype = '".$ltype."', ctype = '".$ctype."', fsub = '".$sub."', status = 'N',dead_update_date = '".$date12."' where id='".$leadid."'  AND mul_proid='".$mul_proid."'");

        $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ltype = '".$ltype."', ctype = '".$ctype."', fsub = '".$sub."', status = 'N',dead_update_date = '".$date12."' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");     

    }
    else
 {
    $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', ltype = '".$ltype."', ctype = '".$ctype."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', fsub = '".$sub."', status = 'Y' where id='".$leadid."'  AND mul_proid='".$mul_proid."'");

    $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', ltype = '".$ltype."', ctype = '".$ctype."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', fsub = '".$sub."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");     

}
}
else
{
    $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', ltype = '".$ltype."', ctype = '".$ctype."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', fsub = '".$sub."', status = 'Y' where id='".$leadid."'  AND mul_proid='".$mul_proid."'");

    $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',fDate = '".$Date."', fTime = '".$Time."', ltype = '".$ltype."', ctype = '".$ctype."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', fsub = '".$sub."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");     
  
}


 
if($mul_ctype != 'Sale')
{
  if($ctype == 'Sale')
	{  
        $lead_update = DB::update("update lead_create set sale_update_date = '".$date12."',stype1 = 'Site Visits - Done'  where id='".$leadid."' AND mul_proid='".$mul_proid."'");

        $leadmulti_update = DB::update("update lead_create_multi set sale_update_date = '".$date12."',stype1 = 'Site Visits - Done'  where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");     

	}

}


if($ltype_re == 'Revisit - 1')
			{  
                $ltype = 'Site Visits - Done';
                $l_schedule = DB::select("select * from lead_log where (ltype = 'Revisit - 1')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
        
                if(count($l_schedule) > 0 )
                {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

                    $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit1_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit1_date = '".$date12_visit."', revisit1_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit1_userid = '".$user_table_id."', revisit1_username = '".$user_table_name."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");

                    $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit1_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit1_date = '".$date12_visit."', revisit1_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit1_userid = '".$user_table_id."', revisit1_username = '".$user_table_name."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
                    
                    $leadmulti_update = DB::insert("INSERT INTO lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$date12_visit."','".$date12t_visit."','Pending','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."','Revisit1')");
                         

                }
                else
                {
                    
                }

            }
///Ended Revisit 1

if($ltype_re == 'Revisit - 2')
			{  
				 $ltype = 'Site Visits - Done'; 
				 $date12_visit = date('Y-m-d');
	             $date12t_visit = date(' H:i');
	 
                 $l_schedule = DB::select("select * from lead_log where (ltype = 'Revisit - 2')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
        
                 if(count($l_schedule) > 0 )
                 {
                     $date12_visit = date('Y-m-d');
                     $date12t_visit = date(' H:i');
 
                     $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit2_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit2_date = '".$date12_visit."', revisit2_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit2_userid = '".$user_table_id."', revisit2_username = '".$user_table_name."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");
 
                     $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit2_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit2_date = '".$date12_visit."', revisit2_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit2_userid = '".$user_table_id."', revisit2_username = '".$user_table_name."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
                     
                     $leadmulti_update = DB::insert("INSERT INTO lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$date12_visit."','".$date12t_visit."','Pending','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."','Revisit2')");
                          
 
                 }
                 else
                 {
                     
                 }
 
            }


            if($ltype_re == 'Revisit - 2')
			{  
				 $ltype = 'Site Visits - Done'; 
				 $date12_visit = date('Y-m-d');
	             $date12t_visit = date(' H:i');
	 
                 $l_schedule = DB::select("select * from lead_log where (ltype = 'Revisit - 2')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
        
                 if(count($l_schedule) > 0 )
                 {
                     $date12_visit = date('Y-m-d');
                     $date12t_visit = date(' H:i');
 
                     $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit2_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit2_date = '".$date12_visit."', revisit2_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit2_userid = '".$user_table_id."', revisit2_username = '".$user_table_name."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");
 
                     $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit2_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit2_date = '".$date12_visit."', revisit2_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit2_userid = '".$user_table_id."', revisit2_username = '".$user_table_name."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
                     
                     $leadmulti_update = DB::insert("INSERT INTO lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$date12_visit."','".$date12t_visit."','Pending','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."','Revisit2')");
                          
 
                 }
                 else
                 {
                     
                 }
 
            }

            if($ltype_re == 'Revisit - 3')
			{  
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');
	 
                 $l_schedule = DB::select("select * from lead_log where (ltype = 'Revisit - 3')  AND ll_leadid='".$leadid."' AND mul_proid='".$mul_proid."'");
        
                 if(count($l_schedule) > 0 )
                 {
                     $date12_visit = date('Y-m-d');
                     $date12t_visit = date(' H:i');
 
                     $lead_update = DB::update("update lead_create set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit3_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit3_date = '".$date12_visit."', revisit3_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit3_userid = '".$user_table_id."', revisit3_username = '".$user_table_name."', status = 'Y' where id='".$leadid."' AND mul_proid='".$mul_proid."'");
 
                     $leadmulti_update = DB::update("update lead_create_multi set log_update_date = '".$date12."',resite_update_date = '".$date12."',revisit3_date1 = '".$date12."', ltype = '".$ltype_re."',fDate = '".$Date."', fTime = '".$Time."',revisit3_date = '".$date12_visit."', revisit3_time = '".$date12t_visit."', fll_details = '".$iadd."', fll_fillby = '".$ivoter."', ctype = '".$ctype."', fsub = '".$sub."', revisit3_userid = '".$user_table_id."', revisit3_username = '".$user_table_name."', status = 'Y' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
                     
                     $leadmulti_update = DB::insert("INSERT INTO lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('".$leadid."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$leadid."','".$mul_source."','".$mul_vendor."','".$date12_visit."','".$date12t_visit."','Pending','".$user_table_name."','".$user_table_id."','".$date12."','".$mul_cp."','".$mul_cpsm."','".$mul_dst."','Revisit3')");
                          
 
                 }
                 else
                 {
                     
                 }
 
            }

        ///Ended Revsit 3
        $folloup_medium = DB::table('followup_medium')->where(['id'=>$followup_mediumid,'status'=>'Y'])->first(['name']);
        $folloup_medium_ = json_decode(json_encode($folloup_medium),True);
        $followup_medium = (isset($folloup_medium_['name']) ? $folloup_medium_['name'] :0);
    
        $reason_medium = DB::table('dead_enquiry_reasons')->where(['id'=>$dead_enquiry_reasons_id])->first(['reason']);
        $reason_medium_ = json_decode(json_encode($reason_medium),True);
        $dead_reason = (isset($reason_medium_['reason']) ? $reason_medium_['reason'] :0);
    
        $lead_log_countquery = DB::select("select count(id) as lead_log_count from lead_log where ll_leadid='".$leadid."' and mul_proid='".$mul_proid."' and ll_fillby='".$ivoter."' and lead_log_count_status='1'");
        $folloup_medium_ = json_decode(json_encode($lead_log_countquery),True);
        $lead_log_count = (isset($folloup_medium_['lead_log_count']) ? $folloup_medium_['lead_log_count'] :0);

        $date12 = date('Y-m-d H:i:s');
        $lead_log_count_full = $lead_log_count + 1;

        $leadmulti_update = DB::update("update lead_create set lead_log_count = '".$lead_log_count_full."',active_date = '".$date12."',active_userid = '".$user_table_id."',active_username = '".$user_table_name."' where id='".$leadid."' AND mul_proid='".$mul_proid."'");
                     
        $leadmulti_update = DB::update("update lead_create_multi set lead_log_count = '".$lead_log_count_full."',active_date = '".$date12."',active_userid = '".$user_table_id."',active_username = '".$user_table_name."' where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");

            if($ltype_re == 'Revisit - 1')
            {  
            $ltype = $ltype_re ;
            }

            if($ltype_re == 'Revisit - 2')
            {  
            $ltype = $ltype_re ;
            }

            if($ltype_re == 'Revisit - 3')
            {  
            $ltype = $ltype_re ;
            }

 $centeruser_idddd = $request->centerid;

 if($centeruser_idddd == '9' OR $centeruser_idddd == '24')
 {
      $date12 = date('Y-m-d H:i:s');

      $leadmulti_update = DB::update("update lead_create_multi set presales = 'Y',presales_date = '".$date12."'  where lead_id='".$leadid."' AND mul_proid='".$mul_proid."'");
     
 }
 $highest_id = '';
 $status = '';
 $leadmulti_updatedd = DB::insert("INSERT INTO lead_log(ll_logno,sub,Date,Time,ll_details,ll_fillby,ll_username,ll_shop_id,ll_leadcode,ll_leadid,ltype,ctype,sm_id,csm_id,log_create_date,log_update_date,mul_proid,mul_proname,mul_procode, dead_enquiry_reasons_id, dead_reason, status2, followup_medium, followup_mediumid, lead_log_count, lead_log_count_status) VALUES ('".$highest_id."','".$sub."','".$Date."','".$Time."','".$iadd."','".$ivoter."','".$user_table_id."','".$user_table_name."','".$leadcode."','".$leadid."','".$ltype."','".$ctype."','".$sm_id."','".$csm_id."','".$date12."','".$date12."','".$mul_proid."','".$mul_proname."','".$mul_procode."','".$dead_enquiry_reasons_id."','".$dead_reason."','".$status."','".$followup_medium."','".$followup_mediumid."','".$lead_log_count_full."','1')");
                          
 
 

                     

    
        


            return response(['status'=>200,'msg'=>['Success']]);    
      
        }
    
        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }


	
}
   
