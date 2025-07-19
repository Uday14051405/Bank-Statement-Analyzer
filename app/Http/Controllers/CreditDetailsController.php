<?php

namespace App\Http\Controllers;

use App\Models\CreditDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Deal;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;

class CreditDetailsController extends Controller
{
    public function index()
    {
        $bankDetails = CreditDetails::where('user_id', Auth::id())->get();
        return view('admin.bank_details.index', compact('bankDetails'));
    }

    public function store_OLD27Aug(Request $request)
    {
        // $request->validate([
        //     'credit_card_no' => 'nullable|string',
        //     'credit_bank_name' => 'nullable|string',
        //     'account_holder_name' => 'nullable|string',
        //     'bank_name' => 'nullable|string',
        //     'ifsc_code' => 'nullable|string',
        //     'account_number' => 'nullable|string',
        //     'nick_name' => 'nullable|string',
        //     'cheque_passbook' => 'nullable|file|mimes:pdf,jpeg,png,jpg',
        // ]);

        $rules = [
            #'account_holder_name' => 'required|string|max:255',
            'bank_id' => 'required',
            #'account_number' => 'required|string|max:20',
            #'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'credit_card_no' => 'required|string|max:19|regex:/^\d{14,19}$/',
            'credit_bank_name' => 'required|string|max:255',
            #'bank_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
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

            // CreditDetails::updateOrCreate(
            //     ['user_id' => Auth::id()],
            //     $data
            // );

            CreditDetails::create(array_merge(
                ['user_id' => Auth::id()],
                $data
            ));
            #return redirect()->route('profile');
            $bank_status = 7;
            #return redirect()->route('profile', ['bank_status' => $bank_status]);
            return redirect()->intended(route('profile') . '?bank_status=' . $bank_status);
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('profile');
        }


        #return redirect()->route('bank_details.index')->with('success', 'Bank details updated successfully.');
    }

    public function store(Request $request)
    {
        $rules = [
            'bank_id' => 'required',
            'credit_card_no' => [
    'required',
    'string',
    'max:19',
    'regex:/^\d{14,19}$/',
    Rule::unique('credit_details')->where(function ($query) {
        return $query->where('user_id', Auth::id())
                     ->where('status', 'Verified');
    })
],
            'credit_bank_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
        ];

        $messages = [
            'bank_id.required' => 'Please select a bank.',
            'credit_card_no.required' => 'The credit card number is required.',
            'credit_card_no.unique' => __('This credit card number has already been verified for your profile.'),
            'credit_bank_name.required' => 'The credit card issuer name is required.',
            'nick_name.required' => 'The nick name is required.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $data = $request->all();

        try {
            if ($request->hasFile('cheque_passbook')) {
                $file = $request->file('cheque_passbook');
                $path = $file->store('investor_doc', 'public');
                $data['cheque_passbook'] = $path;
            }

            CreditDetails::create(array_merge(['user_id' => Auth::id()], $data));

            $bank_status = 7;
            return response()->json(['redirect_url' => route('profile') . '?bank_status=' . $bank_status], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to save credit details. Please try again.'], 500);
        }
    }


    public function update(Request $request)
    {
        $rules = [
            'bank_id_credit' => 'required',
            'credit_card_no_edit_credit' => 'required|string|max:19|regex:/^\d{14,19}$/',
            'credit_bank_name_edit_credit' => 'required|string|max:255',
            'nick_name_edit_credit_credit' => 'required|string|max:255',
        ];

        $messages = [
            'bank_id_credit.required' => 'Please select a bank.',
            'credit_card_no_edit_credit.required' => 'The credit card number is required.',
            'credit_bank_name_edit_credit.required' => 'The credit card issuer name is required.',
            'nick_name_edit_credit_credit.required' => 'The nick name is required.',
        ];
        #dd($request);
        $this->validate($request, $rules, $messages);
        $input = request()->all();

        $data = $request->all();

        $existing_bank_id = $data['existing_bank_id_credit'];
        #dd($data);
        try {

            $bankDetail = CreditDetails::where('id', $existing_bank_id)->first();
            if ($request->hasFile('cheque_passbook_edit')) {
                $file = $request->file('cheque_passbook_edit');
                $path = $file->store('investor_doc', 'public');
                $bankDetail->cheque_passbook = $path;
                $bankDetail->save();
            }
            if ($bankDetail) {
                $bankDetail->credit_card_no = $data['credit_card_no_edit_credit'];
                $bankDetail->credit_bank_name = $data['credit_bank_name_edit_credit'];
               # $bankDetail->account_holder_name = $data['account_holder_name_edit_credit'];
                #$bankDetail->bank_name = $data['bank_name_edit_credit'];
                #$bankDetail->ifsc_code = $data['ifsc_code_edit_credit'];
                #$bankDetail->account_number = $data['account_number_edit_credit'];
                $bankDetail->nick_name = $data['nick_name_edit_credit_credit'];
                $bankDetail->bank_id = $data['bank_id_credit'];
                $bankDetail->save();
            }
            // CreditDetails::updateOrCreate(
            //     ['user_id' => Auth::id()],
            //     $data
            // );
            Toastr::success(__('Credit card details successfully added!'));
        } catch (Exception $e) {

            Toastr::error(__('investor.message.bank.error'));
            return redirect()->route('profile');
        }
        return redirect()->route('profile');

        #return redirect()->route('bank_details.index')->with('success', 'Bank details updated successfully.');
    }

    public function destroy($id)
    {
        $bankDetails = CreditDetails::findOrFail($id);
        if ($bankDetails->cheque_passbook) {
            Storage::delete($bankDetails->cheque_passbook);
        }
        $bankDetails->delete();
        #return redirect()->route('bank_details.index')->with('success', 'Bank details deleted successfully.');
        return redirect()->route('profile');
    }

    public function edit($id)
    {
        $bankDetails = CreditDetails::find($id); // Replace with your actual model and logic
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
}
