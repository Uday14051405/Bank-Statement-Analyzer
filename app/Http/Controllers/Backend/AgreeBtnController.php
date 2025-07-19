<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgreeBtnController extends Controller
{
    public function index(Request $request){
     
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'ibpid'=>$request->centerid,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){
            $centerid=$request->centerid;
            $user_name=$request->user_name;
            $lead_id=$request->lead_id;
            $mul_proid=$request->mul_proid;
            $ibpid=$request->centerid;
            $current_date_time = date('Y-m-d h:i:s');

            $res_pro = DB::table('products')->where(['id' => $mul_proid])->first(['id', 'mul_procode', 'name']);
            $cpid    = (isset($res_pro->id) ? $res_pro->id : 0);
            $mul_procode        = (isset($res_pro->mul_procode) ? $res_pro->mul_procode : 0);
            $mul_proname        = (isset($res_pro->name) ? $res_pro->name : 0);

            $res_cp = DB::table('ibp')->where(['id' => $ibpid])->first(['id', 'owner', 'iname']);
            $cpid    = (isset($res_cp->id) ? $res_cp->id : 0);
            $cp_firmname        = (isset($res_cp->iname) ? $res_cp->iname : 0);
            $cp_name        = (isset($res_cp->owner) ? $res_cp->owner : 0);

            $res_sm = DB::table('cp_empanelled_data')->where(['cpid' => $ibpid])->where(['projectid' => $mul_proid])->where(['emp_status' => 'Y'])->first(['smid']);
            $smid    = (isset($res_sm->smid) ? $res_sm->smid : 0);
       

            $leadnpb_update = DB::update("update npb_lead_create_multi set npb_lead_status = 'Subscribed',ibpid = '$ibpid',mul_cpsm = '$smid',l_employee = '$smid',mul_cp = '$ibpid' where lead_id='" . $lead_id . "' AND mul_proid='" . $mul_proid . "'");
            
            $lead_log_arr['sub'] = '';
            $lead_log_arr['ll_details'] = 'This Lead has been allocated to '.$cp_firmname;
            $lead_log_arr['ll_fillby'] = $user_name;
            $lead_log_arr['ll_username'] = $ibpid;
            $lead_log_arr['ll_shop_id'] = $user_name;
            $lead_log_arr['ll_leadcode'] = $lead_id;
            $lead_log_arr['ll_leadid'] = $lead_id;
            $lead_log_arr['ll_logno'] = '';
            $lead_log_arr['status'] = 'Y';
            $lead_log_arr['Date'] = '';
            $lead_log_arr['Time'] = '';
            $lead_log_arr['dtime'] = '';
            $lead_log_arr['ltype'] = '';
            $lead_log_arr['ltype_id'] = '';
            $lead_log_arr['ctype'] = '';
            $lead_log_arr['csm_id'] = '';
            $lead_log_arr['sm_id'] = $smid;
            $lead_log_arr['cp_id'] = $ibpid;
            $lead_log_arr['admin_id'] = '';
            $lead_log_arr['rece_id'] = '';
            $lead_log_arr['mul_proid'] = $mul_proid;
            $lead_log_arr['mul_proname'] = $mul_proname;
            $lead_log_arr['mul_procode'] = $mul_procode;
            $lead_log_arr['next_followup_medium'] = '';
            $lead_log_arr['next_followup_mediumid'] = '';
            DB::table('npb_lead_log')->insert($lead_log_arr);
         
           return response(['status'=>200,'msg'=>'You have successfully subscribed these lead']);            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }

}
