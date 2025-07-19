<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Deal;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\BankApiCall;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;



class BankDetailsController extends Controller
{
    public function index()
    {
        $bankDetails = BankDetails::where('user_id', Auth::id())->get();
        return view('admin.bank_details.index', compact('bankDetails'));
    }

    public function store_old27Aug(Request $request)
    {

        $rules = [
            #'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            #'credit_card_no' => 'required|string|max:19|regex:/^\d{14,19}$/',
            #'credit_bank_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            #'nick_name' => 'required|string|max:255',
        ];

        $messages = [
            'account_holder_name.required' => __('default.form.validation.account_holder_name.required'),
            'account_number.required' => __('default.form.validation.account_number.required'),
            'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            'credit_card_no.required' => __('default.form.validation.credit_card_no.required'),
            'bank_name.required' => __('default.form.validation.bank_name.required'),
            'credit_bank_name.required' => __('default.form.validation.credit_bank_name.required'),
            'nick_name.required' => __('default.form.validation.nick_name.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        $data = $request->all();

        try {


            if ($request->hasFile('cheque_passbook')) {
                $file = $request->file('cheque_passbook');
                $path = $file->store('investor_doc', 'public');
                $data['cheque_passbook'] = $path;
                #$user->save();
            }

            BankDetails::create(array_merge(
                ['user_id' => Auth::id()],
                $data
            ));
            #return redirect()->route('profile');
            $bank_status = 1;
            #return redirect()->route('profile', ['bank_status' => $bank_status]);
            return redirect()->intended(route('profile') . '?bank_status=' . $bank_status);
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('profile');
        }

        #return redirect()->route('bank_details.index')->with('success', 'Bank details updated successfully.');
    }


    public function store_old30Aug(Request $request)
    {
        $rules = [
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name' => 'required|string|max:255',
        ];

        $messages = [
            'account_number.required' => __('default.form.validation.account_number.required'),
            'ifsc_code.required' => __('default.form.validation.ifsc_code.required'),
            'bank_name.required' => __('default.form.validation.bank_name.required'),
        ];

        $validatedData = $request->validate($rules, $messages);

        $data = $request->all();

        try {
            if ($request->hasFile('cheque_passbook')) {
                $file = $request->file('cheque_passbook');
                $path = $file->store('investor_doc', 'public');
                $data['cheque_passbook'] = $path;
            }

            BankDetails::create(array_merge(['user_id' => Auth::id()], $data));
            $bank_status = 1;
            $redirect_url = route('profile') . '?bank_status=' . $bank_status;
            return response()->json(['redirect_url' => $redirect_url, 'message' => 'Bank details saved successfully.'], 200);
            #return response()->json(['message' => 'Bank details saved successfully.'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to save bank details. Please try again.'], 500);
        }
    }

    public function store(Request $request)
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

        $validatedData = $request->validate($rules, $messages);
        $data = $request->all();

        try {
            // Generate the reference number
            $referenceNumber = 'RB' . rand(10, 99) . time() . rand(1000, 9999);

            // Prepare API request
            $apiData = [
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
            ])->post(env('DECENTRO_API_URL'), $apiData);

            $apiResponse = $response->json();
            #dd($apiResponse);
            // Save API call data
            $apiCall = new BankApiCall([
                'user_id' => Auth::id(),
                'account_number' => $request->input('account_number'),
                'ifsc_code' => $request->input('ifsc_code'),
                'bank_name' => $request->input('bank_name'),
                'api_response' => json_encode($apiResponse),
                'reference_id' => $referenceNumber,
                'status' => $apiResponse['status'] ?? '',
                'decentro_txn_id' => $apiResponse['decentroTxnId'] ?? null,
                'response_code' => $apiResponse['responseCode'] ?? null,
                'response_message' => $apiResponse['message'] ?? null,
            ]);
            $apiResponse_Status = $apiResponse['status'] ?? 'failure';
            $apiResponse_accountStatus = $apiResponse['accountStatus'] ?? 'invalid';
            if ($apiResponse_Status  === 'success' && $apiResponse_accountStatus === 'valid') {
                // If the API validates successfully, save the bank details

                $user = Auth::user();
                #$bankDetails = BankDetails::create(array_merge(['user_id' => Auth::id()], $data));

                $bankdetails = new BankDetails();
                $bankdetails->account_holder_name = $user->name;
                $bankdetails->account_number = $request->input('account_number');
                $bankdetails->ifsc_code = $request->input('ifsc_code');
                $bankdetails->bank_name = $request->input('bank_name');
                $bankdetails->user_id = $user->id;
                $bankdetails->status = 'Pending';
                $bankdetails->save();

                if ($request->hasFile('cheque_passbook')) {
                    $file = $request->file('cheque_passbook');
                    $path = $file->store('investor_doc', 'public');

                    $bankdetails->cheque_passbook = $path;
                    $bankdetails->save();
                }
                // Save the bank_id in the API call data
                $apiCall->bank_id = $bankdetails->id;
                $apiCall->save();

                $bank_status = 1;
                $redirect_url = route('profile') . '?bank_status=' . $bank_status;
                return response()->json(['redirect_url' => $redirect_url, 'bankdetails_id' => $bankdetails->id, 'message' => 'The account has been successfully verified.'], 200);
            } else {
                // Save the API call data even if it fails
                $apiCall->save();
                return response()->json(['message' => $apiResponse['message'] ?? 'Failed to verify bank details. Please try again.'], 422);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to save bank details. Please try again.'], 500);
        }
    }


    public function update(Request $request)
    {
        $rules = [
            #'account_holder_name_edit' => 'required|string|max:255',
            'account_number_edit' => 'required|string|max:20',
            'ifsc_code_edit' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            #'credit_card_no_edit' => 'required|string|max:19|regex:/^\d{14,19}$/',
            #'credit_bank_name_edit' => 'required|string|max:255',
            'bank_name_edit' => 'required|string|max:255',
            #'nick_name_edit' => 'required|string|max:255',
        ];

        $messages = [
            'account_holder_name_edit.required' => __('default.form.validation.account_holder_name.required'),
            'account_number_edit.required' => __('default.form.validation.account_number.required'),
            'ifsc_code_edit.required' => __('default.form.validation.ifsc_code.required'),
            'credit_card_no_edit.required' => __('default.form.validation.credit_card_no.required'),
            'bank_name_edit.required' => __('default.form.validation.bank_name.required'),
            'credit_bank_name_edit.required' => __('default.form.validation.credit_bank_name.required'),
            'nick_name_edit.required' => __('default.form.validation.nick_name.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        $data = $request->all();

        $existing_bank_id = $data['existing_bank_id'];
        #dd($data);
        try {

            $bankDetail = BankDetails::where('id', $existing_bank_id)->first();
            if ($request->hasFile('cheque_passbook_edit')) {
                $file = $request->file('cheque_passbook_edit');
                $path = $file->store('investor_doc', 'public');
                $bankDetail->cheque_passbook = $path;
                $bankDetail->save();
            }
            if ($bankDetail) {
                $bankDetail->credit_card_no = $data['credit_card_no_edit'];
                $bankDetail->credit_bank_name = $data['credit_bank_name_edit'];
                $bankDetail->account_holder_name = $data['account_holder_name_edit'];
                $bankDetail->bank_name = $data['bank_name_edit'];
                $bankDetail->ifsc_code = $data['ifsc_code_edit'];
                $bankDetail->account_number = $data['account_number_edit'];
                $bankDetail->nick_name = $data['nick_name_edit'];
                $bankDetail->save();
            }
            // BankDetails::updateOrCreate(
            //     ['user_id' => Auth::id()],
            //     $data
            // );
            Toastr::success(__('Bank details successfully added!'));
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('profile');
        }
        return redirect()->route('profile');

        #return redirect()->route('bank_details.index')->with('success', 'Bank details updated successfully.');
    }

    public function destroy($id)
    {
        $bankDetails = BankDetails::findOrFail($id);
        if ($bankDetails->cheque_passbook) {
            Storage::delete($bankDetails->cheque_passbook);
        }
        $bankDetails->delete();
        #return redirect()->route('bank_details.index')->with('success', 'Bank details deleted successfully.');
        return redirect()->route('profile');
    }

    public function edit($id)
    {
        $bankDetails = BankDetails::find($id); // Replace with your actual model and logic
        return response()->json($bankDetails);
    }

    public function updatebank(Request $request, $id)
    {
        $deal = Deal::find($id);
        $deal->investor_bank_id = $request->bank_id;
        $deal->bank_update_count = 2;
        $deal->investor_bank_update_date = date('Y-m-d H:i:s');
        $deal->save();

        return response()->json(['success' => true]);
    }

    public function bank_status_update(Request $request)
    {
        $userId = $request->user_id ?? auth()->id();


        // First, update all BankDetails for the user, setting status_default to 0
        BankDetails::where('user_id', $userId)->update(['status_default' => 0]);
        $bank = BankDetails::where('id', $request->id)->update(['status_default' => $request->status]);

        // Then, update the specific bank record with the new status
        # $bank = BankDetails::find($request->id)->update(['status_default' => $request->status]);
        // dd($bank);
        if ($request->status == 1) {
            return response()->json(['message' => 'Default Bank successfully updated.']);
        } else {
            return response()->json(['message' => 'Status deactivated successfully.']);
        }
    }


    public function verify($id, Request $request)
    {
        $detail = BankDetails::find($id);

        if ($detail) {
            $detail->status = 'Verified';
            $detail->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function notReceived($id, Request $request)
    {
        $detail = BankDetails::find($id);

        if ($detail) {
            $detail->status = 'Not Received';
            $detail->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
