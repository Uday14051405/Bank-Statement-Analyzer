<?php

// app/Exports/PaymentsExport.php
namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MISExport implements FromCollection, WithHeadings, WithMapping
{
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function collection()
    {
        return $this->payments;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Payment ID',
            'Invoice Number',
            'Bank RRN',
            'Category',
            'Payment made by / Card Swiped by Mobile Number',
            'Payment made by / Card Swiped by Email ID',
            'Payment method',
            'Customer Name',
            'Created on',
            'Payment Received on',
            'Amount in INR',
            'Status',
           'Investment Period (In Days)',
            'Re-Payment Due on',
            'Account Holder\'s Name',
            'Bank Name',
            'Bank Account Number',
            'Bank Account Type',
            'IFSC Code',
            'Repay Status',
            'Re-payment Made on Date',
            'Transaction UTR Reference Code',
            'Re-payment Interest Rate',
            'Re-payment Interest Amount',
            'Total Re-payment Amount to be paid',
            'Actual Repaid Amount',
            'Remarks',
            'Investor Name',
            'Investor Mobile',
            'Investor Email',
            'Investor Pan Name',
            'Investor Pan Number',
            'Investor Account Holder Name',
            'Investor Account Number',
            'Investor IFSC Code'
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->payments_id,
            $payment->invoice_number,
            $payment->rrn,
            $payment->category,
            $payment->contact,
            $payment->email,
            $payment->method,
            $payment->cust_company_name,
            $payment->created_at->format('d-m-Y'),
            $payment->payment_received_on,
            $payment->amount,
            $payment->status,
            $payment->deal_period,
            $payment->repayment_date,
            $payment->cust_company_name,
            $payment->cust_bank_name,
            $payment->cust_account_number,
            $payment->cust_account_type,
            $payment->cust_ifsc_code,
            $payment->repay_status,
            $payment->repayment_made_on,
            $payment->utr_reference_code,
            $payment->repayment_interest_rate,
            $payment->repayment_interest_amount,
            $payment->total_repayment_amount,
            $payment->actual_repaid_amount,
            $payment->remarks,
            $payment->investor_name,
            $payment->investor_mobile,
            $payment->investor_email,
            $payment->investor_pan_name,
            $payment->investor_pan_number,
            $payment->investor_account_holder_name,
            $payment->investor_account_number,
            $payment->investor_ifsc_code,
        ];
    }
}
