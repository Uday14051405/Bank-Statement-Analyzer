@extends('admin.layouts.master')

@section('page_title')
{{ __('deal.create.title') }}
@endsection

@push('css')
<style>
    #output {
        height: 300px;
        width: 300px;
    }
</style>
@endpush

@section('content')
<form action="{{ route('deal.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{__('deal.index.title')}}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('deal.index.title') }}</a></li>
                        <li class="breadcrumb-item active-breadcrumb"><a href="{{ route('users.create') }}">{{ __('deal.create.title') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="create-btn pull-right">
                        <button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- /card finish -->
    </div><!-- /Page Header -->


    <div class="card-body">

        <div class="row">



            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select_customer" class="required">{{ __('default.form.select_customer') }}</label>
                        <select name="select_customer" id="select_customer" class="select2">
                            @foreach ($company as $role)
                            <option value="{{ $role->id }}">{{ $role->company_name }}</option>
                            @endforeach
                        </select>

                        @error('select_customer')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select_anchor" class="required">{{ __('default.form.select_anchor') }}</label>
                        <select name="select_anchor" id="select_anchor" class="select2">
                            @foreach ($anchor as $role)
                            <option value="{{ $role->id }}">{{ $role->company_name }}</option>
                            @endforeach
                        </select>

                        @error('select_anchor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_name" class="required">{{ __('default.form.deal_name') }}:</label>
                        <input type="text" name="deal_name" id="deal_name" class="form-control @error('deal_name') form-control-error @enderror" required="required" value="{{ old('deal_name') }}">
                        @error('deal_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_value" class="required">{{ __('default.form.invoice_value') }}:</label>
                        <input type="number" name="invoice_value" id="invoice_value" class="form-control @error('invoice_value') form-control-error @enderror" required="required" value="{{ old('invoice_value') }}">
                        @error('invoice_value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="min_investment_amount" class="required">{{ __('default.form.min_investment_amount') }}:</label>
                        <input type="number" name="min_investment_amount" id="min_investment_amount" class="form-control @error('min_investment_amount') form-control-error @enderror" required="required" value="{{ old('min_investment_amount') }}">
                        @error('min_investment_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_expiry_date" class="required">{{ __('default.form.deal_expiry_date') }}:</label>
                        <input type="date" name="deal_expiry_date" id="deal_expiry_date" class="form-control @error('deal_expiry_date') form-control-error @enderror" required="required" value="{{ old('deal_expiry_date') }}">
                        @error('deal_expiry_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_date" class="required">{{ __('default.form.invoice_date') }}:</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control @error('invoice_date') form-control-error @enderror" required="required" value="{{ old('invoice_date') }}">
                        @error('invoice_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_due_date" class="required">{{ __('default.form.deal_due_date') }}:</label>
                        <input type="date" name="deal_due_date" id="deal_due_date" class="form-control @error('deal_due_date') form-control-error @enderror" required="required" value="{{ old('deal_due_date') }}">
                        @error('deal_due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_due_date" class="required">{{ __('default.form.invoice_due_date') }}:</label>
                        <input type="date" name="invoice_due_date" id="invoice_due_date" class="form-control @error('invoice_due_date') form-control-error @enderror" required="required" value="{{ old('invoice_due_date') }}">
                        @error('invoice_due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_buffer_days" class="required">{{ __('default.form.deal_buffer_days') }}:</label>
                        <input type="number" name="deal_buffer_days" id="deal_buffer_days" class="form-control @error('deal_buffer_days') form-control-error @enderror" required="required" value="{{ old('deal_buffer_days') }}">
                        @error('deal_buffer_days')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="yield_returns" class="required">{{ __('default.form.yield_returns') }}:</label>
                        <input type="number" name="yield_returns" id="yield_returns" class="form-control @error('yield_returns') form-control-error @enderror" required="required" value="{{ old('yield_returns') }}">
                        @error('yield_returns')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rumbble_score" class="required">{{ __('default.form.rumbble_score') }}:</label>
                        <input type="number" name="rumbble_score" id="rumbble_score" class="form-control @error('rumbble_score') form-control-error @enderror" required="required" value="{{ old('rumbble_score') }}">
                        @error('rumbble_score')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="assign_crm" class="required">{{ __('default.form.assign_crm') }}</label>
                        <select name="assign_crm" id="assign_crm" class="select2">
                            @foreach ($crm as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('assign_crm')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="upload_invoice" class="required">{{ __('default.form.upload_invoice') }}:</label>
                        <input type="file" name="upload_invoice" id="upload_invoice" class="form-control @error('upload_invoice') form-control-error @enderror" required="required" value="{{ old('upload_invoice') }}">
                        @error('upload_invoice')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>



        </div> <!-- row-end -->

    </div> <!-- card-body-end -->

</form>
@endsection


@push('scripts')
<script>
    // Function to preview selected image
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        // Set the hidden input field value to the selected image URL
        var imageInput = document.getElementById('image1');
        imageInput.value = event.target.files[0].name; // You can change this to store the image URL or any other relevant data
    }
</script>
@endpush