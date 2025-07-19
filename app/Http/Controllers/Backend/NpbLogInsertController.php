<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NpbLogInsertController extends Controller
{
  

    public function log_insert(Request $request) //name changed from log_insert_sale_eoi
    {
        $sub = '';
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            $req_lat = $request->latitude ?? '';
                $req_long = $request->longitude ?? '';
                $req_add = $request->geo_address ?? '';
                $req_lmk = $request->geo_landmark ?? '';
                $mul_proid = $request->mul_proid;
                $ref_id = $request->ref_id;
     
            $lead_id = $request->lead_id;
            $leadid = $request->lead_id;
            $leadcode = $request->lead_id;
            $ivoter = $request->user_name;
            $la_lc1 = $request->lead_id;
            $project_society_name = $request->project_society_name;
            $mul_proname = $request->mul_proname;
            // $followup_mediumid = $request->followup_mediumid;
            $cp_inactive_reasonid = $dead_enquiry_reasons_id = $request->dead_enquiry_reasons_id;
            $Time = $request->ftime;
            // $iadd = $request->comment;
            $iadd = html_entity_decode($request->comment);
            $Date = $request->fdate;
            $ltype = $request->ltype;
            $ltype_re = $request->ltype_re;
            $ctype = $request->ctype;
            $centerid_fill = $request->centerid;
            $pref_loc = $request->location;
            $dead_min_budget = $request->min;
            $dead_max_budget = $request->max;
            $poss_timeline = $request->year;
            $other_comment = $request->lost_reason_if_others;
            $pref_config = $request->prefConfig;
            $lost_res_area = $request->resArea;
            $lost_comm_area = $request->comArea;
            $date12 = date('Y-m-d H:i:s');
            $data_arr = array();

            // $date_coming_from_post = date_create($Date);
            $date_coming_from_post = date('Y-m-d', strtotime($Date));
            // date_add($date_coming_from_post, date_interval_create_from_date_string("60 days"));
            // $visit_expiry_60days = date_format($date_coming_from_post, "Y-m-d");
            $visit_expiry_60days = date('Y-m-d', strtotime($date_coming_from_post . ' + 60 days'));


            $followup_mediumid = $request->followup_mediumid;
            $followup_medium_name = $request->followup_medium_name;
            $next_action_id = $request->next_action_id;
            $next_action_name = $request->next_action_name;
            // $cp_inactive_reasonid = $request->cp_inactive_reasonid;
            $cp_inactive_reason = $request->cp_inactive_reason;
            // dd($request->all());


            // for sale and eoi form
            $no_of_applicant = $request->no_of_applicant ?? '';
            $applicants_names = $request->applicants_name;

            $applicants = explode(',', $applicants_names);
            foreach ($applicants as $key => $applicant) {
                $applicants[$key] = trim($applicant, '[ ]');
            }
            $applicant1 = $applicants[0] ?? '';
            $applicant2 = $applicants[1] ?? '';
            $applicant3 = $applicants[2] ?? '';
            $applicant4 = $applicants[3] ?? '';

            // $agreement_val = $request->agreement_val ?? '';
            $applicant_mobno = $request->applicant_mobno ?? '';
            $relation_with_lead = $request->relation_with_lead ?? '';
            // $unit_no = $request->unit_no ?? '';
            // $wing = $request->wing ?? '';
            // $carpet_area = $request->carpet_area ?? '';


            $lead_stage = '';
            $lead_stage_id = '';
            $ltype_id = '';

            if ($ltype == 'Lost') {
                $lead_stage = 'Unqualified';
                $lead_stage_id = '6';
            } elseif ($ltype == 'New Lead') {
                $lead_stage = 'Incoming';
                $lead_stage_id = '1';
            } elseif ($ltype == 'In Followup') {
                $lead_stage = 'Prospect';
                $lead_stage_id = '2';
            } elseif ($ltype == 'Site Visit Schedule') {
                $lead_stage = 'Opportunity';
                $lead_stage_id = '3';
            } elseif ($ltype == 'Site Visits - Done' || $ltype == 'Revisit - 1 Proposed' || $ltype == 'Revisit - 2 Proposed' || $ltype == 'Revisit - 3 Proposed' || $ltype == 'Revisit - 4 Proposed' || $ltype == 'Revisit - 5 Proposed' || $ltype == 'Revisit - 1' || $ltype == 'Revisit - 2' || $ltype == 'Revisit - 3' || $ltype == 'Revisit - 4' || $ltype == 'Revisit - 5') {
                $lead_stage = 'Qualified';
                $lead_stage_id = '4';
            } else {
                $lead_stage = '';
                $lead_stage_id = '';
            }


            /*------------------------------------------- For Lead Stage Log Data Start Here ----------------------------------------*/
            $old_lead_multi = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['lead_id' => $lead_id, 'project_society_name' => $project_society_name])->first(['lead_stage', 'lead_stage_id', 'ltype', 'ltype_id']);

            $from_lead_stage_old = (isset($old_lead_multi->lead_stage) && !empty($old_lead_multi->lead_stage)) ? $old_lead_multi->lead_stage : '';
            $from_lead_stage_id_old = (isset($old_lead_multi->lead_stage_id) && !empty($old_lead_multi->lead_stage_id)) ? $old_lead_multi->lead_stage_id : '';
            $to_lead_stage = $lead_stage;
            $to_lead_stage_id = $lead_stage_id;
            $ltype_old = (isset($old_lead_multi->ltype) && !empty($old_lead_multi->ltype)) ? $old_lead_multi->ltype : '';
            $ltypeid_old = (isset($old_lead_multi->ltype_id) && !empty($old_lead_multi->ltype_id)) ? $old_lead_multi->ltype_id : '';
            $ltype_new = $ltype;
            $ltypeid_new = $ltype_id;
            $activity_datetime = date('Y-m-d H:i:s');
            $lead_stage_l_employee = $request->centerid;
            $next_follow_date_time = (isset($request->fdate) && !empty($request->fdate)) ? date('Y-m-d', strtotime($request->fdate)) : '';
            $lead_stage_remark = (isset($request->comment) && !empty($request->comment)) ? $request->comment : '';

            /*------------------------------------------- For Lead Stage Log Data Ends Here ----------------------------------------*/






            // $res_pro = DB::connection('mysql_second')->table('products')->where(['id' => $mul_proid])->first(['id', 'name', 'pro_name']);
            // $res_pro_ = json_decode(json_encode($res_pro), True);
            // $row_proid_proid = (isset($res_pro_['id']) ? $res_pro_['id'] : 0);
            // $mul_procode = (isset($res_pro_['name']) ? $res_pro_['name'] : 0);
            // $mul_proname = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] : 0);


            $res_ltype = DB::connection('mysql_second')->table('followup_status')->where(['name' => $ltype])->where('status', '=', 'Y')->first(['id']);
            $res_ltype_ = json_decode(json_encode($res_ltype), True);
            $ltype_id = (isset($res_ltype_['id']) ? $res_ltype_['id'] : 0);


            $res_ctype = DB::connection('mysql_second')->table('ctype_master')->where(['name' => $ctype])->where('status', '=', 'Y')->first(['id']);
            $res_ctype_ = json_decode(json_encode($res_ctype), True);
            $ctype_id = (isset($res_ctype_['id']) ? $res_ctype_['id'] : 0);

            $res_lead_multi = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['lead_id' => $lead_id, 'project_society_name' => $project_society_name])->first(['ctype', 'mul_proname', 'mul_procode', 'mul_proid', 'mul_cp', 'mul_cpsm', 'mul_dst', 'r_employee', 'stype1', 'mul_source', 'mul_vendor', 'l_fname','property_title']);
            $res_lead_multi_ = json_decode(json_encode($res_lead_multi), True);
            $sm_id = (isset($res_lead_multi_['mul_cpsm']) ? $res_lead_multi_['mul_cpsm'] : 0);
            $csm_id = (isset($res_lead_multi_['mul_dst']) ? $res_lead_multi_['mul_dst'] : 0);
            $mul_cp = (isset($res_lead_multi_['mul_cp']) ? $res_lead_multi_['mul_cp'] : 0);
            $mul_cpsm = (isset($res_lead_multi_['mul_cpsm']) ? $res_lead_multi_['mul_cpsm'] : 0);
            $mul_dst = (isset($res_lead_multi_['mul_dst']) ? $res_lead_multi_['mul_dst'] : 0);
            $mul_ctype = (isset($res_lead_multi_['ctype']) ? $res_lead_multi_['ctype'] : 0);
            $stype1stype1 = (isset($res_lead_multi_['stype1']) ? $res_lead_multi_['stype1'] : 0);
            $mul_procode1 = (isset($res_lead_multi_['mul_procode']) ? $res_lead_multi_['mul_procode'] : 0);
            $mul_proid1 = (isset($res_lead_multi_['mul_proid']) ? $res_lead_multi_['mul_proid'] : 0);
            $mul_proname1 = (isset($res_lead_multi_['mul_proname']) ? $res_lead_multi_['mul_proname'] : 0);
            //  print_r($mul_proname1);
            $mul_source = (isset($res_lead_multi_['mul_source']) ? $res_lead_multi_['mul_source'] : 0);
            $mul_vendor = (isset($res_lead_multi_['mul_vendor']) ? $res_lead_multi_['mul_vendor'] : 0);
            $lead_name = (isset($res_lead_multi_['l_fname']) ? $res_lead_multi_['l_fname'] : 0);
            $property_title = (isset($res_lead_multi_['property_title']) ? $res_lead_multi_['property_title'] : 0);
            // $mul_proname = $mul_proname1+1;
            $mul_proname = $mul_proname1;
            $mul_procode = '';


            if ($ctype == 'Booked' || $ctype == 'EOI') {
                $unit_no_count = $request->unit_no_count;
                if ($unit_no_count > 0) {



                    $unit_no_arr = $request->unit_no_arr;
                    $unit_no_arr = explode(',', $unit_no_arr);
                    // $unit_nos = [101, 102, 102];
                    // foreach ($unit_no_arr as $key => $unit_no_arrs) {
                    //     $unit_no_arrs[$key] = trim($unit_no_arrs, '[ ]');
                    // }

                    $wing_arr = $request->wing_arr;
                    $wing_arr = explode(',', $wing_arr);
                    // foreach ($wing_arr as $key => $wing_arrs) {
                    //     $wing_arrs[$key] = trim($wing_arrs, '[ ]');
                    // }

                    $agree_value_arr = $request->agree_value_arr;
                    $agree_value_arr = explode(',', $agree_value_arr);
                    // foreach ($agree_value_arr as $key => $agree_value_arrs) {
                    //     $agree_value_arrs[$key] = trim($agree_value_arrs, '[ ]');
                    // }

                    $carpet_area_arr = $request->carpet_area_arr;
                    $carpet_area_arr = explode(',', $carpet_area_arr);
                    // foreach ($carpet_area_arr as $key => $carpet_area_arrs) {
                    //     $carpet_area_arrs[$key] = preg_replace('/\[|\]/', '', (string)$carpet_area_arrs, 1);
                    // }
                    // print_r(preg_replace('/\[|\]/', '', (string)$carpet_area_arr[2], 1));
                    // die();

                    for ($iter = 0; $iter < $unit_no_count; $iter++) {
                        $booked_insert = DB::connection('mysql_second')->insert("INSERT INTO w3techerp_customer_npb(title, co_title, co_title_two, co_title_three,applicant_number,relation_with_lead,agreement_val,unit_type,wing,w3techerp_carea,mul_proid,ctype_status,ctype_status_id,av_leadid,proid,w3techerp_an,w3techerp_rv,w3techerp_pre,bookdate,av_lemployee,av_remployee,av_source,av_ctype) VALUES ('" . $applicant1 . "','" . $applicant2 . "','" . $applicant3 . "','" . $applicant4 . "','" . $applicant_mobno . "','" . $relation_with_lead . "','" . preg_replace('/\[|\]/', '', (string)$agree_value_arr[$iter], 1) . "','" . preg_replace('/\[|\]/', '', (string)$unit_no_arr[$iter], 1) . "','" . preg_replace('/\[|\]/', '', (string)$wing_arr[$iter], 1) . "','" . preg_replace('/\[|\]/', '', (string)$carpet_area_arr[$iter], 1) . "','" . $mul_proid . "','" . $ctype . "','" . $ctype_id  . "','" . $leadid  . "','" . $mul_proid  . "','" . $lead_name  . "','" . preg_replace('/\[|\]/', '', (string)$agree_value_arr[$iter], 1)  . "','" . preg_replace('/\[|\]/', '', (string)$agree_value_arr[$iter], 1)  . "','" . $date12  . "','" . $centerid_fill  . "','" . $centerid_fill  . "','" . $mul_source  . "','" . $ctype  . "')");
                    }
                }
         
            }

       
            $res_user1 = DB::connection('mysql_second')->table('register')->where(['id' => $centerid_fill, 'usertype' => 'Channel Partner'])->first(['id', 'username', 'usertype']);
            $res_user1_ = json_decode(json_encode($res_user1), True);
            $sessionname = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $user_table_id = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $self_table_id = $centerid_fill;
            $sm_user = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
            $user_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
            $sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
            $user_table_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
            $sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);

            $lead_stage_userid = (isset($res_user1_['id']) ? $res_user1_['id'] : 0);
            $lead_stage_user_type = (isset($res_user1_['role_type']) ? $res_user1_['role_type'] : 0);

            $l_employee = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Site Visits - Done')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

            if (count($l_employee) > 0) {
                if ($ltype == 'Site Visits - Done') {
              

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',site_update_date = '" . $date12 . "',stype = 'Site Visits - Done', ltype = '" . $ltype . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_visit_schedule where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "' AND status != 'Done' order by id DESC limit 1");

                    if (count($l_schedule) > 0) {
                        $l_visitschedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Site Visits - Done')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");
                        if (count($l_visitschedule) == 0) {
                            $date12_visit = date('Y-m-d');
                            $date12t_visit = date(' H:i');
                            $hla_presales1 = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_visit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Done','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "')");
                        } else {
                        }
                    } else {
                        $date12_visit = date('Y-m-d');
                        $date12t_visit = date(' H:i');
                        $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_visit_schedule set site_visit_date = '" . $date12_visit . "',site_visit_time = '" . $date12t_visit . "',update_date1 = '" . $date12 . "',update_userid = '" . $user_table_id . "', update_username = '" . $user_table_name . "',status = 'Done' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "' AND status != 'Done' order by id DESC limit 1");
                    }
                }
                ////ENded Site visit

                elseif ($ltype == 'Site Visit Schedule') {
               

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',visit_schedule_date1 = '" . $date12 . "', ltype = '" . $ltype . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',visit_schedule_date = '" . $Date . "', visit_schedule_time = '" . $Time . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', visit_schedule_userid = '" . $user_table_id . "', visit_schedule_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_visit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $Date . "','" . $Time . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "')");
                }

                ///Ended Site Visit Schedule


                elseif ($ltype == 'Site Visit Schedule') {
             

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ltype = '" . $ltype . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', status = 'N',dead_update_date = '" . $date12 . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");
                } else {
           

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "', ltype = '" . $ltype . "', ctype = '" . $ctype . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', fsub = '" . $sub . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");
                }
            } else {


                $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "', ltype = '" . $ltype . "', ctype = '" . $ctype . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', fsub = '" . $sub . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");
            }



            if ($mul_ctype != 'Booked') {
                if ($ctype == 'Booked') {
 
                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set sale_update_date = '" . $date12 . "',stype1 = 'Site Visits - Done', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "'  where lead_id='" . $leadid . "' AND mul_proid='" . $mul_proid . "'");
                }
            }


            if ($ltype_re == 'Revisit - 1') {
                $ltype = 'Site Visits - Done';
                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 1')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

           

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit1_date = '" . $date12_visit . "',  fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "',  status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    // $lead_update = DB::connection('mysql_second')->update("update lead_create set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit1_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit1_date = '" . $date12_visit . "', revisit1_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit1_userid = '" . $user_table_id . "', revisit1_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "' where id='" . $leadid . "' AND mul_proid='" . $mul_proid . "'");

                    // $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit1_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit1_date = '" . $date12_visit . "', revisit1_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit1_userid = '" . $user_table_id . "', revisit1_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND mul_proid='" . $mul_proid . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit1')");
                } else {
                }
            }
            ///Ended Revisit 1

            if ($ltype_re == 'Revisit - 2') {
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');

                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 2')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

 

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit2_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit2_date = '" . $date12_visit . "', revisit2_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit2_userid = '" . $user_table_id . "', revisit2_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit2')");
                } else {
                }
            }


            if ($ltype_re == 'Revisit - 2') {
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');

                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 2')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

            

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit2_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit2_date = '" . $date12_visit . "', revisit2_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit2_userid = '" . $user_table_id . "', revisit2_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit2')");
                } else {
                }
            }

            if ($ltype_re == 'Revisit - 3') {
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');

                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 3')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

     

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit3_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit3_date = '" . $date12_visit . "', revisit3_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit3_userid = '" . $user_table_id . "', revisit3_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit3')");
                } else {
                }
            }

            if ($ltype_re == 'Revisit - 4') {
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');

                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 4')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

           

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit4_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit4_date = '" . $date12_visit . "', revisit4_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit4_userid = '" . $user_table_id . "', revisit4_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit4')");
                } else {
                }
            }
            if ($ltype_re == 'Revisit - 5') {
                $ltype = 'Site Visits - Done';
                $date12_visit = date('Y-m-d');
                $date12t_visit = date(' H:i');

                $l_schedule = DB::connection('mysql_second')->select("select * from npb_lead_log where (ltype = 'Revisit - 5')  AND ll_leadid='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                if (count($l_schedule) > 0) {
                    $date12_visit = date('Y-m-d');
                    $date12t_visit = date(' H:i');

       

                    $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set log_update_date = '" . $date12 . "',resite_update_date = '" . $date12 . "',revisit5_date1 = '" . $date12 . "', ltype = '" . $ltype_re . "',fDate = '" . $Date . "',visit_expiry_60days = '" . $visit_expiry_60days . "', fTime = '" . $Time . "',revisit5_date = '" . $date12_visit . "', revisit5_time = '" . $date12t_visit . "', fll_details = '" . $iadd . "', fll_fillby = '" . $ivoter . "', ctype = '" . $ctype . "', fsub = '" . $sub . "', revisit5_userid = '" . $user_table_id . "', revisit5_username = '" . $user_table_name . "', status = 'Y', ctype_id = '" . $ctype_id . "', ltype_id = '" . $ltype_id . "', lead_stage = '" . $lead_stage . "', lead_stage_id = '" . $lead_stage_id . "', followup_mediumid='" . $followup_mediumid . "' , followup_medium='" . $followup_medium_name . "' , next_followup_mediumid='" . $next_action_id . "' , next_followup_medium='" . $next_action_name . "' , dead_enquiry_reasons_id='" . $cp_inactive_reasonid . "' , dead_reason = '" . $cp_inactive_reason . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

                    $leadmulti_update = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_revisit_schedule(lead_id, mul_proid, mul_proname, mul_procode, lead_id_mul, mul_source, mul_vendor, site_visit_date, site_visit_time, status, username, userid, insert_date1, mul_cp, mul_cpsm, mul_dst, type) VALUES ('" . $leadid . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $leadid . "','" . $mul_source . "','" . $mul_vendor . "','" . $date12_visit . "','" . $date12t_visit . "','Pending','" . $user_table_name . "','" . $user_table_id . "','" . $date12 . "','" . $mul_cp . "','" . $mul_cpsm . "','" . $mul_dst . "','Revisit5')");
                } else {
                }
            }

            ///Ended Revsit 3
            $folloup_medium = DB::connection('mysql_second')->table('followup_medium')->where(['id' => $followup_mediumid, 'status' => 'Y'])->first(['name']);
            $folloup_medium_ = json_decode(json_encode($folloup_medium), True);
            $followup_medium = (isset($folloup_medium_['name']) ? $folloup_medium_['name'] : 0);

            $reason_medium = DB::connection('mysql_second')->table('dead_enquiry_reasons')->where(['id' => $dead_enquiry_reasons_id])->first(['reason']);
            $reason_medium_ = json_decode(json_encode($reason_medium), True);
            $dead_reason = (isset($reason_medium_['reason']) ? $reason_medium_['reason'] : 0);

            $lead_log_countquery = DB::connection('mysql_second')->select("select count(id) as lead_log_count from npb_lead_log where ll_leadid='" . $leadid . "' and project_society_name='" . $project_society_name . "' and ll_fillby='" . $ivoter . "' and lead_log_count_status='1'");
            $folloup_medium_ = json_decode(json_encode($lead_log_countquery), True);
            $lead_log_count = (isset($folloup_medium_[0]['lead_log_count']) ? $folloup_medium_[0]['lead_log_count'] : 0);

            $date12 = date('Y-m-d H:i:s');
            $lead_log_count_full = $lead_log_count + 1;

        

            $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set lead_log_count = '" . $lead_log_count_full . "',active_date = '" . $date12 . "',active_userid = '" . $user_table_id . "',active_username = '" . $user_table_name . "', dead_enquiry_reasons_id = '" . $dead_enquiry_reasons_id . "', dead_reason = '" . $dead_reason . "',pref_loc = '" . $pref_loc . "',dead_min_budget = '" . $dead_min_budget . "',dead_max_budget = '" . $dead_max_budget . "',poss_timeline = '" . $poss_timeline . "',other_comment='" . $other_comment . "',pref_config='" . $pref_config . "',lost_res_area='" . $lost_res_area . "',lost_comm_area='" . $lost_comm_area . "' where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");

            if ($ltype_re == 'Revisit - 1') {
                $ltype = $ltype_re;
            }

            if ($ltype_re == 'Revisit - 2') {
                $ltype = $ltype_re;
            }

            if ($ltype_re == 'Revisit - 3') {
                $ltype = $ltype_re;
            }
            if ($ltype_re == 'Revisit - 4') {
                $ltype = $ltype_re;
            }
            if ($ltype_re == 'Revisit - 5') {
                $ltype = $ltype_re;
            }

            $centeruser_idddd = $request->centerid;

            if ($centeruser_idddd == '9' or $centeruser_idddd == '24') {
                $date12 = date('Y-m-d H:i:s');

                $leadmulti_update = DB::connection('mysql_second')->update("update npb_lead_create_multi set presales = 'Y',presales_date = '" . $date12 . "'  where lead_id='" . $leadid . "' AND project_society_name='" . $project_society_name . "'");
            }
            $highest_id = '';
            $status = '';
            $leadmulti_updatedd = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_log(ll_logno,sub,Date,Time,ll_details,ll_fillby,ll_username,ll_shop_id,ll_leadcode,ll_leadid,ltype,ctype,sm_id,csm_id,log_create_date,log_update_date,mul_proid,mul_proname,mul_procode, dead_enquiry_reasons_id, dead_reason, status2, followup_medium, followup_mediumid, lead_log_count, lead_log_count_status, lead_from_app_web, ltype_id, ctype_id, lead_stage, lead_stage_id,next_followup_mediumid,next_followup_medium, min_budget, max_budget, pref_loc, poss_timeline, other_comment, pref_config, lost_res_area, lost_comm_area, latitude, longitude, geo_address, geo_landmark, project_society_name,cp_id,property_title,ref_id) VALUES ('" . $highest_id . "','" . $sub . "','" . $Date . "','" . $Time . "','" . $iadd . "','" . $ivoter . "','" . $centeruser_idddd . "','" . $ivoter . "','" . $leadcode . "','" . $leadid . "','" . $ltype . "','" . $ctype . "','" . $sm_id . "','" . $csm_id . "','" . $date12 . "','" . $date12 . "','" . $mul_proid . "','" . $mul_proname . "','" . $mul_procode . "','" . $dead_enquiry_reasons_id . "','" . $dead_reason . "','" . $status . "','" . $followup_medium . "','" . $followup_mediumid . "','" . $lead_log_count_full . "','1','app','" . $ltype_id . "','" . $ctype_id . "','" . $lead_stage . "','" . $lead_stage_id . "','" . $next_action_id . "','" . $next_action_name . "','" . $dead_min_budget . "','" . $dead_max_budget . "','" . $pref_loc . "','" . $poss_timeline . "','" . $other_comment . "','" . $pref_config . "','" . $lost_res_area . "','" . $lost_comm_area . "',
            '" . $req_lat . "', '" . $req_long . "', '" . $req_add . "', '" . $req_lmk . "' , '" . $project_society_name . "','" . $centeruser_idddd . "','" . $property_title . "', '" . $ref_id . "')");


            // $insert_lead_stage_log_data['lead_id'] = $lead_id;
            // $insert_lead_stage_log_data['mul_proid'] = $mul_proid;
            // $insert_lead_stage_log_data['userid'] = $lead_stage_userid;
            // $insert_lead_stage_log_data['user_type'] = $lead_stage_user_type;
            // $insert_lead_stage_log_data['from'] = $from_lead_stage_old;
            // $insert_lead_stage_log_data['from_id'] = $from_lead_stage_id_old;
            // $insert_lead_stage_log_data['to'] = $to_lead_stage;
            // $insert_lead_stage_log_data['to_id'] = $to_lead_stage_id;
            // $insert_lead_stage_log_data['ltype_old'] = $ltype_old;
            // $insert_lead_stage_log_data['ltypeid_old'] = $ltypeid_old;
            // $insert_lead_stage_log_data['ltype_new'] = $ltype_new;
            // $insert_lead_stage_log_data['ltypeid_new'] = $ltypeid_new;
            // $insert_lead_stage_log_data['remark'] = $lead_stage_remark;
            // $insert_lead_stage_log_data['next_follow_date_time'] = $next_follow_date_time;
            // $insert_lead_stage_log_data['activity_datetime'] = $activity_datetime;
            // $insert_lead_stage_log_data['l_employee'] = $lead_stage_l_employee;
            // $insert_lead_stage_log_data['lead_from_app_web'] = 'app';
            // DB::connection('mysql_second')->table('lead_stage_log')->insert($insert_lead_stage_log_data);

            return response(['status' => 200, 'msg' => ['Success']]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }

}
