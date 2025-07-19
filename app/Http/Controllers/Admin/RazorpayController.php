<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Deal;
use App\Models\Payment;
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
use Razorpay\Api\Api;
use PDF;
use Carbon\Carbon;
use App\Exports\InvestorExport;
use App\Mail\AcknowledgementMail;
use Illuminate\Support\Facades\Mail;


class RazorpayController extends Controller
{
    protected $api;

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

        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
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

    private function generateAgreementPdf($user, $other_data, $companyDetail)
    {
        $pdf = PDF::loadView('emails.agreement_payment', compact('user', 'companyDetail', 'other_data'));
        $filePath = 'temp/agreement' . $user->id . '.pdf';
        Storage::put($filePath, $pdf->output());
        return $filePath;
    }

    private function generatePdfAttachments($user, $other_data, $companyDetail)
    {
        return [
            #'privacy_policy' => $this->generatePrivacyPolicyPdf($user),
            #'terms_conditions' => $this->generateTermsConditionsPdf($user),
            'agreement' => $this->generateAgreementPdf($user, $other_data, $companyDetail),
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
    public function createOrder(Request $request)
    {
        $deal_id = $request->deal_id;
        $deal = Deal::findOrFail($deal_id);
        $select_customer = $deal->select_customer ?? '';
        $customer_data = User::findOrFail($select_customer);

        #dd($deal);
        #$api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $deal->invoice_value * 100, // Amount should be in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        $razorpayOrder = $this->api->order->create($orderData);

        $payment = new Payment();
        $user = Auth::user();
        $payment->user_id = $user->id;
        $payment->deal_id = $deal_id;
        $payment->investor_id = $user->id;
        $payment->customer_id = $select_customer;
        $payment->cust_name = $customer_data->name;
        $payment->cust_email = $customer_data->email;
        $payment->cust_mobile = $customer_data->mobile;
        $payment->cust_company_name = $customer_data->company_name;
        $payment->cust_account_holder_name = $customer_data->account_holder_name;
        $payment->cust_bank_name = $customer_data->bank_name;
        $payment->cust_account_number = $customer_data->account_number;
        $payment->cust_ifsc_code = $customer_data->ifsc_code;
        $payment->order_id = $razorpayOrder['id'] ?? '';
        $payment->amount = $deal->invoice_value;
        $payment->amount_in_paisa = $deal->invoice_value  * 100;
        $payment->investor_name = $request->user()->name;
        $payment->investor_email = $request->user()->email;
        $payment->investor_mobile = $request->user()->mobile;
        $payment->investor_company_name = $request->user()->company_name;
        $payment->investor_account_holder_name = $request->user()->account_holder_name;
        $payment->investor_account_number = $request->user()->account_number;
        $payment->investor_ifsc_code = $request->user()->ifsc_code;
        $payment->investor_pan_name = $request->user()->pan_name;
        $payment->investor_pan_number = $request->user()->pan_number;
        $payment->save();

        return response()->json([
            'id' => $razorpayOrder['id'],
            'amount' => $deal->invoice_value,
            'payment_id' => $payment->id,
            'currency' => 'INR',
            'name' => 'Rumbble Investment',
            'description' => 'Order #' . $razorpayOrder['receipt'],
            'prefill' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'contact' => $request->user()->mobile,
            ],
            'notes' => [
                'merchant_order_id' => $razorpayOrder['receipt'],
                'deal_id' => $deal->deal_id,
                'invoice_value' => $deal->invoice_value,
                'min_investment_amount' => $deal->min_investment_amount,
            ],
        ]);
    }
    public function handlePayment(Request $request)
    {
        #dd('Hello');
        $user = Auth::user();
        $payment_id_val = $request->payment_id;
        $payment_data_val = Payment::findOrFail($payment_id_val);
        $deal_id = $payment_data_val->deal_id;
        $deal = Deal::findOrFail($deal_id);

        $userId = Auth::id();
        $payment_id = $request->razorpay_payment_id;
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_signature = $request->razorpay_signature;
        $registrationCreateId = $payment_data_val->deal_id;
        $registration_create_id = $payment_data_val->deal_id;
        $name = $payment_data_val->investor_name;;
        $first_name = $payment_data_val->investor_name;;
        $real_number = $payment_data_val->investor_mobile;;
        $c_code = '+91';
        $totalAmount = $payment_data_val->amount;;
        $razorpay_signature = $request->razorpay_signature;
        try {

            $payment = $this->api->payment->fetch($payment_id);
            #dd($payment);
            $payment_data = $payment->toArray();
            //$serialized_payment_data = serialize($payment_data);
            $json_payment_data = json_encode($payment_data);
            $amount_in_paise = $payment_data_val['amount_in_paisa'];
            $payment_status = '';

            if (isset($payment_data['id']) && $payment_data['status'] === 'authorized') {
                #dd('hello1');
                $payment = $this->api->payment->fetch($payment_id)->capture(array('amount' => $amount_in_paise, 'currency' => 'INR'));
                $payment_status = $payment->status ?? 'authorized';

                $success = true;
                $response = 'Payment successful! Details: ' . $payment->id;
            } elseif (isset($payment_data['id']) && $payment_data['status'] === 'captured') {
                #dd('hello2');
                $payment_status = 'captured';
                $success = true;
                $response = 'Payment successful! Details: ' . $json_payment_data;
            } else {
                #dd('hello3');
                $success = false;
                $payment_status = 'failed';
                $response = 'Payment failed! Details: ' . $json_payment_data;
                $log_message = date('Y-m-d H:i:s') . ' - Payment failed: ' . json_encode($payment_data) . PHP_EOL;
                file_put_contents('failed_payments.log', $log_message, FILE_APPEND);
            }
        } catch (\Exception $e) {
            #dd($e->getMessage());
            // Handle payment API error
            $payment = $this->api->payment->fetch($payment_id);
            $success = false;
            $payment_status = 'failed';
            $response = 'Payment failed! Error: ' . $e->getMessage();
            return response()->json(['success' => true, 'message' => 'Payment failed! Error: ' . $e->getMessage()]);
        }
        #dd($payment_status);
        $entity = $payment->entity ?? '';
        $currency = $payment->currency ?? '';
        $status = $payment_status;
        $orderId = $payment->order_id ?? '';
        $invoice_id = $payment->invoice_id ?? '';
        $international = $payment->international ?? '';
        $method = $payment->method ?? '';
        $amount_refunded = $payment->amount_refunded ?? '';
        $refund_status = $payment->refund_status ?? '';
        $captured = $payment->captured ?? '';
        $description = $payment->description ?? '';
        $card_id = $payment->card_id ?? '';
        $bank = $payment->bank ?? '';
        $wallet = $payment->wallet ?? '';
        $vpa = $payment->vpa ?? '';
        $email = $payment->email ?? '';
        $contact = $payment->contact ?? '';
        $fee = $payment->fee ?? '';
        $tax = $payment->tax ?? '';
        $errorCode = $payment->error_code ?? '';
        $errorDescription = $payment->error_description ?? '';
        $errorSource = $payment->error_source ?? '';
        $errorStep = $payment->error_step ?? '';
        $errorReason = $payment->error_reason ?? '';
        $bank_transaction_id = $payment->acquirer_data->bank_transaction_id ?? '';
        $created_at = $payment->created_at ?? now();
        $rrn = '';

        $payment_data_val->acquirer_rrn = $payment->acquirer_data->rrn ?? '';
        $payment_data_val->authentication_reference_number = $payment->acquirer_data->authentication_reference_number ?? '';


        if ($payment->method === 'upi') {
            $payment_data_val->upi_payer_account_type = $payment->upi->payer_account_type ?? '';
            $payment_data_val->upi_vpa = $payment->upi->vpa ?? '';
            $payment_data_val->upi_flow = $payment->upi->flow ?? '';
        }

        if ($payment->method === 'card') {
            $payment_data_val->card_id = $payment->card->id ?? '';
            $payment_data_val->card_entity = $payment->card->entity ?? 'card';
            $payment_data_val->card_name = $payment->card->name ?? '';
            $lastFourDigits =  $payment_data_val->card_last4 = $payment->card->last4 ?? 0;
            $payment_data_val->card_network = $payment->card->network ?? '';
            $payment_data_val->card_type = $payment->card->type ?? '';
            $payment_data_val->card_issuer = $payment->card->issuer ?? '';
            $payment_data_val->card_emi = $payment->card->emi ?? false;
            $payment_data_val->card_sub_type = $payment->card->sub_type ?? '';
        }

        $payment_data_val->payments_id = $request->razorpay_payment_id;
        $payment_data_val->order_id = $request->razorpay_order_id;
        $payment_data_val->razorpay_signature = $request->razorpay_signature;

        $payment_data_val->entity = $entity;
        $payment_data_val->currency = $currency;
        $payment_data_val->status = $status;
        $payment_data_val->invoice_id = $invoice_id;
        $payment_data_val->international = $international;
        $payment_data_val->method = $method;
        $payment_data_val->amount_refunded = $amount_refunded;
        $payment_data_val->refund_status = $refund_status;
        $payment_data_val->captured = $captured;
        $payment_data_val->description = $description;
        $payment_data_val->card_id = $card_id;
        $payment_data_val->bank = $bank;
        $payment_data_val->wallet = $wallet;
        $payment_data_val->vpa = $vpa;
        $payment_data_val->email = $email;
        $payment_data_val->contact = $contact;
        $payment_data_val->fee = $fee;
        $payment_data_val->tax = $tax;
        $payment_data_val->error_code = $errorCode;
        $payment_data_val->error_description = $errorDescription;
        $payment_data_val->error_source = $errorSource;
        $payment_data_val->error_step = $errorStep;
        $payment_data_val->error_reason = $errorReason;
        $payment_data_val->bank_transaction_id = $bank_transaction_id;
        $payment_data_val->created_at = $created_at;

        $payment_data_val->rrn = '';

        $purchase_date = Carbon::createFromTimestamp($created_at)->format('Y-m-d H:i:s');
        $receiptNumber = 'RC' . now()->format('YmdHis') . rand(10, 99);

        $payment_data_val->purchase_date = $purchase_date;
        $payment_data_val->receipt_number = $receiptNumber;
        #$payment_data_val->save();



        if ($payment_data_val->save()) {
            // Update the deal status

            if ($deal) {
                $deal_period_days = $deal->deal_period ?? 30;
                // if ($method = 'card') {
                //     // $bankDetails = BankDetails::where('user_id', $userId)
                //     // ->where('credit_card_no', 'like', '%' . $lastFourDigits)
                //     // ->first();

                //     if (isset($lastFourDigits)) {
                //         $bankDetails = CreditDetails::where('user_id', $userId)
                //             ->where('credit_card_no', 'like', '%' . $lastFourDigits)
                //             ->first();
                //     } else {
                //         $bankDetails = '';
                //     }

                //     if ($bankDetails) {
                //         // Assuming $deal is your Deal model instance
                //         $deal->card_last4 = $lastFourDigits;
                //         $deal->investor_bank_id = $bankDetails->bank_id;
                //         $deal->investor_bank_nick_name = $bankDetails->nick_name;
                //         $deal->investor_bank_update_date = Carbon::now()->format('Y-m-d H:i:s');

                //         // Save the updated deal object
                //         #$deal->save();
                //     } else {
                //         // Handle the case where $bankDetails is null, if needed
                //         // For example, log an error or take an alternative action
                //     }
                // }



                // $principal = $deal->invoice_value ?? 0; // Amount Invested
                // $rateOfInterest = $deal->yield_returns ?? 0; // Rate of Interest
                // $tenureInDays = $deal->deal_period ?? 0; // Tenure in days

                $userId = Auth::id(); // Get authenticated user ID

                // First, find the bank details that match the criteria
                $bankDetails = BankDetails::where('user_id', $userId)
                    ->where('status', 'Verified')
                    ->where('status_default', 1)
                    ->first();

                    if ($bankDetails) {
                        
                        $deal->investor_bank_id = $bankDetails->id;
                        $deal->investor_bank_nick_name = $bankDetails->bank_name;
                        $deal->investor_bank_update_date = Carbon::now()->format('Y-m-d H:i:s');
                        
                        // Save the deal after updates
                    
                    }
                //         $deal->investor_bank_nick_name = $bankDetails->nick_name;
                //         $deal->investor_bank_update_date = Carbon::now()->format('Y-m-d H:i:s');



                $principal = $deal->invoice_value ?? '0';
                $tenureInDays = $deal->calculateDaysToRepayment();
                $rateOfInterest = $deal->yield_returns ?? '0';
        
                $amountsDeal = $deal->calculateAmounts($principal, $tenureInDays, $rateOfInterest); // Example values
        
                $maturityAmountDeal = $amountsDeal['maturity_amount'];
                $repaymentAmountDeal = $amountsDeal['repayment_amount'];
                #dd($deal);
                // $deal->maturityAmountDeal = $maturityAmountDeal;
                // $deal->repaymentAmountDeal = $repaymentAmountDeal;
                // $deal->deal_period_days = $deal_period_days;
                // // Calculate Interest
                // $interest = ($principal * $rateOfInterest * $tenureInDays) / (100 * 365);

                // // Calculate Maturity Amount without rounding
                // $maturityAmountWithoutRounding = $principal + $interest;

                // // Calculate Maturity Amount with rounding up to 2 decimal places
                $maturityAmountWithRounding = round($repaymentAmountDeal, 2);

                $maturityAmountWithRound = round($repaymentAmountDeal);


                //echo "Maturity Amount without rounding: ₹" . number_format($maturityAmountWithoutRounding, 2) . "\n";
                // "Maturity Amount with rounding: ₹" . number_format($maturityAmountWithRounding, 2);

                $deal->deal_status = 'Invested'; // Set the status to 'Paid' or any other appropriate status
                $deal->status = 'Invested'; // Set the status to 'Paid' or any other appropriate status
                $deal->bank_update_count = 1;

                #$new_repayment_date = Carbon::now()->addDays($deal_period_days); 
                $new_repayment_date = $deal->repayment_date ?? '';
                $deal->repayment_date = $new_repayment_date;
                $deal->maturity_amount_roundup = $maturityAmountWithRounding;
                $deal->maturity_amount = $maturityAmountWithRound;
                $deal->yield_returns_amount = $maturityAmountDeal;
                $deal->purchase_date = $purchase_date;
                $deal->receipt_number = $receiptNumber;
                $deal->investor_id = $userId;
                $deal->payment_date = date('Y-m-d H:i:s');
                $deal->save();

                $payment_data_val->maturity_amount_roundup = $maturityAmountWithRounding;
                $payment_data_val->maturity_amount = $maturityAmountWithRound;
                $payment_data_val->deal_period = $deal_period_days;
                $payment_data_val->yield_returns_amount = $maturityAmountDeal;
                $payment_data_val->deal_number = $deal->deal_number;
                $payment_data_val->invoice_number = $deal->invoice_number ?? '';
                $payment_data_val->repayment_date = $new_repayment_date;
                $payment_data_val->save();
            }
        }
        

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
        $pdfAttachments = $this->generatePdfAttachments($user, $other_data, $companyDetail);
       

        Mail::to($user->email)->queue(new AcknowledgementMail($user, $payment_data_val, $deal, $pdfAttachments, $other_data, $companyDetail));

       
        $this->scheduleAttachmentCleanup($pdfAttachments);

        return response()->json(['success' => true, 'message' => 'Payment successful and data saved!']);
    }

    public function handlePaymentSep11(Request $request)
    {
        #dd('Hello');
        $user = Auth::user();
        $payment_id_val = $request->payment_id;
        $payment_data_val = Payment::findOrFail($payment_id_val);
        $deal_id = $payment_data_val->deal_id;
        $deal = Deal::findOrFail($deal_id);

        $userId = Auth::id();
        $payment_id = $request->razorpay_payment_id;
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_signature = $request->razorpay_signature;
        $registrationCreateId = $payment_data_val->deal_id;
        $registration_create_id = $payment_data_val->deal_id;
        $name = $payment_data_val->investor_name;;
        $first_name = $payment_data_val->investor_name;;
        $real_number = $payment_data_val->investor_mobile;;
        $c_code = '+91';
        $totalAmount = $payment_data_val->amount;;
        $razorpay_signature = $request->razorpay_signature;
        try {

            $payment = $this->api->payment->fetch($payment_id);
            #dd($payment);
            $payment_data = $payment->toArray();
            //$serialized_payment_data = serialize($payment_data);
            $json_payment_data = json_encode($payment_data);
            $amount_in_paise = $payment_data_val['amount_in_paisa'];
            $payment_status = '';

            if (isset($payment_data['id']) && $payment_data['status'] === 'authorized') {
                #dd('hello1');
                $payment = $this->api->payment->fetch($payment_id)->capture(array('amount' => $amount_in_paise, 'currency' => 'INR'));
                $payment_status = $payment->status ?? 'authorized';

                $success = true;
                $response = 'Payment successful! Details: ' . $payment->id;
            } elseif (isset($payment_data['id']) && $payment_data['status'] === 'captured') {
                #dd('hello2');
                $payment_status = 'captured';
                $success = true;
                $response = 'Payment successful! Details: ' . $json_payment_data;
            } else {
                #dd('hello3');
                $success = false;
                $payment_status = 'failed';
                $response = 'Payment failed! Details: ' . $json_payment_data;
                $log_message = date('Y-m-d H:i:s') . ' - Payment failed: ' . json_encode($payment_data) . PHP_EOL;
                file_put_contents('failed_payments.log', $log_message, FILE_APPEND);
            }
        } catch (\Exception $e) {
            #dd($e->getMessage());
            // Handle payment API error
            $payment = $this->api->payment->fetch($payment_id);
            $success = false;
            $payment_status = 'failed';
            $response = 'Payment failed! Error: ' . $e->getMessage();
            return response()->json(['success' => true, 'message' => 'Payment failed! Error: ' . $e->getMessage()]);
        }
        #dd($payment_status);
        $entity = $payment->entity ?? '';
        $currency = $payment->currency ?? '';
        $status = $payment_status;
        $orderId = $payment->order_id ?? '';
        $invoice_id = $payment->invoice_id ?? '';
        $international = $payment->international ?? '';
        $method = $payment->method ?? '';
        $amount_refunded = $payment->amount_refunded ?? '';
        $refund_status = $payment->refund_status ?? '';
        $captured = $payment->captured ?? '';
        $description = $payment->description ?? '';
        $card_id = $payment->card_id ?? '';
        $bank = $payment->bank ?? '';
        $wallet = $payment->wallet ?? '';
        $vpa = $payment->vpa ?? '';
        $email = $payment->email ?? '';
        $contact = $payment->contact ?? '';
        $fee = $payment->fee ?? '';
        $tax = $payment->tax ?? '';
        $errorCode = $payment->error_code ?? '';
        $errorDescription = $payment->error_description ?? '';
        $errorSource = $payment->error_source ?? '';
        $errorStep = $payment->error_step ?? '';
        $errorReason = $payment->error_reason ?? '';
        $bank_transaction_id = $payment->acquirer_data->bank_transaction_id ?? '';
        $created_at = $payment->created_at ?? now();
        $rrn = '';

        $payment_data_val->acquirer_rrn = $payment->acquirer_data->rrn ?? '';
        $payment_data_val->authentication_reference_number = $payment->acquirer_data->authentication_reference_number ?? '';


        if ($payment->method === 'upi') {
            $payment_data_val->upi_payer_account_type = $payment->upi->payer_account_type ?? '';
            $payment_data_val->upi_vpa = $payment->upi->vpa ?? '';
            $payment_data_val->upi_flow = $payment->upi->flow ?? '';
        }

        if ($payment->method === 'card') {
            $payment_data_val->card_id = $payment->card->id ?? '';
            $payment_data_val->card_entity = $payment->card->entity ?? 'card';
            $payment_data_val->card_name = $payment->card->name ?? '';
            $lastFourDigits =  $payment_data_val->card_last4 = $payment->card->last4 ?? 0;
            $payment_data_val->card_network = $payment->card->network ?? '';
            $payment_data_val->card_type = $payment->card->type ?? '';
            $payment_data_val->card_issuer = $payment->card->issuer ?? '';
            $payment_data_val->card_emi = $payment->card->emi ?? false;
            $payment_data_val->card_sub_type = $payment->card->sub_type ?? '';
        }

        $payment_data_val->payments_id = $request->razorpay_payment_id;
        $payment_data_val->order_id = $request->razorpay_order_id;
        $payment_data_val->razorpay_signature = $request->razorpay_signature;

        $payment_data_val->entity = $entity;
        $payment_data_val->currency = $currency;
        $payment_data_val->status = $status;
        $payment_data_val->invoice_id = $invoice_id;
        $payment_data_val->international = $international;
        $payment_data_val->method = $method;
        $payment_data_val->amount_refunded = $amount_refunded;
        $payment_data_val->refund_status = $refund_status;
        $payment_data_val->captured = $captured;
        $payment_data_val->description = $description;
        $payment_data_val->card_id = $card_id;
        $payment_data_val->bank = $bank;
        $payment_data_val->wallet = $wallet;
        $payment_data_val->vpa = $vpa;
        $payment_data_val->email = $email;
        $payment_data_val->contact = $contact;
        $payment_data_val->fee = $fee;
        $payment_data_val->tax = $tax;
        $payment_data_val->error_code = $errorCode;
        $payment_data_val->error_description = $errorDescription;
        $payment_data_val->error_source = $errorSource;
        $payment_data_val->error_step = $errorStep;
        $payment_data_val->error_reason = $errorReason;
        $payment_data_val->bank_transaction_id = $bank_transaction_id;
        $payment_data_val->created_at = $created_at;

        $payment_data_val->rrn = '';

        $purchase_date = Carbon::createFromTimestamp($created_at)->format('Y-m-d H:i:s');
        $receiptNumber = 'RC' . now()->format('YmdHis') . rand(10, 99);

        $payment_data_val->purchase_date = $purchase_date;
        $payment_data_val->receipt_number = $receiptNumber;
        #$payment_data_val->save();



        if ($payment_data_val->save()) {
            // Update the deal status

            if ($deal) {
                $deal_period_days = $deal->deal_period ?? 30;
                if ($method = 'card') {
                    // $bankDetails = BankDetails::where('user_id', $userId)
                    // ->where('credit_card_no', 'like', '%' . $lastFourDigits)
                    // ->first();

                    if (isset($lastFourDigits)) {
                        $bankDetails = CreditDetails::where('user_id', $userId)
                            ->where('credit_card_no', 'like', '%' . $lastFourDigits)
                            ->first();
                    } else {
                        $bankDetails = '';
                    }

                    if ($bankDetails) {
                        // Assuming $deal is your Deal model instance
                        $deal->card_last4 = $lastFourDigits;
                        $deal->investor_bank_id = $bankDetails->bank_id;
                        $deal->investor_bank_nick_name = $bankDetails->nick_name;
                        $deal->investor_bank_update_date = Carbon::now()->format('Y-m-d H:i:s');

                        // Save the updated deal object
                        #$deal->save();
                    } else {
                        // Handle the case where $bankDetails is null, if needed
                        // For example, log an error or take an alternative action
                    }
                }
                // $principal = $deal->invoice_value ?? 0; // Amount Invested
                // $rateOfInterest = $deal->yield_returns ?? 0; // Rate of Interest
                // $tenureInDays = $deal->deal_period ?? 0; // Tenure in days


                $principal = $deal->invoice_value ?? '0';
                $tenureInDays = $deal->calculateDaysToRepayment();
                $rateOfInterest = $deal->yield_returns ?? '0';
        
                $amountsDeal = $deal->calculateAmounts($principal, $tenureInDays, $rateOfInterest); // Example values
        
                $maturityAmountDeal = $amountsDeal['maturity_amount'];
                $repaymentAmountDeal = $amountsDeal['repayment_amount'];
                #dd($deal);
                // $deal->maturityAmountDeal = $maturityAmountDeal;
                // $deal->repaymentAmountDeal = $repaymentAmountDeal;
                // $deal->deal_period_days = $deal_period_days;
                // // Calculate Interest
                // $interest = ($principal * $rateOfInterest * $tenureInDays) / (100 * 365);

                // // Calculate Maturity Amount without rounding
                // $maturityAmountWithoutRounding = $principal + $interest;

                // // Calculate Maturity Amount with rounding up to 2 decimal places
                $maturityAmountWithRounding = round($repaymentAmountDeal, 2);

                $maturityAmountWithRound = round($repaymentAmountDeal);


                //echo "Maturity Amount without rounding: ₹" . number_format($maturityAmountWithoutRounding, 2) . "\n";
                // "Maturity Amount with rounding: ₹" . number_format($maturityAmountWithRounding, 2);

                $deal->deal_status = 'Invested'; // Set the status to 'Paid' or any other appropriate status
                $deal->status = 'Invested'; // Set the status to 'Paid' or any other appropriate status
                $deal->bank_update_count = 1;

                #$new_repayment_date = Carbon::now()->addDays($deal_period_days); 
                $new_repayment_date = $deal->repayment_date ?? '';
                $deal->repayment_date = $new_repayment_date;
                $deal->maturity_amount_roundup = $maturityAmountWithRounding;
                $deal->maturity_amount = $maturityAmountWithRound;
                $deal->yield_returns_amount = $maturityAmountDeal;
                $deal->purchase_date = $purchase_date;
                $deal->receipt_number = $receiptNumber;
                $deal->investor_id = $userId;
                $deal->payment_date = date('Y-m-d H:i:s');
                $deal->save();

                $payment_data_val->maturity_amount_roundup = $maturityAmountWithRounding;
                $payment_data_val->maturity_amount = $maturityAmountWithRound;
                $payment_data_val->deal_period = $deal_period_days;
                $payment_data_val->yield_returns_amount = $maturityAmountDeal;
                $payment_data_val->deal_number = $deal->deal_number;
                $payment_data_val->invoice_number = $deal->invoice_number ?? '';
                $payment_data_val->repayment_date = $new_repayment_date;
                $payment_data_val->save();
            }
        }
        

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
        $pdfAttachments = $this->generatePdfAttachments($user, $other_data, $companyDetail);
       

        Mail::to($user->email)->queue(new AcknowledgementMail($user, $payment_data_val, $deal, $pdfAttachments, $other_data, $companyDetail));

       
        $this->scheduleAttachmentCleanup($pdfAttachments);

        return response()->json(['success' => true, 'message' => 'Payment successful and data saved!']);
    }


    public function paymentSuccess(Request $request)
    {
        // Handle successful payment logic here
        return redirect()->route('deal.index')->with('success', 'Payment successful!');
    }

    public function paymentFailure(Request $request)
    {
        // Handle payment failure logic here
        return redirect()->route('deal.index')->with('error', 'Payment failed!');
    }

    public function generateAgreementt()
    {
        $data = [
            'vendor_name' => 'Vendor Name',
            'vendor_address' => 'Vendor Address',
            'financier_name' => 'Financier Name',
            'financier_address' => 'Financier Address',
        ];

        $pdf = PDF::loadView('pdf.agreement', $data);
        return $pdf->download('agreement.pdf');
    }

    public function generateAgreementSep3(Request $request, $id = 35)
    {
        $deal = Deal::with('customer')->findOrFail($id);

        // Retrieve customer details
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
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');

        // Display the data for review before generating PDF
        return view('admin.agreement.agreement1', [
            'deal' => $deal,
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

        ]);
    }

    public function generateAgreement(Request $request, $id = 35)
    {
        $deal = Deal::with('customer')->findOrFail($id);       
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');


        $vendor_name = $deal->customer->company_name ?? '';
        $deal_id = $deal->id ?? '';
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
        $companyDetail = CompanyDetail::getCompanyDetails();
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
        // Display the data for review before generating PDF
        return view('admin.agreement.agreement1', [
            'user' => $user,
            'other_data' => $other_data,
            'companyDetail' => $companyDetail,
            'pdfDownload' => 'Yes',
            'deal_id' => $deal_id,

        ]);
    }

    public function downloadAgreementSep3(Request $request, $id = 35)
    {
        $deal = Deal::with('customer')->findOrFail($id);

        // Retrieve customer details
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

        // Retrieve authenticated user details
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');
        $data = [
            'deal' => $deal,
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
            'pdfDownload' => 'No',
        ];


        $pdf = PDF::loadView('admin.agreement.agreement1', $data);
        return $pdf->download('agreement.pdf');
    }

    public function downloadAgreement(Request $request, $id = 35)
    {
        $deal = Deal::with('customer')->findOrFail($id);       
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');


        $vendor_name = $deal->customer->company_name ?? '';
        $deal_id = $deal->id ?? '';
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
        $companyDetail = CompanyDetail::getCompanyDetails();
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
        // Display the data for review before generating PDF
        
        $pdfDownload = 'No';
        $pdf = PDF::loadView('admin.agreement.agreement1', compact('user', 'companyDetail', 'other_data', 'pdfDownload'));

        #$pdf = PDF::loadView('admin.agreement.agreement1', $data);
        return $pdf->download('agreement.pdf');
    }

    public function generateAgreement_terms(Request $request, $id = 35)
    {
        #$deal = Deal::with('customer')->findOrFail($id);
        $deal = '';
        // Retrieve customer details
        $vendor_id = 1;
        $vendor_name = 'Vendor_name';
        $vendor_address = 'Vendor_address';
        $customerCompanyName = 'Company Name';
        $customerMobile = 'Customer Mobile';
        $customerName = 'Customer Name';
        $customerEmail = 'Customer Email';
        $customerPanNumber = 'Customer Pan Number';
        $customerGst = 'Customer GST';
        $customerBankName = 'Customer Bank Name';
        $customerIfscCode = 'Customer IFSC Code';
        $customerAccountNumber = 'Customer Account Number';
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');

        // Display the data for review before generating PDF
        return view('admin.agreement.agreement_terms', [
            'deal' => $deal,
            'formattedDate' => $formattedDate,
            'monthYear' => $monthYear,
            'vendor_id' => $vendor_id,
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
            'name' => $user->name ?? 'Financier_name',
            'financier_name' => $user->name ?? 'Financier_name',
            'financier_address' => $user->address ?? 'Financier_address',
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

        ]);
    }

    public function downloadAgreement_terms(Request $request, $id = 1)
    {
        // $deal = Deal::with('customer')->findOrFail($id);
        $deal = '';
        // Retrieve customer details
        $vendor_id = 1;
        $vendor_name = 'Vendor_name';
        $vendor_address = 'Vendor_address';
        $customerCompanyName = 'Company Name';
        $customerMobile = 'Customer Mobile';
        $customerName = 'Customer Name';
        $customerEmail = 'Customer Email';
        $customerPanNumber = 'Customer Pan Number';
        $customerGst = 'Customer GST';
        $customerBankName = 'Customer Bank Name';
        $customerIfscCode = 'Customer IFSC Code';
        $customerAccountNumber = 'Customer Account Number';

        // Retrieve authenticated user details
        $user = Auth::user();
        $vendor_desgination = '';
        // Get current date using Carbon
        $currentDate = Carbon::now();

        // Format the date with ordinal suffix
        $formattedDate = $currentDate->format('jS');

        $monthYear = $currentDate->format('F Y');
        $data = [
            'deal' => $deal,
            'formattedDate' => $formattedDate,
            'monthYear' => $monthYear,
            'vendor_id' => $vendor_id,
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
            'name' => $user->name ?? 'Financier_name',
            'financier_name' => $user->name ?? 'Financier_name',
            'financier_address' => $user->address ?? 'Financier_address',
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
            'pdfDownload' => 'No',
        ];


        $pdf = PDF::loadView('admin.agreement.agreement_terms', $data);
        return $pdf->download('agreement.pdf');
    }
}
