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
                <h3 class="page-title">{{__('deal.index.title')}}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="{{ route('deal.index') }}">{{ __('deal.index.title') }}</a>
                    </li>
                </ul>
            </div>
            @if (Gate::check('deal-create'))
            <div class="col-md-3">
                <div class="create-btn pull-right">
                    <a href="{{ route('deal.create') }}" class="btn custom-create-btn">{{ __('default.form.deal-add-button') }}</a>
                </div>
            @endif
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
                            <th class="">{{ __('default.table.deal-view_deal') }}</th>
                            <th class="">{{ __('default.table.invoice') }}</th>
                           
                            <th class="">{{ __('default.table.raised_by') }}</th>
                            <th class="">{{ __('default.table.gross_yield') }}</th>
                            <th class="">{{ __('default.table.maturity_date') }}</th>
                            <th class="">{{ __('default.table.invoice_amount') }}</th>
                            <th class="">{{ __('default.table.deal_buffer_days_val') }}</th>
                            <th class="">{{ __('default.table.main_status') }}</th>
                            @if (Gate::check('deal-edit') || Gate::check('deal-delete'))
                            <th class="">{{ __('default.table.action') }}</th>
                            @endif
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
            ajax: '{{ route('deal.index_invested') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'view_deal',
                    name: 'view_deal'
                },
                {
                    data: 'upload_invoice_path',
                    name: 'upload_invoice_path'
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'yield_returns',
                    name: 'yield_returns'
                },
                {
                    data: 'invoice_due_date',
                    name: 'invoice_due_date'
                },
                {
                    data: 'invoice_value',
                    name: 'invoice_value'
                },
                {
                    data: 'deal_buffer_days_val.buffer_days',
                    name: 'deal_buffer_days_val.buffer_days'
                },
                {
                    data: 'deal_status',
                    name: 'deal_status'
                },
                @if (Gate::check('user-edit') || Gate::check('user-delete'))
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    @endif
            ],
        });
    });
</script>

@endpush
