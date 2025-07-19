<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CpSalevController extends Controller
{

    public function view(Request $request)
    {
        #dd('Hello');
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $column = ($request->role_type == 'ibp') ? 'av_ibpid' : 'l_employee';

            #$query = DB::table('lead_create_multi')->where('display_status','!=','N');
            $query = DB::table('w3techerp_customer')->where([$column => $request->centerid]);
            #dd($query);
            $leadid     = (isset($request->lead_id) && !empty($request->lead_id)) ? $request->lead_id : '';
            $l_fname    = (isset($request->first_name) && !empty($request->first_name)) ? $request->first_name : '';
            $gen        = (isset($request->general) && !empty($request->general)) ? $request->general : '';
            $leadstatus = (isset($request->leadstatus) && !empty($request->leadstatus)) ? $request->leadstatus : '';
            $from       = (isset($request->from) && !empty($request->from)) ? $request->from : '';
            $to         = (isset($request->to) && !empty($request->to)) ? $request->to : '';


            if (!empty($leadid))
                $query = $query->where('lead_id', '=', $leadid);
            if (!empty($leadstatus))
                $query = $query->where('ltype', '=', $leadstatus);
            if (!empty($l_fname))
                $query = $query->where('l_fname', 'LIKE', $l_fname . '%');
            if (!empty($from) and ($to)) {
                $query = $query->whereBetween('l_pc_multi', [$from, $to]);
            }
            if (!empty($gen)) {
                $query = $query->where('l_fname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_code', 'LIKE', '%' . $gen . '%')->orWhere('l_email', 'LIKE', '%' . $gen . '%')->orWhere('l_lname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile1', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile2', 'LIKE', '%' . $gen . '%');
            }

            $data = $query->get(['id', 'bookdate', 'uniid', 'proid', 'rno', 'wing', 'leadname', 'w3techerp_an', 'w3techerp_cn', 'w3techerp_carea', 'w3techerp_rv', 'av_leadid'])->toArray();
            #dd($data);
            $resultArray = json_decode(json_encode($data), true);

            foreach ($resultArray as $key => $val) {

                $l_products = DB::table('products')->where(['id' => $val['proid'], 'proc_status' => 'Y'])->pluck('pro_name')->toArray();

                $l_wing = DB::table('pro_building')->where(['id' => $val['wing']])->pluck('build_name')->toArray();

                $l_wingrno = DB::table('sngl_unitconf')->where(['id' => $val['rno']])->pluck('sngluni_no')->toArray();

                /* $l_employee = DB::table('headcenter')->where(['id'=>$val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id'=>$val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id'=>$val['ibpid']])->pluck('iname')->toArray();*/

                $val['l_products'] = (count($l_products) > 0) ? $l_products[0] : '';
                $val['l_wing'] = (count($l_wing) > 0) ? $l_wing[0] : '';
                $val['l_wingrno'] = (count($l_wingrno) > 0) ? $l_wingrno[0] : '';
                /* $val['l_employee'] = (count($l_employee) > 0 ) ? $l_employee[0]:'';
                $val['r_employee'] = (count($r_employee) > 0 ) ? $r_employee[0]:'';
                $val['ibpid'] = (count($ibpid) > 0 ) ? $ibpid[0]:'';*/
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['Dashboard View Success'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }

    public function cp_form_filling(Request $request)
    {
        // $user = DB::table('user')->where(['user_name'=>$request->user_name,'ibpid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        // if($user == 1)
        // {
        $mobile_cnt          = strlen($request->mobile_no);
        if ($mobile_cnt == 5) {
            if (!DB::table('temp_lead_cp_app')->where(['mobile_no' => $request->mobile_no, 'project_name' => $request->project_name, 'cp_id' => $request->cp_id,])->exists()) {

                $ibp_arr = DB::table('ibp')->where(['id' => $request->cp_id, 'status' => 'ACTIVE'])->first();
                $project_arr = DB::table('products')->where(['name' => $request->project_name, 'proc_status' => 'Y'])->first();
                $headcenter_arr = DB::table('headcenter')->where(['project_id' => $project_arr->id, 'status' => 'Active', 'role' => 'CPSM'])->first();
                $data = array();

                $request_site_visit_date    = (isset($request->site_visit_date) && !empty($request->site_visit_date)) ? $request->site_visit_date : date('Y-m-d');
                $request_site_visit_time    = (isset($request->site_visit_time) && !empty($request->site_visit_time)) ? $request->site_visit_time : '';
                $request_client_name        = (isset($request->client_name) && !empty($request->client_name)) ? $request->client_name : '';
                $request_mobile_no          = (isset($request->mobile_no) && !empty($request->mobile_no)) ? $request->mobile_no : '';
                $request_cp_id              = (isset($request->cp_id) && !empty($request->cp_id)) ? $request->cp_id : '';

                $data['site_visit_date']    = date('Y-m-d', strtotime($request_site_visit_date));
                $data['site_visit_time']    = (isset($request_site_visit_time) && !empty($request_site_visit_time)) ? $request_site_visit_time : '';
                // $data['created_on']      = date('Y-m-d H:m:s');
                // $data['expiry']          = date('Y-m-d', strtotime(' + 6 days'));    
                $data['expiry']             = date('Y-m-d', strtotime($request_site_visit_date . ' + 6 days'));

                $data['client_name']        =   $client_name   =  $request_client_name;
                $data['cp_name']            =  (isset($ibp_arr) && !empty($ibp_arr)) ? $ibp_arr->iname : '';
                $data['mobile_no']          =  $request_mobile_no;
                $data['project_id']         =  (isset($project_arr) && !empty($project_arr)) ? $project_arr->id : '';
                $data['project_name']       =  $project_name = (isset($project_arr) && !empty($project_arr)) ? $project_arr->name : '';
                $data['cpsm_id']            =  (isset($headcenter_arr) && !empty($headcenter_arr)) ? $headcenter_arr->id : '';
                $cp_mobile_number           =  (isset($ibp_arr) && !empty($ibp_arr)) ? $ibp_arr->ihand : '';
                // $data['cpsm_id']         =  '';
                $data['cp_id']              =  $request_cp_id;
                $data['revisit_count']      =  '1';
                $data['lead_type_category'] =  'self_tagging';
                $data['form_fill']          =  'app';
                $client_tag_num             = $request_mobile_no;

                $result = DB::table('temp_lead_cp_app')->insert($data);

                DB::table('cp_empanelled_data')->where(['cpid' => $request_cp_id, 'projectid' => $project_arr->id])->update(['last_tag_Status' => 'Y', 'tag_date' => date('Y-m-d H:i:s')]);



                if (isset($result) && !empty($result)) {

                    $data_for_cp_1_arr = DB::table('temp_lead_cp_app')->select('cp_id')->where(['mobile_no' => $request->mobile_no, 'project_name' => $request->project_name])->orderBy('created_on', 'asc')->first();

                    $data_for_cp_count = DB::table('temp_lead_cp_app')->select('cp_id')->where(['mobile_no' => $request->mobile_no, 'project_name' => $request->project_name])->count();
                    $data_for_cp = DB::table('temp_lead_cp_app')->select('cp_id')->where(['mobile_no' => $request->mobile_no, 'project_name' => $request->project_name])->get();

                    if (isset($data_for_cp_count) && !empty($data_for_cp_count) && intval($data_for_cp_count) > 1) {
                        foreach ($data_for_cp as $key) {
                            if (isset($data_for_cp_1_arr) && !empty($data_for_cp_1_arr) && $data_for_cp_1_arr->cp_id == $key->cp_id) {
                                // $old_message = "Alert!!! The client {#var#} you have tagged is also been tagged with another Channel Partner. Please drive your visit as soon as possible. TEAM MSPACE";
                                // $templateid = '1707165840449405339';

                                // $ibp_arr = DB::table('ibp')->where(['id' => $data_for_cp_1_arr->cp_id, 'status' => 'ACTIVE'])->first();
                                // $cp_mobile_number   =  (isset($ibp_arr) && !empty($ibp_arr)) ? $ibp_arr->ihand : '';
                                // $this->send_sms_from_nimbus_it_api_json($client_name, $client_tag_num, $project_name, $cp_mobile_number, $old_message, $templateid);
                            } else {
                                // $old_message = "Alert!! The client {#var#} you are trying to tag is already been tagged with another Channel Partner. Please drive your visit as soon as possible. TEAM MSPACE";
                                // $templateid = '1707165840457849675';

                                // $ibp_arr = DB::table('ibp')->where(['id' => $key->cp_id, 'status' => 'ACTIVE'])->first();
                                // $cp_mobile_number   =  (isset($ibp_arr) && !empty($ibp_arr)) ? $ibp_arr->ihand : '';
                                // $this->send_sms_from_nimbus_it_api_json($client_name, $client_tag_num, $project_name, $cp_mobile_number, $old_message, $templateid);
                            }
                        }

                        return response(['status' => 200, 'msg' => ['Form is saved & Msg Sent Both']]);
                    } else {

                        //  $old_message = "Congratulations for tagging a client {#var#}. We wish you to drive your visit as soon as possible. TEAM MSPACE";
                        // $templateid = '1707165840443401265';

                        // $this->send_sms_from_nimbus_it_api_json($client_name, $client_tag_num, $project_name, $cp_mobile_number, $old_message, $templateid);
                        // return response(['status' => 200, 'msg' => ['Form is saved & Msg Sent Single']]);
                    }
                } else {
                    return response(['status' => 200, 'msg' => ['Form is not saved']]);
                }
            } else {
                // $result = DB::table('temp_lead_cp_app')->find(['mobile_no'=>$request->mobile_no,'project_name'=>$request->project_name,'cp_id'=>$request->cp_id,]);
                // $result->site_visit_date = date('Y-m-d', strtotime($request->site_visit_date));
                // $result->site_visit_time = $request->site_visit_time;
                // $result->update();

                // if($result == NULL)
                // {
                return response(['status' => 200, 'msg' => ['Mobile Number Already Existing']]);
                // }
                // else
                // {
                //     return response(['status'=>200,'msg'=>['Form is saved']]);
                // }
            }
        } else {
            return ['result' => 'mobile Number is Not Equal 5'];
        }
        // }
    }


    public function project_detail(Request $request)
    {

        $data = DB::table('products')->selectRaw('area_id, id, id as project_id,name,mul_procode,pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code, pro_name as site_name, pro_map as google_map_link,default_number_cpsm')->where(['status' => 'Y', 'app_show_status' => 'Y'])->get()->toArray();

        $resultArray = json_decode(json_encode($data), true);

        $data_arr['url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';
        $data_arr['project_logo_url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';

        foreach ($resultArray as $val) {
            $categoryname = DB::table('category')->where(['status' => 'Y', 'id' => $val['category']])->pluck('name')->toArray();
            $val['categoryname'] = (count($categoryname) > 0) ? $categoryname[0] : '';
            $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';

            $create_multi_arr = DB::table('lead_create_multi')->select('l_mydate', 'ltype', 'mul_proid', 'lead_create_date')->where(['ibpid' => $request->centerid, 'mul_procode' => $val['site_name']])->orderBy('l_mydate', 'DESC')->first();

            $lead_create_date = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->lead_create_date : '';
            $l_mydate = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->l_mydate : '';
            $ltype = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->ltype : '';
            // $mul_proid = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->mul_proid : '';


            $val['start_date'] = (isset($lead_create_date) && !empty($lead_create_date)) ? $lead_create_date : '1997-10-20';
            $val['end_date'] = (isset($l_mydate) && !empty($l_mydate)) ? $l_mydate : '1997-10-20';
            $val['visite_status'] = (isset($ltype) && !empty($ltype)) ? $ltype : 'NA';

            $head_center_arr = DB::table('headcenter')->select('ihand')->where(['project_id' => $val['project_id'], 'status' => 'Active', 'role' => 'CPSM'])->first();

            $ihand = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';

            $val['cpsm_number'] = (isset($ihand) && !empty($ihand)) ? $ihand : $val['default_number_cpsm'];

            $data_arr['product_arr'][] = $val;
        }
        return response(['status' => 200, 'msg' => ['Products Show'], 'data' => $data_arr]);
    }


    public function project_detail_by_cp_inactive(Request $request)
    {
        // $data_store = DB::table('lead_create_multi as a')
        //     ->join('products as b', 'a.mul_proid', '=', 'b.id')
        //     ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
        //     ->select('b.id')
        //     ->groupBy('a.mul_proid')
        //     ->get()->toArray();
        $data_store = DB::table('products')->where(['status' => 'N'])->where(['app_proj_status' => 'Deactive'])->groupBy('id')->get()->toArray();

        $show = json_decode(json_encode($data_store, true), true);
        $pro_id = array_column($show, 'id');

        $data = DB::table('products')->selectRaw('area_id, id, id as project_id,name,mul_procode,pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code, pro_name as site_name, pro_map as google_map_link,default_number_cpsm')->where(['area_id' => $request->area_id, 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->get()->toArray();

        $resultArray = json_decode(json_encode($data), true);

        $data_arr['url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';
        $data_arr['project_logo_url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';

        foreach ($resultArray as $key => $val) {
            $categoryname = DB::table('category')->where(['status' => 'Y', 'id' => $val['category']])->pluck('name')->toArray();
            $val['categoryname'] = (count($categoryname) > 0) ? $categoryname[0] : '';
            $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';

            $create_multi_arr = DB::table('lead_create_multi')->select('l_mydate', 'ltype', 'mul_proid', 'lead_create_date')->where(['ibpid' => $request->centerid, 'ltype' => '', 'mul_procode' => $val['site_name']])->orderBy('l_mydate', 'DESC')->first();

            $lead_create_date = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->lead_create_date : '';
            $l_mydate = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->l_mydate : '';
            $ltype = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->ltype : '';
            // $mul_proid = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->mul_proid : '';


            $val['start_date'] = (isset($lead_create_date) && !empty($lead_create_date)) ? $lead_create_date : '1997-10-20';
            $val['end_date'] = (isset($l_mydate) && !empty($l_mydate)) ? $l_mydate : '1997-10-20';
            $val['visite_status'] = (isset($ltype) && !empty($ltype)) ? $ltype : 'NA';

            $head_center_arr = DB::table('headcenter')->select('ihand')->where(['project_id' => $val['project_id'], 'status' => 'Active', 'role' => 'CPSM'])->first();

            $ihand = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';

            $val['cpsm_number'] = (isset($ihand) && !empty($ihand)) ? $ihand : $val['default_number_cpsm'];

            $data_arr['product_arr'][] = $val;
        }
        return response(['status' => 200, 'msg' => ['Products Show'], 'data' => $data_arr]);
    }

    public function project_detail_by_cp_active(Request $request)
    {
        $pro = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->groupBy('id')->get()->toArray();
        //  $pro = DB::table('lead_create_multi as a')
        // ->join('products as b', 'a.mul_proid', '=', 'b.id')
        // ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
        // ->select('b.id')
        // ->groupBy('a.mul_proid')
        // ->get()->toArray();
        $show = json_decode(json_encode($pro, true), true);
        $pro_id = array_column($show, 'id');
        //  $data = DB::table('products')->selectRaw('area_id, id, name, mul_procode, pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code,  "2022-07-07" as start_date,  "2022-07-17" as end_date, pro_name as site_name, pro_map as google_map_link')->where(['status' => 'Y', 'area_id' => $request->area_id, 'app_show_status' => 'Y'])->whereIn('id', $pro_id)->get()->toArray();
        $data = DB::table('products')->selectRaw('area_id, id, name, mul_procode, pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code,   pro_name as site_name, pro_map as google_map_link')->where(['status' => 'Y', 'area_id' => $request->area_id, 'app_show_status' => 'Y', 'app_proj_status' => 'Active'])->whereIn('id', $pro_id)->get()->toArray();

        $resultArray = json_decode(json_encode($data), true);

        if (isset($resultArray) && !empty($resultArray)) {
            $data_arr['url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';
            $data_arr['project_logo_url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';

            foreach ($resultArray as $val) {
                $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();

                $create_multi_arr = DB::table('lead_create_multi')->select('l_mydate', 'ltype', 'mul_proid', 'lead_create_date')->where(['ibpid' => $request->centerid, 'ltype' => 'Site Visits - Done', 'mul_procode' => $val['mul_procode']])->orderBy('l_mydate', 'DESC')->first();


                $val['start_date'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->lead_create_date : '';
                $val['end_date'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->l_mydate : '';
                $val['visite_status'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->ltype : '';
                $mul_proid = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->mul_proid : '';

                $head_center_arr = DB::table('headcenter')->select('ihand')->where(['project_id' => $mul_proid, 'status' => 'Active', 'role' => 'CPSM'])->first();
                $val['cpsm_number'] = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';

                $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';
                $data_arr['product_arr'][] = $val;
            }
            return response(['status' => 200, 'msg' => ['Products Show'], 'data' => $data_arr]);
        } else {
            return response(['status' => 200, 'msg' => ['No Data Available']]);
        }
    }



    public function live_site_link()
    {
        $data['microsite_arr'] = DB::table('products')->select('microsite', 'name', 'id')->where(['status' => 'Y'])->where('microsite', '!=', '')->get();
        return response(['status' => 200, 'msg' => ['Microsite List'], 'data' => $data]);
    }

    public function get_home_number()
    {
        $data['home_call'] = '8208009101';
        return response(['status' => 200, 'msg' => ['Home Calling'], 'data' => $data]);
    }


    public function active_inner_area_list(Request $request)
    {
        // $ioppopipppro = DB::table('lead_create_multi as a')
        //     ->join('products as b', 'a.mul_proid', '=', 'b.id')
        //     ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
        //     ->select('b.id')
        //     ->groupBy('a.mul_proid')
        //     ->get()->toArray();
        $ioppopipppro = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->groupBy('id')->get()->toArray();
        $show_ajkbakfbkbfkbafbkjk = json_decode(json_encode($ioppopipppro, true), true);
        $ioppopipppro_id = array_column($show_ajkbakfbkbfkbafbkjk, 'id');

        $data_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();

        //  $data_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();

        $area_arra_showing_tbl_active = json_decode(json_encode($data_arr_active), true);
        foreach ($area_arra_showing_tbl_active as $key => $val) {
            $area_name_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_name_active) > 0) ? $area_name_active[0] : '';
            $active_project_divide[] = $val;
        }

        return response(['status' => 200, 'msg' => ['Microsite List'], 'data' => $active_project_divide]);
    }


    public function assoc_active_inner_area_list(Request $request)
    {
        $ioppopipppro = DB::table('lead_create_multi as a')
            ->join('products as b', 'a.mul_proid', '=', 'b.id')
            ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
            ->select('b.id')
            ->groupBy('a.mul_proid')
            ->get()->toArray();
        $show_ajkbakfbkbfkbafbkjk = json_decode(json_encode($ioppopipppro, true), true);
        $ioppopipppro_id = array_column($show_ajkbakfbkbfkbafbkjk, 'id');

        $data_assoc_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->where(['nbp_prop_type' => $request->nbp_prop_type])->where(['app_proj_status' => 'Active'])->get()->toArray();

        $area_assoc_showing_tbl_active = json_decode(json_encode($data_assoc_active), true);
        //  print_r($area_assoc_showing_tbl_active);   

        foreach ($area_assoc_showing_tbl_active as $key => $val) {
            $area_assoc_name_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_assoc_name_active) > 0) ? $area_assoc_name_active[0] : '';
            $active_assoc_project_divide[] = $val;
            // print_r($active_assoc_project_divide);
        }
        if ($request->nbp_prop_type == 'Associate Projects') {
            return response(['status' => 200, 'msg' => ['Active Associate Project List'], 'data' => $active_assoc_project_divide ?? []]);
        }elseif($request->nbp_prop_type == 'Live Projects') {
        return response(['status' => 200, 'msg' => ['Active Live Project List'], 'data' => $active_assoc_project_divide ?? []]);
        }elseif($request->nbp_prop_type == 'Upcoming Projects') {
            return response(['status' => 200, 'msg' => ['Active Upcoming Project List'], 'data' => $active_assoc_project_divide ?? []]);
        }
    }



   
    public function assoc_deactive_inner_area_list(Request $request)
    {
        $ioppopipppro = DB::table('lead_create_multi as a')
            ->join('products as b', 'a.mul_proid', '=', 'b.id')
            ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
            ->select('b.id')
            ->groupBy('a.mul_proid')
            ->get()->toArray();
        $show_ajkbakfbkbfkbafbkjk = json_decode(json_encode($ioppopipppro, true), true);
        $ioppopipppro_id = array_column($show_ajkbakfbkbfkbafbkjk, 'id');

        $data_assoc_inactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y'])->whereNotIn('id', $ioppopipppro_id)->where(['nbp_prop_type' => $request->nbp_prop_type])->groupBy('area_id')->get()->toArray();

        $area_assoc_showing_tbl_inactive = json_decode(json_encode($data_assoc_inactive), true);

        foreach ($area_assoc_showing_tbl_inactive as $key => $val) {
            $inactive_area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['inactive_area_name'] = (count($inactive_area_name) > 0) ? $inactive_area_name[0] : '';
            $data_arr[] = $val;
        }

        if ($request->nbp_prop_type == 'Associate Projects') {
            return response(['status' => 200, 'msg' => ['Associate Project Pending Activation'], 'data' => $data_arr ?? []]);
        }elseif($request->nbp_prop_type == 'Live Projects') {
        return response(['status' => 200, 'msg' => ['Live Project Pending Activation'], 'data' => $data_arr ?? []]);
        }elseif($request->nbp_prop_type == 'Upcoming Projects') {
            return response(['status' => 200, 'msg' => ['Upcoming Project Pending Activation'], 'data' => $data_arr ?? []]);
        }
    }
    
    public function inactive_inner_area_list(Request $request)
    {

        // $ioppopipppro = DB::table('lead_create_multi as a')
        //     ->join('products as b', 'a.mul_proid', '=', 'b.id')
        //     ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
        //     ->select('b.id')
        //     ->groupBy('a.mul_proid')
        //     ->get()->toArray();
        $ioppopipppro = DB::table('products')->where(['app_proj_status' => 'Deactive'])->groupBy('id')->get()->toArray();
        $show_ajkbakfbkbfkbafbkjk = json_decode(json_encode($ioppopipppro, true), true);
        $ioppopipppro_id = array_column($show_ajkbakfbkbfkbafbkjk, 'id');

        // $data_arr_inactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y'])->whereNotIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
        $data_arr_inactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['app_proj_status' => 'Deactive'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
        $area_arra_showing_tbl_inactive = json_decode(json_encode($data_arr_inactive), true);

        foreach ($area_arra_showing_tbl_inactive as $key => $val) {
            $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';
            $data_arr[] = $val;
        }

        return response(['status' => 200, 'msg' => ['Microsite List'], 'data' => $data_arr]);
    }




    public function faq_data_list()
    {
        $data = DB::table('dynamic_faq')->where(['status' => 'ACTIVE'])->get();
        return response(['status' => 200, 'msg' => ['Microsite List'], 'data' => $data]);
    }






    // public function test_post(Request $request)
    // {
    //     print_r($request->all());
    // }





    public function cp_registration_form(Request $request)
    {
        $firm_name = (isset($request->firm_name) && !empty($request->firm_name)) ? $request->firm_name : '';
        $rera_no = (isset($request->rera_no) && !empty($request->rera_no)) ? $request->rera_no : '';
        $cp_name = (isset($request->cp_name) && !empty($request->cp_name)) ? $request->cp_name : '';
        $mobile = (isset($request->mobile) && !empty($request->mobile)) ? $request->mobile : '';
        $foo = str_replace(' ', '', strtolower($cp_name . '---' . $mobile));
        $yoyo_microsite = (isset($cp_name) && !empty($cp_name)) ? $foo : '';
        $waPhoneNumber = (isset($request->waPhoneNumber) && !empty($request->waPhoneNumber)) ? $request->waPhoneNumber : '';
        $microSite = (isset($request->microSite) && !empty($request->microSite)) ? $request->microSite : $yoyo_microsite;
        $password = (isset($request->password) && !empty($request->password)) ? $request->password : '';
        $cnfpassword = (isset($request->cnfpassword) && !empty($request->cnfpassword)) ? $request->cnfpassword : '';

        // if (!DB::table('user')->where(['user_name' => $mobile, 'approve_status' => 'Yes', 'role_type' => 'ibp', 'name' => $cp_name,])->exists()) {
        if (!DB::table('user')->where(['user_name' => $mobile])->exists()) {
            if (!DB::table('ibp')->where(['slogan' => $microSite])->exists()) {

                if ($password == $cnfpassword) {

                    $ibp_data['ihand']          =  $mobile;
                    $ibp_data['itel']           =  $mobile;
                    $ibp_data['owner']          =  $cp_name;
                    $ibp_data['iurera']         =  $rera_no;
                    $ibp_data['iname']          =  $firm_name;
                    $ibp_data['whatsapp']       =  $waPhoneNumber;
                    $ibp_data['slogan']         =  $microSite;
                    $ibp_data['micro_status']   =  'Enable';
                    $ibp_data['status']         =  'Active';
                    $ibp_data['insert_from']    =  'app';
                    $ibp_data['cpdate']         =  date('Y-m-d');

                    DB::table('ibp')->insert($ibp_data);

                    $ibp_id = DB::getPdo()->lastInsertId();


                    $u_data['ibpid']            =  $ibp_id;
                    $u_data['password']         =  md5($password);
                    $u_data['type']             =  'i';
                    $u_data['status']           =  'a';
                    $u_data['role_type']        =  'ibp';
                    $u_data['approve_status']   =  'Yes';
                    $u_data['user_name']        =  $mobile;
                    $u_data['name']             =  $cp_name;

                    $result = DB::table('user')->insert($u_data);
                    if (isset($result) && !empty($result)) {

                        $client_name = $cp_name;
                        $client_tag_num = 0;
                        $project_name = '';
                        $cp_mobile_number = $mobile;

                        //  $old_message = "Welcome {#var#} Thank you for Registering in M.Space Realty CP APP. Please Empanel Yourself At Our Project And Avail Benefits Happy Selling MSpace";
                        $templateid = '1707166080430876467';
                        $this->send_sms_from_nimbus_it_api_json($client_name, $client_tag_num, $project_name, $cp_mobile_number, $old_message, $templateid);
                        return response(['status' => 200, 'msg' => ['Success']]);
                    } else {
                        return response(['status' => 404, 'msg' => ['Not Success']]);
                    }
                } else {
                    return response(['status' => 404, 'msg' => ['Password Not Matched']]);
                }
            } else {
                return response(['status' => 404, 'msg' => ['Microsite Alredy Existing']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User Alredy Existing']]);
        }
    }


    public function last_share_pdf(Request $request)
    {

        $share_type = $request->share_type;

        if (isset($share_type) && !empty($share_type) && $share_type == 'pdf') {
            $result = DB::table('cp_empanelled_data')->where(['cpid' => $request->cp_id, 'projectid' => $request->project_id])->update(['last_share' => 'Y', 'last_share_date' => date('Y-m-d H:i:s')]);
        }
        if (isset($share_type) && !empty($share_type) && $share_type == 'microsite') {
            $result = DB::table('cp_empanelled_data')->where(['cpid' => $request->cp_id, 'projectid' => $request->project_id])->update(['microsite_share' => 'Y', 'last_microsite_share' => date('Y-m-d H:i:s')]);
        }


        if (isset($result) && !empty($result)) {
            return response(['status' => 200, 'msg' => ['Success']]);
        } else {
            return response(['status' => 404, 'msg' => ['Not Success']]);
        }
    }






    public function send_sms_from_nimbus_it_api_json($client_name, $client_tag_num = 0, $project_name, $mobile_no, $old_message, $templateid)
    {
        $apiURL = 'http://nimbusit.info/api/pushsmsjson.php';

        $name = (isset($client_tag_num) && !empty($client_tag_num) && intval($client_tag_num) > 0) ? $client_name . '/' . $client_tag_num : $client_name;
        $p_name = (isset($project_name) && !empty($project_name)) ? $name . '/' . $project_name : $client_name;
        $var = $p_name;

        $message = str_replace("{#var#}", $var, $old_message);

        $postInput = [

            'Authorization' => [
                'User' => 't5Retail',
                'Key' => '0106aI830RsxofDBK9xS'
            ],
            'Data' => [
                'Sender' => 'MSPACE',
                'Message' => $message,
                'Flash' => 0,
                'ReferenceId' => '1564879',
                'EntityId' => '1701158045268877895',
                'TemplateId' => $templateid,
                'Mobile' => [
                    $mobile_no
                ]
            ]
        ];
        $headers = [];
        $response = Http::withHeaders($headers)->acceptJson()->post($apiURL, $postInput);
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
        return ['statusCode' => $statusCode, 'content' => $responseBody];
    }

    public function test_get(Request $request)
    {
        return response(['status' => 200, 'msg' => ['Success'], 'request' => $request->all()]);
    }

    public function test_post(Request $request)
    {
        return response(['status' => 200, 'msg' => ['Success'], 'request' => $request->all()]);
    }


    public function delete_cp_account(Request $request)
    {
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {
            $check_user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token, 'password' => md5($request->password)])->count();
            if ($check_user == 1) {

                $affected = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token, 'password' => md5($request->password)])->update(['status' => 'd', 'token' => '']);
                if ($affected != 0) {
                    return response(['status' => 200, 'msg' => 'Your Account is Been Deleted.']);
                } else {
                    return response(['status' => 404, 'msg' => 'Your Account is Not Deleted.']);
                }
            } else {
                return response(['status' => 404, 'msg' => 'Password is Not Matched. Please Check Password.']);
            }
        } else {
            return response(['status' => 404, 'msg' => 'User not login']);
        }

        // if (isset($request->all()) && !empty($request->all())) {
        //     return response(['status' => 200, 'msg' => ['Success'],'request' => $request->all()]);
        // }
        // else{
        //     return response(['status' => 404, 'msg' => ['Failed']]);
        // }
    }

    public function validate_microsite(Request $request)
    {
        $user = DB::table('ibp')->where(['slogan' => $request->microsite])->count();
        if ($user == 1) {
            return response(['status' => 404, 'msg' => 'Microsite Already Exsist']);
        } else {
            return response(['status' => 200, 'msg' => '']);
        }
    }


    //New Code
    public function assoc_active_inner_data(Request $request)
    {
        $pro = DB::table('lead_create_multi as a')
            ->join('products as b', 'a.mul_proid', '=', 'b.id')
            ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
            ->select('b.id')
            ->groupBy('a.mul_proid')
            ->get()->toArray();
        $show = json_decode(json_encode($pro, true), true);
        $pro_id = array_column($show, 'id');

        $data = DB::table('products')->selectRaw('area_id, id, name, mul_procode,pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code,  pro_name as site_name, pro_map as google_map_link,proj_img,proj_img2')->where(['status' => 'Y', 'area_id' => $request->area_id, 'app_show_status' => 'Y'])->whereIn('id', $pro_id)->where(['nbp_prop_type' => $request->nbp_prop_type])->where(['app_proj_status' => 'Active'])->get()->toArray();

        $resultArray = json_decode(json_encode($data), true);

        if (isset($resultArray) && !empty($resultArray)) {
            $data_arr['url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';
            $data_arr['project_logo_url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';

            foreach ($resultArray as $val) {
                $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();

                $create_multi_arr = DB::table('lead_create_multi')->select('l_mydate', 'ltype', 'mul_proid', 'lead_create_date')->where(['ibpid' => $request->centerid, 'ltype' => 'Site Visits - Done', 'mul_procode' => $val['mul_procode']])->orderBy('l_mydate', 'DESC')->first();


                $val['start_date'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->lead_create_date : '';
                $val['end_date'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->l_mydate : '';
                $val['visite_status'] = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->ltype : '';
                $mul_proid = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->mul_proid : '';

                $head_center_arr = DB::table('headcenter')->select('ihand')->where(['project_id' => $mul_proid, 'status' => 'Active', 'role' => 'CPSM'])->first();
                $val['cpsm_number'] = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';

                $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';
                $data_arr['product_arr'][] = $val;
            }
            return response(['status' => 200, 'msg' => ['Products Show'], 'data' => $data_arr]);
        } else {
            return response(['status' => 200, 'msg' => ['No Data Available'],'data' => []]);
        }
    }

    public function deactive_inner_data(Request $request)
    {
        $data_store = DB::table('lead_create_multi as a')
            ->join('products as b', 'a.mul_proid', '=', 'b.id')
            ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
            ->select('b.id')
            ->groupBy('a.mul_proid')
            ->get()->toArray();

        $show = json_decode(json_encode($data_store, true), true);
        $pro_id = array_column($show, 'id');

        $data = DB::table('products')->selectRaw('area_id, id, id as project_id,name,mul_procode,pro_name,pconstr,brochure,category,project_logo, microsite,  "red" as color_code, pro_name as site_name, pro_map as google_map_link, default_number_cpsm,proj_img,proj_img2')->where(['status' => 'Y', 'area_id' => $request->area_id, 'app_show_status' => 'Y'])->whereNotIn('id', $pro_id)->where(['nbp_prop_type' => $request->nbp_prop_type])->where(['app_proj_status' => 'Active'])->get()->toArray();

        $resultArray = json_decode(json_encode($data), true);
        if (isset($resultArray) && !empty($resultArray)) {
        $data_arr['url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';
        $data_arr['project_logo_url_link'] = 'https://d78.vvelocity.com/w3tech_admin/master/pro_filedoc/';

        foreach ($resultArray as $key => $val) {
            $categoryname = DB::table('category')->where(['status' => 'Y', 'id' => $val['category']])->pluck('name')->toArray();
            $val['categoryname'] = (count($categoryname) > 0) ? $categoryname[0] : '';
            $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
            $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';

            $create_multi_arr = DB::table('lead_create_multi')->select('l_mydate', 'ltype', 'mul_proid', 'lead_create_date')->where(['ibpid' => $request->centerid, 'ltype' => '', 'mul_procode' => $val['site_name']])->orderBy('l_mydate', 'DESC')->first();

            $lead_create_date = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->lead_create_date : '';
            $l_mydate = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->l_mydate : '';
            $ltype = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->ltype : '';
            // $mul_proid = (isset($create_multi_arr) && !empty($create_multi_arr)) ? $create_multi_arr->mul_proid : '';


            $val['start_date'] = (isset($lead_create_date) && !empty($lead_create_date)) ? $lead_create_date : '1997-10-20';
            $val['end_date'] = (isset($l_mydate) && !empty($l_mydate)) ? $l_mydate : '1997-10-20';
            $val['visite_status'] = (isset($ltype) && !empty($ltype)) ? $ltype : 'NA';

            $head_center_arr = DB::table('headcenter')->select('ihand')->where(['project_id' => $val['project_id'], 'status' => 'Active', 'role' => 'CPSM'])->first();

            $ihand = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';

            $val['cpsm_number'] = (isset($ihand) && !empty($ihand)) ? $ihand : $val['default_number_cpsm'];

            $data_arr['product_arr'][] = $val;
        }
        return response(['status' => 200, 'msg' => ['Products Show'], 'data' => $data_arr]);
    }else{
        return response(['status' => 200, 'msg' => ['Products Show'], 'data' => []]);
    }
        
    }
    //End Code
}
