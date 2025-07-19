<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payments_id',
        'razorpay_signature',
        'name',
        'entity',
        'amount',
        'cust_account_type',
        'repay_status',
        'utr_reference_code',
        'repayment_made_on',
        'repayment_interest_rate',
        'repayment_interest_amount',
        'total_repayment_amount',
        'actual_repaid_amount',
        'remarks',
        'amount_in_paisa',
        'currency',
        'status',
        'order_id',
        'invoice_id',
        'international',
        'method',
        'amount_refunded',
        'refund_status',
        'captured',
        'description',
        'card_id',
        'bank',
        'wallet',
        'vpa',
        'email',
        'contact',
        'fee',
        'tax',
        'error_code',
        'error_description',
        'error_source',
        'error_step',
        'error_reason',
        'rrn',
        'upi_transaction_id',
        'bank_transaction_id',
        'upi_vpa',
        'renew_status',
        'user_id',
        'deal_id',
        'created_at',
        'payment_received_on',
        'updated_at',
        'cust_name',
        'cust_mobile',
        'cust_company_name',
        'cust_account_holder_name',
        'cust_bank_name',
        'cust_account_number',
        'cust_ifsc_code',
        'customer_id',
        'investor_name',
        'investor_mobile',
        'investor_company_name',
        'investor_account_holder_name',
        'investor_bank_name',
        'investor_pan_number',
        'investor_pan_name',
        'investor_account_number',
        'investor_ifsc_code',
        'investor_id',
        'investor_email',
        'cust_email',
        'category'
    ];


    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }

    

    public static function getCapturedPaymentsWithDeals1()
    {
        return static::where('status', 'captured')
            ->with('deal')
            ->get();
    }


    public static function getCapturedPaymentsWithDeals()
    {
        return static::where('status', 'captured')
            ->with('deal')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($payment) {
                // Check if payment_date is not null and not the default invalid date
                if (isset($payment->deal->payment_date) && $payment->deal->payment_date !== '0000-00-00 00:00:00') {
                    // Format the payment date using Carbon in d-m-Y format
                    $payment->formatted_payment_date = Carbon::parse($payment->deal->payment_date)->format('d-m-Y H:i:s');
                } else {
                    // Set to an empty string if payment_date is null or invalid
                    $payment->formatted_payment_date = '';
                }
    
                // Check if repayment_date is not null and not the default invalid date
                if (isset($payment->deal->repayment_date) && $payment->deal->repayment_date !== '0000-00-00 00:00:00') {
                    // Format the repayment date using Carbon in d-m-Y format
                    $payment->formatted_repayment_date = Carbon::parse($payment->deal->repayment_date)->format('d-m-Y');
                } else {
                    // Set to an empty string if repayment_date is null or invalid
                    $payment->formatted_repayment_date = '';
                }
    
                return $payment;
            });
    }


    public static function getCapturedPaymentsWithDealsAndBankDetails()
{
    return static::where('status', 'captured')
        ->with(['deal', 'deal.investorBankDetails']) // Assuming 'investorBankDetails' is the relation name in the Deal model
        ->get();
}
}
