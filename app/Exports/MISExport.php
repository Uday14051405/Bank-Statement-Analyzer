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
    protected $serialNumber = 0;

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
            'Sr.No',
            'Payment ID',
            'Invoice Number',
            'Bank RRN',
            'Description',
            'Category',
            'Payment made by / Card Swiped by Mobile Number',
            'Payment made by / Card Swiped by Email ID',
            'Payment method',
            'Customer detail',
            'Created on',
            'Payment Received on',
            'Amount in INR',
            'Status',
            'Investment Period (In Days)',
            'Re-Payment Due on',
            'Investor Name',
            'Investor Mobile',
            'Investor Email',
            'Investor Pan Name',
            'Investor Pan Number',
            'Investor Credit Card No',
            'Investor Credit Card Bank Name',
            'Investor Account Holder Name',
            'Investor Linked Bank Name',
            'Investor Account Number',
            'Investor IFSC Code',
            'Investor Nick Name',
            'Repay Status',
            'Re-payment Made on Date',
            'Transaction UTR Reference Code',
            'Re-payment Interest Rate',
            'Re-payment Interest Amount',
            'Total Re-payment Amount to be paid',
            'Actual Repaid Amount'
        ];
        
        
    }

    public function map($payment): array
    {
        $this->serialNumber++;

        return [
            $this->serialNumber,
            $payment->payments_id,
            $payment->invoice_number,
            $payment->acquirer_rrn,
            $payment->description,
            $payment->category,
            $payment->contact,
            $payment->email,
            $payment->method,
            $payment->cust_company_name,
            $payment->created_at->format('d-m-Y'),
            $payment->formatted_payment_date,
            $payment->amount,
            $payment->status,
            $payment->deal_period,
            $payment->formatted_repayment_date,
            $payment->investor_name,
            $payment->investor_mobile,
            $payment->investor_email,
            $payment->investor_pan_name,
            $payment->investor_pan_number,
            $payment->deal->investorCreditDetails->credit_card_no ?? 'N/A',
            $payment->deal->investorCreditDetails->credit_bank_name ?? 'N/A',
            $payment->deal->investorBankDetails->account_holder_name ?? 'N/A',
            $payment->deal->investorBankDetails->bank_name ?? 'N/A',
            $payment->deal->investorBankDetails->account_number ?? 'N/A',
            $payment->deal->investorBankDetails->ifsc_code ?? 'N/A',
            $payment->deal->investorCreditDetails->nick_name ?? '',
            $payment->repay_status,
            $payment->repayment_made_on,
            $payment->utr_reference_code,
            $payment->repayment_interest_rate,
            $payment->repayment_interest_amount,
            $payment->total_repayment_amount,
            $payment->actual_repaid_amount,
           
           
        ];
    }
}
