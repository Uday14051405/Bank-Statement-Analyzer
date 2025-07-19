<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LogDetailsController extends Controller
{
    public function index(Request $request)
    {
             
    }

    public function view(Request $request){



        #dd('Hello');
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $role_type_source  = $request->role_type;
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'ibpid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        
        // print_r($request->all());
        // echo "<br>";
        // echo $user;
        // exit();
        if($user == 1){

            $day1 = date('Y-m-d', strtotime('-1 day'));
            $day7 = date('Y-m-d', strtotime('-7 day'));
            $day8 = date('Y-m-d', strtotime('-8 day'));
            $day9 = "2015-01-01";

            #$column = ($request->role_type =='DST') ? 'r_employee':'l_employee';
            #$query = DB::table('lead_create_multi')->where('id','=',1)->get()->toArray();
            $query = DB::table('lead_create_multi');
            #dd($query);
           # $query = DB::table('lead_create_multi')->where([$column=>$request->centerid])->where('display_status','!=','N');
            $dash_type = $request->dash_type;
            $source = $request->source;
            $proid = $request->proid;
            $lead_id = $request->lead_id;
            $column1 = ($dash_type =='Site Visit Schedule' || $dash_type =='Site Visits - Done') ? 'ltype':'ctype';

            
            
            #$da = DB::select("select DISTINCT lead_create_multi.* from lead_create_multi where id != '' AND display_status != 'N' AND l_employee = '24' AND lead_create_multi.ltype not in ('incoming','outgoing','new','cp','New','incomming','Conversation','Micro_Site','Lost') AND lead_create_multi.ctype != 'Lost' AND (r_employee = '' OR r_employee = 'None' OR r_employee IS NULL)  AND lead_create_multi.fDate between '2022-01-16' and '2022-01-22' order by lead_create_multi.fDate ASC");
           #dd($da);

           if (! empty($source)) 
           $query = $query->where('source','=',$source);
           if (! empty($lead_id)) 
           $query = $query->where('lead_id','=',$lead_id);
           if (! empty($proid)) 
           $query = $query->where('mul_proid','=',$proid);

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
               #$query = $query->where([$column1=>$request->dash_type]);
            }

            

            if($request->role_type =='Presales'){
                $query = $query->where('r_employee', '=', '')->orwhere('r_employee', '=', 'None')->orWhereNull('r_employee');
            }
            $data = $query->get(['l_bid','l_jtitle','l_company','l_tfd','l_itos','l_rs','l_rsl','l_hqc','l_lhs','l_hc','l_pcln','l_pce','l_pcn','l_pcn1','l_pcn2','l_pcn3','l_bid','l_jtitle','purpose','lead_upload_date','ibpid','l_mobile','l_mobile1','l_mobile2','uploadcomment','eadd','adv','prof','lead_id','lead_create_date','l_pc','fdate','l_fname','l_lname','l_pno','l_employee','r_employee','l_rs','source','vendor','l_prodt','l_pcfn','Property','l_rsl','ltype','ctype','l_email','fll_details','mul_proid'])->toArray();
			#dd($data);
            $resultArray = json_decode(json_encode($data), true);

            #$newlead_divide1 = DB::table('lead_log')->groupBy('source')->selectRaw('count(id) as sum, source, source as title,"Blank" as dash_type,"" as proid')->where([$column=>$request->centerid])->where('ltype', '=', ' ')->orWhereNull('ltype')->where('display_status', '!=', 'N')->get()->toArray();

            $lead_res_arr = array();
            $lead_res_project_ = array();
            $lead_res_arr_ = array();

            $allo_dst = DB::table('headcenter')->where(['status'=>'Active','role'=>'DST'])->get(['id','iname as name']);
            $allo_dst_data = json_decode(json_encode($allo_dst),True);
           
            $allo_sm = DB::table('headcenter')->where(['status'=>'Active','role'=>'Presales'])->get(['id','iname as name']);
            $allo_sm_data = json_decode(json_encode($allo_sm),True);

            $allo_cp = DB::table('ibp')->where(['status'=>'Active'])->get(['id','iname as name']);
            $allo_cp_data = json_decode(json_encode($allo_cp),True);
            
            $allo_pro = DB::table('products')->where(['status'=>'Y'])->orderBy('id', 'desc')->get(['pro_name as id','name']);
            $allo_pro_data = json_decode(json_encode($allo_pro),True);
            
            if($role_type_source == 'Presales')
		{
            $allo_source = DB::table('v_source1')->where(['status'=>'Y'])->orderBy('id', 'desc')->get(['slogan']);
            $allo_source_data = json_decode(json_encode($allo_source),True);
        }
        else
        {
            $allo_source = DB::table('v_source1')->whereIn('slogan', ['CP','Walkin','Self'])->where(['status'=>'Y'])->orderBy('id', 'desc')->get(['slogan']);
            $allo_source_data = json_decode(json_encode($allo_source),True);
         }

         $insert_log_medium1 = DB::table('followup_medium')->where(['status'=>1])->orderBy('id', 'ASC')->get(['id','name']);
         $insert_log_medium = json_decode(json_encode($insert_log_medium1),True);
        
         $insert_log_pro1 = DB::table('lead_create_multi')->where(['lead_id'=>$request->lead_id])->orderBy('id', 'DESC')->get(['mul_proid as id','mul_proname as name']);
         $insert_log_pro = json_decode(json_encode($insert_log_pro1),True);
         
         $insert_log_reason1 = DB::table('dead_enquiry_reasons')->where(['status'=>1])->orderBy('id','ASC')->get(['id','reason as name']);
         $insert_log_reason = json_decode(json_encode($insert_log_reason1),True);
         #dd($insert_log_reason);

            $leadLog = DB::table('lead_log')->where(['ll_leadid'=>$request->lead_id])->where('mul_proid', '!=', '')->where('mul_proname', '!=', '')->get(['id','ll_details','ll_fillby','mul_proid','mul_proname','ll_username','ll_leadid','status','Date','Time','dtime','ltype','ctype','csm_id','sm_id','followup_medium','lead_log_count','mydate','dead_reason','filename1']);
            $leadLog_arr = json_decode(json_encode($leadLog),True);
            foreach($leadLog_arr as $logkey=>$logval){
               

                $sql1gfggf = DB::table('lead_create_multi')->where(['lead_id'=>$logval['ll_leadid'],'mul_proid'=>$logval['mul_proid']])->first(['mul_cp','mul_cpsm','mul_dst','mul_source']);

                $sql1gfggf_ = json_decode(json_encode($sql1gfggf),True);

                $mul_dst_p = (isset($sql1gfggf_['mul_dst']) ? $sql1gfggf_['mul_dst'] :0);
                $mul_cpsm_p = (isset($sql1gfggf_['mul_cpsm']) ? $sql1gfggf_['mul_cpsm'] :0);
                $mul_cp_p = (isset($sql1gfggf_['mul_cp']) ? $sql1gfggf_['mul_cp'] :0);
                $mul_source_p = (isset($sql1gfggf_['mul_source']) ? $sql1gfggf_['mul_source'] :'');
                
                $mul_dst_name = DB::table('headcenter')->where(['id'=>$mul_dst_p,'role'=>'DST'])->pluck('iname')->first();

                $mul_cpsm_name = DB::table('headcenter')->where(['id'=>$mul_cpsm_p])->where('role','!=','DST')->pluck('iname')->first();

                $mul_cp_name = DB::table('ibp')->where(['id'=>$mul_cp_p])->pluck('iname')->first();

                
                // $lead_res_project_[$logval['mul_proid']][$sql1gfggf_['mul_source']][$mul_dst_name][$mul_cpsm_name][$mul_cp_name][] = ['ll_details'=>$logval['ll_details'],'username'=>$logval['ll_fillby'],'source'=>$sql1gfggf_['mul_source'],'DST'=>$mul_dst_name,'SM'=>$mul_cpsm_name,'CP'=>$mul_cp_name];
                #dd($lead_res_project_);
                $old_date =  $logval['mydate'];
	            $middle = strtotime($old_date);            // returns bool(false)
                $new_date = date('d-m-Y H:i:s', $middle);
	  
                $lead_res_arr[$logval['mul_proid']][] = ['ll_details'=>$logval['ll_details'],'mul_proname'=>$logval['mul_proname'],'followup_medium'=>$logval['followup_medium'],'username'=>$logval['ll_fillby'],'lead_log_count'=>$logval['lead_log_count'],'new_date'=>$new_date,'userdate'=>$logval['Date'],'usertime'=>$logval['Time'],'ltype'=>$logval['ltype'],'ctype'=>$logval['ctype'],'dead_reason'=>$logval['dead_reason'],'filename'=>$logval['filename1']];

                $lead_res_arr[$logval['mul_proid']]['status'] = ['project Name'=>$logval['mul_proname'],'source'=>$mul_source_p,'DST'=>$mul_dst_name,'SM'=>$mul_cpsm_name,'CP'=>$mul_cp_name,'project_id'=>$logval['mul_proid']];

              #  $lead_res_arr_[$logval['mul_proid']][$logval['ll_leadid']][$logval['mul_cp']][$logval['mul_cpsm']][$logval['mul_dst']][$logval['mul_source']][] = ['mul_cp'=>$logval['mul_cp'],'mul_cpsm'=>$logval['mul_cpsm'],'mul_dst'=>$logval['mul_dst'],'mul_source'=>$logval['mul_source']];
            }
            

            
           # dd($lead_res_arr_);
            foreach($resultArray as $key=>$val)
            {

                $l_employee = DB::table('headcenter')->where(['id'=>$val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id'=>$val['r_employee']])->pluck('iname')->toArray();
                //$ibpid = DB::table('ibp')->where(['id'=>$val['ibpid']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->select('iname', 'ihand','owner')->where(['id' => $val['ibpid']])->first();

                $val['l_employee'] = (count($l_employee) > 0 ) ? $l_employee[0]:'';
                $val['r_employee'] = (count($r_employee) > 0 ) ? $r_employee[0]:'';
                //$val['ibpid'] = (count($ibpid) > 0 ) ? $ibpid[0]:'';
                $val['iname'] = (isset($ibpid->iname) && !empty($ibpid->iname)) ? $ibpid->iname : '';
                $val['ihand'] = (isset($ibpid->ihand) && !empty($ibpid->ihand)) ? $ibpid->ihand : '';
                $val['owner'] = (isset($ibpid->owner) && !empty($ibpid->owner)) ? $ibpid->owner : '';
                $data_arr[] = $val;
            }
            return response(['status'=>200,'msg'=>['Dashboard View Success'],'count'=>count($resultArray),'data'=>$data_arr,'lead_res_arr'=>$lead_res_arr,'all_lead'=>$leadLog_arr,'allo_dst_data'=>$allo_dst_data,'allo_sm_data'=>$allo_sm_data,'allo_cp_data'=>$allo_cp_data,'allo_pro_data'=>$allo_pro_data,'allo_source_data'=>$allo_source_data,'insert_log_medium'=>$insert_log_medium,'insert_log_pro'=>$insert_log_pro,'insert_log_reason'=>$insert_log_reason]);
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
       
    }
}
