<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request){
       # dd('Hello');
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){
            
           $arr = array();
           $day1 = date('Y-m-d', strtotime('-1 day'));
           $day7 = date('Y-m-d', strtotime('-7 day'));
           $day8 = date('Y-m-d', strtotime('-8 day'));
           $day9 = "2015-01-01";
          
            $column = ($request->role_type =='DST') ? 'r_employee':'l_employee';
            $headcenter = DB::table('headcenter')->where(['id'=>$request->centerid])->get()->toArray();
            
            $query1 = DB::table('lead_create_multi')->where(['fll_fillby'=>$request->user_name]);
  
                $newlead = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->count();
            
                $totalfollowup = $query1->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
               
                $total_follw_Prospect_today = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '!=', ' ')->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visit Schedule'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
            
                $todayfollowup = $totalfollowup + $total_follw_Prospect_today;

                $totalfollowup7 =  DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day7,$day1])->count();
    
                $totalfollowup8 = DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day9,$day8])->count();
                
                $folloupmissed = $totalfollowup7 + $totalfollowup8;

                $total_visit = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visits - Done'])->count();
    
                $total_Sale = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Sale'])->count();
                
                $total_Hot = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Hot'])->count();
    
                $total_Warm = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Warm'])->count();
    
                $total_Cold = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Cold'])->count();
    
                $followups = $total_Hot + $total_Warm + $total_Cold ;
                #$newlead_divide = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->count()->groupBy('source')->get(['source'])->toArray();

                $newlead_divide1 = DB::table('lead_create_multi')->groupBy('source')->selectRaw('count(id) as sum, source, source as title,"Blank" as dash_type,"" as proid')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->get()->toArray();

                $sitevisits_divide1 = DB::table('lead_create_multi')->groupBy('mul_proid')->selectRaw('count(id) as sum, l_prodt as title,mul_proid as proid,"Site Visits - Done" as dash_type,"" as source')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visits - Done'])->get()->toArray();

                $sales_divide1 = DB::table('lead_create_multi')->groupBy('mul_proid')->selectRaw('count(id) as sum, l_prodt as title,mul_proid as proid,"Sale" as dash_type,"" as source')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Sale'])->get()->toArray();

                $followups_divide1 = DB::table('lead_create_multi')->groupBy('ctype')->selectRaw('count(id) as sum, ctype as dash_type, ctype as title,"" as source,"" as proid')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->whereIn('ctype',['Hot','Warm','Cold'])->get()->toArray();



               
                #dd($followups_divide1);
                #$newlead_divide1 = DB::select("select source,count(id) as count from lead_create_multi where (ltype = '' OR ltype IS NULL)  AND display_status != 'N' AND ".$column."=".$request->centerid." group by source");
                $newlead_divide = json_decode(json_encode($newlead_divide1), true);
                $todayfollowup_divide = array (
                    0 => 
                    array (
                      'sum' => $totalfollowup,
                      'dash_type' => 'Today_followup',
                      'title' => 'Today Followup',
                      'source' => '',
                      'proid' => ''
                    ),
                    1 => 
                    array (
                      'sum' => $total_follw_Prospect_today,
                      'dash_type' => 'Today_followupToday_followup',
                      'title' => 'Today Site Visit Prospect',
                      'source' => '',
                      'proid' => ''
                    ),
                  );
                  $folloupmissed_divide = array (
                    0 => 
                    array (
                      'sum' => $totalfollowup7,
                      'dash_type' => 'misseds14',
                      'title' => 'Followup missed in 7 Days',
                      'source' => '',
                      'proid' => ''
                    ),
                    1 => 
                    array (
                      'sum' => $totalfollowup8,
                      'dash_type' => 'misseds18',
                      'title' => 'Followup missed in >7 Days',
                      'source' => '',
                      'proid' => ''
                    ),
                  );
                  $sitevisits_divide = json_decode(json_encode($sitevisits_divide1), true);
                  $sales_divide = json_decode(json_encode($sales_divide1), true);
                  $followups_divide = json_decode(json_encode($followups_divide1), true);

                
               
            

            $arr['newlead']    = ['count'=>$newlead,'dash_type'=>'Blank','viewTitle'=>'New Lead','insidedata'=>$newlead_divide];
            $arr['todayfollowup']     = ['count'=>$todayfollowup,'title'=>'Today Followup','viewTitle'=>'Todays Followup','insidedata'=>$todayfollowup_divide];
            $arr['folloupmissed']     = ['count'=>$folloupmissed,'title'=>'Followup Missed','viewTitle'=>'Followup Missed','insidedata'=>$folloupmissed_divide];
            $arr['sitevisits']     = ['count'=>$total_visit,'title'=>'Site Visits - Done','viewTitle'=>'Site Visits','insidedata'=>$sitevisits_divide];
            $arr['sales']     = ['count'=>$total_Sale,'title'=>'Sale','viewTitle'=>'Sales','insidedata'=>$sales_divide];
            $arr['followups']     = ['count'=>$followups,'title'=>'In Followups','viewTitle'=>'In Followups','insidedata'=>$followups_divide];


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


           return response(['status'=>200,'msg'=>['Dashboard Success'],'data'=>$arr]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
}
