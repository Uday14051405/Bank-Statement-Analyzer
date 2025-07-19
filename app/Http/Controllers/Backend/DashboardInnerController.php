<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardInnerController extends Controller
{
    public function index(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $arr = array();
            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            #$headcenter = DB::table('headcenter')->where(['id'=>$request->centerid])->get()->toArray();

            $total_Sale_nt = DB::table('lead_create_multi')->where([$column => $request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->get(['lead_id', 'mul_procode', 'mul_source'])->toArray();

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
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            $query = DB::table('lead_create_multi')->where([$column => $request->centerid])->where('display_status', '!=', 'N');
            $querynew = DB::table('lead_create_multi')->where('display_status', '!=', 'N');
            $querycp = DB::table('temp_lead_cp_app')->where(['cp_id' => $request->centerid]);
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
                $query = $query->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day7, $day1]);
            } elseif ($dash_type == 'misseds18') {
                $query = $query->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day9, $day8]);
            } elseif ($dash_type == 'site_visit_expired') {
                $query = $query->whereBetween('visit_expiry_60days', [$day9, $day_3]);
            } elseif ($dash_type == 'total_visit_lost') {
                $query = $query->where(['ctype' => 'Lost'])->where('visit_expiry_60days','<=', $today);
                // $query = $query->where(['ctype' => 'Lost']);
            } elseif ($dash_type == 'npb_vdnp_leads') {
                $query = $querynew->where('npb_lead_status', '=', 'Open');
            } elseif ($dash_type == 'site_visits_done') {
                $query = $query->whereIn('ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3']);
            }
            // }elseif ($dash_type == 'pre_visit_tagging') {
            //     $query = $querycp->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today);
            // }
            else {
                $query = $query->where([$column1 => $request->dash_type]);
            }


            if ($request->role_type == 'Presales') {
                $query = $query->where('r_employee', '=', '')->orwhere('r_employee', '=', 'None')->orWhereNull('r_employee');
            }
            $data = $query->orderBy('lead_id', 'desc')->get(['mul_proid', 'lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details', 'lead_id'])->toArray();
            #ssdd($data);
            $resultArray = json_decode(json_encode($data), true);

            foreach ($resultArray as $key => $val) {
                $primary_source = DB::table('lead_create_multi')->where(['lead_id' => $val['lead_id']])->pluck('source')->toArray();
                $l_employee = DB::table('headcenter')->where(['id' => $val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id' => $val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id' => $val['ibpid']])->pluck('iname')->toArray();
                $val['primary_source'] = (count($primary_source) > 0) ? $primary_source[0] : '';
                $val['l_employee'] = (count($l_employee) > 0) ? $l_employee[0] : '';
                $val['r_employee'] = (count($r_employee) > 0) ? $r_employee[0] : '';
                $val['ibpid'] = (count($ibpid) > 0) ? $ibpid[0] : '';

                $cpsm_arr   = DB::table('headcenter')->select('itel', 'iname')->where(['project_id' => $val['mul_proid'],'iname' => $val['l_employee'], 'role' => 'CPSM', 'status' => 'Active'])->first();
                $val['cpsm_name'] = (isset($cpsm_arr->iname) && !empty($cpsm_arr->iname)) ? $cpsm_arr->iname : '';
                $val['cpsm_number'] = (isset($cpsm_arr->itel) && !empty($cpsm_arr->itel)) ? $cpsm_arr->itel : '';
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['Dashboard View Success'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }


    public function tag_expiry(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->project_name != '') {
                $today = date('Y-m-d');
                $day_3 = date('Y-m-d', strtotime('+3 day'));
                $total_tag_expire = DB::table('temp_lead_cp_app')->where(['cp_id' =>  $request->centerid, 'project_name' => $request->project_name])->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->whereBetween('expiry', [$today, $day_3])->get();
                return response(['status' => 200, 'msg' => ['Tag Expiry'], 'data' => $total_tag_expire]);
            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }


    
    public function pre_visit_tagging(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->project_name != '') {
                $today = date('Y-m-d');
                $day_3 = date('Y-m-d', strtotime('+3 day'));
                $total_tag_expire = DB::table('temp_lead_cp_app')->where(['cp_id' =>  $request->centerid, 'project_name' => $request->project_name])->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->get();


                $resultArray = json_decode(json_encode($total_tag_expire), true);

                foreach ($resultArray as $val) {
                    $cpsm_arr   = DB::table('headcenter')->select('ihand', 'iname')->where(['id' => $val['cpsm_id']])->first();
                    $val['cpsm_name'] = (isset($cpsm_arr->iname) && !empty($cpsm_arr->iname)) ? $cpsm_arr->iname : '';


      
                    $data_arr[] = $val;
                }

                return response(['status' => 200, 'msg' => ['Pre Visit Tagging'], 'data' => $data_arr]);
            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }

    // public function tag_expiry(Request $request)
    // {
    //     $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    //     if ($user == 1) {
    //         if ($request->project_name != '') {
    //             $today = date('Y-m-d');
    //             $day_3 = date('Y-m-d', strtotime('+3 day'));
    //             $total_tag_expire = DB::table('temp_lead_cp_app')->where(['cp_id' =>  $request->centerid, 'project_name' => $request->project_name])->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->whereBetween('expiry', [$today, $day_3])->get();
    //             return response(['status' => 200, 'msg' => ['Tag Expiry'], 'data' => $total_tag_expire]);
    //         } else {
    //             return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
    //         }
    //     } else {
    //         return response(['status' => 404, 'msg' => ['User not login']]);
    //     }
    // }




    public function tag_expiry_date_reschedule(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->id != '') {

                $visit_type = (isset($request->visit_type) && !empty($request->visit_type))?$request->visit_type:'';
                

                $count_visit = (isset($visit_type) && !empty($visit_type) && $visit_type == 'Expiry')?'2':'1';

                $site_visit_date      = date('Y-m-d', strtotime($request->site_visit_date));
                $expiry      = date('Y-m-d', strtotime($request->site_visit_date . ' + 6 days'));
                $propose_arr = DB::table('temp_lead_cp_app')->where('id', $request->id)->update(['site_visit_date' => $site_visit_date, 'site_visit_time' => $request->site_visit_time, 'expiry' => $expiry,'revisit_count' => $count_visit]);
                if (isset($propose_arr) && !empty($propose_arr)) {
                    return response(['status' => 200, 'msg' => ['ReSchedule Done']]);
                } else {
                    return response(['status' => 200, 'msg' => ['Something Not Right']]);
                }



            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }





    public function tag_propose(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->project_name != '') {
                $today = date('Y-m-d');
                $propose_arr = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where('cp_id', $request->centerid)->where('project_name', $request->project_name)->orderBy('id', 'desc')->get()->toArray();

                $resultArray = json_decode(json_encode($propose_arr), true);

                foreach ($resultArray as $val) {
                    $cpsm_arr   = DB::table('headcenter')->select('ihand', 'iname')->where(['project_id' => $val['project_id'], 'role' => 'CPSM', 'status' => 'Active'])->first();
                    $val['cpsm_name'] = (isset($cpsm_arr->iname) && !empty($cpsm_arr->iname)) ? $cpsm_arr->iname : '';
                    $val['cpsm_number'] = (isset($cpsm_arr->ihand) && !empty($cpsm_arr->ihand)) ? $cpsm_arr->ihand : '';

                    // $data_arr['site_visit_date'] = (isset($val['site_visit_date']) && !empty($val['site_visit_date']))?date('d, F Y', strtotime($val['site_visit_date'])):date('Y-m-d');
                    // $data_arr['site_visit_date'] = $val['site_visit_date'];
                    $data_arr[] = $val;
                }

                return response(['status' => 200, 'msg' => ['Tag Proposed'], 'data' => $data_arr]);
            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }


    public function micro_site_tag_propose(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->project_name != '') {
                $today = date('Y-m-d');
                $propose_arr = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where('cp_id', $request->centerid)->where('project_name', $request->project_name)->where('real_mobile_no', '!=', '')->where('form_fill','=','micro_website')->orderBy('created_on', 'desc')->get();
                return response(['status' => 200, 'msg' => ['Tag Proposed'], 'data' => $propose_arr]);
            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }




    public function tag_expiry_lost(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            if ($request->id != '') {
                $lead_status      = 'LOST';
                $propose_arr = DB::table('temp_lead_cp_app')->where('id', $request->id)->update(['lead_status' => $lead_status]);
                if (isset($propose_arr) && !empty($propose_arr)) {
                    return response(['status' => 200, 'msg' => ['Lead Lost']]);
                } else {
                    return response(['status' => 200, 'msg' => ['Something Not Right']]);
                }
            } else {
                return response(['status' => 404, 'msg' => ['Please Select Project Name']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }



}