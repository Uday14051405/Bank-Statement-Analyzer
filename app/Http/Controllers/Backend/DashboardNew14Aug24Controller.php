<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardNew14Aug24Controller extends Controller
{
  public function index(Request $request)
  {
    # dd('Hello');
   // $user = DB::connection('mysql_second')->table('user')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    $user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
    // dd();
    if ($user == 1) {

      $arr   = array();
      $day1  = date('Y-m-d', strtotime('-1 day'));
      $day2 = date('Y-m-d', strtotime('-2 day'));  
      $day3 = date('Y-m-d', strtotime('-3 day'));  
      $day_3 = date('Y-m-d', strtotime('+3 day'));
      $day_60 = date('Y-m-d', strtotime('+60 day'));
      $day7  = date('Y-m-d', strtotime('-7 day'));
      $day8  = date('Y-m-d', strtotime('-8 day'));
      $today = date('Y-m-d');
      $day9  = "2015-01-01";

      $column = ($request->usertype == 'ibp') ? 'ibpid' : 'l_employee';
      $column1 = ($request->usertype == 'ibp') ? 'a.ibpid' : 'a.l_employee';
      $headcenter = DB::connection('mysql_second')->table('ibp')->where(['id' => $request->centerid])->get()->toArray();

      $query1 = DB::connection('mysql_second')->table('lead_create_multi')->where(['fll_fillby' => $request->username]);

      $my_leads = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();
      $my_leads_new = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['add_new_customer_status' => 'Y'])->where(['ibpid' => $request->centerid])->count();     


      //Untounched Lead
      $newlead = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where('ltype', '=', '')->where('ctype', '=', '')->where('display_status', '!=', 'N')->where('fDate', '=', '')->count();

      $newlead_divide1 = DB::connection('mysql_second')->table('npb_lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum, source, source as title, "Blank" as dash_type,"" as proid')->where(['ibpid' => $request->centerid])->where('ltype', '=', '')->where('display_status', '!=', 'N')->where('fDate', '=', '')->where('ctype', '=', '')->orderBy('ltype', 'desc')->get()->toArray();

      $newlead_divide = json_decode(json_encode($newlead_divide1), true);


      //Today Followup Lead
      $npb_today_followup = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->count();

      $npb_todayfollowup_divide = DB::connection('mysql_second')->table('npb_lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum,"Today_followup" as dash_type,source as title,source')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->where('ctype', '!=', 'Lost')->where('display_status', '!=', 'N')->orderBy('id', 'asc')->get()->toArray();

      //Task Overdue
      $totalfollowup7 =  DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day2, $day1])->count();

      $totalfollowup8 = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day9, $day3])->count();

      $folloupmissed = $totalfollowup7 + $totalfollowup8;

      $npb_vdnp_leads = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['npb_lead_status' => 'Open'])->count();

      $my_subscribed_leads = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();




      $npb_followup_missed = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [$day9, $day1])->count();

      $hm_leads = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['source' => 'Housing Magic'])->count();
      $microsite_leads = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['source' => 'Microsite'])->count();

      $nbp_hot = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Hot'])->count();

      $nbp_warm = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Warm'])->count();

      $nbp_cold = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Cold'])->count();

      $open_opportunity = $nbp_hot + $nbp_warm + $nbp_cold;

      $nbp_lost = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Lost'])->count();

      $nbp_booked = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereIn('ctype', ['Booked'])->count();
      $nbp_eoi= DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereIn('ctype', ['EOI'])->count();

      $lost_lead1  = DB::connection('mysql_second')->table('npb_lead_create_multi')->groupBy('dead_reason')->selectRaw('count(id) as sum,dead_reason as title,dead_reason as dead_reason,"" as proid,"Lost_lead" as dash_type')->where(['ibpid' => $request->centerid])->where('ctype', '=', 'Lost')->where('ctype', '!=', '')->where('display_status', '!=', 'N')->get()->toArray();
      $lost_lead = json_decode(json_encode($lost_lead1), true);


      $total_cp_tm = DB::connection('mysql_second')->table('user')->where(['ibpid' => $request->centerid, 'status' => 'a' , 'sub_role' => 'cp_tm','role_type' => 'ibp'])->count();  
      
      
      //Site Visits Done
      
      $total_visit = DB::connection('mysql_second')->table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->whereIn('a.ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3'])->count();


      // Visit Lost
      $total_Lost = DB::connection('mysql_second')->table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Lost'])->where('visit_expiry_60days', '<=', $today)->count();

      $total_visit_expire = DB::connection('mysql_second')->table('lead_create_multi')->whereBetween('visit_expiry_60days', [$today, $day_3])->where(['ibpid' => $request->centerid])->count();

      $total_tag_expire = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->whereBetween('expiry', [$today, $day_3])->where(['cp_id' => $request->centerid])->count();

      $pre_visit_tagging = DB::connection('mysql_second')->table('temp_lead_cp_app')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->count();
      
      $pre_visit_tagging1 = DB::connection('mysql_second')->table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "pre_visit_tagging" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('expiry', '>=', $today)->where(['cp_id' => $request->centerid])->orderBy('created_on', 'desc')->get()->toArray();

      $visit_expire_divide1 = DB::connection('mysql_second')->table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proname')->selectRaw('count(a.id) as sum, a.mul_proname as title, "site_visit_expired" as dash_type, a.mul_proid as proid,"" as source')->whereBetween('a.visit_expiry_60days', [$today, $day_3])->where('b.app_show_status', 'Y')->where(['a.ibpid' => $request->centerid])->orderBy('a.l_mydate', 'desc')->get()->toArray();

      
      $sitevisits_divide1 = DB::connection('mysql_second')->table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proid')->selectRaw('count(a.id) as sum, a.mul_proname as title, a.mul_proid as proid,"site_visits_done" as dash_type,"" as source')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->whereIn('a.ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3'])->orderBy('a.l_mydate', 'desc')->get()->toArray();


      $lost_data_divide1 = DB::connection('mysql_second')->table('lead_create_multi as a')->join('products as b', 'b.id', '=', 'a.mul_proid')->groupBy('a.mul_proname')->selectRaw('count(a.id) as sum, a.mul_proname as title, "total_visit_lost" as dash_type, a.mul_proid as proid, "" as source')->where([$column1 => $request->centerid])->where('b.app_show_status', 'Y')->where('a.display_status', '!=', 'N')->where(['a.ctype' => 'Lost'])->where('a.visit_expiry_60days', '<=', $today)->orderBy('a.l_mydate', 'desc')->get()->toArray();
  

      
      $tag_expire_divide1 = DB::connection('mysql_second')->table('temp_lead_cp_app')->groupBy('project_name')->selectRaw('count(id) as sum, project_name as title, "site_visit_expired" as dash_type,"" as source')->where('site_visit_done', '!=', 'Yes')->where('lead_status', '!=', 'LOST')->whereBetween('expiry', [$today, $day_3])->where(['cp_id' => $request->centerid])->where('lead_status', '!=', 'LOST')->orderBy('created_on', 'desc')->get()->toArray();
      
      $folloupmissed_divide = array(
        0 =>
        array(
          'sum' => $totalfollowup7,
          'dash_type' => 'misseds14',
          'title' => 'Tasks Overdue in 2 Days',
          'source' => '',
          'proid' => ''
        ),
        1 =>
        array(
          'sum' => $totalfollowup8,
          'dash_type' => 'misseds18',
          'title' => 'Tasks Overdue in >2 Days',
          'source' => '',
          'proid' => ''
        ),
      );

      $open_opportunity_divide = array(
        0 =>
        array(
          'sum' => $nbp_hot,
          'dash_type' => 'npb_Hot',
          'title' => 'Hot',
          'source' => '',
          'proid' => ''
        ),
        1 =>
        array(
          'sum' => $nbp_warm,
          'dash_type' => 'npb_Warm',
          'title' => 'Warm',
          'source' => '',
          'proid' => ''
        ),
        2 =>
        array(
          'sum' => $nbp_cold,
          'dash_type' => 'npb_Cold',
          'title' => 'Cold',
          'source' => '',
          'proid' => ''
        ),
      
      );



      
      $booking_divide = array(
        0 =>
        array(
          'sum' => $nbp_eoi,
          'dash_type' => 'EOI',
          'title' => 'EOI',
          'source' => '',
          'proid' => ''
        ),
        1 =>
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
      // $sales_divide               = (isset($sales_divide1) && !empty($sales_divide1)) ? json_decode(json_encode($sales_divide1), true) : [];
      // $followups_divide           = (isset($followups_divide1) && !empty($followups_divide1)) ? json_decode(json_encode($followups_divide1), true) : [];
      $tag_expire_divide          = (isset($tag_expire_divide1) && !empty($tag_expire_divide1)) ? json_decode(json_encode($tag_expire_divide1), true) : [];
      // $tag_visit_proposed         = (isset($tag_visit_proposed1) && !empty($tag_visit_proposed1)) ? json_decode(json_encode($tag_visit_proposed1), true) : [];
      // $tag_micro_site_lead        = (isset($tag_micro_site_lead1) && !empty($tag_micro_site_lead1)) ? json_decode(json_encode($tag_micro_site_lead1), true) : [];
      // $new_boxes        = (isset($new_boxes1) && !empty($new_boxes1)) ? json_decode(json_encode($new_boxes1), true) : [];
      $visit_expire_divide        = (isset($visit_expire_divide1) && !empty($visit_expire_divide1)) ? json_decode(json_encode($visit_expire_divide1), true) : [];
      // $active_project_divide      = (isset($active_project_divide1) && !empty($active_project_divide1)) ? json_decode(json_encode($active_project_divide1), true) : [];
      // $active_assoc_project_divide      = (isset($active_assoc_project_divide1) && !empty($active_assoc_project_divide1)) ? json_decode(json_encode($active_assoc_project_divide1), true) : [];
      // $active_live_project_divide      = (isset($active_live_project_divide1) && !empty($active_live_project_divide1)) ? json_decode(json_encode($active_live_project_divide1), true) : [];
      // $active_upcoming_project_divide      = (isset($active_upcoming_project_divide1) && !empty($active_upcoming_project_divide1)) ? json_decode(json_encode($active_upcoming_project_divide1), true) : [];

      // $deactive_assoc_project_divide      = (isset($deactive_assoc_project_divide1) && !empty($deactive_assoc_project_divide1)) ? json_decode(json_encode($deactive_assoc_project_divide1), true) : [];
      // $deactive_live_project_divide      = (isset($deactive_live_project_divide1) && !empty($deactive_live_project_divide1)) ? json_decode(json_encode($deactive_live_project_divide1), true) : [];
      // $deactive_upcoming_project_divide      = (isset($deactive_upcoming_project_divide1) && !empty($deactive_upcoming_project_divide1)) ? json_decode(json_encode($deactive_upcoming_project_divide1), true) : [];

      // $inactive_project_divide    = (isset($data_arr) && !empty($data_arr)) ? json_decode(json_encode($data_arr), true) : [];
      $pre_visit_tagging_divide               = (isset($pre_visit_tagging1) && !empty($pre_visit_tagging1)) ? json_decode(json_encode($pre_visit_tagging1), true) : [];

      /* New App Box For Showing*/
      if (!empty($data_arr) && !is_null($data_arr)) {
        $data_arr = $data_arr;
      } else {
        $data_arr = 'NULL';
      }
      // $arr['visit_proposed'] = ['count' => $total_visiting, 'title' => 'Visit Proposed', 'viewTitle' => 'Visit Proposed', 'insidedata' => $tag_visit_proposed];
      $arr['newlead']        = ['count' => $newlead, 'dash_type' => 'Blank', 'viewTitle' => 'Untouched Leads', 'insidedata' => $newlead_divide];

      // $arr['todayfollowup']  = ['count' => $my_subscribed_leads, 'title' => 'My Subscribed Leads', 'viewTitle' => 'My Subscribed Leads', 'insidedata' => $npb_todayfollowup_divide];

      $arr['todayfollowup']  = ['count' => $npb_today_followup, 'title' => 'Today Followup', 'viewTitle' => 'Today Followup', 'insidedata' => $npb_todayfollowup_divide];

      $arr['npb_followup_missed']  = ['count' => $npb_followup_missed, 'title' => 'Followup Missed', 'viewTitle' => 'Followup Missed', 'insidedata' => $folloupmissed_divide];

      $arr['open_opportunity']  = ['count' => $open_opportunity, 'title' => 'Open Opportunity', 'viewTitle' => 'Open Opportunity', 'insidedata' => $open_opportunity_divide];

      $arr['booking']  = ['count' => $nbp_booked, 'title' => 'Booking', 'viewTitle' => 'Booking', 'insidedata' => $booking_divide];

      $arr['lost_lead']        = ['count' => $nbp_lost, 'dash_type' => 'Lost', 'viewTitle' => 'Lost', 'insidedata' => $lost_lead];

      $arr['sitevisits']    = ['count' => $total_visit, 'title' => 'Site Visits - Done', 'viewTitle' => 'Site Visits Done', 'insidedata' => $sitevisits_divide];

      $arr['total_Lost']    = ['count' => $total_Lost, 'title' => 'Lost', 'viewTitle' => 'Visit Lost', 'insidedata' => $lost_data_divide];
      
      $arr['visit_expiring']  = ['count' => $total_visit_expire, 'title' => 'Visit Expire', 'viewTitle' => 'Visit Expiring', 'insidedata' => $visit_expire_divide];

      $arr['pre_visit_tagging']  = ['count' => $pre_visit_tagging, 'title' => 'Pre Visit Tagging', 'viewTitle' => 'Pre Visit Tagging', 'insidedata' => $pre_visit_tagging_divide];

      $arr['tag_expiring']  = ['count' => $total_tag_expire, 'title' => 'Tag Expiring in 3 Days', 'viewTitle' => 'Tag Expiring in 3 Days', 'insidedata' => $tag_expire_divide];

      $arr['user_management']  = ['count' => $total_cp_tm, 'title' => 'User Management', 'viewTitle' => 'User Management'];

      // $arr['walkin_to_revisit']            = ['count' => $revisit_ftd, 'dash_type' => 'Revisit_FTD', 'viewTitle' => 'Revisit FTD', 'insidedata' => $revisit_ftd11];

      // $arr['walkin_to_booking']            = ['count' => $walkin_to_booking_ratio, 'title' => 'Walkin to Booking Ratio', 'viewTitle' => 'Walkin to Booking Ratio'];

      // $arr['reports']            = ['count' => 'Reports', 'title' => 'Reports', 'viewTitle' => 'Reports', 'insidedata' => $reportss];
    

      return response(['status' => 200, 'msg' => ['Dashboard Success'], 'data' => $arr]);
    } else {
      return response(['status' => 404, 'msg' => ['User not login']]);
    }
  }



  public function show_temp_lead()
  {
    $data['tags'] = DB::connection('mysql_second')->table('temp_lead_cp_app')->get();
    return response(['status' => 200, 'msg' => ['Prodcuts Show'], 'data' => $data]);
  }

  public function my_profile(Request $request)
  {
    $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'ibpid' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    // dd();
    if ($user == 1) {
      $cp_details = DB::Select("SELECT ibp.itel AS contact,ibp.contact AS contact2,ibp.whatsapp AS whatsapp,ibp.whatsapp AS whatsapp,ibp.owner AS owner_name,ibp.entity AS business_name,ibp.iadd AS address,ibp.landmark,ibp.pincode,ibp.iemail AS email,ibp.website,ibp.idriving AS rera_no,ibp.type_new AS cp_type,ibp.project_name,ibp.profile AS rera_certificate_pic,ibp.profile2 AS visiting_card_pic,ibp.visitcard_back AS visitcard_back_pic,ibp.profile3 AS shop_photograph_pic,ibp.iname AS firm_name FROM user JOIN ibp ON user.ibpid = ibp.id WHERE user.username = '$request->username' AND user.ibpid = '$request->centerid' AND user.token= '$request->token' AND user.usertype = 'ibp' ");

      return response([
        'status' => 200, 'msg' => ['Success'], 'data' => $cp_details,
        'rera_certificate_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files1/',
        'visiting_card_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files2/',
        'shop_photograph_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/files3/',
        'visitcard_back_image_path' => 'https://d78.vvelocity.com/center_project_dst/storage/app/uploads/visitcard_back/'
      ]);
    } else {
      return response(['status' => 404, 'msg' => ['User not login']]);
    }
  }
}
