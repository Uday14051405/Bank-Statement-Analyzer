<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardNew4March24Controller extends Controller
{
  public function index(Request $request)
  {
    # dd('Hello');
   // $user = DB::table('user')->where(['username' => $request->username, 'id' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
    $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
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
      $headcenter = DB::table('ibp')->where(['id' => $request->centerid])->get()->toArray();

      $query1 = DB::table('lead_create_multi')->where(['fll_fillby' => $request->username]);

      $my_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();
      $my_leads_new = DB::table('npb_lead_create_multi')->where(['add_new_customer_status' => 'Y'])->where(['ibpid' => $request->centerid])->count();     


      //Untounched Lead
      $newlead = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where('ltype', '=', '')->where('ctype', '=', '')->where('display_status', '!=', 'N')->where('fDate', '=', '')->count();

      $newlead_divide1 = DB::table('npb_lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum, source, source as title, "Blank" as dash_type,"" as proid')->where(['ibpid' => $request->centerid])->where('ltype', '=', '')->where('display_status', '!=', 'N')->where('fDate', '=', '')->where('ctype', '=', '')->orderBy('ltype', 'desc')->get()->toArray();

      $newlead_divide = json_decode(json_encode($newlead_divide1), true);


      //Today Followup Lead
      $npb_today_followup = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->count();

      $npb_todayfollowup_divide = DB::table('npb_lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum, source as title,source as dash_type')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [date('Y-m-d'), date('Y-m-d')])->where('ctype', '!=', 'Lost')->where('display_status', '!=', 'N')->orderBy('id', 'asc')->get()->toArray();

      //Task Overdue
      $totalfollowup7 =  DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day2, $day1])->count();

      $totalfollowup8 = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereNotIn('ltype', ['incoming', 'outgoing', 'new', 'cp', 'New', 'incomming', 'Conversation', 'Micro_Site', 'Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate', [$day9, $day3])->count();

      $folloupmissed = $totalfollowup7 + $totalfollowup8;

      $npb_vdnp_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Open'])->count();

      $my_subscribed_leads = DB::table('npb_lead_create_multi')->where(['npb_lead_status' => 'Subscribed'])->where(['ibpid' => $request->centerid])->count();




      $npb_followup_missed = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereBetween('fDate', [$day9, $day1])->count();

      $hm_leads = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['source' => 'Housing Magic'])->count();
      $microsite_leads = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['source' => 'Microsite'])->count();

      $nbp_hot = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Hot'])->count();

      $nbp_warm = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Warm'])->count();

      $nbp_cold = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Cold'])->count();

      $open_opportunity = $nbp_hot + $nbp_warm + $nbp_cold;

      $nbp_lost = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->where(['ctype' => 'Lost'])->count();

      $nbp_booked = DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereIn('ctype', ['Booked'])->count();
      $nbp_eoi= DB::table('npb_lead_create_multi')->where(['ibpid' => $request->centerid])->whereIn('ctype', ['EOI'])->count();

      $lost_lead1  = DB::table('npb_lead_create_multi')->groupBy('dead_reason')->selectRaw('count(id) as sum,dead_reason as title,dead_reason as dead_reason,"" as proid,"Lost_lead" as dash_type')->where(['ibpid' => $request->centerid])->where('ctype', '=', 'Lost')->where('ctype', '!=', '')->where('display_status', '!=', 'N')->get()->toArray();
      $lost_lead = json_decode(json_encode($lost_lead1), true);


      $total_cp_tm = DB::table('user')->where(['ibpid' => $request->centerid, 'status' => 'a' , 'sub_role' => 'cp_tm','role_type' => 'ibp'])->count();   
      // $newlead_divide = json_decode(json_encode($newlead_divide1), true);
      // $todayfollowup_divide = array(
      //   0 =>
      //   array(
      //     'sum' => $totalfollowup,
      //     'dash_type' => 'Today_followup',
      //     'title' => 'Today Followup',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   1 =>
      //   array(
      //     'sum' => $total_follw_Prospect_today,
      //     'dash_type' => 'Today_followupToday_followup',
      //     'title' => 'Today Site Visit Prospect',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      // );
      // $folloupmissed_divide = array(
      //   0 =>
      //   array(
      //     'sum' => $totalfollowup7,
      //     'dash_type' => 'misseds14',
      //     'title' => 'Followup missed in 7 Days',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   1 =>
      //   array(
      //     'sum' => $totalfollowup8,
      //     'dash_type' => 'misseds18',
      //     'title' => 'Followup missed in >7 Days',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      // );

      // $new_boxes1 = array(
      //   0 =>
      //   array(
      //     'sum' => $npb_vdnp_leads,
      //     'dash_type' => 'npb_vdnp_leads',
      //     'title' => 'NPB VDNB Leads',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   1 =>
      //   array(
      //     'sum' => $my_subscribed_leads,
      //     'dash_type' => 'my_subscribed_leads',
      //     'title' => 'My Subscribed Leads',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   2 =>
      //   array(
      //     'sum' => $npb_today_followup,
      //     'dash_type' => 'npb_today_followup',
      //     'title' => 'Today Followup',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   3 =>
      //   array(
      //     'sum' => $npb_followup_missed,
      //     'dash_type' => 'npb_followup_missed',
      //     'title' => 'Followup Missed',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   4 =>
      //   array(
      //     'sum' => $microsite_leads,
      //     'dash_type' => 'microsite_lead',
      //     'title' => 'Microsite Leads',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   5 =>
      //   array(
      //     'sum' => $hm_leads,
      //     'dash_type' => 'HM_Leads',
      //     'title' => 'H.M Leads',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   6 =>
      //   array(
      //     'sum' => $nbp_hot,
      //     'dash_type' => 'npb_Hot',
      //     'title' => 'Hot',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   7 =>
      //   array(
      //     'sum' => $nbp_warm,
      //     'dash_type' => 'npb_Warm',
      //     'title' => 'Warm',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   8 =>
      //   array(
      //     'sum' => $nbp_cold,
      //     'dash_type' => 'npb_Cold',
      //     'title' => 'Cold',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   9 =>
      //   array(
      //     'sum' => $nbp_lost,
      //     'dash_type' => 'npb_lost',
      //     'title' => 'Lost',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   10 =>
      //   array(
      //     'sum' => $nbp_booked,
      //     'dash_type' => 'npb_booked',
      //     'title' => 'Booked',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      //   11 =>
      //   array(
      //     'sum' => $my_leads_new,
      //     'dash_type' => 'my_leads',
      //     'title' => 'My Leads',
      //     'source' => '',
      //     'proid' => ''
      //   ),
      // );


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
      // $sitevisits_divide          = (isset($sitevisits_divide1) && !empty($sitevisits_divide1)) ? json_decode(json_encode($sitevisits_divide1), true) : [];
      // $lost_data_divide           = (isset($lost_data_divide1) && !empty($lost_data_divide1)) ? json_decode(json_encode($lost_data_divide1), true) : [];
      // $sales_divide               = (isset($sales_divide1) && !empty($sales_divide1)) ? json_decode(json_encode($sales_divide1), true) : [];
      // $followups_divide           = (isset($followups_divide1) && !empty($followups_divide1)) ? json_decode(json_encode($followups_divide1), true) : [];
      // $tag_expire_divide          = (isset($tag_expire_divide1) && !empty($tag_expire_divide1)) ? json_decode(json_encode($tag_expire_divide1), true) : [];
      // $tag_visit_proposed         = (isset($tag_visit_proposed1) && !empty($tag_visit_proposed1)) ? json_decode(json_encode($tag_visit_proposed1), true) : [];
      // $tag_micro_site_lead        = (isset($tag_micro_site_lead1) && !empty($tag_micro_site_lead1)) ? json_decode(json_encode($tag_micro_site_lead1), true) : [];
      // $new_boxes        = (isset($new_boxes1) && !empty($new_boxes1)) ? json_decode(json_encode($new_boxes1), true) : [];
      // $visit_expire_divide        = (isset($visit_expire_divide1) && !empty($visit_expire_divide1)) ? json_decode(json_encode($visit_expire_divide1), true) : [];
      // $active_project_divide      = (isset($active_project_divide1) && !empty($active_project_divide1)) ? json_decode(json_encode($active_project_divide1), true) : [];
      // $active_assoc_project_divide      = (isset($active_assoc_project_divide1) && !empty($active_assoc_project_divide1)) ? json_decode(json_encode($active_assoc_project_divide1), true) : [];
      // $active_live_project_divide      = (isset($active_live_project_divide1) && !empty($active_live_project_divide1)) ? json_decode(json_encode($active_live_project_divide1), true) : [];
      // $active_upcoming_project_divide      = (isset($active_upcoming_project_divide1) && !empty($active_upcoming_project_divide1)) ? json_decode(json_encode($active_upcoming_project_divide1), true) : [];

      // $deactive_assoc_project_divide      = (isset($deactive_assoc_project_divide1) && !empty($deactive_assoc_project_divide1)) ? json_decode(json_encode($deactive_assoc_project_divide1), true) : [];
      // $deactive_live_project_divide      = (isset($deactive_live_project_divide1) && !empty($deactive_live_project_divide1)) ? json_decode(json_encode($deactive_live_project_divide1), true) : [];
      // $deactive_upcoming_project_divide      = (isset($deactive_upcoming_project_divide1) && !empty($deactive_upcoming_project_divide1)) ? json_decode(json_encode($deactive_upcoming_project_divide1), true) : [];

      // $inactive_project_divide    = (isset($data_arr) && !empty($data_arr)) ? json_decode(json_encode($data_arr), true) : [];
      // $pre_visit_tagging_divide               = (isset($pre_visit_tagging1) && !empty($pre_visit_tagging1)) ? json_decode(json_encode($pre_visit_tagging1), true) : [];

      /* New App Box For Showing*/
      if (!empty($data_arr) && !is_null($data_arr)) {
        $data_arr = $data_arr;
      } else {
        $data_arr = 'NULL';
      }
      // $arr['visit_proposed'] = ['count' => $total_visiting, 'title' => 'Visit Proposed', 'viewTitle' => 'Visit Proposed', 'insidedata' => $tag_visit_proposed];
      $arr['newlead']        = ['count' => $newlead, 'dash_type' => 'Blank', 'viewTitle' => 'Untouched Leads', 'insidedata' => $newlead_divide];

      $arr['todayfollowup']  = ['count' => $my_subscribed_leads, 'title' => 'My Subscribed Leads', 'viewTitle' => 'My Subscribed Leads', 'insidedata' => $npb_todayfollowup_divide];

      $arr['todayfollowup']  = ['count' => $npb_today_followup, 'title' => 'Today Followup', 'viewTitle' => 'Today Followup', 'insidedata' => $npb_todayfollowup_divide];

      $arr['npb_followup_missed']  = ['count' => $npb_followup_missed, 'title' => 'Followup Missed', 'viewTitle' => 'Followup Missed', 'insidedata' => $folloupmissed_divide];

      $arr['open_opportunity']  = ['count' => $open_opportunity, 'title' => 'Open Opportunity', 'viewTitle' => 'Open Opportunity', 'insidedata' => $open_opportunity_divide];

      $arr['booking']  = ['count' => $nbp_booked, 'title' => 'Booking', 'viewTitle' => 'Booking', 'insidedata' => $booking_divide];

      $arr['lost_lead']        = ['count' => $nbp_lost, 'dash_type' => 'Lost', 'viewTitle' => 'Lost', 'insidedata' => $lost_lead];

      // $arr['walkin_to_revisit']            = ['count' => $revisit_ftd, 'dash_type' => 'Revisit_FTD', 'viewTitle' => 'Revisit FTD', 'insidedata' => $revisit_ftd11];

      // $arr['walkin_to_booking']            = ['count' => $walkin_to_booking_ratio, 'title' => 'Walkin to Booking Ratio', 'viewTitle' => 'Walkin to Booking Ratio'];

      // $arr['reports']            = ['count' => 'Reports', 'title' => 'Reports', 'viewTitle' => 'Reports', 'insidedata' => $reportss];
      $arr['user_management']  = ['count' => $total_cp_tm, 'title' => 'User Management', 'viewTitle' => 'User Management'];


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
    $user = DB::table('register')->where(['username' => $request->username, 'ibpid' => $request->centerid, 'usertype' => $request->usertype, 'token' => $request->token])->count();
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
