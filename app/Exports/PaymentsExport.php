<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function collection()
    {
        return $this->payment;
    }

    public function headings(): array
    {
        // Define column headers
        return [
            'ID',
            'Payment ID',
            'Razorpay Signature',
            'Amount',
            'Currency',
            'Status',
            'Order ID',
            'Method',
            'Amount Refunded',
            'Refund Status',
            'Description',
            'Card ID',
            'Bank',
            'Wallet',
            'VPA',
            'Email',
            'Contact',
            'Error Code',
            'Error Description',
            'Error Source',
            'Error Step',
            'Error Reason',
            'RRN',
            'UPI Transaction ID',
            'Bank Transaction ID',
            'UPI VPA',
            'Renew Status',
            'Customer ID',
            'Customer Name',
            'Customer Mobile',
            'Customer Email',
            'Customer Company Name',
            'Customer Account Holder Name',
            'Customer Bank Name',
            'Customer Account Number',
            'Customer IFSC Code',
            'Investor ID',
            'Investor Name',
            'Investor Mobile',
            'Investor Email',
            'Created At',
            'Updated At',
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->payments_id,
            $payment->razorpay_signature,
            $payment->amount,
            $payment->currency,
            $payment->status,
            $payment->order_id,
            $payment->method,
            $payment->amount_refunded,
            $payment->refund_status,
            $payment->description,
            $payment->card_id,
            $payment->bank,
            $payment->wallet,
            $payment->vpa,
            $payment->email,
            $payment->contact,
            $payment->error_code,
            $payment->error_description,
            $payment->error_source,
            $payment->error_step,
            $payment->error_reason,
            $payment->rrn,
            $payment->upi_transaction_id,
            $payment->bank_transaction_id,
            $payment->upi_vpa,
            $payment->renew_status,
            $payment->customer_id,
            $payment->cust_name ?? '', // Assuming `name` is the attribute in the `Customer` model
            $payment->cust_mobile ?? '',
            $payment->cust_email ?? '',
            $payment->cust_company_name ?? '',
            $payment->cust_account_holder_name ?? '',
            $payment->cust_bank_name ?? '',
            $payment->cust_account_number ?? '',
            $payment->cust_ifsc_code ?? '',
            $payment->investor_id,
            $payment->investor_name ?? '', // Assuming `name` is the attribute in the `Investor` model
            $payment->investor_mobile ?? '',
            $payment->investor_email ?? '',
            $payment->created_at,
            $payment->updated_at,
        ];
    }
}
