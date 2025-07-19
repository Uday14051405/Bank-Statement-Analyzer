<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardInnernewController extends Controller
{
    public function index(Request $request)
    {
        $user = DB::connection('mysql_second')->table('user1')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $arr = array();
            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            $column = ($request->usertype == 'ibp') ? 'ibpid' : 'l_employee';

            #$headcenter = DB::connection('mysql_second')->table('headcenter')->where(['id'=>$request->centerid])->get()->toArray();

            $total_Sale_nt = DB::connection('mysql_second')->table('lead_create_multi')->where([$column => $request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->get(['lead_id', 'mul_procode', 'mul_source'])->toArray();

            $arr['total_Sale_nt']   = $total_Sale_nt;
            #$arr['headcenter']   = json_decode(json_encode($headcenter), true);
            #dd($arr);

            return response(['status' => 200, 'msg' => ['Dashboard Success'], 'data' => $arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }

    public function view(Request $request)
    {
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        
      $today = date('Y-m-d');
      $day_3 = date('Y-m-d', strtotime('+3 day'));
      //  $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
        $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            $day2 = date('Y-m-d', strtotime('-2 day'));  
            $day3 = date('Y-m-d', strtotime('-3 day')); 
            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            $query = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where('display_status', '!=', 'N');
            $querynew = DB::connection('mysql_second')->table('npb_lead_create_multi')->where('display_status', '!=', 'N');
            $querynpb = DB::connection('mysql_second')->table('npb_lead_create_multi')->where('display_status', '!=', 'N')->where([$column => $request->centerid]);
          //  $querylcm = DB::connection('mysql_second')->table('lead_create_multi')->where('display_status', '!=', 'N')->where([$column => $request->centerid]);
            $dash_type = $request->dash_type;
            $source = $request->source;
            $proid = $request->proid;
            $column1 = ($dash_type == 'Site Visit Schedule' || $dash_type == 'Site Visits - Done') ? 'ltype' : 'ctype';


            #$da = DB::select("select DISTINCT lead_create_multi.* from lead_create_multi where id != '' AND display_status != 'N' AND l_employee = '24' AND lead_create_multi.ltype not in ('incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost') AND lead_create_multi.ctype != 'Lost' AND (r_employee = '' OR r_employee = 'None' OR r_employee IS NULL)  AND lead_create_multi.fDate between '2022-01-16' and '2022-01-22' order by lead_create_multi.fDate ASC");
            #dd($da);

            if (!empty($source))
                $query = $query->where('source', '=', $source);
            if (!empty($proid))
                $query = $query->where('mul_proid', '=', $proid);

            if ($dash_type == 'Blank') {
                $query = $query->where('ltype', '=', '')->orWhereNull('ltype');
            } elseif ($dash_type == 'Today_followup') {
                $query = $query->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->whereBetween('fDate', [$from_date, $to_date]);
            } elseif ($dash_type == 'Today_SiteVisitsProspect') {
                $query = $query->where(['ltype' => 'Site Visit Schedule'])->whereBetween('fDate', [$from_date, $to_date]);
            } elseif ($dash_type == 'misseds14') {
                $query = $query->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day2, $day1]);
            } elseif ($dash_type == 'misseds18') {
                $query = $query->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day9, $day3]);
            } elseif ($dash_type == 'site_visit_expired') {
                $query = $query->whereBetween('visit_expiry_60days', [$day9, $day_3]);
            } elseif ($dash_type == 'total_visit_lost') {
                $query = $query->where(['ctype' => 'Lost'])->where('visit_expiry_60days','<=', $today);
                // $query = $query->where(['ctype' => 'Lost']);
            } elseif ($dash_type == 'npb_vdnp_leads') {
                $query = $querynew->where('npb_lead_status', '=', 'Open');
            } elseif ($dash_type == 'npb_today_followup') {
                $query = $querynpb->whereBetween('fDate', [$from_date, $to_date]);
            }elseif ($dash_type == 'npb_followup_missed') {
                $query = $querynpb->whereBetween('fDate', [$day9, $day1]);
            }
            elseif ($dash_type == 'npb_Warm') {
                $query = $querynpb->where('ctype', '=', 'Warm');
            }elseif ($dash_type == 'npb_Hot') {
                $query = $querynpb->where('ctype', '=', 'Hot');
            }elseif ($dash_type == 'npb_Cold') {
                $query = $querynpb->where('ctype', '=', 'Cold');
            }
            elseif ($dash_type == 'nbp_lost') {
                $query = $querynpb->where('ctype', '=', 'Lost');
            }  elseif ($dash_type == 'npb_booked') {
                $query = $querynpb->where('ctype', '=', 'Booked');
            }
            elseif ($dash_type == 'my_subscribed_leads') {
                $query = $querynpb->where('npb_lead_status', '=', 'Subscribed');
            }
            elseif ($dash_type == 'HM_Leads') {
                $query = $querynpb->where('source', '=', 'Housing Magic');
            }
            elseif ($dash_type == 'microsite_lead') {
                $query = $querynpb->where('source', '=', 'Microsite');
            }
            elseif ($dash_type == 'my_leads') {
                $query = $querynpb->where('add_new_customer_status', '=', 'Y');
            }
             elseif ($dash_type == 'site_visits_done') {
                $query = $query->whereIn('ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3']);
            }else {
                $query = $query->where([$column1 => $request->dash_type]);
            }


            if ($request->usertype == 'Presales') {
                $query = $query->where('r_employee', '=', '')->orwhere('r_employee', '=', 'None')->orWhereNull('r_employee');
            }
            // if($dash_type=='npb_vdnp_leads'){
            //     $data = $querynew->orderBy('lead_id', 'desc')->get(['mul_proid', 'lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details', 'lead_id', 'l_rs_max'])->toArray();
            // }elseif($dash_type=='my_subscribed_leads' || $dash_type=='npb_today_followup'){
            //     $data = $querynpb->orderBy('lead_id', 'desc')->get(['mul_proid', 'lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details', 'lead_id', 'l_rs_max'])->toArray();
            // }            
            // else{
            $data = $query->orderBy('lead_id', 'desc')->get(['mul_proid', 'lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid','l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details', 'lead_id', 'l_rs_max','property_title','project_society_name','ref_id'])->toArray();
            // }
            #ssdd($data);
            $resultArray = json_decode(json_encode($data), true);

            foreach ($resultArray as $key => $val) {
                $primary_source = DB::connection('mysql_second')->table('lead_create_multi')->where(['lead_id' => $val['lead_id']])->pluck('source')->toArray();
                $l_employee = DB::connection('mysql_second')->table('headcenter')->where(['id' => $val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::connection('mysql_second')->table('headcenter')->where(['id' => $val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::connection('mysql_second')->table('register')->where(['id' => $val['ibpid']])->pluck('name')->toArray();
                $val['primary_source'] = (count($primary_source) > 0) ? $primary_source[0] : '';
                $val['l_employee'] = (count($l_employee) > 0) ? $l_employee[0] : '';
                $val['r_employee'] = (count($r_employee) > 0) ? $r_employee[0] : '';
                $val['ibpid'] = (count($ibpid) > 0) ? $ibpid[0] : '';

                $number = $val['l_pno'];
                $maskedNumber = substr($number, -5); // Get the last 5 digits
                $hiddenPart = substr($number, 0, -5); // Get the part to be hidden
                $maskedHiddenPart = str_pad('', strlen($hiddenPart), '*'); // Mask the hidden part with asterisks                
                $visibleNumber = $maskedHiddenPart . $maskedNumber; // Concatenate masked parts
                if($dash_type == 'npb_vdnp_leads'){
                    $val['l_pno'] = $visibleNumber; 
                }else{
              
                }
           
                $cpsm_arr   = DB::connection('mysql_second')->table('headcenter')->select('itel', 'iname')->where(['project_id' => $val['mul_proid'],'iname' => $val['l_employee'], 'role' => 'CPSM', 'status' => 'Active'])->first();
                $val['cpsm_name'] = (isset($cpsm_arr->iname) && !empty($cpsm_arr->iname)) ? $cpsm_arr->iname : '';
                $val['cpsm_number'] = (isset($cpsm_arr->itel) && !empty($cpsm_arr->itel)) ? $cpsm_arr->itel : '';
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['Dashboard View Success'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }


    // public function tag_expiry(Request $request)
    // {
    //     $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         if ($request->project_name != '') {
    //             $today = date('Y-m-d');
    //             $day_3 = date('Y-m-d', strtotime('+3 day'));
    //             $total_tag_expire = DB::connection('mysql_second')->table('temp_lead_cp_app')->where(['cp_id' =>  $request->centerid, 'project_name' => $request->project_name])->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->whereBetween('expiry', [$today, $day_3])->get();
    //             return response(['status' => 200, 'msg' => ['Tag Expiry'], 'data' => $total_tag_expire]);
    //         } else {
    //             return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }


    // public function tag_expiry_date_reschedule(Request $request)
    // {
    //     $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         if ($request->centerid != '') {

    //             $visit_type = (isset($request->visit_type) && !empty($request->visit_type))?$request->visit_type:'';
                

    //             $count_visit = (isset($visit_type) && !empty($visit_type) && $visit_type == 'Expiry')?'2':'1';

    //             $site_visit_date      = date('Y-m-d', strtotime($request->site_visit_date));
    //             $expiry      = date('Y-m-d', strtotime($request->site_visit_date . ' + 6 days'));
    //             $propose_arr = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('id', $request->centerid)->update(['site_visit_date' => $site_visit_date, 'site_visit_time' => $request->site_visit_time, 'expiry' => $expiry,'revisit_count' => $count_visit]);
    //             if (isset($propose_arr) && !empty($propose_arr)) {
    //                 return response(['status' => 200, 'msg' => ['ReSchedule Done']]);
    //             } else {
    //                 return response(['status' => 200, 'msg' => ['Something Not Right']]);
    //             }



    //         } else {
    //             return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }





    // public function tag_propose(Request $request)
    // {
    //     $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         if ($request->project_name != '') {
    //             $today = date('Y-m-d');
    //             $propose_arr = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where('cp_id', $request->centerid)->where('project_name', $request->project_name)->orderBy('id', 'desc')->get()->toArray();

    //             $resultArray = json_decode(json_encode($propose_arr), true);

    //             foreach ($resultArray as $val) {
    //                 $cpsm_arr   = DB::connection('mysql_second')->table('headcenter')->select('ihand', 'iname')->where(['project_id' => $val['project_id'], 'role' => 'CPSM', 'status' => 'Active'])->first();
    //                 $val['cpsm_name'] = (isset($cpsm_arr->iname) && !empty($cpsm_arr->iname)) ? $cpsm_arr->iname : '';
    //                 $val['cpsm_number'] = (isset($cpsm_arr->ihand) && !empty($cpsm_arr->ihand)) ? $cpsm_arr->ihand : '';

    //                 // $data_arr['site_visit_date'] = (isset($val['site_visit_date']) && !empty($val['site_visit_date']))?date('d, F Y', strtotime($val['site_visit_date'])):date('Y-m-d');
    //                 // $data_arr['site_visit_date'] = $val['site_visit_date'];
    //                 $data_arr[] = $val;
    //             }

    //             return response(['status' => 200, 'msg' => ['Tag Proposed'], 'data' => $data_arr]);
    //         } else {
    //             return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }


    // public function micro_site_tag_propose(Request $request)
    // {
    //     $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         // if ($request->project_name != '') {
    //             $today = date('Y-m-d');
    //             $propose_arr = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where('cp_id', $request->centerid)->where('project_name', $request->project_name)->where('real_mobile_no', '!=', '')->where('form_fill','=','micro_website')->orderBy('created_on', 'desc')->get();
    //             return response(['status' => 200, 'msg' => ['Tag Proposed'], 'data' => $propose_arr]);
    //         // } else {
    //         //     return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         // }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }




    // public function tag_expiry_lost(Request $request)
    // {
    //     $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         if ($request->centerid != '') {
    //             $lead_status      = 'LOST';
    //             $propose_arr = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('id', $request->centerid)->update(['lead_status' => $lead_status]);
    //             if (isset($propose_arr) && !empty($propose_arr)) {
    //                 return response(['status' => 200, 'msg' => ['Lead Lost']]);
    //             } else {
    //                 return response(['status' => 200, 'msg' => ['Something Not Right']]);
    //             }
    //         } else {
    //             return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }



}