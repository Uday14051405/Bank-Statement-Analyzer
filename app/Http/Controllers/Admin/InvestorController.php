<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Models\CompanyDetail;
use Image;
use Storage;
use App\Models\BankDetails;
use App\Models\CreditDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvestorExport;
use App\Mail\SignupThankYouMail;
use Illuminate\Support\Facades\Mail;
use PDF;
use Carbon\Carbon;
use App\Models\BankApiCall;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use App\Mail\BankDisputeRaised;

class InvestorController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:user-list', ['only' => ['index', 'store']]);
        // $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

        // $user_list = Permission::get()->filter(function ($item) {
        // 	return $item->name == 'user-list';
        // })->first();
        // $user_create = Permission::get()->filter(function ($item) {
        // 	return $item->name == 'user-create';
        // })->first();
        // $user_edit = Permission::get()->filter(function ($item) {
        // 	return $item->name == 'user-edit';
        // })->first();
        // $user_delete = Permission::get()->filter(function ($item) {
        // 	return $item->name == 'user-delete';
        // })->first();
        // $profile_index = Permission::get()->filter(function ($item) {
        // 	return $item->name == 'profile-index';
        // })->first();


        // if ($user_list == null) {
        // 	Permission::create(['name' => 'user-list']);
        // }
        // if ($user_create == null) {
        // 	Permission::create(['name' => 'user-create']);
        // }
        // if ($user_edit == null) {
        // 	Permission::create(['name' => 'user-edit']);
        // }
        // if ($user_delete == null) {
        // 	Permission::create(['name' => 'user-delete']);
        // }
        // if ($profile_index == null) {
        // 	Permission::create(['name' => 'profile-index']);
        // }
    }

    public function generatePdfAttachments1($user)
    {
        // Privacy Policy PDF
        $privacyPolicyHtml = view('emails.privacy_policy', compact('user'))->render();
        $privacyPolicyPdf = PDF::loadHTML($privacyPolicyHtml)->output();

        // Terms & Conditions PDF
        $termsConditionsHtml = view('emails.terms_conditions', compact('user'))->render();
        $termsConditionsPdf = PDF::loadHTML($termsConditionsHtml)->output();

        return [
            'privacy_policy' => $privacyPolicyPdf,
            'terms_conditions' => $termsConditionsPdf,
        ];
    }

    private function generatePdfAttachmentsold($user)
    {
        // Define the paths
        $tempDir = storage_path('app/temp');
        $privacyPolicyPath = $tempDir . '/privacy_policy_' . $user->id . '.pdf';
        $termsConditionsPath = $tempDir . '/terms_conditions_' . $user->id . '.pdf';

        // Create the temp directory if it doesn't exist
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Generate PDFs and store them temporarily
        PDF::loadView('emails.privacy_policy', compact('user'))->save($privacyPolicyPath);
        PDF::loadView('emails.terms_conditions', compact('user'))->save($termsConditionsPath);

        return [
            'privacy_policy' => $privacyPolicyPath,
            'terms_conditions' => $termsConditionsPath,
        ];
    }

    private function generatePrivacyPolicyPdfold($user)
    {
        // $pdf = PDF::loadView('emails.privacy_policy', compact('user'));
        // return $pdf->output();
        $termsConditionsHtml = view('emails.privacy_policy', compact('user'))->render();
        $termsConditionsPdf = PDF::loadHTML($termsConditionsHtml)->output();
        return $termsConditionsPdf;
    }

    private function generateTermsConditionsPdfold($user)
    {
        // $pdf = PDF::loadView('emails.terms_conditions', compact('user'));
        // return $pdf->output();
        $termsConditionsHtml = view('emails.terms_conditions', compact('user'))->render();
        $termsConditionsPdf = PDF::loadHTML($termsConditionsHtml)->output();
        return $termsConditionsPdf;
    }

    private function generatePrivacyPolicyPdf($user)
    {
        $pdf = PDF::loadView('emails.privacy_policy', compact('user'));
        $filePath = 'temp/privacy_policy_' . $user->id . '.pdf';
        Storage::put($filePath, $pdf->output());
        return $filePath;
    }

    private function generateTermsConditionsPdf($user)
    {
        $pdf = PDF::loadView('emails.terms_conditions', compact('user'));
        $filePath = 'temp/terms_conditions_' . $user->id . '.pdf';
        Storage::put($filePath, $pdf->output());
        return $filePath;
    }

    private function generateAgreementPdf($user, $companyDetail, $other_data)
    {
        $pdf = PDF::loadView('emails.agreement', compact('user', 'companyDetail', 'other_data'));
        $filePath = 'temp/agreement' . $user->id . '.pdf';
        Storage::put($filePath, $pdf->output());
        return $filePath;
    }

    private function generatePdfAttachments($user, $companyDetail, $other_data)
    {
        return [
            #'privacy_policy' => $this->generatePrivacyPolicyPdf($user),
            #'terms_conditions' => $this->generateTermsConditionsPdf($user),
            'agreement' => $this->generateAgreementPdf($user, $companyDetail, $other_data),
        ];
    }

    public function scheduleAttachmentCleanup($pdfAttachments)
    {
        foreach ($pdfAttachments as $filePath) {
            dispatch(function () use ($filePath) {
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            })->delay(now()->addMinutes(2)); // Adjust delay as needed
        }
    }
    //Frontend Started Investor Signup

    public function showSignUpForm()
    {
        return view('frontend.signup');
    }

    public function signUp_27Aug24(Request $request)
    {
        
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',  // Correctly formatted regex with delimiters
            'mobile' => 'required|string|unique:users,mobile',
        ];

        $messages = [
            'name.required' => __('default.form.validation.name.required'),
            'email.required' => __('default.form.validation.email.required'),
            'email.email' => __('default.form.validation.email.email'),
            'email.unique' => __('default.form.validation.email1.unique'),
            'password.required' => __('default.form.validation.password.required'),
            'password.min' => 'The password must be at least 6 characters.',
            #'password.regex' => 'The password must contain at least one special character.',
            'mobile.required' => __('default.form.validation.mobile.required'),
        ];
      
        #$request->validate($rules, $messages);

        $data = $this->validate($request, $rules, $messages);
        
        $input = request()->all();
        $data['remember'] = "off";
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 7;
        $input['status'] = 1;

      
        try {

            $user = User::create($input);
           
            $user->assignRole('Investor');
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
                if (Auth::user()->status == 1) {
                    #dd('hello');
                    Toastr::success(__('user.message.store.success'));
                    return redirect()->route('form-bank-details');
                } else {
                   
                    Toastr::success(__('user.message.store.success'));
                    return redirect()->route('form-bank-details');
                }
            } else {
                Toastr::error(__('user.message.store.error'));
                return redirect()->route('signup');
            }
            $data = Auth::login($user);
           
        } catch (Exception $e) {
          
            Toastr::error(__('user.message.store.error'));
            return redirect()->route('signup');
        }
    }

    public function signUp1(Request $request)
    {
        
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',  // Correctly formatted regex with delimiters
            'mobile' => 'required|string|unique:users,mobile',
        ];

        $messages = [
            'name.required' => __('default.form.validation.name.required'),
            'email.required' => __('default.form.validation.email.required'),
            'email.email' => __('default.form.validation.email.email'),
            'email.unique' => __('default.form.validation.email1.unique'),
            'password.required' => __('default.form.validation.password.required'),
            'password.min' => 'The password must be at least 6 characters.',
            #'password.regex' => 'The password must contain at least one special character.',
            'mobile.required' => __('default.form.validation.mobile.required'),
        ];
      
        #$request->validate($rules, $messages);

        $data = $this->validate($request, $rules, $messages);
        
        $input = request()->all();
        $data['remember'] = "off";
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 7;
        $input['status'] = 1;

      
        try {

            $user = User::create($input);
           
            $user->assignRole('Investor');
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
                if (Auth::user()->status == 1) {
                    #dd('hello');
                    Toastr::success(__('user.message.store.success'));
                    return redirect()->route('form-bank-details');
                } else {
                   
                    Toastr::success(__('user.message.store.success'));
                    return redirect()->route('form-bank-details');
                }
            } else {
                Toastr::error(__('user.message.store.error'));
                return redirect()->route('signup');
            }
            $data = Auth::login($user);
           
        } catch (Exception $e) {
          
            Toastr::error(__('user.message.store.error'));
            return redirect()->route('signup');
        }
    }
    public function signUp(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'mobile' => 'required|string|unique:users,mobile',
        ];
    
        $messages = [
            'name.required' => __('default.form.validation.name.required'),
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name cannot be more than 100 characters.',
            'email.required' => __('default.form.validation.email.required'),
            'email.email' => __('default.form.validation.email.email'),
            'email.unique' => __('default.form.validation.email1.unique'),
            'password.required' => __('default.form.validation.password.required'),
            'password.min' => 'The password must be at least 6 characters.',
            'mobile.required' => __('default.form.validation.mobile.required'),
        ];
    
        $data = $this->validate($request, $rules, $messages);
    
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['role_id'] = 7;
            $input['status'] = 1;
    
            $user = User::create($input);
            $user->assignRole('Investor');
    
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
                return response()->json(['redirect_url' => route('form-bank-details')]);
            }
    
            return response()->json(['message' => __('user.message.store.error')], 400);
        } catch (Exception $e) {
            return response()->json(['message' => __('user.message.store.error')], 500);
        }
    }
    
    public function showPanForm()
    {
        return view('frontend.userauth');
    }

    public function showBankForm()
    {
        return view('frontend.userbank');
    }

    public function showBankSuccessForm()
    {
        return view('frontend.userbank_success');
    }

    public function showBankErrorForm()
    {
        return view('frontend.userbank_error');
    }

    public function showCreditForm()
    {
        $bankDetails = BankDetails::where('user_id', Auth::id())->get();
        return view('frontend.usercredit', compact('bankDetails'));
        #return view('frontend.usercredit');
    }

    public function savePanForm(Request $request)
    {

        $rules = [
            'pan_number' => 'required|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'pan_name' => 'required|string|max:255',
        ];

        $messages = [
            'pan_name.required'            => __('default.form.validation.pan_name.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        try {

            $user = Auth::user();

            $user->pan_number = $request->input('pan_number');
            $user->pan_name = $request->input('pan_name');
            $user->save();
            #dd($user);
            Toastr::success(__('PAN Card details have been added.'));
            return redirect()->route('form-bank-details');
        } catch (Exception $e) {

            Toastr::error(__('user.message.store.error'));
            return redirect()->route('form-pan-details');
        }
    }

    public function saveBankFormOLd(Request $request)
    {

        $rules = [
           # 'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            #'credit_card_no' => 'required|string|max:19|regex:/^\d{14,19}$/', // Assuming credit card numbers are between 16 and 19 digits
            #'credit_bank_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
           # 'nick_name' => 'required|string|max:255',
        ];

        $messages = [
            #'account_holder_name.required' => __('default.form.validation.account_holder_name.required'),
            'account_number.required' => __('default.form.validation.account_number.required'),
            'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            #'credit_card_no.required' => __('default.form.validation.credit_card_no.required'),
            'bank_name.required' => __('default.form.validation.bank_name.required'),

           # 'credit_bank_name.required' => __('default.form.validation.credit_bank_name.required'),
            #'nick_name.required' => __('default.form.validation.nick_name.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        try {

            $user = Auth::user();
            $user->account_holder_name = $user->name;
            $user->account_number = $request->input('account_number');
            $user->ifsc_code = $request->input('ifsc_code');
            $user->bank_name = $request->input('bank_name');
            $user->pan_name = $user->name;
            $user->status = 1;
            $user->save();

            $bankdetails = new BankDetails();
            $bankdetails->account_holder_name = $user->name;
            $bankdetails->account_number = $request->input('account_number');
            $bankdetails->ifsc_code = $request->input('ifsc_code');
            $bankdetails->bank_name = $request->input('bank_name');
            $bankdetails->user_id = $user->id;
            $bankdetails->save();


            if ($request->hasFile('cheque_passbook')) {
                $file = $request->file('cheque_passbook');
                $path = $file->store('investor_doc', 'public');
                $user->cheque_pass = $path;
                $user->save();
                $bankdetails->cheque_passbook = $path;
                $bankdetails->save();
            }
            //Toastr::success(__('investor.message.bank.success'));
            // Toastr::success(__('investor.message.bank.success'), 'Success', [
            //     "timeOut" => 9000,
            //     "extendedTimeOut" => 2000, // Close after hovering for 2 seconds
            //     "progressBar" => true,
            //     "closeButton" => true,
            //     "positionClass" => "toast-top-right",
            // ]);
            #Mail::to($user->email)->queue(new SignupThankYouMail($user));

            //     $pdfAttachments = [
            //     'privacy_policy' => base64_encode($this->generatePrivacyPolicyPdf($user)),
            //     'terms_conditions' => base64_encode($this->generateTermsConditionsPdf($user)),
            // ];

            //     Mail::to($user->email)->queue(new SignupThankYouMail($user, $pdfAttachments));
            #$pdfAttachments = $this->generatePdfAttachments($user);

            // Mail::send('emails.signup_thank_you', compact('user'), function ($message) use ($user, $pdfAttachments) {
            //     $message->to($user->email)
            //             ->subject('Rumbble - Acknowledgement of your online payment')
            //             ->attachData($pdfAttachments['privacy_policy'], 'Privacy_Policy.pdf')
            //             ->attachData($pdfAttachments['terms_conditions'], 'Terms_Conditions.pdf');
            // });

            // $pdfAttachments = $this->generatePdfAttachments($user);

            // Mail::to($user->email)->queue(new SignupThankYouMail($user, $pdfAttachments));

            // $login_status = 1;

            // $this->scheduleAttachmentCleanup($pdfAttachments);
            #return redirect()->route('admin.dashboard');
            // return redirect()->intended('/admin/dashboard');
            #return redirect()->intended(route('dashboard') . '?login_status=' . $login_status);

            Toastr::success(__('Bank details have been added.'));
            return redirect()->route('form-credit-details');
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('form-bank-details');
        }
    }
   
    public function saveBankForm(Request $request)
    {
        $rules = [
            'account_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('bank_details')->where(function ($query) {
                    return $query->where('user_id', Auth::id())
                                 ->where('status', 'Verified');
                })
            ],
            'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name' => 'required|string|max:255',
        ];
    
        $messages = [
            'account_number.required' => __('default.form.validation.account_number.required'),
            'account_number.unique' => __('This account number has already been verified for your profile.'),
            'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            'bank_name.required' => __('default.form.validation.bank_name.required'),
        ];
    
        $this->validate($request, $rules, $messages);
        $input = $request->all();
    
        try {
            // Generate the reference number
            $referenceNumber = 'RB' . rand(10, 99) . time() . rand(1000, 9999);
    
            // Prepare API request
            $data = [
                "reference_id" => $referenceNumber,
                "purpose_message" => "This is a penny drop transaction",
                "transfer_amount" => "1",
                "beneficiary_details" => [
                    "account_number" => $request->input('account_number'),
                    "ifsc" => $request->input('ifsc_code')
                ]
            ];
    
            $response = Http::withHeaders([
                'client_id' => env('DECENTRO_CLIENT_ID'),
                'client_secret' => env('DECENTRO_CLIENT_SECRET'),
                'module_secret' => env('DECENTRO_MODULE_SECRET'),
                'provider_secret' => env('DECENTRO_PROVIDER_SECRET'),
                'Content-Type' => 'application/json'
            ])->post(env('DECENTRO_API_URL'), $data);
    
            $apiResponse = $response->json();
            $bank_response_data = json_encode($apiResponse);
            // Save API call data
            $apiCall = new BankApiCall([
                'user_id' => Auth::id(),
                'account_number' => $request->input('account_number'),
                'ifsc_code' => $request->input('ifsc_code'),
                'bank_name' => $request->input('bank_name'),
                'reference_id' => $referenceNumber,
                'full_response_message' => $bank_response_data,
                'status' => $apiResponse['status'] ?? '',
                'decentro_txn_id' => $apiResponse['decentroTxnId'] ?? null,
                'response_code' => $apiResponse['responseCode'] ?? null,
                'response_message' => $apiResponse['message'] ?? null,
            ]);
    
            $apiResponse_Status = $apiResponse['status'] ?? 'failure';
            $apiResponse_accountStatus = $apiResponse['accountStatus'] ?? 'invalid';
            if ($apiResponse_Status  === 'success' && $apiResponse_accountStatus === 'valid') {
                 // Save the user bank details if the API validates successfully
                $user = Auth::user();
                $user->account_holder_name = $user->name;
                $user->account_number = $request->input('account_number');
                $user->ifsc_code = $request->input('ifsc_code');
                $user->bank_name = $request->input('bank_name');
                $user->status = 1;
               
                $user->save();
                $userId = $request->user_id ?? auth()->id();

                BankDetails::where('user_id', $userId)->update(['status_default' => 0]);
                $bankdetails = new BankDetails();
                $bankdetails->account_holder_name = $user->name;
                $bankdetails->account_number = $request->input('account_number');
                $bankdetails->ifsc_code = $request->input('ifsc_code');
                $bankdetails->bank_name = $request->input('bank_name');
                $bankdetails->user_id = $user->id;
                $bankdetails->reference_id = $referenceNumber;
                $bankdetails->decentro_txn_id = $apiResponse['decentroTxnId'] ?? null;
                $bankdetails->status = 'Pending';
                $bankdetails->status_default = 0;
                $bankdetails->save();
    
                // Save the bank_id in the API call data
                $apiCall->bank_id = $bankdetails->id;
    
                if ($request->hasFile('cheque_passbook')) {
                    $file = $request->file('cheque_passbook');
                    $path = $file->store('investor_doc', 'public');
                    $user->cheque_pass = $path;
                    $user->save();
                    $bankdetails->cheque_passbook = $path;
                    $bankdetails->save();
                }
    
                Toastr::success(__('The account has been successfully added..'));
                $apiCall->save(); // Save the API call data
                #return redirect()->route('form-bank-success-details');
                #return redirect()->route('form-bank-success-details')->with('bankdata', $bankdetails);
                return view('frontend.userbank_success', compact('bankdetails'));

            } else {
                // Save the API call data even if it fails
                $apiCall->save();
                // Handle the error if the API validation fails
                Toastr::error(__('This account number is invalid. Please check and try again.'));
                return redirect()->route('form-bank-details')->withInput($input);
            }
        } catch (Exception $e) {
            Toastr::error(__('An error occurred while processing your request.'));
            return redirect()->route('form-bank-details')->withInput($input);
        }
    }


    public function saveBankFormDev(Request $request)
    {
        $rules = [
            'account_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('bank_details')->where(function ($query) {
                    return $query->where('user_id', Auth::id())
                                 ->where('status', 'Verified');
                })
            ],
            'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name' => 'required|string|max:255',
        ];
    
        $messages = [
            'account_number.required' => __('default.form.validation.account_number.required'),
            'account_number.unique' => __('This account number has already been verified for your profile.'),
            'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            'bank_name.required' => __('default.form.validation.bank_name.required'),
        ];
    
        $this->validate($request, $rules, $messages);
        $input = $request->all();
    
        try {
            // Generate the reference number
            $referenceNumber = 'RB' . rand(10, 99) . time() . rand(1000, 9999);
    
            // Prepare API request
            $data = [
                "reference_id" => $referenceNumber,
                "purpose_message" => "This is a penny drop transaction",
                "transfer_amount" => "1",
                "beneficiary_details" => [
                    "account_number" => $request->input('account_number'),
                    "ifsc" => $request->input('ifsc_code')
                ]
            ];
    
            // $response = Http::withHeaders([
            //     'client_id' => env('DECENTRO_CLIENT_ID'),
            //     'client_secret' => env('DECENTRO_CLIENT_SECRET'),
            //     'module_secret' => env('DECENTRO_MODULE_SECRET'),
            //     'provider_secret' => env('DECENTRO_PROVIDER_SECRET'),
            //     'Content-Type' => 'application/json'
            // ])->post(env('DECENTRO_API_URL'), $data);
    
            // $apiResponse = $response->json();
            // $bank_response_data = json_encode($apiResponse);
            // Save API call data
            // $apiCall = new BankApiCall([
            //     'user_id' => Auth::id(),
            //     'account_number' => $request->input('account_number'),
            //     'ifsc_code' => $request->input('ifsc_code'),
            //     'bank_name' => $request->input('bank_name'),
            //     'reference_id' => $referenceNumber,
            //     'full_response_message' => $bank_response_data,
            //     'status' => $apiResponse['status'] ?? '',
            //     'decentro_txn_id' => $apiResponse['decentroTxnId'] ?? null,
            //     'response_code' => $apiResponse['responseCode'] ?? null,
            //     'response_message' => $apiResponse['message'] ?? null,
            // ]);
    
            $apiResponse_Status = $apiResponse['status'] ?? 'failure';
            $apiResponse_accountStatus = $apiResponse['accountStatus'] ?? 'invalid';
            // if ($apiResponse_Status  === 'success' && $apiResponse_accountStatus === 'valid') {
                 // Save the user bank details if the API validates successfully
                $user = Auth::user();
                $user->account_holder_name = $user->name;
                $user->account_number = $request->input('account_number');
                $user->ifsc_code = $request->input('ifsc_code');
                $user->bank_name = $request->input('bank_name');
                $user->status = 1;
               
                $user->save();
                $userId = $request->user_id ?? auth()->id();

                BankDetails::where('user_id', $userId)->update(['status_default' => 0]);
                $bankdetails = new BankDetails();
                $bankdetails->account_holder_name = $user->name;
                $bankdetails->account_number = $request->input('account_number');
                $bankdetails->ifsc_code = $request->input('ifsc_code');
                $bankdetails->bank_name = $request->input('bank_name');
                $bankdetails->user_id = $user->id;
                $bankdetails->reference_id = $referenceNumber;
                $bankdetails->decentro_txn_id = $apiResponse['decentroTxnId'] ?? null;
                $bankdetails->status = 'Pending';
                $bankdetails->status_default = 0;
                $bankdetails->save();
    
                // Save the bank_id in the API call data
                #$apiCall->bank_id = $bankdetails->id;
    
                if ($request->hasFile('cheque_passbook')) {
                    $file = $request->file('cheque_passbook');
                    $path = $file->store('investor_doc', 'public');
                    $user->cheque_pass = $path;
                    $user->save();
                    $bankdetails->cheque_passbook = $path;
                    $bankdetails->save();
                }
    
                Toastr::success(__('The account has been successfully added..'));
                #$apiCall->save(); // Save the API call data
                #return redirect()->route('form-bank-success-details');
                #return redirect()->route('form-bank-success-details')->with('bankdata', $bankdetails);
                return view('frontend.userbank_success', compact('bankdetails'));

            // } else {
            //     // Save the API call data even if it fails
            //     $apiCall->save();
            //     // Handle the error if the API validation fails
            //     Toastr::error(__('This account number is invalid. Please check and try again.'));
            //     return redirect()->route('form-bank-details')->withInput($input);
            // }
        } catch (Exception $e) {
            Toastr::error(__('An error occurred while processing your request.'));
            return redirect()->route('form-bank-details')->withInput($input);
        }
    }
    


    public function saveCreditForm(Request $request)
    {

        $rules = [
            #'account_holder_name' => 'required|string|max:255',
            #'account_number' => 'required|string|max:20',
            #'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'credit_card_no' => 'required|string|max:19|regex:/^\d{14,19}$/', // Assuming credit card numbers are between 16 and 19 digits
            'credit_bank_name' => 'required|string|max:255',
            #'bank_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
        ];

        $messages = [
            #'account_holder_name.required' => __('default.form.validation.account_holder_name.required'),
            #'account_number.required' => __('default.form.validation.account_number.required'),
            #'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            'credit_card_no.required' => __('default.form.validation.credit_card_no.required'),
            #'bank_name.required' => __('default.form.validation.bank_name.required'),

            'credit_bank_name.required' => __('default.form.validation.credit_bank_name.required'),
            'nick_name.required' => __('default.form.validation.nick_name.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        try {

            $user = Auth::user();
            $user->credit_bank_name = $request->input('credit_bank_name');
            $user->nick_name = $request->input('nick_name');
            $user->credit_card_no = $request->input('credit_card_no');
            $user->bank_id = $request->input('bank_id');
            $user->status = 1;
            $user->save();

            $bankdetails = new CreditDetails();
            #$bankdetails->account_holder_name = $request->input('account_holder_name');
            #$bankdetails->account_number = $request->input('account_number');
            #$bankdetails->ifsc_code = $request->input('ifsc_code');
            #$bankdetails->bank_name = $request->input('bank_name');
            $bankdetails->credit_bank_name = $request->input('credit_bank_name');
            $bankdetails->nick_name = $request->input('nick_name');
            $bankdetails->credit_card_no = $request->input('credit_card_no');
            $bankdetails->bank_id = $request->input('bank_id');
            $bankdetails->user_id = $user->id;
            $bankdetails->save();


            if ($request->hasFile('cheque_passbook')) {
                $file = $request->file('cheque_passbook');
                $path = $file->store('investor_doc', 'public');
                $user->cheque_pass = $path;
                $user->save();
                $bankdetails->cheque_passbook = $path;
                $bankdetails->save();
            }
            //Toastr::success(__('investor.message.bank.success'));
            // Toastr::success(__('investor.message.bank.success'), 'Success', [
            //     "timeOut" => 9000,
            //     "extendedTimeOut" => 2000, // Close after hovering for 2 seconds
            //     "progressBar" => true,
            //     "closeButton" => true,
            //     "positionClass" => "toast-top-right",
            // ]);
            #Mail::to($user->email)->queue(new SignupThankYouMail($user));

            //     $pdfAttachments = [
            //     'privacy_policy' => base64_encode($this->generatePrivacyPolicyPdf($user)),
            //     'terms_conditions' => base64_encode($this->generateTermsConditionsPdf($user)),
            // ];

            //     Mail::to($user->email)->queue(new SignupThankYouMail($user, $pdfAttachments));
            #$pdfAttachments = $this->generatePdfAttachments($user);

            // Mail::send('emails.signup_thank_you', compact('user'), function ($message) use ($user, $pdfAttachments) {
            //     $message->to($user->email)
            //             ->subject('Rumbble - Acknowledgement of your online payment')
            //             ->attachData($pdfAttachments['privacy_policy'], 'Privacy_Policy.pdf')
            //             ->attachData($pdfAttachments['terms_conditions'], 'Terms_Conditions.pdf');
            // });
            $vendor_name = $deal->customer->company_name ?? '';
            $vendor_address = $deal->customer->address ?? '';
            $customerCompanyName = $deal->customer->company_name ?? '';
            $customerMobile = $deal->customer->mobile ?? '';
            $customerName = $deal->customer->name ?? '';
            $customerEmail = $deal->customer->email ?? '';
            $customerPanNumber = $deal->customer->pan_number ?? '';
            $customerGst = $deal->customer->gst ?? '';
            $customerBankName = $deal->customer->bank_name ?? '';
            $customerIfscCode = $deal->customer->ifsc_code ?? '';
            $customerAccountNumber = $deal->customer->account_number ?? '';
            #$user = Auth::user();
            $vendor_desgination = '';
            // Get current date using Carbon
            $currentDate = Carbon::now();
    
            // Format the date with ordinal suffix
            $formattedDate = $currentDate->format('jS');
    
            $monthYear = $currentDate->format('F Y');
    
            $other_data = [
                'formattedDate' => $formattedDate,
                'monthYear' => $monthYear,
                'customerCompanyName' => $customerCompanyName,
                'customerMobile' => $customerMobile,
                'vendor_name' => $vendor_name,
                'vendor_address' => $vendor_address,
                'vendor_desgination' => $vendor_desgination,
                'customerName' => $customerName,
                'customerEmail' => $customerEmail,
                'customerPanNumber' => $customerPanNumber,
                'customerGst' => $customerGst,
                'customerBankName' => $customerBankName,
                'customerIfscCode' => $customerIfscCode,
                'customerAccountNumber' => $customerAccountNumber,
                'id' => $user->id ?? '',
                'name' => $user->name ?? '',
                'financier_name' => $user->name ?? '',
                'financier_address' => $user->address ?? '',
                'email' => $user->email ?? '',
                'mobile' => $user->mobile ?? '',
                'image' => $user->image ?? '',
                'chequePass' => $user->cheque_pass ?? '',
                'companyName' => $user->company_name ?? '',
                'panNumber' => $user->pan_number ?? '',
                'panName' => $user->pan_name ?? '',
                'gst' => $user->gst ?? '',
                'accountHolderName' => $user->account_holder_name ?? '',
                'bankName' => $user->bank_name ?? '',
                'accountNumber' => $user->account_number ?? '',
                'ifscCode' => $user->ifsc_code ?? '',
                'pdfDownload' => 'Yes',
            ];

            $companyDetail = CompanyDetail::getCompanyDetails();
            #dd($companyDetail);
            $pdfAttachments = $this->generatePdfAttachments($user, $companyDetail, $other_data);
            
            Mail::to($user->email)->queue(new SignupThankYouMail($user, $pdfAttachments, $companyDetail));

            $login_status = 1;

            $this->scheduleAttachmentCleanup($pdfAttachments);
            #return redirect()->route('admin.dashboard');
            // return redirect()->intended('/admin/dashboard');
            return redirect()->intended(route('dashboard') . '?login_status=' . $login_status);
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('form-bank-details');
        }
    }

    public function handleBankConfirmationAction(Request $request)
    {
        #dd($request);
        // Retrieve the action type from the request
        $user = auth()->user();
        
        $actionType = $request->input('action');
        $bank_id = $request->input('bankid');
    
        // Check if bank_id is provided and retrieve bank details
        if ($bank_id) {
            $bankdata = BankDetails::find($bank_id);
        } else {
            $bankdata = null;
        }
       
        $actionType = $request->input('action');
        $user = Auth::user();
        // Handle the action based on its value
        if ($actionType === 'confirm') {

            if ($bankdata) {
                $bankdata->status = 'Verified';
                $bankdata->status_default = 1;
                $bankdata->save();

            }
            // Handle "Confirm" action
            // e.g., update a database record, send a notification, etc.
            $vendor_name = $deal->customer->company_name ?? '';
            $vendor_address = $deal->customer->address ?? '';
            $customerCompanyName = $deal->customer->company_name ?? '';
            $customerMobile = $deal->customer->mobile ?? '';
            $customerName = $deal->customer->name ?? '';
            $customerEmail = $deal->customer->email ?? '';
            $customerPanNumber = $deal->customer->pan_number ?? '';
            $customerGst = $deal->customer->gst ?? '';
            $customerBankName = $deal->customer->bank_name ?? '';
            $customerIfscCode = $deal->customer->ifsc_code ?? '';
            $customerAccountNumber = $deal->customer->account_number ?? '';
            #$user = Auth::user();
            $vendor_desgination = '';
            // Get current date using Carbon
            $currentDate = Carbon::now();
    
            // Format the date with ordinal suffix
            $formattedDate = $currentDate->format('jS');
    
            $monthYear = $currentDate->format('F Y');
    
            $other_data = [
                'formattedDate' => $formattedDate,
                'monthYear' => $monthYear,
                'customerCompanyName' => $customerCompanyName,
                'customerMobile' => $customerMobile,
                'vendor_name' => $vendor_name,
                'vendor_address' => $vendor_address,
                'vendor_desgination' => $vendor_desgination,
                'customerName' => $customerName,
                'customerEmail' => $customerEmail,
                'customerPanNumber' => $customerPanNumber,
                'customerGst' => $customerGst,
                'customerBankName' => $customerBankName,
                'customerIfscCode' => $customerIfscCode,
                'customerAccountNumber' => $customerAccountNumber,
                'id' => $user->id ?? '',
                'name' => $user->name ?? '',
                'financier_name' => $user->name ?? '',
                'financier_address' => $user->address ?? '',
                'email' => $user->email ?? '',
                'mobile' => $user->mobile ?? '',
                'image' => $user->image ?? '',
                'chequePass' => $user->cheque_pass ?? '',
                'companyName' => $user->company_name ?? '',
                'panNumber' => $user->pan_number ?? '',
                'panName' => $user->pan_name ?? '',
                'gst' => $user->gst ?? '',
                'accountHolderName' => $user->account_holder_name ?? '',
                'bankName' => $user->bank_name ?? '',
                'accountNumber' => $user->account_number ?? '',
                'ifscCode' => $user->ifsc_code ?? '',
                'pdfDownload' => 'Yes',
            ];

            $companyDetail = CompanyDetail::getCompanyDetails();
            #dd($companyDetail);
            $pdfAttachments = $this->generatePdfAttachments($user, $companyDetail, $other_data);
            
            Mail::to($user->email)->queue(new SignupThankYouMail($user, $pdfAttachments, $companyDetail));

            $login_status = 1;

            $this->scheduleAttachmentCleanup($pdfAttachments);
            #return redirect()->route('admin.dashboard');
            // return redirect()->intended('/admin/dashboard');
            return redirect()->intended(route('dashboard') . '?login_status=' . $login_status);
        } elseif ($actionType === 'not_received') {
            // Handle "Not Received" action
            // e.g., log an issue, alert a team member, etc.

            return redirect()->route('form-bank-details');
            #return view('frontend.userbank');
        } 
        elseif ($actionType === 'raise_dispute') {
           

        // Send email with user and bank details
        Mail::to('ac@oneinfinity.in') // Change to actual recipient email
            ->send(new BankDisputeRaised($user, $bankdata));
            $login_status = 1;
            return redirect()->intended(route('dashboard') . '?login_status=' . $login_status);
        // Redirect back or to the form-bank-details route
        // return redirect()->route('form-bank-details')
        //                  ->with('message', 'Dispute raised successfully, and email sent to support.');
        //     return redirect()->route('form-bank-details');
            #return view('frontend.userbank');
        } 
        else {
            // Handle unknown action type
            return redirect()->back()->with('error', 'Unknown Action!');
        }
    }









    public function export(Request $request)
    {
        $query = User::query();

        // Apply filters if any


        $query->where('role_id', 7);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $users = $query->get();

        return Excel::download(new InvestorExport($users), 'investor.xlsx');
    }
}
