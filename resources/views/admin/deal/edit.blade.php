@extends('admin.layouts.master')

@section('page_title')
{{__('user.edit.title')}}
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
<form method="post" action="{{ route('deal.update', $user->id) }}" enctype="multipart/form-data">
    @csrf()

    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{__('user.index.title')}}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.index') }}">{{ __('user.index.title') }}</a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="{{ route('users.edit', $user->id) }}">{{ __('user.edit.title') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="create-btn pull-right">
                        <button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- /card finish -->
    </div><!-- /Page Header -->

    <div class="card-body">

        <div class="row">



            <div class="row">


                <div class="col-md-6 ">
                    <div class="form-group">
                        <label for="deal_number" class="required">{{ __('default.form.deal_number') }}:</label>
                        <input type="text" name="deal_number" id="deal_number" class="form-control @error('deal_number') form-control-error @enderror" required="required" value="{{ $user->deal_number }}" readonly>
                        @error('deal_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select_customer" class="required">{{ __('default.form.select_customer') }}</label>

                        <select name="select_customer" id="select_customer" class="select2">
                            <option value="">Select Customer</option>
                            @foreach ($company as $customer)
                            <option value="{{ $customer->id }}" {{ $user->select_customer == $customer->id ? 'selected' : '' }}>
                                {{ $customer->company_name }}
                            </option>
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
                            <option value="">Select Anchor</option>
                            <!-- Dynamically populated via AJAX -->
                            @if ($anchors)
                            @foreach ($anchors as $anchor)
                            <option value="{{ $anchor->id }}" {{ $user->select_anchor == $anchor->id ? 'selected' : '' }}>
                                {{ $anchor->company_name }}
                            </option>
                            @endforeach
                            @endif
                        </select>

                        @error('select_anchor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>









                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_number" class="required">{{ __('default.form.invoice_number') }}:</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control @error('invoice_number') form-control-error @enderror" required="required" value="{{ $user->invoice_number }}">

                        @error('invoice_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_name" class="required">{{ __('default.form.deal_name') }}:</label>
                        <input type="text" name="deal_name" id="deal_name" class="form-control @error('deal_name') form-control-error @enderror" value="{{ old('deal_name') }}">
                        @error('deal_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_value" class="required">{{ __('default.form.invoice_value') }}:</label>
                        <input type="number" name="invoice_value" id="invoice_value" class="form-control @error('invoice_value') form-control-error @enderror" readonly required="required" value="{{ $user->invoice_value }}">
                        @error('invoice_value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="min_investment_amount" class="required">{{ __('default.form.min_investment_amount') }}:</label>
                        <input type="number" name="min_investment_amount" id="min_investment_amount" class="form-control @error('min_investment_amount') form-control-error @enderror" value="{{ old('min_investment_amount') }}">
                        @error('min_investment_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_expiry_date" class="required">{{ __('default.form.deal_expiry_date') }}:</label>
                        <input type="date" name="deal_expiry_date" id="deal_expiry_date" class="form-control @error('deal_expiry_date') form-control-error @enderror" value="{{ old('deal_expiry_date') }}">
                        @error('deal_expiry_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_date" class="required">{{ __('default.form.invoice_date') }}:</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control @error('invoice_date') form-control-error @enderror" required="required" value="{{ $user->formatted_invoice_date_input }}" readonly>
                        @error('invoice_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
    <div class="form-group">
        <label for="deal_due_date_days" class="required">{{ __('default.form.deal_due_date_days') }}:</label>
        <input 
            type="number" 
            name="deal_due_date_days" 
            id="deal_due_date_days" 
            class="form-control @error('deal_due_date_days') form-control-error @enderror" 
            value="{{ $user->deal_due_date_days }}"
            min="1" 
            max="8" 
            step="1"
            oninput="validity.valid||(value=''); calculateExpiryDate();" 
        >
        @error('deal_due_date_days')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="deal_due_date" class="required">{{ __('default.form.deal_due_date') }}:</label>
                        <input type="date" name="deal_due_date" id="deal_due_date" class="form-control @error('deal_due_date') form-control-error @enderror" readonly required="required" value="{{ $user->formatted_deal_due_date_input }}" >
                        @error('deal_due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="invoice_due_date" class="required">{{ __('default.form.invoice_due_date') }}:</label>
                        <input type="date" name="invoice_due_date" id="invoice_due_date" class="form-control @error('invoice_due_date') form-control-error @enderror" value="{{ $user->formatted_invoice_due_date_input }}">
                        @error('invoice_due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_buffer_days" class="required">{{ __('default.form.deal_buffer_days') }}:</label>
                        <input type="number" name="deal_buffer_days" id="deal_buffer_days" class="form-control @error('deal_buffer_days') form-control-error @enderror"  value="{{ $user->deal_buffer_days }}">
                        @error('deal_buffer_days')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_period" class="required">{{ __('default.form.deal_period') }}</label>
                        <!-- <select name="deal_period" id="deal_period" class="select2">
                            @foreach ($deal_period as $role)
                            <option value="{{ $role->value }}" {{ $user->deal_period == $role->value ? 'selected' : '' }}>{{ $role->value }}</option>
                            @endforeach
                        </select> -->
                        <input type="number" name="deal_period" id="deal_period" class="form-control @error('deal_period') form-control-error @enderror" required="required" value="{{ $user->deal_period }}" min="30" max="180" readonly>

                        <input type="hidden" value="{{ $user->deal_period_pending }}"  name="deal_period_pending" id="deal_period_pending" >

                        @error('deal_period')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="yield_returns" class="required">{{ __('default.form.yield_returns') }}:</label>
                        <input type="number" name="yield_returns" id="yield_returns" class="form-control @error('yield_returns') form-control-error @enderror" readonly required="required" value="{{ $user->yield_returns }}">
                        @error('yield_returns')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_live_date">{{ __('default.form.deal_live_date') }}:</label>
                        <input type="datetime-local" name="deal_live_date" id="deal_live_date" class="form-control @error('deal_live_date') form-control-error @enderror" value="{{ $user->deal_live_date1 }}">
                        @error('deal_live_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="maturity_amount">{{ __('default.form.maturity_amount') }}:</label>
                        <input type="number" id="maturity_amount" name="maturity_amount" class="form-control" readonly value="{{ $user->yield_returns_amount }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="repayment_amount">{{ __('default.form.repayment_amount') }}:</label>
                        <input type="number" id="repayment_amount" name="repayment_amount" class="form-control" readonly value="{{ $user->maturity_amount_roundup }}">
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="rumbble_score" class="required">{{ __('default.form.rumbble_score') }}:</label>
                        <input type="number" name="rumbble_score" id="rumbble_score" class="form-control @error('rumbble_score') form-control-error @enderror" value="{{ old('rumbble_score') }}">
                        @error('rumbble_score')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
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
                        <label for="upload_invoice" class="">{{ __('default.form.upload_invoice') }}:</label>
                        <input type="file" name="upload_invoice1" id="upload_invoice" class="form-control @error('upload_invoice') form-control-error @enderror">
                        @error('upload_invoice')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if($user->upload_invoice)
                        <a href="{{ asset('storage/' . $user->upload_invoice) }}" target="_blank">View</a>
                        @else

                        @endif
                    </div>
                </div>



            </div>



        </div> <!-- row-end -->

    </div> <!-- card-body-end -->
</form>
@endsection


@push('scripts')

<script>
function calculateExpiryDate() {
    const daysInput = document.getElementById('deal_due_date_days').value; // Get the number of days
    const days = parseInt(daysInput);

    if (!isNaN(days) && days > 0) {
        // Get today's date
        const today = new Date();

        // Add the number of days to today's date
        const expiryDate = new Date(today);
        expiryDate.setDate(today.getDate() + days);

        // Format the date to 'YYYY-MM-DD' format for the input field
        const formattedDate = expiryDate.toISOString().split('T')[0];

        // Set the calculated expiry date to the deal_due_date input field
        document.getElementById('deal_due_date').value = formattedDate;
    } else {
        // If the number of days is not valid, clear the expiry date
        document.getElementById('deal_due_date').value = '';
    }
}
</script>


<script>
    function calculateAmounts() {
        const invoiceValue = parseFloat(document.getElementById('invoice_value').value) || 0;
        const dealPeriod = parseFloat(document.getElementById('deal_period').value) || 0;
        const yieldReturns = parseFloat(document.getElementById('yield_returns').value) || 0;

        // Calculate interest
        const interest = (invoiceValue * yieldReturns * dealPeriod) / 36500;

        // Calculate maturity amount (principal + interest)
        const maturityAmount = invoiceValue + interest;

        // Calculate repayment amount (maturity amount - 10% of interest)
        const repaymentAmount = maturityAmount - (interest * 0.1);

        document.getElementById('maturity_amount').value = maturityAmount.toFixed(2);
        document.getElementById('repayment_amount').value = repaymentAmount.toFixed(2);
    }

    function calculateAmounts1() {
        const invoiceValue = parseFloat(document.getElementById('invoice_value').value) || 0;
        const dealPeriod = parseFloat(document.getElementById('deal_period_pending').value) || 0;
        const yieldReturns = parseFloat(document.getElementById('yield_returns').value) || 0;

        // Calculate interest
        const interest = (invoiceValue * yieldReturns * dealPeriod) / 36500;

        // Calculate maturity amount (principal + interest)
        const maturityAmount = invoiceValue + interest;

        // Calculate repayment amount (maturity amount - 10% of interest)
        const repaymentAmount = maturityAmount - (interest * 0.1);

        document.getElementById('maturity_amount').value = maturityAmount.toFixed(2);
        document.getElementById('repayment_amount').value = repaymentAmount.toFixed(2);
    }
    // Attach event listeners to the input fields
    document.getElementById('invoice_value').addEventListener('input', calculateAmounts);
    document.getElementById('deal_period').addEventListener('input', calculateAmounts);
    document.getElementById('yield_returns').addEventListener('input', calculateAmounts);
    //document.getElementById('yield_returns').addEventListener('input', calculateAmounts);
</script>
<script>
    $(document).ready(function() {
        calculateAmounts1();
        $('#select_customer').on('change', function() {
            var customerId = $(this).val();

            // Clear previous anchor options
            $('#select_anchor').empty();

            if (customerId) {
                var routeUrl = "{{ route('anchor.getAnchors', ':customerId') }}";
                routeUrl = routeUrl.replace(':customerId', customerId);

                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    success: function(data) {
                        $('#select_anchor').append('<option value="">Select Anchor</option>');
                        $.each(data, function(key, value) {
                            $('#select_anchor').append('<option value="' + value.id + '">' + value.company_name + '</option>');
                        });

                        // Optionally, if there's a previously selected anchor, re-select it.
                        var selectedAnchorId = "{{ $user->select_anchor }}";
                        if (selectedAnchorId) {
                            $('#select_anchor').val(selectedAnchorId).trigger('change');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#select_anchor').append('<option value="">Select Anchor</option>');
            }
        });

        // Trigger change on load if customer is already selected
        if ($('#select_customer').val()) {
            $('#select_customer').trigger('change');
        }
    });
</script>

<script>
    var loadFileImageFront = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();
            inputId = 'image1';
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });
    });

    // input
    let inputId = '';
    let output = 'output';

    // set file link
    function fmSetLink($url) {
        document.getElementById(inputId).value = $url;
        document.getElementById(output).src = $url;
    }
</script>
@endpush