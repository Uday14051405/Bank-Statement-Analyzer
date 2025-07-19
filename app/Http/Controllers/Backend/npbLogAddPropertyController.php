<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class npbLogAddPropertyController extends Controller
{
    public function add_npbproperty(Request $request)
    {

        // $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        // $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            $pre_mobileno = $request->pre_mobileno;
            $pre_prodt = '';
            $com = '';
            $centerid_fill = $request->centerid;
            $pre_property = $request->pre_property;
            $pre_prodt = $request->pre_property;
            $l_prodt = $request->project_society_name;
            // $pre_source = $request->pre_source;
            $project_society_name = $request->project_society_name;
            $property_title = $request->property_title;
            $pre_cp = $request->centerid;
            $mul_vendor = '';
            $pre_vendor = '';
            $ibpid = $request->centerid;
            $image_upload = 'Update';


            $res_user1 = DB::connection('mysql_second')->table('register')->where(['id' => $centerid_fill, 'usertype' => $request->usertype])->first(['id', 'username']);
            $res_user1_ = json_decode(json_encode($res_user1), True);
            $user_id1 = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $user_table_id = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $self_table_id = $centerid_fill;
            $centerid = $centerid_fill;
            $error_lead = 0;
            $sm_user = (isset($res_user1_['username']) ? $res_user1_['username'] : 0);
            $user_name = (isset($res_user1_['username']) ? $res_user1_['username'] : 0);
            $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $sessionshop = (isset($res_user1_['username']) ? $res_user1_['username'] : 0);
            $user_table_name = (isset($res_user1_['username']) ? $res_user1_['username'] : 0);
            $sm_user_fill = (isset($res_user1_['username']) ? $res_user1_['username'] : 0);

            // $res_pro = DB::connection('mysql_second')->table('products')->where(['pro_name' => $pre_prodt])->first(['id', 'mul_procode', 'pro_name']);
            // $res_pro_ = json_decode(json_encode($res_pro), True);
            // $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] : 0);
            // $mul_procode = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] : 0);
            // $mul_proname = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] : 0);
            $mul_procode = '';
            $row_proid_proid ='';

            $l_employeeuser = DB::select("SELECT lead_id FROM npb_lead_create_multi WHERE " . $pre_mobileno . " IN(l_pno,l_mobile,l_mobile1,l_mobile2) AND ibpid='" . $ibpid . "' AND project_society_name='" . $project_society_name . "'");
            $lead_userss_ = json_decode(json_encode($l_employeeuser), True);
            //  echo count($l_employeeuser);
            //  print_r($lead_userss_);

            if (count($l_employeeuser) == 0) {
          
                $row_lead_id = (isset($lead_userss_['lead_id']) ? $lead_userss_['lead_id'] : 0);
        
                $l_employeeuser1 = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['l_pno' => $pre_mobileno])->where(['ibpid' => $ibpid])->orderBy('id', 'desc')->first(['id', 'mul_proname', 'lead_id', 'source']);
                $p1_count = json_decode(json_encode($l_employeeuser1), True);
                $p1_count1 = (isset($p1_count['mul_proname']) ? $p1_count['mul_proname'] : 0);
                $row_lead_id = (isset($p1_count['lead_id']) ? $p1_count['lead_id'] : 0);
                $pre_source = (isset($p1_count['source']) ? $p1_count['source'] : 0);
                $idd = (isset($p1_count['id']) ? $p1_count['id'] : 0);
       

                if ($p1_count1 == 'P1') {
                    $l_prodt  = 'P2';
                } elseif ($p1_count1 == 'P2') {
                    $l_prodt  = 'P3';
                } elseif ($p1_count1 == 'P3') {
                    $l_prodt  = 'P4';
                } elseif ($p1_count1 == 'P4') {
                    $l_prodt  = 'P5';
                } elseif ($p1_count1 == 'P5') {
                    $l_prodt  = 'P6';
                } elseif ($p1_count1 == 'P6') {
                    $l_prodt  = 'P7';
                } elseif ($p1_count1 == 'P7') {
                    $l_prodt  = 'P8';
                } elseif ($p1_count1 == 'P8') {
                    $l_prodt  = 'P9';
                } elseif ($p1_count1 == 'P9') {
                    $l_prodt  = 'P10';
                }

                $ll_details = 'New Property ' . $project_society_name . ' is been added.';
                $redate = date("Y-m-d");
                $retime = date("H:i:s");
                $date12 = date('Y-m-d H:i:s');
                $lead_date = date("Y-m-d");
                $lead_date15 =  date('Y-m-d', strtotime(' + 15 days'));
                $lead_date30 =  date('Y-m-d', strtotime(' + 30 days'));
                $lead_date45 =  date('Y-m-d', strtotime(' + 45 days'));
                $lead_date60 =  date('Y-m-d', strtotime(' + 60 days'));
                $lead_date75 =  date('Y-m-d', strtotime(' + 75 days'));
                $lead_date90 =  date('Y-m-d', strtotime(' + 90 days'));
                $lead_date105 =  date('Y-m-d', strtotime(' + 105 days'));


                $hla_presales1 = DB::insert("INSERT INTO npb_lead_create_multi( l_fname, l_lname, l_email, l_pno, l_rs, l_rsl, l_employee, l_mydate, l_mydate1, ibpid, l_prodt, Property, ltype, loca, pref, prof, eadd, l_mobile,source,r_employee, v_userid, v_username, v_date, l_pc, l_pjln, redate, retime,mul_cp,mul_dst,mul_proid,mul_proname, lead_id, mul_source, mul_procode, lead_create_multi_date,l_pc_multi,purpose, lead_stage, lead_stage_id,lead_create_date,hm_url,property_title,project_society_name,npb_lead_status) SELECT l_fname, l_lname,l_email, l_pno,l_rs,l_rsl,  '$centerid', '$date12', '$date12','$ibpid', '$l_prodt', Property, '', loca,pref, prof, eadd,l_mobile,'$pre_source', '','$user_table_id','$user_table_name','$date12', '$date12', l_pjln,  '$redate', '$retime','$ibpid','','$row_proid_proid','$l_prodt', '$row_lead_id', '$pre_source', '$mul_procode', '$date12', '$date12', purpose,'', '','$date12','','$property_title','$project_society_name','' FROM npb_lead_create_multi WHERE id='" . $idd . "'");

                // print_r($hla_presales1);

                $hla_presales1dst = DB::insert("INSERT INTO npb_lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode,project_society_name,property_title)SELECT sub, '$ll_details', '$sm_user', '$sessionname', '$sessionshop', '$row_lead_id', '$row_lead_id', ll_logno, status, '', admin_id, rece_id, '$ibpid','$row_proid_proid','$l_prodt','$mul_procode', '$project_society_name','$property_title' FROM npb_lead_log WHERE ll_leadid='" . $row_lead_id . "' limit 1");

                $lead_update = DB::update("update npb_lead_create_multi set lead_count = lead_count+1,r_employee = '',l_employee = '" . $centerid . "',ibpid = '" . $ibpid . "',source = '" . $pre_source . "',vendor = '" . $pre_vendor . "',mul_proid = '" . $row_proid_proid . "',mul_proname = '" . $l_prodt . "',l_prodt = '" . $l_prodt . "',mul_procode = '" . $mul_procode . "',ltype = '',ctype = '',fDate = '',fTime = '',dtime = '',fll_details = '',fll_fillby = '' where lead_id='" . $row_lead_id . "'  AND  project_society_name='" . $project_society_name . "'");

                $lead_update = DB::update("update npb_lead_create_multi set l_itos = '',l_rs = '',l_rsl = '',l_hqc = '',l_lhs = '',l_hc = '',l_ld = '',l_pcfn = '',l_pcln = '',l_pce = '',l_pcn = '',l_pc3 = '',l_mydate = '" . $date12 . "',l_mydate1 = '" . $date12 . "',lead_upload_date = '" . $date12 . "',lead_create_date = '" . $date12 . "',lead_update_date = '" . $date12 . "',lead_allo_time = '" . $retime . "',lead_allo_date = '" . $date12 . "',v_date = '" . $date12 . "',l_pc = '" . $date12 . "',Property = '',loca = '',pref = '',prof = '',eadd = '',comment = '',uploadcomment = '',v_userid = '" . $user_table_id . "',v_username = '" . $user_table_name . "' where lead_id='" . $row_lead_id . "'  AND  project_society_name='" . $project_society_name . "'");

                return response(['status' => 200, 'msg' => ['Success']]);
                // }
            } else {
                return response(['status' => 200, 'msg' => ['Existing Property']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }
    public function source_list(Request $request)
    {

        // $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1){
            $centerid_fill = $request->centerid;
            $arr = DB::connection('mysql_second')->table('v_source1')->select('slogan as source')->where('status', 'Y')->where('slogan', '!=', 'Channel Partner')->get();
            return response(['status' => 200, 'msg' => ['Success'], 'data' => $arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }
}
