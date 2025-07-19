<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadSearchController extends Controller
{

    public function view(Request $request)
    {
        #dd('Hello');
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            #$query = DB::table('lead_create_multi')->where('display_status','!=','N');
            $query = DB::table('lead_create_multi')->where([$column => $request->centerid]);
            #dd($query);

            $leadid     = (isset($request->lead_id) && !empty($request->lead_id))?$request->lead_id:'';
            $l_fname    = (isset($request->first_name) && !empty($request->first_name))?$request->first_name:'';
            $gen        = (isset($request->general) && !empty($request->general))?$request->general:'';
            $leadstatus = (isset($request->leadstatus) && !empty($request->leadstatus))?$request->leadstatus:'';
            $from       = (isset($request->from) && !empty($request->from))?$request->from:'';
            $to         = (isset($request->to) && !empty($request->to))?$request->to:'';
            $dash_type  = (isset($request->dash_type) && !empty($request->dash_type))?$request->dash_type:'';

            if (isset($dash_type) && !empty($dash_type) && $dash_type =='self_tagging')
            {
                $query = $query->where('lead_type_category', '=', 'self_tagging');
            }

            if (isset($dash_type) && !empty($dash_type) && $dash_type =='microsite_tagging')
            {
                $query = $query->where('lead_type_category', '=', 'microsite_tagging');
            }

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

            $data = $query->orderBy('l_mydate', 'desc')->get(['lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details','mul_proid'])->toArray();
            #dd($data);
            $resultArray = json_decode(json_encode($data), true);

            foreach ($resultArray as $val) {

                $l_employee = DB::table('headcenter')->where(['id' => $val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id' => $val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id' => $val['ibpid']])->pluck('iname')->toArray();

                $head_center_arr = DB::table('headcenter')->select('ihand','iname')->where(['project_id' => $val['mul_proid'], 'status' => 'Active', 'role' => 'CPSM'])->first();
                $ihand = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->ihand : '';
                $iname = (isset($head_center_arr) && !empty($head_center_arr)) ? $head_center_arr->iname : '';
                $val['cpsm_number'] = (isset($ihand) && !empty($ihand)) ? $ihand : '7977653990';
                $val['cpsm_name'] = (isset($iname) && !empty($iname)) ? $iname : 'MSPACE';

                $val['l_employee'] = (count($l_employee) > 0) ? $l_employee[0] : '';
                $val['r_employee'] = (count($r_employee) > 0) ? $r_employee[0] : '';
                $val['ibpid'] = (count($ibpid) > 0) ? $ibpid[0] : '';
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['Dashboard View Success'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }







    public function lead_lost_list_menu(Request $request)
    {
        #dd('Hello');
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            $query = DB::table('lead_create_multi')->where([$column => $request->centerid,'ltype'=>'Lost']);
            // $query = DB::table('lead_create_multi');
            #dd($query);
            $leadid = (isset($request->lead_id) && !empty($request->lead_id))?$request->lead_id:'';
            $l_fname = (isset($request->first_name) && !empty($request->first_name))?$request->first_name:'';
            $gen = (isset($request->general) && !empty($request->general))?$request->general:'';
            $leadstatus = (isset($request->leadstatus) && !empty($request->leadstatus))?$request->leadstatus:'';
            $from = (isset($request->from) && !empty($request->from))?$request->from:'';
            $to = (isset($request->to) && !empty($request->to))?$request->to:'';


            if (!empty($leadid))
            {
                $query = $query->where('lead_id', '=', $leadid);
            }
            if (!empty($leadstatus))
            {
                $query = $query->where('ltype', '=', $leadstatus);
            }
            if (!empty($l_fname))
            {
                $query = $query->where('l_fname', 'LIKE', $l_fname . '%');
            }
            if (!empty($from) and ($to))
            {
                $query = $query->whereBetween('l_pc_multi', [$from, $to]);
            }
            if (!empty($gen))
            {
                $query = $query->where('l_fname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_code', 'LIKE', '%' . $gen . '%')->orWhere('l_email', 'LIKE', '%' . $gen . '%')->orWhere('l_lname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile1', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile2', 'LIKE', '%' . $gen . '%');
            }

            $data = $query->orderBy('l_mydate', 'desc')->get(['lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details'])->toArray();
            // dd($data);
            $resultArray = (isset($data) && !empty($data))?json_decode(json_encode($data), true):[];

            foreach ($resultArray as $key => $val) {

                $l_employee = DB::table('headcenter')->where(['id' => $val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id' => $val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id' => $val['ibpid']])->pluck('iname')->toArray();

                $val['l_employee'] = (count($l_employee) > 0) ? $l_employee[0] : '';
                $val['r_employee'] = (count($r_employee) > 0) ? $r_employee[0] : '';
                $val['ibpid'] = (count($ibpid) > 0) ? $ibpid[0] : '';
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['All Time Lost'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }




    public function  site_visite_done_list_menu(Request $request)
    {
        #dd('Hello');
        $data_arr = array();
        $from_date = date('Y-m-d');
        $to_date   = date('Y-m-d');
        $user = DB::table('user')->where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user == 1) {

            $column = ($request->role_type == 'ibp') ? 'ibpid' : 'l_employee';

            // $query = DB::table('lead_create_multi')->where([$column => $request->centerid,'ltype'=>'Site Visits - Done']);
            $query = DB::table('lead_create_multi')->where([$column => $request->centerid])->whereIn('ltype', ['Site Visits - Done', 'Revisit - 1', 'Revisit - 2', 'Revisit - 3']);
            // $query = DB::table('lead_create_multi');
            #dd($query);
            $leadid = (isset($request->lead_id) && !empty($request->lead_id))?$request->lead_id:'';
            $l_fname = (isset($request->first_name) && !empty($request->first_name))?$request->first_name:'';
            $gen = (isset($request->general) && !empty($request->general))?$request->general:'';
            $leadstatus = (isset($request->leadstatus) && !empty($request->leadstatus))?$request->leadstatus:'';
            $from = (isset($request->from) && !empty($request->from))?$request->from:'';
            $to = (isset($request->to) && !empty($request->to))?$request->to:'';


            if (!empty($leadid))
            {
                $query = $query->where('lead_id', '=', $leadid);
            }
            if (!empty($leadstatus))
            {
                $query = $query->where('ltype', '=', $leadstatus);
            }
            if (!empty($l_fname))
            {
                $query = $query->where('l_fname', 'LIKE', $l_fname . '%');
            }
            if (!empty($from) and ($to))
            {
                $query = $query->whereBetween('l_pc_multi', [$from, $to]);
            }
            if (!empty($gen))
            {
                $query = $query->where('l_fname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_code', 'LIKE', '%' . $gen . '%')->orWhere('l_email', 'LIKE', '%' . $gen . '%')->orWhere('l_lname', 'LIKE', '%' . $gen . '%')->orWhere('l_pno', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile1', 'LIKE', '%' . $gen . '%')->orWhere('l_mobile2', 'LIKE', '%' . $gen . '%');
            }

            $data = $query->orderBy('l_mydate', 'desc')->get(['lead_id', 'lead_create_date', 'l_pc', 'fdate', 'l_fname', 'l_lname', 'l_pno', 'l_employee', 'r_employee', 'l_rs', 'source', 'ibpid', 'vendor', 'l_prodt', 'l_pcfn', 'Property', 'l_rsl', 'ltype', 'ctype', 'l_email', 'fll_details'])->toArray();
            // dd($data);
            $resultArray = (isset($data) && !empty($data))?json_decode(json_encode($data), true):[];

            foreach ($resultArray as $key => $val) {

                $l_employee = DB::table('headcenter')->where(['id' => $val['l_employee']])->pluck('iname')->toArray();
                $r_employee = DB::table('headcenter')->where(['id' => $val['r_employee']])->pluck('iname')->toArray();
                $ibpid = DB::table('ibp')->where(['id' => $val['ibpid']])->pluck('iname')->toArray();

                $val['l_employee'] = (count($l_employee) > 0) ? $l_employee[0] : '';
                $val['r_employee'] = (count($r_employee) > 0) ? $r_employee[0] : '';
                $val['ibpid'] = (count($ibpid) > 0) ? $ibpid[0] : '';
                $data_arr[] = $val;
            }
            return response(['status' => 200, 'msg' => ['All Time Site Viste Done'], 'count' => count($resultArray), 'data' => $data_arr]);
        } else {
            return response(['status' => 404, 'msg' => ['User not login']]);
        }
    }



}