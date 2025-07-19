<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


class DealsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $deals;

    public function __construct($deals)
    {
        $this->deals = $deals;
    }

    public function collection()
    {
        return $this->deals;
    }

    public function headings(): array
    {
        return [
            'Company Name',
            'Invoice Value',
            'Invoice Date',
            'Invoice Due Date',
            'Deal Start Date',
            'Deal Expiry Date',
            'Yield Returns',
            'Status',
            'Invoice Path',
        ];
    }

    public function map($deal): array
    {
        return [
            $deal->customer->company_name ?? 'N/A',
            $deal->invoice_value,
            optional(Carbon::parse($deal->invoice_date))->format('d-m-Y'),
            optional(Carbon::parse($deal->invoice_due_date))->format('d-m-Y'),
            optional(Carbon::parse($deal->deal_start_date))->format('d-m-Y'),
            optional(Carbon::parse($deal->deal_expiry_date))->format('d-m-Y'),
            $deal->yield_returns,
            $deal->main_status,
            $deal->upload_invoice ? asset('storage/' . $deal->upload_invoice) : 'N/A'
        ];
    }
}
