<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        #$data = DB::connection('mysql_second')->table('api_lead')->get();
        #dd($data);
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 404, 'msg' => $validator->errors()->all()]);
        }

        #$user = User::where(['user_name'=>$request->user_name,'status'=>'a'])->get()->toArray();
        $user = User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->whereIn('role_type', ['ibp'])->get(['user_name', 'name', 'role_type', 'token', 'password', 'ibpid as centerid','id'])->toArray();
        #dd($user);
        if ($user) {
            if ($user[0]['password'] == md5($request->password)) {

                if ($request->user_name == '9082069998') {
                    $token = 'XyEac3xFJ6TREw5M4nAf';
                } else {
                    $token = Str::random(20);
                }
                $ibpid = DB::table('ibp')->where(['id' => $user[0]['centerid']])->pluck('slogan')->toArray();
                $user[0]['slogan'] = (count($ibpid) > 0) ? $ibpid[0] : '';

                $ibpid = DB::table('ibp')->where(['id' => $user[0]['centerid']])->pluck('emp_code')->toArray();
                $user[0]['emp_code'] = (count($ibpid) > 0) ? $ibpid[0] : '';

                $updated =  User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->update(['token' => $token, 'app_version' => $request->version]);
                if ($updated) {
                    DB::connection('mysql_second')->table('user')
                        ->where([
                            'user_name' => $request->user_name,
                            'status' => 'a',
                            'type' => 'i'
                        ])
                        ->update([
                            'token' => $token,
                            'app_version' => $request->version
                        ]);
                }

                unset($user[0]['password']);
                $user[0]['token'] = $token;
                return response(['status' => 200, 'msg' => ['Login Success'], 'data' => $user]);
            } else {
                return response(['status' => 404, 'msg' => ['Password mismatch']]);
            }
        } else {
            return response(['status' => 404, 'msg' => ['User does not exist']]);
        }
    }


    public function forgotpass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 404, 'msg' => $validator->errors()->all()]);
        }

        #$user = User::where(['user_name'=>$request->user_name,'status'=>'a'])->get()->toArray();
        $user = User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->whereIn('role_type', ['ibp'])->get(['user_name', 'id', 'name', 'role_type', 'token', 'password', 'ibpid as centerid'])->toArray();
        #dd($user);
        if ($user) {

            $ibpid = DB::table('ibp')->where(['id' => $user[0]['centerid']])->pluck('ihand')->toArray();
            $itel = (count($ibpid) > 0) ? $ibpid[0] : '';


            $digits = 6;
            $i = 0; //counter
            $otp = ""; //our default pin is blank.
            while ($i < $digits) {
                //generate a random number between 0 and 9.
                $otp .= rand(0, 9);
                $i++;
            }

            /* $l_employeeuser = DB::table('otp')->where(['mobile'=>$itel])->pluck('otp')->toArray();
        $lead_userss_ = json_decode(json_encode($l_employeeuser),True);
              # dd($lead_userss_);
            if(count($l_employeeuser) > 0 )
            {
                $row_lead_id = $lead_userss_[0]['id'];
            
			}			
			 */
            $user[0]['itel'] = $itel;

            unset($user[0]['password']);

            User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->update(['otp' => $otp]);


            $message = '' . $otp . ' is your One Time Password for password reset and only valid for 5 minutes. Please DO NOT share this OTP with anyone. GrowHs';
            $message = urlencode($message);

            $baseurl = 'http://digitechastra.net/API/WebSMS/Http/v1.0a/index.php?username=rashmigrowth&password=Rashmi@2023&sender=GrowHs&reqid=1&Template_ID=1707170384053094003&PE_ID=1701168180720344074';

            $url = $baseurl . '&to=' . $itel . '&message=' . $message;
            // print_r($url);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            return response(['status' => 200, 'msg' => ['Otp Sent Success'], 'data' => $user]);
        } else {
            return response(['status' => 404, 'msg' => ['User does not exist']]);
        }
    }



    public function checkotp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 404, 'msg' => $validator->errors()->all()]);
        }

        #$user = User::where(['user_name'=>$request->user_name,'status'=>'a'])->get()->toArray();
        $user = User::where(['user_name' => $request->user_name, 'otp' => $request->otp, 'status' => 'a', 'type' => 'i'])->whereIn('role_type', ['ibp'])->get(['user_name', 'id', 'name', 'role_type', 'token', 'password', 'ibpid as centerid'])->toArray();
        #dd($user);
        if ($user) {

            $otp = '';

            User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->update(['otp' => $otp]);


            return response(['status' => 200, 'msg' => ['Success'], 'data' => $user]);
        } else {
            return response(['status' => 404, 'msg' => ['Please Enter Correct OTP']]);
        }
    }




    public function savepass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['status' => 404, 'msg' => $validator->errors()->all()]);
        }

        #$user = User::where(['user_name'=>$request->user_name,'status'=>'a'])->get()->toArray();
        $user = User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->whereIn('role_type', ['ibp'])->get(['user_name', 'id', 'name', 'role_type', 'token', 'password', 'ibpid as centerid'])->toArray();
        #dd($user);
        if ($user) {


            //$user[0]['itel'] = $itel;



            User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->update(['password' => md5($request->password)]);


            return response(['status' => 200, 'msg' => ['Password Change Success'], 'data' => $user]);
        } else {
            return response(['status' => 404, 'msg' => ['User does not exist']]);
        }
    }

    public function logout(Request $request)
    {

        $user = User::where(['user_name' => $request->user_name, 'token' => $request->token])->count();
        if ($user) {

            User::where(['user_name' => $request->user_name, 'status' => 'a', 'type' => 'i'])->update(['token' => '']);
            return response(['status' => 200, 'msg' => ['You have been successfully logged out!']]);
        } else {
            return response(['status' => 404, 'msg' => ['Something Error']]);
        }
    }

    public function update_member_subscription(Request $request)
    {
        $user = User::where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->count();
        if ($user) {
            $update_subscription = User::where(['user_name' => $request->user_name, 'ibpid' => $request->centerid, 'role_type' => $request->role_type, 'token' => $request->token])->update(['subscription' => 'N']);
            if ($update_subscription) {
                return response(['status' => 200, 'msg' => ['Subscription updated successfully.']]);
            } else {
                return response(['status' => 200, 'msg' => ['Something Went Wrong. Please Try Again Later.']]);
            }
        }
        return response(['status' => 404, 'msg' => ['Something Went Wrong. Please Try Again Later.']]);
    }
}
