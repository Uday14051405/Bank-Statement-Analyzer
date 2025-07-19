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
            
            $query = DB::table('lead_create_multi')->where([$column=>$request->centerid]);
            $query2 = DB::table('lead_create_multi')->where([$column=>$request->centerid]);
            $query1 = DB::table('lead_create_multi')->where(['fll_fillby'=>$request->user_name]);

            $total_Sale_nt = $query->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->count();
            
            $totalfollowup = $query1->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
           
            $total_follw_Prospect_today = $query->where('ltype', '!=', ' ')->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visit Schedule'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
        
            $totalfollowup7 =  DB::table('lead_create_multi')->where([$column=>$request->centerid])->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day7,$day1])->count();

            $totalfollowup8 = $query->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('display_status', '!=', 'N')->where('ctype', '!=', 'Lost')->whereBetween('fDate',[$day9,$day8])->count();
            #dd($totalfollowup8);

            $total_visit = $query->where('display_status', '!=', 'N')->where(['ltype'=>'Site Visits - Done'])->count();

            $total_Sale = $query->where('display_status', '!=', 'N')->where(['ctype'=>'Sale'])->count();
            
            $total_Hot = $query->where('display_status', '!=', 'N')->where(['ctype'=>'Hot'])->count();

            $total_Warm = $query->where('display_status', '!=', 'N')->where(['ctype'=>'Warm'])->count();

            $total_Cold = $query->where('display_status', '!=', 'N')->where(['ctype'=>'Cold'])->count();


            #dd($total_visit);

/*
            $total_Walkin = $query->where(['source'=>'Walkin'])->count();
            $total_Self = $query->where(['source'=>'Self'])->count();

            $total_Micro_Site = $query->where(['source'=>'Micro_Site'])->count();
            $totalfollowup = $query->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Dead'])->whereBetween('fDate',[date('Y-m-d'),date('Y-m-d')])->count();
           */
           

            $arr['total_Sale_nt']    = $total_Sale_nt;
            $arr['totalfollowup']     = $totalfollowup;
            $arr['total_follw_Prospect_today']       = $total_follw_Prospect_today;
            $arr['totalfollowup7']   = $totalfollowup7;
            $arr['totalfollowup8']   = $totalfollowup8;
            $arr['total_visit']   = $total_visit;
            $arr['total_Sale']   = $total_Sale;
            $arr['total_Hot']   = $total_Hot;
            $arr['total_Warm']   = $total_Warm;
            $arr['total_Cold']   = $total_Cold;
            $arr['headcenter']   = json_decode(json_encode($headcenter), true);
            dd($arr);


           return response(['status'=>200,'msg'=>['Login Success'],'data'=>$arr]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
}
