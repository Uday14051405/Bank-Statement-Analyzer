<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardNew20_jan24Controller extends Controller
{
  public function index(Request $request)
  {
    # dd('Hello');
    $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    // dd();
    if ($user == 1) {

      $arr   = array();
      $day1  = date('Y-m-d', strtotime('-1 day'));
      $day_3 = date('Y-m-d', strtotime('+3 day'));
      $day_60 = date('Y-m-d', strtotime('+60 day'));
      $day7  = date('Y-m-d', strtotime('-7 day'));
      $day8  = date('Y-m-d', strtotime('-8 day'));
      $today = date('Y-m-d');
      $day9  = "2015-01-01";

      $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';
      $column1 = ($request->role_type == 'ibp') ? 'a.ibpid' : 'a.l_employee';
      $headcenter = DB::table('ibp')->where(['id' => $request->centerid])->get()->toArray();

      $query1 = DB::table('lead_create_multi')->where(['fll_fillby' => $request->user_name]);

      $lead_create_multi_query = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y');

      $newlead = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.ltype', '=', ' ')->orWhereNull('a.ltype')->where('a.display_status', '!=', 'N')->count();

      $totalfollowup = $query1->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->count();

      $total_follw_Prospect_today = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.ltype', '!=', ' ')->where('a.display_status', '!=', 'N')->where(['a.ltype' => 'Site Visit Schedule'])->whereBetween('a.fDate', [date('Y-m-d'), date('Y-m-d')])->count();

      $todayfollowup = $totalfollowup + $total_follw_Prospect_today;

      $totalfollowup7 =  DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->whereNotIn('a.ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('a.display_status', '!=', 'N')->where('a.ctype', '!=', 'Lost')->whereBetween('a.fDate', [$day7, $day1])->count();

      $totalfollowup8 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->whereNotIn('a.ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('a.display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('a.fDate', [$day9, $day8])->count();

      $folloupmissed = $totalfollowup7 + $totalfollowup8;

      // $total_visit = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status','Y')->where('display_status', '!=', 'N')->where(['ltype' => 'Site Visits - Done'])->count();
      $total_visit = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->whereIn('a.ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3'])->count();

      $total_Sale = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Sale'])->count();

      $total_Hot = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Hot'])->count();

      $total_Warm = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Warm'])->count();

      $total_Cold = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Cold'])->count();

      $total_Interested = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Interested'])->count();

      $total_Lost = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Lost'])->where('visit_expiry_60days', '<=', $today)->count();
      // $total_Lost = DB::table('lead_create_multi')->where([$column => $request->centerid])->where('display_status', '!=', 'N')->where(['ctype' => 'Lost'])->count();

      $total_micro_site_lead = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->where('real_mobile_no', '!=', '')->where('form_fill', '=', 'micro_website')->count();

      $total_tag_expire = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->whereBetween('expiry', [$today, $day_3])->where(['cp_id' => $request->centerid])->count();

      $total_cp_tm = DB::table('user')->where(['ibpid' => $request->centerid, 'status' => 'a' , 'sub_role' => 'cp_tm','role_type' => 'ibp'])->count();            

      $pre_visit_tagging = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->count();

      $pre_visit_tagging1 = DB::table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "pre_visit_tagging" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->orderBy('created_on', 'desc')->get()->toArray();

      // $tag_visit_proposed1 = DB::table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "site_visit_proposed" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->orderBy('created_on', 'desc')->get()->toArray();
      $total_visiting = DB::table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->count();

      // $total_visit_expire = DB::table('lead_create_multi')->whereBetween('visit_expiry_60days', [$day9, $day_3])->where(['ibpid' => $request->centerid])->count();
      $total_visit_expire = DB::table('lead_create_multi')->whereBetween('visit_expiry_60days', [$today, $day_3])->where(['ibpid' => $request->centerid])->count();


      //$total_active_project = DB::table('lead_create_multi')->where(['ibpid' => $request->centerid, 'ltype' => 'Site Visits - Done'])->distinct('mul_proid')->count();
      $total_active_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->distinct('id')->count();
      $total_inactive_project = DB::table('products')->where(['app_proj_status' => 'Deactive'])->distinct('id')->count();

      $total_associate_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Associate Projects'])->count();
      $total_live_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Live Projects'])->count();
      $total_upcoming_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Upcoming Projects'])->count();

      // $total_deactive_associate_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Associate Projects'])->count();
      // $total_deactive_live_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Live Projects'])->count();
      // $total_deactive_upcoming_project = DB::table('products')->where(['status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Upcoming Projects'])->count();
      // select DISTINCT (mul_proid) from lead_create_multi where ibpid='1' AND ltype='Site Visits - Done';

      //  $total_inactive_project = DB::table('lead_create_multi')->where(['ibpid'=>$request->centerid])->where('ltype','!=','Site Visits - Done')->distinct('mul_proid')->count();
      // select DISTINCT (mul_proid) from lead_create_multi where ibpid='1' AND ltype!='Site Visits - Done';


      $my_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();


      $total_microsite = DB::table('products')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where('microsite', '!=', '')->distinct('microsite')->count();
      $ioppopipppro = DB::table('lead_create_multi as a')
        ->join('products as b', 'a.mul_proid', '=', 'b.id')
        ->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])
        ->select('b.id')
        ->groupBy('a.mul_proid')
        ->get()->toArray();
      $show_ajkbakfbkbfkbafbkjk = json_decode(json_encode($ioppopipppro, true), true);

      $ioppopipppro_id = array_column($show_ajkbakfbkbfkbafbkjk, 'id');
      $data_cntncntn = DB::table('products')->where(['status' => 'Y', 'app_show_status' => 'Y'])->whereNotIn('id', $ioppopipppro_id)->get(['id', 'category', 'name', 'pro_name'])->toArray();
      $bjdjkdvjksjkfbjsfjksfjkfk_resultArray = json_decode(json_encode($data_cntncntn), true);

      $nilesh = 0;

      foreach ($bjdjkdvjksjkfbjsfjksfjkfk_resultArray as $key => $val) {
        $categoryname = DB::table('category')->where(['status' => 'Y', 'id' => $val['category']])->pluck('name')->toArray();
        $val['categoryname'] = (count($categoryname) > 0) ? $categoryname[0] : '';
        $data_arr1['product_arr'][] = $val;
        if (isset($val) && !empty($val)) {
          $nilesh++;
        }
      }

      //$total_inactive_project = $nilesh;

      // $data_arr_inactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->whereNotIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $data_arr_inactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['app_show_status' => 'Y', 'app_proj_status' => 'Deactive'])->groupBy('area_id')->get()->toArray();

      $area_arra_showing_tbl_inactive = json_decode(json_encode($data_arr_inactive), true);

      //print_r($area_arra_showing_tbl_inactive);
      foreach ($area_arra_showing_tbl_inactive as $key => $val) {
        $area_name = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        // print_r(count($area_name));
        $val['area_name'] = (count($area_name) > 0) ? $area_name[0] : '';
        $data_arr[] = $val;
      }

      // $data_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Active'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $data_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Active'])->groupBy('area_id')->get()->toArray();
      $area_arra_showing_tbl_active = json_decode(json_encode($data_arr_active), true);

      foreach ($area_arra_showing_tbl_active as $key => $val) {
        $area_name_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_name_active) > 0) ? $area_name_active[0] : '';
        $active_project_divide1[] = $val;
      }

      $data_assoc_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Associate Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_assoc_showing_tbl_active = json_decode(json_encode($data_assoc_arr_active), true);
      foreach ($area_assoc_showing_tbl_active as $key => $val) {
        $area_assoc_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_assoc_active) > 0) ? $area_assoc_active[0] : '';
        $active_assoc_project_divide1[] = $val;
      }

      $data_assoc_arr_deactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Associate Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_assoc_showing_tbl_deactive = json_decode(json_encode($data_assoc_arr_deactive), true);
      foreach ($area_assoc_showing_tbl_deactive as $key => $val) {
        $area_assoc_deactive = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_assoc_deactive) > 0) ? $area_assoc_deactive[0] : '';
        $deactive_assoc_project_divide1[] = $val;
      }

      $data_live_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Live Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_live_showing_tbl_active = json_decode(json_encode($data_live_arr_active), true);
      foreach ($area_live_showing_tbl_active as $key => $val) {
        $area_live_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_live_active) > 0) ? $area_live_active[0] : '';
        $active_live_project_divide1[] = $val;
      }

      $data_live_arr_deactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Live Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_live_showing_tbl_deactive = json_decode(json_encode($data_live_arr_deactive), true);
      foreach ($area_live_showing_tbl_deactive as $key => $val) {
        $area_live_deactive = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_live_deactive) > 0) ? $area_live_deactive[0] : '';
        $deactive_live_project_divide1[] = $val;
      }


      $data_upcoming_arr_active = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Active'])->where(['nbp_prop_type' => 'Upcoming Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_upcoming_showing_tbl_active = json_decode(json_encode($data_upcoming_arr_active), true);
      foreach ($area_upcoming_showing_tbl_active as $key => $val) {
        $area_upcoming_active = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_upcoming_active) > 0) ? $area_upcoming_active[0] : '';
        $active_upcoming_project_divide1[] = $val;
      }


      $data_upcoming_arr_deactive = DB::table('products')->selectRaw('count(area_id) as area_cnt, area_id')->where(['status' => 'Y', 'app_show_status' => 'Y'])->where(['app_proj_status' => 'Deactive'])->where(['nbp_prop_type' => 'Upcoming Projects'])->whereIn('id', $ioppopipppro_id)->groupBy('area_id')->get()->toArray();
      $area_upcoming_showing_tbl_deactive = json_decode(json_encode($data_upcoming_arr_deactive), true);
      foreach ($area_upcoming_showing_tbl_deactive as $key => $val) {
        $area_upcoming_deactive = DB::table('area')->where(['status' => 'Y', 'shop_id' => $val['area_id']])->pluck('shop_name')->toArray();
        $val['area_name'] = (count($area_upcoming_deactive) > 0) ? $area_upcoming_deactive[0] : '';
        $deactive_upcoming_project_divide1[] = $val;
      }


      # $followups = $total_Hot + $total_Warm + $total_Cold + $total_Interested + $total_Lost;
      $followups = $total_Hot + $total_Warm + $total_Cold + $total_Interested;
      #$newlead_divide = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->count()->groupBy('source')->get(['source'])->toArray();


      $tag_expire_divide1 = DB::table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "site_visit_expired" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->whereBetween('expiry', [$today, $day_3])->where(['cp_id' => $request->centerid])->where('lead_status', '!=', 'LOST')->orderBy('created_on', 'desc')->get()->toArray();

      $lost_data_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proname')->selectRaw('count(a.id) as sum, a.mul_proname as title, "total_visit_lost" as dash_type, a.mul_proid as proid, "" as source')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Lost'])->where('a.visit_expiry_60days', '<=', $today)->orderBy('a.l_mydate', 'desc')->get()->toArray();
      // $lost_data_divide1 = DB::table('lead_create_multi')->groupBy('mul_proname')->selectRaw('count(id) as sum, mul_proname as title, "total_visit_lost" as dash_type, mul_proid as proid, "" as source')->where([$column => $request->centerid])->where('display_status', '!=', 'N')->where(['ctype' => 'Lost'])->orderBy('l_mydate', 'desc')->get()->toArray();

      $tag_visit_proposed1 = DB::table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "site_visit_proposed" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->orderBy('created_on', 'desc')->get()->toArray();

      $tag_micro_site_lead1 = DB::table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "site_visit_proposed" as dash_type,"" as source')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->where('real_mobile_no', '!=', '')->where('form_fill', '=', 'micro_website')->orderBy('created_on', 'desc')->get()->toArray();


      $newlead_divide1 = DB::table('lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum, source, source as title,"Blank" as dash_type,"" as proid')->where([$column => $request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->orderBy('l_mydate', 'desc')->get()->toArray();

      // $sitevisits_divide1 = DB::table('lead_create_multi')->groupBy('mul_proid')->selectRaw('count(id) as sum, l_prodt as title,mul_proid as proid,"site_visits_done" as dash_type,"" as source')->where([$column => $request->centerid])->where('display_status', '!=', 'N')->where(['ltype' => 'Site Visits - Done'])->orderBy('l_mydate', 'desc')->get()->toArray();

      $sitevisits_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.mul_proname as title, a.mul_proid as proid,"site_visits_done" as dash_type,"" as source')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->whereIn('a.ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3'])->orderBy('a.l_mydate', 'desc')->get()->toArray();

      // $visit_expire_divide1 = DB::table('lead_create_multi')->groupBy('mul_proname')->selectRaw('count(id) as sum, mul_proname as title, "site_visit_expired" as dash_type, mul_proid as proid,"" as source')->whereBetween('visit_expiry_60days', [$day9, $day_3])->where(['ibpid' => $request->centerid])->orderBy('l_mydate', 'desc')->get()->toArray();
      $visit_expire_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proname')->selectRaw('count(a.id) as sum, a.mul_proname as title, "site_visit_expired" as dash_type, a.mul_proid as proid,"" as source')->whereBetween('a.visit_expiry_60days', [$today, $day_3])->where('b.app_show_status', 'Y')->where(['a.ibpid' => $request->centerid])->orderBy('a.l_mydate', 'desc')->get()->toArray();

      $sales_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.l_prodt as title, a.mul_proid as proid,"Sale" as dash_type,"" as source')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Sale'])->orderBy('a.l_mydate', 'desc')->get()->toArray();

      //$sales_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.l_prodt as title,a.mul_proid as proid,"Sale" as a.dash_type,"" as source')->where([$column => $request->centerid])->where('display_status', '!=', 'N')->where(['ctype' => 'Sale'])->orderBy('l_mydate', 'desc')->get()->toArray();




      $followups_divide1 = DB::table('lead_create_multi')->groupBy('ctype')->selectRaw('count(id) as sum, ctype as dash_type, ctype as title,"" as source,"" as proid')->where([$column => $request->centerid])->where('display_status', '!=', 'N')->whereIn('ctype', ['Hot', 'Warm', 'Cold', 'Interested'])->orderBy('l_mydate', 'desc')->get()->toArray();

      $active_project_divide11   = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.ctype as dash_type, a.l_prodt as title,"" as source, a.mul_proid')->where('b.app_show_status', 'Y')->where(['a.ibpid' => $request->centerid, 'a.ltype' => 'Site Visits - Done'])->orderBy('l_mydate', 'desc')->get()->toArray();

      $inactive_project_divide1 = DB::table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.ctype as dash_type, a.l_prodt as title,"" as source, a.mul_proid')->where('b.app_show_status', 'Y')->where(['a.ibpid' => $request->centerid])->where('a.ltype', '!=', 'Site Visits - Done')->orderBy('a.l_mydate', 'desc')->get()->toArray();


      //New Changes
      // $npb_vdnp_leads = $query1->where('npb_lead_statuss', '=','Open')->count();
      $npb_vdnp_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Open'])->count();

      $my_subscribed_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();

      $npb_today_followup = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['npb_lead_status' => 'Subscribed'])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->count();

      $npb_followup_missed = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [$day9, $day1])->where(['npb_lead_status' => 'Subscribed'])->count();

      $hm_leads = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['source' => 'Housing Magic'])->count();

      $nbp_hot = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Hot'])->where(['npb_lead_status' => 'Subscribed'])->count();

      $nbp_warm = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Warm'])->where(['npb_lead_status' => 'Subscribed'])->count();

      $nbp_cold = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Cold'])->where(['npb_lead_status' => 'Subscribed'])->count();

      $nbp_lost = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Lost'])->where(['npb_lead_status' => 'Subscribed'])->count();

      $nbp_booked = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereIn('ctype', ['Booked', 'EOI'])->where(['npb_lead_status' => 'Subscribed'])->count();


      //$npb_vdnp_leads = $query1->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->count();


      #dd($followups_divide1);
      #$newlead_divide1 = DB::select("select source,count(id) as count from lead_create_multi where (ltype = '' OR ltype IS NULL)  AND display_status != 'N' AND ".$column."=".$request->centerid." group by source");
      $newlead_divide = json_decode(json_encode($newlead_divide1), true);
      $todayfollowup_divide = array(
        0 =>
        array(
          'sum' => $totalfollowup,
          'dash_type' => 'Today_followup',
          'title' => 'Today Followup',
          'source' => '',
          'proid' => ''
        ),
        1 =>
        array(
          'sum' => $total_follw_Prospect_today,
          'dash_type' => 'Today_followupToday_followup',
          'title' => 'Today Site Visit Prospect',
          'source' => '',
          'proid' => ''
        ),
      );
      $folloupmissed_divide = array(
        0 =>
        array(
          'sum' => $totalfollowup7,
          'dash_type' => 'misseds14',
          'title' => 'Followup missed in 7 Days',
          'source' => '',
          'proid' => ''
        ),
        1 =>
        array(
          'sum' => $totalfollowup8,
          'dash_type' => 'misseds18',
          'title' => 'Followup missed in >7 Days',
          'source' => '',
          'proid' => ''
        ),
      );

      $new_boxes1 = array(
        0 =>
        array(
          'sum' => $npb_vdnp_leads,
          'dash_type' => 'npb_vdnp_leads',
          'title' => 'NPB VDNB Leads',
          'source' => '',
          'proid' => ''
        ),
        1 =>
        array(
          'sum' => $my_subscribed_leads,
          'dash_type' => 'my_subscribed_leads',
          'title' => 'My Subscribed Leads',
          'source' => '',
          'proid' => ''
        ),
        2 =>
        array(
          'sum' => $npb_today_followup,
          'dash_type' => 'npb_today_followup',
          'title' => 'Today Followup',
          'source' => '',
          'proid' => ''
        ),
        3 =>
        array(
          'sum' => $npb_followup_missed,
          'dash_type' => 'npb_followup_missed',
          'title' => 'Followup Missed',
          'source' => '',
          'proid' => ''
        ),
        4 =>
        array(
          'sum' => $total_micro_site_lead,
          'dash_type' => 'micro_site_lead',
          'title' => 'Microsite Leads',
          'source' => '',
          'proid' => ''
        ),
        5 =>
        array(
          'sum' => $hm_leads,
          'dash_type' => 'HM_Leads',
          'title' => 'H.M Leads',
          'source' => '',
          'proid' => ''
        ),
        6 =>
        array(
          'sum' => $nbp_hot,
          'dash_type' => 'npb_Hot',
          'title' => 'Hot',
          'source' => '',
          'proid' => ''
        ),
        7 =>
        array(
          'sum' => $nbp_warm,
          'dash_type' => 'npb_Warm',
          'title' => 'Warm',
          'source' => '',
          'proid' => ''
        ),
        8 =>
        array(
          'sum' => $nbp_cold,
          'dash_type' => 'npb_Cold',
          'title' => 'Cold',
          'source' => '',
          'proid' => ''
        ),
        9 =>
        array(
          'sum' => $nbp_lost,
          'dash_type' => 'npb_lost',
          'title' => 'Lost',
          'source' => '',
          'proid' => ''
        ),
        10 =>
        array(
          'sum' => $nbp_booked,
          'dash_type' => 'npb_booked',
          'title' => 'Booked',
          'source' => '',
          'proid' => ''
        ),
      );
      $sitevisits_divide          = (isset($sitevisits_divide1) && !empty($sitevisits_divide1)) ? json_decode(json_encode($sitevisits_divide1), true) : [];
      $lost_data_divide           = (isset($lost_data_divide1) && !empty($lost_data_divide1)) ? json_decode(json_encode($lost_data_divide1), true) : [];
      $sales_divide               = (isset($sales_divide1) && !empty($sales_divide1)) ? json_decode(json_encode($sales_divide1), true) : [];
      $followups_divide           = (isset($followups_divide1) && !empty($followups_divide1)) ? json_decode(json_encode($followups_divide1), true) : [];
      $tag_expire_divide          = (isset($tag_expire_divide1) && !empty($tag_expire_divide1)) ? json_decode(json_encode($tag_expire_divide1), true) : [];
      $tag_visit_proposed         = (isset($tag_visit_proposed1) && !empty($tag_visit_proposed1)) ? json_decode(json_encode($tag_visit_proposed1), true) : [];
      $tag_micro_site_lead        = (isset($tag_micro_site_lead1) && !empty($tag_micro_site_lead1)) ? json_decode(json_encode($tag_micro_site_lead1), true) : [];
      $new_boxes        = (isset($new_boxes1) && !empty($new_boxes1)) ? json_decode(json_encode($new_boxes1), true) : [];
      $visit_expire_divide        = (isset($visit_expire_divide1) && !empty($visit_expire_divide1)) ? json_decode(json_encode($visit_expire_divide1), true) : [];
      $active_project_divide      = (isset($active_project_divide1) && !empty($active_project_divide1)) ? json_decode(json_encode($active_project_divide1), true) : [];
      $active_assoc_project_divide      = (isset($active_assoc_project_divide1) && !empty($active_assoc_project_divide1)) ? json_decode(json_encode($active_assoc_project_divide1), true) : [];
      $active_live_project_divide      = (isset($active_live_project_divide1) && !empty($active_live_project_divide1)) ? json_decode(json_encode($active_live_project_divide1), true) : [];
      $active_upcoming_project_divide      = (isset($active_upcoming_project_divide1) && !empty($active_upcoming_project_divide1)) ? json_decode(json_encode($active_upcoming_project_divide1), true) : [];

      $deactive_assoc_project_divide      = (isset($deactive_assoc_project_divide1) && !empty($deactive_assoc_project_divide1)) ? json_decode(json_encode($deactive_assoc_project_divide1), true) : [];
      $deactive_live_project_divide      = (isset($deactive_live_project_divide1) && !empty($deactive_live_project_divide1)) ? json_decode(json_encode($deactive_live_project_divide1), true) : [];
      $deactive_upcoming_project_divide      = (isset($deactive_upcoming_project_divide1) && !empty($deactive_upcoming_project_divide1)) ? json_decode(json_encode($deactive_upcoming_project_divide1), true) : [];

      // $inactive_project_divide    = (isset($inactive_project_divide1) && !empty($inactive_project_divide1)) ? json_decode(json_encode($inactive_project_divide1), true) : [];
      $inactive_project_divide    = (isset($data_arr) && !empty($data_arr)) ? json_decode(json_encode($data_arr), true) : [];
      $pre_visit_tagging_divide               = (isset($pre_visit_tagging1) && !empty($pre_visit_tagging1)) ? json_decode(json_encode($pre_visit_tagging1), true) : [];




      // $arr['newlead']       = ['count'=>$newlead,'dash_type'=>'Blank','viewTitle'=>'New Lead','insidedata'=>$newlead_divide];
      // $arr['todayfollowup'] = ['count'=>$todayfollowup,'title'=>'Today Followup','viewTitle'=>'Todays Followup','insidedata'=>$todayfollowup_divide];
      // $arr['folloupmissed'] = ['count'=>$folloupmissed,'title'=>'Followup Missed','viewTitle'=>'Followup Missed','insidedata'=>$folloupmissed_divide];
      // $arr['sales']         = ['count'=>$total_Sale,'title'=>'Sale','viewTitle'=>'Sales','insidedata'=>$sales_divide];
      // $arr['sitevisits']    = ['count'=>$total_visit,'title'=>'Site Visits - Done','viewTitle'=>'Site Visits','insidedata'=>$sitevisits_divide];










      /* New App Box For Showing*/
      if (!empty($data_arr) && !is_null($data_arr)) {
        $data_arr = $data_arr;
      } else {
        $data_arr = 'NULL';
      }
      // $arr['visit_proposed'] = ['count' => $total_visiting, 'title' => 'Visit Proposed', 'viewTitle' => 'Visit Proposed', 'insidedata' => $tag_visit_proposed];
      $arr['sitevisits']    = ['count' => $total_visit, 'title' => 'Site Visits - Done', 'viewTitle' => 'Site Visits Done', 'insidedata' => $sitevisits_divide];
      $arr['followups']     = ['count' => $followups, 'title' => 'In Followups', 'viewTitle' => 'In Followups', 'insidedata' => $followups_divide];
      $arr['total_Lost']    = ['count' => $total_Lost, 'title' => 'Lost', 'viewTitle' => 'Lost', 'insidedata' => $lost_data_divide];
      // $arr['tag_expiring']  = ['count' => $total_tag_expire, 'title' => 'Tag Expire', 'viewTitle' => 'Tag Expiring', 'insidedata' => $tag_expire_divide];
      $arr['visit_expiring']  = ['count' => $total_visit_expire, 'title' => 'Visit Expire', 'viewTitle' => 'Visit Expiring', 'insidedata' => $visit_expire_divide];
      // $arr['e_brochure']  = ['count' => '0', 'title' => 'E-Brochure', 'viewTitle' => 'E-Brochure', 'insidedata' => []];
      $arr['micro_site_lead']  = ['count' => $my_leads, 'title' => 'My Leads', 'viewTitle' => 'My Leads', 'insidedata' => $new_boxes];
      $arr['landing_pages']  = ['count' => $total_microsite, 'title' => 'Landing Pages', 'viewTitle' => 'Landing Pages', 'insidedata' => []];
      $arr['new_tagging']  = ['count' => '0', 'title' => 'New Tagging', 'viewTitle' => 'New Tagging', 'insidedata' => []];
      $arr['active_project']  = ['count' => $total_active_project, 'title' => 'Active Project', 'viewTitle' => 'Active Project', 'insidedata' => $active_project_divide];
      $arr['inactive_project']  = ['count' => $total_inactive_project, 'title' => 'Inactive Project', 'viewTitle' => 'Inactive Project', 'insidedata' => $data_arr];
      // $arr['associate_project'] = ['count' => $total_associate_project, 'title' => 'Associate Projects', 'viewTitle' => 'Associate Projects'];
      $arr['live_project'] = ['count' => $total_live_project, 'title' => 'Live Projects', 'viewTitle' => 'Live Projects'];
      $arr['upcoming_project'] = ['count' => $total_upcoming_project, 'title' => 'Upcoming Projects', 'viewTitle' => 'Upcoming Projects'];
       $arr['pre_visit_tagging']  = ['count' => $pre_visit_tagging, 'title' => 'Pre Visit Tagging', 'viewTitle' => 'Pre Visit Tagging', 'insidedata' => $pre_visit_tagging_divide];
       $arr['tag_expiring']  = ['count' => $total_tag_expire, 'title' => 'Tag Expiring in 3 Days', 'viewTitle' => 'Tag Expiring in 3 Days', 'insidedata' => $tag_expire_divide];
       $arr['user_management']  = ['count' => $total_cp_tm, 'title' => 'User Management', 'viewTitle' => 'User Management'];
      /*$arr['total_follw_Prospect_today']       = ['count'=>$total_follw_Prospect_today,'title'=>'Today_followupToday_followup','viewTitle'=>'Today Site Visit Prospect'];
            $arr['totalfollowup7']   = ['count'=>$totalfollowup7,'title'=>'Followup missed in 7 Days','viewTitle'=>'misseds14'];
            $arr['totalfollowup8']   = ['count'=>$totalfollowup8,'title'=>'misseds18','viewTitle'=>'Followups missed > 7 Days'];
            $arr['total_visit']   = ['count'=>$total_visit,'title'=>'Site Visits - Done','viewTitle'=>'Total Site Visit Done'];
            $arr['total_Sale']   = ['count'=>$total_Sale,'title'=>'Sale','viewTitle'=>'Sale Done'];
            $arr['total_Hot']   = ['count'=>$total_Hot,'title'=>'Hot','viewTitle'=>'Hot'];
            $arr['total_Warm']   = ['count'=>$total_Warm,'title'=>'Warm','viewTitle'=>'Warm'];
            $arr['total_Cold']   = ['count'=>$total_Cold,'title'=>'Cold','viewTitle'=>'Cold'];*/
      // $arr['headcenter']   = ['count'=>count($headcenter),'title'=>'headcenter','viewTitle'=>json_decode(json_encode($headcenter), true)];
      #dd($arr);


      return response(['status' => 200, 'msg' => ['Dashboard Success'], 'data' => $arr]);
    } else {
      return response(['status' => 404, 'msg' => ['User not login']]);
    }
  }



  public function show_temp_lead()
  {
    $data['tags'] = DB::table('temp_lead_cp_app')->get();
    return response(['status' => 200, 'msg' => ['Prodcuts Show'], 'data' => $data]);
  }

  public function my_profile(Request $request)
  {
    $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    // dd();
    if ($user == 1) {
      $cp_details = DB::Select("SELECT ibp.itel AS contact,ibp.contact AS contact2,ibp.whatsapp AS whatsapp,ibp.whatsapp AS whatsapp,ibp.owner AS owner_name,ibp.entity AS business_name,ibp.iadd AS address,ibp.landmark,ibp.pincode,ibp.iemail AS email,ibp.website,ibp.idriving AS rera_no,ibp.type_new AS cp_type,ibp.project_name,ibp.profile AS rera_certificate_pic,ibp.profile2 AS visiting_card_pic,ibp.visitcard_back AS visitcard_back_pic,ibp.profile3 AS shop_photograph_pic,ibp.iname AS firm_name FROM user JOIN ibp ON user.ibpid = ibp.id WHERE user.user_name = '$request->user_name' AND user.ibpid = '$request->centerid' AND user.token= '$request->token' AND user.role_type = 'ibp' ");

      return response(['status' => 200, 'msg' => ['Success'], 'data' => $cp_details, 
      'rera_certificate_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files1/',
      'visiting_card_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files2/',
      'shop_photograph_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files3/',
      'visitcard_back_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/visitcard_back/']);
    } else {
      return response(['status' => 404, 'msg' => ['User not login']]);
    }
  }

}
