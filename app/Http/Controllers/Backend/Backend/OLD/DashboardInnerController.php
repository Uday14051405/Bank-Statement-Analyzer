<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardInnerController extends Controller
{
    public function index(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){
            
           $arr = array();
           $day1 = date('Y-m-d', strtotime('-1 day'));
           $day7 = date('Y-m-d', strtotime('-7 day'));
           $day8 = date('Y-m-d', strtotime('-8 day'));
           $day9 = "2015-01-01";
          
            $column = ($request->role_type =='DST') ? 'r_employee':'l_employee';

           # $headcenter = DB::table('headcenter')->where(['id'=>$request->centerid])->get()->toArray();
            
            $total_Sale_nt = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->get(['lead_id','mul_procode','mul_source'])->toArray();

            $arr['total_Sale_nt']   = $total_Sale_nt;
            #$arr['headcenter']   = json_decode(json_encode($headcenter), true);
            #dd($arr);

           return response(['status'=>200,'msg'=>['Dashboard Success'],'data'=>$arr]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
    public function view(Request $request){
        
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){

            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            $column = ($request->role_type =='DST') ? 'r_employee':'l_employee';
            $query = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status','!=','N');
            $dash_type = $request->dash_type;
            $column1 = ($dash_type =='Site Visit Schedule' || $dash_type =='Site Visits - Done') ? 'ltype':'ctype';

            
            
            #$da = DB::select("select DISTINCT lead_create_multi.* from lead_create_multi where id != '' AND display_status != 'N' AND l_employee = '24' AND lead_create_multi.ltype not in ('incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost') AND lead_create_multi.ctype != 'Lost' AND (r_employee = '' OR r_employee = 'None' OR r_employee IS NULL)  AND lead_create_multi.fDate between '2022-01-16' and '2022-01-22' order by lead_create_multi.fDate ASC");
           #dd($da);
            if($dash_type == 'Blank'){
                $query = $query->where('ltype','=','')->orWhereNull('ltype');
            }
            elseif($dash_type == 'Today_followup'){
                $query = $query->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->whereBetween('fDate',[$from_date,$to_date]);
            }
            elseif($dash_type == 'Today_SiteVisitsProspect'){
                $query = $query->where(['ltype'=>'Site Visit Schedule'])->whereBetween('fDate',[$from_date,$to_date]);
            }

            elseif($dash_type == 'misseds14'){
                $query = $query->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('ctype','!=','Lost')->whereBetween('fDate',[$day7,$day1]);
            }

            elseif($dash_type == 'misseds18'){
                $query = $query->whereNotIn('ltype',['incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost'])->where('ctype','!=','Lost')->whereBetween('fDate',[$day9,$day8]);
            }
           
           else{
               $query = $query->where([$column1=>$request->dash_type]);
            }

            if($request->role_type =='Presales'){
                $query = $query->where('r_employee', '=', '')->orwhere('r_employee', '=', 'None')->orWhereNull('r_employee');
            }
            $data = $query->get(['lead_id','lead_create_date','l_pc','fdate','l_fname','l_lname','l_pno','l_employee','r_employee','l_rs','source','ibpid','vendor','l_prodt','l_pcfn','Property','l_rsl','ltype','ctype','l_email','fll_details'])->toArray();
			#dd($data);
            $resultArray = json_decode(json_encode($data), true);

            foreach($resultArray as $key=>$val){

                $l_employee = DB::table('headcenter')->where(['id'=>$val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id'=>$val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id'=>$val['ibpid']])->pluck('iname')->toArray();

                $val['l_employee'] = (count($l_employee) > 0 ) ? $l_employee[0]:'';
                $val['r_employee'] = (count($r_employee) > 0 ) ? $r_employee[0]:'';
                $val['ibpid'] = (count($ibpid) > 0 ) ? $ibpid[0]:'';
                $data_arr[] = $val;
            }
            return response(['status'=>200,'msg'=>['Dashboard View Success'],'count'=>count($resultArray),'data'=>$data_arr]);
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
       
    }
}
