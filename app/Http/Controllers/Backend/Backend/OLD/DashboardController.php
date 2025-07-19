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
            
            #$query = DB::table('lead_create_multi')->where([$column=>$request->centerid]);
            #$query2 = DB::table('lead_create_multi')->where([$column=>$request->centerid]);
            $query1 = DB::table('lead_create_multi')->where(['fll_fillby'=>$request->user_name]);

            if($request->role_type =='Presales')
            {

              // dd('Hello');
            

            $total_Sale_nt = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', '')->orWhereNull('ltype')->where('r_employee', '=', '')->orwhere('r_employee', '=', 'None')->orWhereNull('r_employee')->get();
           // dd($total_Sale_nt);
            
            $totalfollowup = $query1->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
           
            $total_follw_Prospect_today = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '!=', ' ')->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visit Schedule'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
        
            $totalfollowup7 =  DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day7,$day1])->count();

            $totalfollowup8 = DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day9,$day8])->count();
            
            $total_visit = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visits - Done'])->count();

            $total_Sale = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Sale'])->count();
            
            $total_Hot = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Hot'])->count();

            $total_Warm = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Warm'])->count();

            $total_Cold = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Cold'])->count();

            }
            else
            {
            
                $total_Sale_nt = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->count();
            
                $totalfollowup = $query1->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
               
                $total_follw_Prospect_today = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '!=', ' ')->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visit Schedule'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
            
                $totalfollowup7 =  DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day7,$day1])->count();
    
                $totalfollowup8 = DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day9,$day8])->count();
                
                $total_visit = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visits - Done'])->count();
    
                $total_Sale = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Sale'])->count();
                
                $total_Hot = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Hot'])->count();
    
                $total_Warm = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Warm'])->count();
    
                $total_Cold = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status', '!=', 'N')->where(['ctype'=>'Cold'])->count();
    
            }

            $arr['total_Sale_nt']    = ['count'=>$total_Sale_nt,'title'=>'Blank','viewTitle'=>'Not Contacted Lead'];
            $arr['totalfollowup']     = ['count'=>$totalfollowup,'title'=>'Today_followup','viewTitle'=>'Today Followup'];
            $arr['total_follw_Prospect_today']       = ['count'=>$total_follw_Prospect_today,'title'=>'Site Visit Schedule','viewTitle'=>'Today Site Visit Prospect'];
            $arr['totalfollowup7']   = ['count'=>$totalfollowup7,'title'=>'Followup missed in 7 Days','viewTitle'=>'misseds14'];
            $arr['totalfollowup8']   = ['count'=>$totalfollowup8,'title'=>'misseds18','viewTitle'=>'Followups missed > 7 Days'];
            $arr['total_visit']   = ['count'=>$total_visit,'title'=>'Site Visits - Done','viewTitle'=>'Total Site Visit Done'];
            $arr['total_Sale']   = ['count'=>$total_Sale,'title'=>'Sale','viewTitle'=>'Sale Done'];
            $arr['total_Hot']   = ['count'=>$total_Hot,'title'=>'Hot','viewTitle'=>'Hot'];
            $arr['total_Warm']   = ['count'=>$total_Warm,'title'=>'Warm','viewTitle'=>'Warm'];
            $arr['total_Cold']   = ['count'=>$total_Cold,'title'=>'Cold','viewTitle'=>'Cold'];
           // $arr['headcenter']   = ['count'=>count($headcenter),'title'=>'headcenter','viewTitle'=>json_decode(json_encode($headcenter), true)];
            
            
            
            #dd($arr);


           return response(['status'=>200,'msg'=>['Dashboard Success'],'data'=>$arr]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
}
