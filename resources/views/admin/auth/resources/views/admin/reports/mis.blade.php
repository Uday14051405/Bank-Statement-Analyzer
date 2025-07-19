@extends('admin.layouts.master')

@section('page_title')
{{ __('deal.index.title') }}
@endsection

@push('css')
<style>
    .table tr td {
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
<div class="card breadcrumb-card">
    <div class="row justify-content-between align-content-between" style="height: 100%;">
        <div class="col-md-6">
            <h3 class="page-title">{{__('reports.mis.title')}}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active-breadcrumb">
                    <a href="{{ route('deal.index') }}">{{ __('reports.mis.title') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('reports.export_payments') }}" class="btn btn-primary mt-2">Export MIS</a>
        </div>
    </div><!-- /card finish -->
</div><!-- /Page Header -->


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="">{{ __('default.table.sl') }}</th>
                                <th>Payment ID</th>
                                <th>Bank RRN</th>
                                <th>Category</th>
                                <th>Payment made by / Card Swiped by Mobile Number</th>
                                <th>Payment made by / Card Swiped by Email ID</th>
                                <th>Payment method</th>
                                <th>Customer detail</th>
                                <th>Created on</th>
                                <th>Payment Received on</th>
                                <th>Amount in INR</th>
                                <th>Status</th>
                                <th>Re-Payment Due on (40 Days)</th>
                                <th>Account Holder's Name</th>
                                <th>Bank Name</th>
                                <th>Bank Account Number</th>
                                <th>Bank Account Type</th>
                                <th>IFSC Code</th>
                                <th>Repay Status</th>
                                <th>Re-payment Made on Date</th>
                                <th>Transaction UTR Reference Code</th>
                                <th>Re-payment Interest Rate</th>
                                <th>Re-payment Interest Amount</th>
                                <th>Total Re-payment Amount to be paid</th>
                                <th>Actual Repaid Amount</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                responsive: false,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                ajax: '{{ route('reports.mis') }}',
                columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'payments_id', name: 'payments_id' },
                { data: 'rrn', name: 'rrn' },
                { data: 'category', name: 'category' },
                { data: 'contact', name: 'contact' },
                { data: 'email', name: 'email' },
                { data: 'method', name: 'method' },
                { data: 'cust_company_name', name: 'cust_company_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'payment_received_on', name: 'payment_received_on' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
                { data: 'deal.invoice_due_date', name: 'due_date' },
                { data: 'cust_company_name', name: 'customer_account_holder_name' },
                { data: 'cust_bank_name', name: 'customer_bank_name' },
                { data: 'cust_account_number', name: 'customer_account_number' },
                { data: 'cust_account_type', name: 'customer_account_type' },
                { data: 'cust_ifsc_code', name: 'customer_ifsc_code' },
                { data: 'repay_status', name: 'repay_status' },
                { data: 'repayment_made_on', name: 'repayment_made_on' },
                { data: 'utr_reference_code', name: 'utr_reference_code' },
                { data: 'repayment_interest_rate', name: 'repayment_interest_rate' },
                { data: 'repayment_interest_amount', name: 'repayment_interest_amount' },
                { data: 'total_repayment_amount', name: 'total_repayment_amount' },
                { data: 'actual_repaid_amount', name: 'actual_repaid_amount' },
                { data: 'remarks', name: 'remarks' }
                ],
            });
        });
    </script>

    @endpush