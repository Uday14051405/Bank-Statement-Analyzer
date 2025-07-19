<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class npbLeadInsertController extends Controller
{
	public function add_new_customer(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {
			$customer_name = $request->customer_name;
			$l_name = $request->l_name;
			$pre_mobileno = $request->pre_mobileno;
			$email = $request->email;
			$whatsapp_no = $request->whatsapp_no;
			$address = $request->address;
			$sub_location = $request->sub_location;
			$property_type = $request->property_type;
			$configuration = $request->configuration;
			$com_prop_type = $request->com_prop_type;
			$office_com_property_area = $request->office_com_property_area;
			$shop_com_property_area = $request->shop_com_property_area;
			$construnction_stage = $request->construnction_stage;
			$purpose = $request->purpose;
			$form_status = $request->form_status;
			$notes = $request->notes;
			$shop_off = '';
			if ($com_prop_type == 'Shop') {
				$shop_off = $shop_com_property_area;
			} elseif ($com_prop_type == 'Office') {
				$shop_off = $office_com_property_area;
			}
			$pre_prodt = '';
			$com = '';
			$centerid_fill = $request->centerid;
			$pre_property = $request->pre_property;
			$pre_prodt = $request->pre_property;
			$l_prodt = $request->project_society_name;
			$pre_source = $request->pre_source;
			$project_society_name = $request->project_society_name;
			$property_title = $request->property_title;
			$pre_cp = $request->centerid;
			$mul_vendor = '';
			$pre_vendor = '';
			$ibpid = $request->centerid;
			$image_upload = 'Update';


			$res_user1 = DB::connection('mysql_second')->table('user')->where(['hm_ibpid' => $centerid_fill, 'role_type' => 'ibp'])->first(['hm_ibpid', 'user_name']);

			$res_user1_ = json_decode(json_encode($res_user1), True);
			$user_id1 = (isset($res_user1_['hm_ibpid']) ? $res_user1_['hm_ibpid'] : 0);
			$user_table_id = (isset($res_user1_['hm_ibpid']) ? $res_user1_['hm_ibpid'] : 0);
			$self_table_id = $centerid_fill;
			$centerid = $centerid_fill;
			$error_lead = 0;
			$sm_user = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
			$user_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
			$sessionname = (isset($res_user1_['hm_ibpid']) ? $res_user1_['hm_ibpid'] : 0);
			$sessionshop = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
			$user_table_name = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);
			$sm_user_fill = (isset($res_user1_['user_name']) ? $res_user1_['user_name'] : 0);

			// $res_pro = DB::connection('mysql_second')->table('products')->where(['pro_name' => $pre_prodt])->first(['id', 'mul_procode', 'pro_name']);
			// $res_pro_ = json_decode(json_encode($res_pro), True);
			//  = (isset($res_pro_['id']) ? $res_pro_['id'] : 0);
			//  = (isset($res_pro_['mul_procode']) ? $res_pro_['mul_procode'] : 0);
			// $mul_proname = (isset($res_pro_['pro_name']) ? $res_pro_['pro_name'] : 0);


			$l_employeeuser = DB::select("SELECT lead_id FROM npb_lead_create_multi WHERE " . $pre_mobileno . " IN(l_pno,l_mobile,l_mobile1,l_mobile2) AND ibpid='" . $ibpid . "'");
			$lead_userss_ = json_decode(json_encode($l_employeeuser), True);

			$l_employeeuser11 = DB::connection('mysql_second')->table('npb_lead_create_multi')
				->select('lead_id', 'project_society_name')
				->where(function ($query) use ($pre_mobileno) {
					$query->where('l_pno', $pre_mobileno)
						->orWhere('l_mobile', $pre_mobileno)
						->orWhere('l_mobile1', $pre_mobileno)
						->orWhere('l_mobile2', $pre_mobileno);
				})
				->where('id', $ibpid)
				->get();



			if ((count($l_employeeuser) == 0) && $form_status == 'new') {
				$row_lead_id = (isset($lead_userss_['lead_id']) ? $lead_userss_['lead_id'] : 0);
				$l_employeeuser1 = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['l_pno' => $pre_mobileno])->where(['id' => $ibpid])->orderBy('id', 'desc')->first(['id', 'mul_proname', 'lead_id']);
				$p1_count = json_decode(json_encode($l_employeeuser1), True);
				$p1_count1 = (isset($p1_count['mul_proname']) ? $p1_count['mul_proname'] : 0);

				$row_lead_id = (isset($p1_count['lead_id']) ? $p1_count['lead_id'] : 0);
				$idd = (isset($p1_count['id']) ? $p1_count['id'] : 0);

				if ($p1_count1 == 'P1') {
					$l_prodt  = 'P2';
				} elseif ($p1_count1 == 'P2') {
					$l_prodt  = 'P3';
				} elseif ($p1_count1 == 'P3') {
					$l_prodt  = 'P4';
				} elseif ($p1_count1 == 'P4') {
					$l_prodt  = 'P5';
				} elseif ($p1_count1 == 'P5') {
					$l_prodt  = 'P6';
				} elseif ($p1_count1 == 'P6') {
					$l_prodt  = 'P7';
				} elseif ($p1_count1 == 'P7') {
					$l_prodt  = 'P8';
				} elseif ($p1_count1 == 'P8') {
					$l_prodt  = 'P9';
				} elseif ($p1_count1 == 'P9') {
					$l_prodt  = 'P10';
				} else {
					$l_prodt  = 'P1';
				}

				$l_prodt  = 'P1';
				$ll_details = 'New Customer is been added.';
				$redate = date("Y-m-d");
				$retime = date("H:i:s");
				$date12 = date('Y-m-d H:i:s');
				$lead_date = date("Y-m-d");
				$lead_date15 =  date('Y-m-d', strtotime(' + 15 days'));
				$lead_date30 =  date('Y-m-d', strtotime(' + 30 days'));
				$lead_date45 =  date('Y-m-d', strtotime(' + 45 days'));
				$lead_date60 =  date('Y-m-d', strtotime(' + 60 days'));
				$lead_date75 =  date('Y-m-d', strtotime(' + 75 days'));
				$lead_date90 =  date('Y-m-d', strtotime(' + 90 days'));
				$lead_date105 =  date('Y-m-d', strtotime(' + 105 days'));

				$hla_presales1 = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_create_multi(l_fname, l_lname, l_email, l_pno, l_rs, l_rsl, l_employee, l_mydate, l_mydate1, ibpid, l_prodt, Property, ltype, loca, pref, prof, eadd,eadd1, l_mobile,source,r_employee, v_userid, v_username, v_date, l_pc, l_pjln, redate, retime,mul_cp,mul_dst,mul_proid,mul_proname, lead_id, mul_source, mul_procode, lead_create_multi_date,l_pc_multi,purpose, lead_stage, lead_stage_id,lead_create_date,hm_url,property_title,project_society_name,npb_lead_status,whatsapp,l_pcfn,l_pcln,l_itos,prop_area,add_new_customer_status) values ('$customer_name', '$l_name','$email', '$pre_mobileno','','',  '', '$date12', '$date12','$ibpid', '$l_prodt', '$configuration', '', '','', '', '$address','$sub_location','','$pre_source', '','$user_table_id','$user_table_name','$date12', '$date12','','$redate', '$retime','$ibpid','','','$l_prodt', '$row_lead_id', '$pre_source', '', '$date12', '$date12', '$purpose','', '','$date12','','$property_title','$project_society_name','','$whatsapp_no','$property_type','$shop_off','$construnction_stage','$com_prop_type','Y')");

				$billid = DB::getPdo()->lastInsertId();
				$row_lead_idnew = $billid;

				DB::connection('mysql_second')->table('npb_lead_create_multi')
					->where('id', $row_lead_idnew)
					->update([
						'lead_id' => $row_lead_idnew,

					]);

				$hla_presales1dst = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode,project_society_name,property_title,lead_create_date)values ('', '$ll_details', '$sm_user', '$sessionname', '$sessionshop', '$row_lead_idnew', '$row_lead_idnew', '', '', '', '','', '$ibpid','','$l_prodt','', '$project_society_name','$property_title','$date12')");

				if ($notes != '') {
					$hla_presales1dst = DB::connection('mysql_second')->insert("INSERT INTO npb_lead_log(sub, ll_details,ll_fillby, ll_username, ll_shop_id, ll_leadcode, ll_leadid, ll_logno, status, sm_id, admin_id, rece_id, cp_id,mul_proid,mul_proname,mul_procode,project_society_name,property_title,lead_create_date)values ('', '$notes', '$sm_user', '$sessionname', '$sessionshop', '$row_lead_idnew', '$row_lead_idnew', '', '', '', '','', '$ibpid','','$l_prodt','', '$project_society_name','$property_title','$date12')");
				}
				return response(['status' => 200, 'msg' => ['Success']]);
				// }
			} else {
				return response(['status' => 200, 'msg' => ['Existing Custing'], 'data' => $l_employeeuser11]);
			}
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}

	public function check_mobile(Request $request)
	{
		// $user = DB::connection('mysql_second')->table('register')->where(['username' => $request->username, 'id' => $request->id, 'usertype' => $request->usertype, 'token' => $request->token])->count();
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();

		if ($user == 1) {
			$l_schedule = DB::connection('mysql_second')->select("SELECT id FROM npb_lead_create_multi WHERE " . $request->pre_mobileno . " IN(l_pno,l_mobile,l_mobile1,l_mobile2 ) AND ibpid = " . $request->centerid . " AND project_society_name='" . $request->project_society_name . "'");
			if (count($l_schedule) > 0) {
				return response(['status' => 201, 'msg' => ['Customer Already Exist'], 'submit_button' => 'inactive', 'form_status' => 'old']); //block form submission
			} else {
				return response(['status' => 200, 'msg' => ['Success'], 'submit_button' => 'active', 'form_status' => 'new']);
			}
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}

	public function address_list(Request $request)
	{

		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {
			// $centerid_fill = $request->id;


			$arr = DB::connection('mysql_second')->table('locality')->select('locality')->where(['status' => 'Y'])->get();

			return response(['status' => 200, 'msg' => ['Success'], 'data' => $arr]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}



	public function configuration_list(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {
			$centerid_fill = $request->centerid;
			$arr = DB::connection('mysql_second')->table('residetial_property_area')->select('name')->where(['status' => 'Y'])->get();
			return response(['status' => 200, 'msg' => ['Success'], 'data' => $arr]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}

	public function commercial_property_area(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {

			$arr = DB::connection('mysql_second')->table('commnercial_property_area')->select('name')->where(['status' => 'Y'])->get();
			return response(['status' => 200, 'msg' => ['Success'], 'data' => $arr]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}
	public function commercial_property_type(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {

			$arr[] = 'Office';
			$arr[] = 'Shop';
			return response(['status' => 200, 'msg' => ['Success'], 'data' => $arr]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}


	public function fetch_customer_data(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {
			$l_employeeuser1 = DB::connection('mysql_second')->table('npb_lead_create_multi')->where(['id' => $request->id])->orderBy('id', 'desc')->first(['id', 'source', 'l_fname as customer_name', 'l_email as email', 'l_pno as mobile', 'whatsapp', 'eadd as address', 'eadd1 as sub_location', 'Property as configuration', 'prop_area as com_prop_type', 'l_itos as construnction_stage', 'l_pcln as commercial_shop_office_area', 'l_pcfn as property_type', 'purpose as purpose', 'l_ld as notes']);
			$data = json_decode(json_encode($l_employeeuser1), True);
			return response(['status' => 200, 'msg' => ['Success'], 'data' => $data]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}

	public function edit_customer_data(Request $request)
	{
		$user = DB::connection('mysql_second')->table('user')->where(['user_name' => $request->user_name, 'hm_ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
		if ($user == 1) {

			$customer_name = $request->customer_name;
			$id = $request->centerid;
			$l_name = $request->l_name;
			$l_pno = $request->l_pno;
			$email = $request->email;
			$whatsapp_no = $request->whatsapp_no;
			$whatsapp_no = $request->whatsapp_no;
			$address = $request->address;
			$sub_location = $request->sub_location;
			$property_type = $request->property_type;
			$configuration = $request->configuration;
			$com_prop_type = $request->com_prop_type;
			$office_com_property_area = $request->office_com_property_area;
			$shop_com_property_area = $request->shop_com_property_area;
			$construnction_stage = $request->construnction_stage;
			$purpose = $request->purpose;
			$notes = $request->notes;
			$shop_off = '';
			if ($com_prop_type == 'Shop') {
				$shop_off = $shop_com_property_area;
			} elseif ($com_prop_type == 'Office') {
				$shop_off = $office_com_property_area;
			}
			$centerid_fill = $request->id;
			$pre_source = $request->pre_source;
			$property_title = $request->property_title;






			$sql  = DB::connection('mysql_second')->table('npb_lead_create_multi')->where('l_pno', $l_pno)->update([
				'l_fname' => $customer_name,
				'l_email' => $email,
				'whatsapp' => $whatsapp_no,
				'eadd' => $address,
				'eadd1' => $sub_location,
				'Property' => $configuration,
				'prop_area' => $com_prop_type,
				'l_itos' => $construnction_stage,
				'l_pcln' => $shop_off,
				'l_pcfn' => $property_type,
				'purpose' => $purpose,

			]);
			return response(['status' => 200, 'msg' => ['Customer Data Updated Successfully']]);
		} else {
			return response(['status' => 404, 'msg' => ['User not login']]);
		}
	}
}
