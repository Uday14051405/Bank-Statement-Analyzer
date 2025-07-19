<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogAddProController extends Controller
{
    public function add_project(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'centerid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1)
		{
            $pre_mobileno = $request->pre_mobileno;
            $pre_prodt = '';
            $com = '';
            $centerid_fill = $request->centerid;
            $pre_property = $request->pre_property;
            $pre_prodt = $request->pre_property;
            $l_prodt = $request->pre_property;
            $pre_source = $request->pre_source;
            $pre_cp = $request->pre_cp;
            $mul_vendor ='';
            $pre_vendor ='';
            $ibpid = $request->pre_cp;
            $image_upload = 'Update';
           

            $res_user1 = DB::table('user')->where(['centerid'=>$centerid_fill,'type'=>'c'])->first(['id','user_name']);
            $res_user1_ = json_decode(json_encode($res_user1),True);
            $user_id1 = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $user_table_id = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $self_table_id = $centerid_fill;
            $centerid = $centerid_fill;
            $error_lead = 0;
            $sm_user = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $user_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] :0);
            $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $user_table_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);
            $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] :0);

            $res_pro = DB::table('products')->where(['pro_name'=>$pre_prodt])->first(['id','mul_procode','pro_name']);
            $res_pro_ = json_decode(json_encode($res_pro),True);
            $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] :0);
            $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] :0);
            $mul_proname = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] :0);

            $l_employeeuser = DB::select("SELECT id FROM lead_create WHERE ".$pre_mobileno." IN(l_pno,l_mobile,l_mobile1,l_mobile2) limit 1");
            $lead_userss_ = json_decode(json_encode($l_employeeuser),True);
              # dd($lead_userss_);
            if(count($l_employeeuser) > 0 )
            {
                $row_lead_id = $lead_userss_[0]['id'];
            
                $l_employeeuser1 = DB::select("select lead_id from lead_create_multi where lead_id='".$row_lead_id."' AND  mul_proid='".$row_proid_proid."'");
            
                if(count($l_employeeuser1) > 0 )
                {
                    return response(['status'=>200,'msg'=>['Existing Customer With Same Project please check details']]);    
                }
                else
                {
                    $res_headcenter = DB::table('headcenter')->where(['id'=>$centerid])->first();
                    $res_headcenter1_ = json_decode(json_encode($res_headcenter),True);
                    #dd($res_headcenter1_);
                    $izone = (isset($res_headcenter1_['izone']) ? $res_headcenter1_['izone'] :0);
                    $iregion = (isset($res_headcenter1_['iregion']) ? $res_headcenter1_['iregion'] :0);
                    $idivision = (isset($res_headcenter1_['idivision']) ? $res_headcenter1_['idivision'] :0);
                    $icenter = (isset($res_headcenter1_['icenter']) ? $res_headcenter1_['icenter'] :0);
                    $centernname = (isset($res_headcenter1_['centernname']) ? $res_headcenter1_['centernname'] :0);
                    $contact = (isset($res_headcenter1_['contact']) ? $res_headcenter1_['contact'] :0);
                    $whatsapp = (isset($res_headcenter1_['whatsapp']) ? $res_headcenter1_['whatsapp'] :0);
                    $landmark = (isset($res_headcenter1_['landmark']) ? $res_headcenter1_['landmark'] :0);
                    $pincode = (isset($res_headcenter1_['pincode']) ? $res_headcenter1_['pincode'] :0);
                    $iname = (isset($res_headcenter1_['iname']) ? $res_headcenter1_['iname'] :0);
                    $iadd = (isset($res_headcenter1_['iadd']) ? $res_headcenter1_['iadd'] :0);
                    $ioadd = (isset($res_headcenter1_['ioadd']) ? $res_headcenter1_['ioadd'] :0);
                    $itel = (isset($res_headcenter1_['itel']) ? $res_headcenter1_['itel'] :0);
                    $ihand = (isset($res_headcenter1_['ihand']) ? $res_headcenter1_['ihand'] :0);
                    $iemail = (isset($res_headcenter1_['iemail']) ? $res_headcenter1_['iemail'] :0);
                    $owner = (isset($res_headcenter1_['owner']) ? $res_headcenter1_['owner'] :0);
                    $role = (isset($res_headcenter1_['role']) ? $res_headcenter1_['role'] :0);
                    if($ibpid == 'sm_self' OR $ibpid == '')
                    {
                        
                        if($role == 'DST')
                        {
                            
                            $centerid_dst = $centerid;
                            $centerid = '';
                            $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated.';
                        }
                        else
                        {
                            $centerid_dst = '';
                            $centerid = $centerid;
                            $ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated.';
                      }
                      $redate= date("Y-m-d");
                    $retime= date("H:i:s");
                     $date12 = date('Y-m-d H:i:s');
                     $hla_presales1 = DB::insert("INSERT INTO lead_create_multi( l_code, l_fname, l_lname, l_jtitle, l_email, l_pno, l_company, l_tfd, l_itos, l_rs, l_rsl, l_hqc, l_lhs, l_hc, l_ld, l_pcfn, l_pcln, l_pce, l_pcn, l_pc3, l_employee, l_mydate, l_mydate1, status, l_bid, izone, iregion, idivision, icenter, ibpid, l_prodt, Property, l_pcn1, l_pcn2, l_pcn3, mil, type,  adv, loca, pref, prof, eadd, smid, l_mobile, smmobile, source, vendor, r_employee, comment, uploadcomment, user_name, status2, status3,  site_visit1, site_visit2, lead_upload_date, lead_create_date, lead_update_date, lead_all_date, first_comment_date, last_comment_date, lead_auto_date, dst_first_comment, dst_last_comment, booking_date, booking_amt, booking_due, booking_per, due_per, due_clearation_date, allocation_id, dst_qualifty, cl_sm_status, reid, allocation_id1, log_update_date, v_userid, v_username, v_date, l_pc, l_pc2, l_pjln, fsub, stype, site_update_date, stype1, sale_update_date, dead_update_date, l_mobile1, l_mobile2, r_employee_pre, l_employee_pre, reallocation, redate, retime, pav_an, pav_can1, pav_can2, pav_can3, pav_av, pav_proid, pav_wing, pav_rno, pav_comm, pav_gst, pav_ordernoani, pav_fundtype, pav_bookdate, pav_cn, av_an, av_can1, av_can2, av_can3, av_av, av_proid, av_wing, av_rno, av_comm, av_gst, av_ordernoani, av_fundtype, av_bookdate, av_cn, av_other_charges, av_ibptype, av_custid, av_type, lead_allo_date, lead_allo_time, dead_status, dead_time, dsm, dst_name, d_employee,mul_cp,mul_cpsm,mul_dst,mul_proid,mul_proname, lead_id, mul_source, mul_procode, mul_vendor, lead_create_multi_date,l_pc_multi)SELECT  l_code, l_fname, l_lname, l_jtitle, l_email, l_pno, l_company, l_tfd, l_itos, l_rs, l_rsl, l_hqc, l_lhs, l_hc, l_ld, l_pcfn, l_pcln, l_pce, l_pcn, l_pc3, '".$centerid."', l_mydate, l_mydate1, status, l_bid, izone, iregion, idivision, icenter, '".$ibpid."', '".$l_prodt."', Property, l_pcn1, l_pcn2, l_pcn3, mil, type,  adv, loca, pref, prof, eadd, smid, l_mobile, smmobile, '".$pre_source."', '".$mul_vendor."', '".$centerid_dst."', comment, uploadcomment, user_name, status2, status3,  site_visit1, site_visit2, lead_upload_date, lead_create_date, lead_update_date, lead_all_date, first_comment_date, last_comment_date, lead_auto_date, dst_first_comment, dst_last_comment, booking_date, booking_amt, booking_due, booking_per, due_per, due_clearation_date, allocation_id, dst_qualifty, cl_sm_status, reid, allocation_id1, log_update_date, v_userid, v_username, v_date, l_pc, l_pc2, l_pjln, fsub, stype, site_update_date, stype1, sale_update_date, dead_update_date, l_mobile1, l_mobile2, r_employee_pre, l_employee_pre, reallocation, redate, retime, pav_an, pav_can1, pav_can2, pav_can3, pav_av, pav_proid, pav_wing, pav_rno, pav_comm, pav_gst, pav_ordernoani, pav_fundtype, pav_bookdate, pav_cn, av_an, av_can1, av_can2, av_can3, av_av, av_proid, av_wing, av_rno, av_comm, av_gst, av_ordernoani, av_fundtype, av_bookdate, av_cn, av_other_charges, av_ibptype, av_custid, av_type, lead_allo_date, lead_allo_time, dead_status, dead_time, dsm, dst_name, d_employee,'".$ibpid."','".$centerid."','".$centerid_dst."','".$row_proid_proid."','".$l_prodt."', '".$row_lead_id."', '".$pre_source."', '".$mul_procode."', '".$mul_vendor."', '".$date12."', '".$date12."' FROM lead_create WHERE id='".$row_lead_id."'"); 
                     
                     if($role == 'DST')
                     {
                        $hla_presales1dst = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode)SELECT sub, '".$ll_details."', '".$sm_user."', '".$sessionname."', '".$sessionshop."', '".$row_lead_id."', '".$row_lead_id."', ll_logno, status, '".$centerid_dst."', admin_id, rece_id, cp_id,'".$row_proid_proid."','".$l_prodt."','".$mul_procode."' FROM lead_log WHERE ll_leadid='".$row_lead_id."' limit 1");
                     }
                     else
                     {
                        $hla_presales1dst = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode)SELECT sub, '".$ll_details."', '".$sm_user."', '".$sessionname."', '".$sessionshop."', '".$row_lead_id."', '".$row_lead_id."', ll_logno, status, '".$centerid."', admin_id, rece_id, cp_id,'".$row_proid_proid."','".$l_prodt."','".$mul_procode."' FROM lead_log WHERE ll_leadid='".$row_lead_id."' limit 1");
                     }


                    }
                    
else
{
    $res_lead_multi = DB::table('ibp')->where(['id'=>$ibpid])->first(['sm','iname']);
    $res_lead_multi_ = json_decode(json_encode($res_lead_multi),True);
    $sm = (isset($res_lead_multi_['sm']) ? $res_lead_multi_['sm'] :0);
    $iname = (isset($res_lead_multi_['iname']) ? $res_lead_multi_['iname'] :0);

    if($iname == '')
		{
			$cpnamee = '';
		}
		else
		{
			$cpnamee = 'with '.$iname.'';
		}
		
		if($role == 'DST')
	{
		$centeridaa = $centerid_fill;
		$centerid_dst = $centeridaa;
		$centerid = $sm;
		$ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated '.$cpnamee.'.';
	}
	else
	{
		$centerid_dst = '';
		$centerid = $sm;
		$ll_details = 'On this lead For Project '.$l_prodt.' '.$sm_user.' is been allocated '.$cpnamee.'.';
	}
	
  $redate= date("Y-m-d");
  $retime= date("H:i:s");
   $date12 = date('Y-m-d H:i:s');
    $lead_date= date("Y-m-d");
  $lead_date15 =  date('Y-m-d', strtotime(' + 15 days')); 
  $lead_date30 =  date('Y-m-d', strtotime(' + 30 days')); 
  $lead_date45 =  date('Y-m-d', strtotime(' + 45 days')); 
  $lead_date60 =  date('Y-m-d', strtotime(' + 60 days')); 
  $lead_date75 =  date('Y-m-d', strtotime(' + 75 days')); 
  $lead_date90 =  date('Y-m-d', strtotime(' + 90 days')); 
  $lead_date105 =  date('Y-m-d', strtotime(' + 105 days')); 
  


   $hla_presales1 = DB::insert("INSERT INTO lead_create_multi( `l_code`, `l_fname`, `l_lname`, `l_jtitle`, `l_email`, `l_pno`, `l_company`, `l_tfd`, `l_itos`, `l_rs`, `l_rsl`, `l_hqc`, `l_lhs`, `l_hc`, `l_ld`, `l_pcfn`, `l_pcln`, `l_pce`, `l_pcn`, `l_pc3`, `l_employee`, `l_mydate`, `l_mydate1`, `status`, `l_bid`, `izone`, `iregion`, `idivision`, `icenter`, `ibpid`, `l_prodt`, `Property`, `l_pcn1`, `l_pcn2`, `l_pcn3`, `mil`, `type`,  `adv`, `loca`, `pref`, `prof`, `eadd`, `smid`, `l_mobile`, `smmobile`, `source`, `vendor`, `r_employee`, `comment`, `uploadcomment`, `user_name`, `status2`, `status3`,  `site_visit1`, `site_visit2`, `lead_upload_date`, `lead_create_date`, `lead_update_date`, `lead_all_date`, `first_comment_date`, `last_comment_date`, `lead_auto_date`, `dst_first_comment`, `dst_last_comment`, `booking_date`, `booking_amt`, `booking_due`, `booking_per`, `due_per`, `due_clearation_date`, `allocation_id`, `dst_qualifty`, `cl_sm_status`, `reid`, `allocation_id1`, `log_update_date`, `v_userid`, `v_username`, `v_date`, `l_pc`, `l_pc2`, `l_pjln`,  `fsub`, `stype`, `site_update_date`, `stype1`, `sale_update_date`, `dead_update_date`, `l_mobile1`, `l_mobile2`, `r_employee_pre`, `l_employee_pre`, `reallocation`, `redate`, `retime`, `pav_an`, `pav_can1`, `pav_can2`, `pav_can3`, `pav_av`, `pav_proid`, `pav_wing`, `pav_rno`, `pav_comm`, `pav_gst`, `pav_ordernoani`, `pav_fundtype`, `pav_bookdate`, `pav_cn`, `av_an`, `av_can1`, `av_can2`, `av_can3`, `av_av`, `av_proid`, `av_wing`, `av_rno`, `av_comm`, `av_gst`, `av_ordernoani`, `av_fundtype`, `av_bookdate`, `av_cn`, `av_other_charges`, `av_ibptype`, `av_custid`, `av_type`, `lead_allo_date`, `lead_allo_time`, `dead_status`, `dead_time`, `dsm`, `dst_name`, `d_employee`,`mul_cp`,`mul_cpsm`,`mul_dst`,`mul_proid`,`mul_proname`, `lead_id`, `mul_source`, `mul_vendor`, `lead_create_multi_date`,`l_pc_multi`, `lead_date`, `lead_date15`, `lead_date30`, `lead_date45`, `lead_date60`, `lead_date75`, `lead_date90`, `lead_date105`, `mul_procode`)SELECT  l_code, l_fname, l_lname, l_jtitle, l_email, l_pno, l_company, l_tfd, l_itos, l_rs, l_rsl, l_hqc, l_lhs, l_hc, l_ld, l_pcfn, l_pcln, l_pce, l_pcn, l_pc3, '$centerid', l_mydate, l_mydate1, status, l_bid, izone, iregion, idivision, icenter, '$ibpid', '$l_prodt', Property, l_pcn1, l_pcn2, l_pcn3,  mil, type, adv, loca, pref, prof, eadd, smid, l_mobile, smmobile, '$pre_source', '$mul_vendor', '$centerid_dst', comment, uploadcomment, user_name, status2, status3,  site_visit1, site_visit2, lead_upload_date, lead_create_date, lead_update_date, lead_all_date, first_comment_date, last_comment_date, lead_auto_date, dst_first_comment, dst_last_comment, booking_date, booking_amt, booking_due, booking_per, due_per, due_clearation_date, allocation_id, dst_qualifty, cl_sm_status, reid, allocation_id1, log_update_date, v_userid, v_username, v_date, l_pc, l_pc2, l_pjln, fsub, stype, site_update_date, stype1, sale_update_date, dead_update_date, l_mobile1, l_mobile2, r_employee_pre, l_employee_pre, reallocation, redate, retime, pav_an, pav_can1, pav_can2, pav_can3, pav_av, pav_proid, pav_wing, pav_rno, pav_comm, pav_gst, pav_ordernoani, pav_fundtype, pav_bookdate, pav_cn, av_an, av_can1, av_can2, av_can3, av_av, av_proid, av_wing, av_rno, av_comm, av_gst, av_ordernoani, av_fundtype, av_bookdate, av_cn, av_other_charges, av_ibptype, av_custid, av_type, lead_allo_date, lead_allo_time, dead_status, dead_time, dsm, dst_name, d_employee,'$ibpid','$centerid','$centerid_dst','$row_proid_proid','$l_prodt', '$row_lead_id', '$pre_source', '$mul_vendor', '$date12', '$date12', '$lead_date', '$lead_date15', '$lead_date30', '$lead_date45', '$lead_date60', '$lead_date75', '$lead_date90', '$lead_date105','$l_prodt' FROM lead_create WHERE id='".$row_lead_id."'"); 
                     
                     if($role == 'DST')
                     {
                        $hla_presales1dst = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, csm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode)SELECT sub, '$ll_details', '$sm_user', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid_dst', admin_id, rece_id, '$ibpid','$row_proid_proid','$l_prodt','$mul_procode' FROM lead_log WHERE ll_leadid='".$row_lead_id."' limit 1");
                     }
                     else
                     {
                        $hla_presales1dst = DB::insert("INSERT INTO lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode)SELECT sub, '$ll_details', '$sm_user', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '$centerid', admin_id, rece_id, '$ibpid','$row_proid_proid','$l_prodt','$mul_procode' FROM lead_log WHERE ll_leadid='".$row_lead_id."' limit 1");
                     }
}

$lead_update = DB::update("update lead_create set r_employee = '',l_employee = '',ibpid = '',source = '',vendor = '' where id='".$row_lead_id."'");

$lead_update = DB::update("update lead_create_multi set lead_count = lead_count+1,r_employee = '".$centerid_dst."',l_employee = '".$centerid."',ibpid = '".$ibpid."',source = '".$pre_source."',vendor = '".$pre_vendor."',mul_proid = '".$row_proid_proid."',mul_proname = '".$l_prodt."',l_prodt = '".$l_prodt."',mul_procode = '".$mul_procode."',ltype = '',ctype = '',fDate = '',fTime = '',dtime = '',fll_details = '',fll_fillby = '' where lead_id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");

$lead_update = DB::update("update lead_create_multi set l_itos = '',l_rs = '',l_rsl = '',l_hqc = '',l_lhs = '',l_hc = '',l_ld = '',l_pcfn = '',l_pcln = '',l_pce = '',l_pcn = '',l_pc3 = '',l_mydate = '".$date12."',l_mydate1 = '".$date12."',lead_auto_date = '".$date12."',lead_upload_date = '".$date12."',lead_create_date = '".$date12."',lead_update_date = '".$date12."',lead_allo_time = '".$retime."',lead_allo_date = '".$date12."',lead_all_date = '".$date12."',v_date = '".$date12."',l_pc = '".$date12."',Property = '',l_pcn1 = '',l_pcn2 = '',l_pcn3 = '',loca = '',pref = '',prof = '',eadd = '',comment = '',uploadcomment = '',site_visit1 = '',site_visit2 = '',first_comment_date = '',last_comment_date = '',dst_first_comment = '',dst_last_comment = '',booking_date = '',booking_amt = '',booking_due = '',booking_per = '',due_per = '',dst_qualifty = '',cl_sm_status = '',reid = '',allocation_id1 = '',log_update_date = '',v_userid = '".$user_table_id."',v_username = '".$user_table_name."',stype = '',site_update_date = '',stype1 = '',sale_update_date = '',dead_update_date = '',l_mobile1 = '',l_mobile2 = '',r_employee_pre = '',l_employee_pre = '',reallocation = '',redate = '',retime = '',pav_an = '',pav_can1 = '',pav_can2 = '',pav_can3 = '',pav_av = '',pav_proid = '',pav_wing = '',pav_rno = '',pav_comm = '',pav_gst = '',pav_ordernoani = '',pav_fundtype = '',pav_bookdate = '',pav_cn = '',av_an = '',av_can1 = '',av_can2 = '',av_can3 = '',av_av = '',av_proid = '',av_wing = '',av_rno = '',av_comm = '',av_gst = '',av_ordernoani = '',av_fundtype = '',av_bookdate = '',av_cn = '',av_other_charges = '',av_ibptype = '',av_custid = '',dead_status = '',dead_time = '',dsm = '',dst_name = '',d_employee = '',r_employee = '',l_employee = '',ibpid = '',source = '',vendor = '' where lead_id='".$row_lead_id."'  AND  mul_proid='".$row_proid_proid."'");

$lead_updatee = DB::update("update lead_create set lead_count = lead_count+1,r_employee = '".$centerid_dst."',l_employee = '".$centerid."',ibpid = '".$ibpid."',source = '".$pre_source."',vendor = '".$pre_vendor."',mul_proid = '".$row_proid_proid."',mul_proname = '".$l_prodt."',l_prodt = '".$l_prodt."',mul_procode = '".$mul_procode."',ltype = '',ctype = '',fDate = '',fTime = '',dtime = '',fll_details = '',fll_fillby = '' where id='".$row_lead_id."'");


                    
             return response(['status'=>200,'msg'=>['Success']]);    
            }


            }
            else
            {
                return response(['status'=>200,'msg'=>['Please Check Customer Mobile Number']]); 
            }

           
	
           
        }




        else
		{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }





	
}
   
