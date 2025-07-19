@extends('admin.layouts.master')

@section('page_title')
Deal Details
@endsection

@section('content')
<div class="page-header">
    <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
            <div class="col-md-6">
                <h3 class="page-title">Deal Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('deal.index_invested') }}">My Investment</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">Investment Details</li>
                </ul>
            </div>
        </div>
    </div><!-- /card finish -->
</div><!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <table class="table table-bordered">
                            <!-- <tr>
                                <th>Customer</th>
                                <td>{{ $deal->customer->name ?? 'N/A' }}</td>
                            </tr> -->
                            <!-- <tr>
                                <th>Anchor</th>
                                <td>{{ $deal->select_anchor }}</td>
                            </tr> -->
                            <!-- <tr>
                                <th>Deal Name</th>
                                <td>{{ $deal->deal_name }}</td>
                            </tr> -->
                            <tr >
                            <th>Deal Number</th>
                                <td>{{ $deal->deal_number }} </td>
                            </tr>
                            <tr>
                                <th>Anchor Name</th>
                                <td>{{ $deal->anchor->company_name ?? 'N/A' }}</td>
                            </tr>
                           
                           
                            <tr>
                                <th>Deal Date</th>
                                <td>{{ $deal->invoice_date }}</td>
                            </tr>
                            <!-- <tr>
                                <th>Deal Start Date</th>
                                <td>{{ $deal->deal_expiry_date }}</td>
                            </tr> -->
                            <tr>
                                <th>Yield Returns</th>
                                <td>{{ $deal->yield_returns }} %</td>
                            </tr>
                            <tr>
                                <th>Deal Status</th>
                                <td>{{ $deal->deal_status }} </td>
                            </tr>
                            <tr>
                                <th>Investment Period(In Days)</th>
                                <td>{{ $deal->deal_period ?? '' }} </td>
                            </tr>

                            <tr>
                                <th>{{ __('default.form.maturity_amount') }}</th>
                                <td>{{ __('default.table.currency_symbol') }} {{ $deal->yield_returns_amount ?? '' }} </td>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <td>
                                    @if($deal->upload_invoice)
                                    <a href="{{ asset('storage/' . $deal->upload_invoice) }}" target="_blank">View</a>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                        <tr >
                                <th>Invoice Number</th>
                                <td>{{ $deal->invoice_number }} </td>
                            </tr>
                            <tr>
                                <th>Deal Value</th>
                                <td>{{ __('default.table.currency_symbol') }} {{ $deal->invoice_value }}</td>
                            </tr>
                           
                            <!-- <tr>
                                <th>Min Investment Amount</th>
                                <td>{{ $deal->min_investment_amount }}</td>
                            </tr> -->
                            <!-- <tr>
                                <th>Invoice Due Date</th>
                                <td>{{ $deal->invoice_due_date }}</td>
                            </tr> -->
                            <tr>
                                <th>Deal Expiry Date</th>
                                <td>{{ $deal->deal_due_date }}</td>
                            </tr>
                            <!-- <tr>
                                <th>Deal Buffer Days</th>
                                <td>{{ $deal->deal_buffer_days }}</td>
                            </tr> -->

                            <!-- <tr>
                                <th>Rumbble Score</th>
                                <td>{{ $deal->rumbble_score }}</td>
                            </tr> -->
                            <!-- <tr>
                                <th>Assign CRM</th>
                                <td>{{ $deal->assign_crm }}</td>
                            </tr> -->
                           
                            <tr>
                                <th>Invested Date</th>
                                <td>
                                    @if($deal->formatted_payment_date)
                                    {{ $deal->formatted_payment_date }}
                                    @else
                                    
                                    @endif
                                </td>
                            </tr>
                            <tr >
                                <th>Investor Name</th>
                                <td>{{ $deal->investor->name ?? '' }} </td>
                            </tr>
                            <tr >
                                <th>Repayment Date</th>
                                <td>{{ $deal->formatted_repayment_date }} </td>
                            </tr>
                            <tr>
                                <th>{{ __('default.form.repayment_amount') }}</th>
                                <td>{{ __('default.table.currency_symbol') }} {{ $deal->maturity_amount_roundup ?? '' }} </td>
                            </tr>
                        </table>
                    </div>


                </div>

                @if($deal->deal_status == 'Pending')
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <button id="invest-button" class="btn btn-primary">Invest</button>
                    </div>
                </div>
                @endif
                <center>
                    <h3>Payment Transaction Details</h3>
                </center>
                <!-- <a href="{{ url('export-payments/' . $deal->id) }}" class="btn btn-primary">Export Payments</a> -->

                <!-- <a href="{{ route('export.payments') }}" class="btn btn-primary">Export Payments</a> -->
                <!-- <a href="{{ route('export.payments', ['id' => $deal->id]) }}" class="btn btn-primary">Export Payments</a> -->

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                         
                            <tr>
                               
                            <th>Payment ID</th>
                                <th>Razorpay Signature</th>
                                <th>Name</th>
                                <th>Entity</th>
                                <th>Amount</th>
                                <th>Amount in Paisa</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Order ID</th>
                                <th>Invoice ID</th>
                                <th>International</th>
                                <th>Method</th>
                                <th>Amount Refunded</th>
                                <th>Refund Status</th>
                                <th>Captured</th>
                                <th>Description</th>
                                <th>Bank</th>
                                <th>Wallet</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Fee</th>
                                <th>Tax</th>
                                <th>Card ID</th>
                                <th>Card Entity</th>
                                <th>Card Name</th>
                                <th>Card Last4</th>
                                <th>Card Network</th>
                                <th>Card Type</th>
                                <th>Card Issuer</th>
                                <th>Card Sub Type</th>
                                <th>Card EMI</th>
                                <th>VPA</th>
                                <th>UPI Payer Account Type</th>
                                <th>UPI Flow</th>
                                <th>UPI Transaction ID</th>
                                <th>Acquirer RRN</th>
                                <th>Authentication Reference Number</th>
                                <th>Bank Transaction ID</th>
                                <th>Error Code</th>
                                <th>Error Description</th>
                                <th>Error Source</th>
                                <th>Error Step</th>
                                <th>Error Reason</th>
                                
                               
                                <th>Repay Status</th>
                                <th>Re-payment Made on Date</th>
                                <th>Transaction UTR Reference Code</th>
                                <th>Re-payment Interest Rate</th>
                                <th>Re-payment Interest Amount</th>
                                <th>Total Re-payment Amount to be paid</th>
                                <th>Actual Repaid Amount</th>
                              
                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($deal->payments as $payment)
                            <tr>
                              
                            <td>{{ $payment->payments_id }}</td>
                                <td>{{ $payment->razorpay_signature ?? 'N/A' }}</td>
                                <td>{{ $payment->name ?? 'N/A' }}</td>
                                <td>{{ $payment->entity }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->amount_in_paisa ?? 'N/A' }}</td>
                                <td>{{ $payment->currency }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ $payment->order_id }}</td>
                                <td>{{ $payment->invoice_id }}</td>
                                <td>{{ $payment->international ? 'Yes' : 'No' }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>{{ $payment->amount_refunded }}</td>
                                <td>{{ $payment->refund_status ?? 'N/A' }}</td>
                                <td>{{ $payment->captured ? 'Yes' : 'No' }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>{{ $payment->bank ?? 'N/A' }}</td>
                                <td>{{ $payment->wallet ?? 'N/A' }}</td>
                                <td>{{ $payment->email }}</td>
                                <td>{{ $payment->contact }}</td>
                                <td>{{ $payment->fee }}</td>
                                <td>{{ $payment->tax }}</td>
                                <td>{{ $payment->card_id ?? 'N/A' }}</td>
                                <td>{{ $payment->card_entity ?? 'N/A' }}</td>
                                <td>{{ $payment->card_name ?? 'N/A' }}</td>
                                <td>{{ $payment->card_last4 ?? 'N/A' }}</td>
                                <td>{{ $payment->card_network ?? 'N/A' }}</td>
                                <td>{{ $payment->card_type ?? 'N/A' }}</td>
                                <td>{{ $payment->card_issuer ?? 'N/A' }}</td>
                                <td>{{ $payment->card_sub_type ?? 'N/A' }}</td>
                                <td>{{ $payment->card_emi ? 'Yes' : 'No' }}</td>
                                <td>{{ $payment->vpa ?? 'N/A' }}</td>
                                <td>{{ $payment->upi_payer_account_type ?? 'N/A' }}</td>
                                <td>{{ $payment->upi_flow ?? 'N/A' }}</td>
                                <td>{{ $payment->upi_transaction_id ?? 'N/A' }}</td>
                                <td>{{ $payment->acquirer_rrn ?? 'N/A' }}</td>
                                <td>{{ $payment->authentication_reference_number ?? 'N/A' }}</td>
                                <td>{{ $payment->bank_transaction_id ?? 'N/A' }}</td>
                                <td>{{ $payment->error_code ?? 'N/A' }}</td>
                                <td>{{ $payment->error_description ?? 'N/A' }}</td>
                                <td>{{ $payment->error_source ?? 'N/A' }}</td>
                                <td>{{ $payment->error_step ?? 'N/A' }}</td>
                                <td>{{ $payment->error_reason ?? 'N/A' }}</td>

                                <td>{{ $payment->repay_status ?? '' }}</td>
                                <td>{{ $payment->repayment_made_on ?? '' }}</td>
                                <td>{{ $payment->utr_reference_code ?? '' }}</td>
                                <td>{{ $payment->repayment_interest_rate ?? '' }}</td>
                                <td>{{ $payment->repayment_interest_amount ?? '' }}</td>
                                <td>{{ $payment->total_repayment_amount ?? '' }}</td>
                                <td>{{ $payment->actual_repaid_amount ?? '' }}</td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var payment_id = '';
    document.getElementById('invest-button').addEventListener('click', function() {
        fetch('{{ route('invest.create-order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        amount: {
                            {
                                $deal - > min_investment_amount
                            }
                        },
                        deal_id: {
                            {
                                $deal - > id
                            }
                        },
                        invoice_value: {
                            {
                                $deal - > invoice_value
                            }
                        },
                        min_investment_amount: {
                            {
                                $deal - > min_investment_amount
                            }
                        },
                        _token: '{{ csrf_token() }}'
                    })
                })
            .then(response => response.json())
            .then(order => {
                payment_id = order.payment_id;
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": order.amount * 100,
                    "currency": "INR",
                    "name": order.name,
                    "description": order.description,
                    "order_id": order.id,

                    "handler": function(response) {
                        alert('Payment successful');
                        //window.location.href = '{{ route('invest.payment-success') }}';


                        $.ajax({
                            url: "{{ route('invest.payment-handle') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                payment_id: payment_id,
                                status: 'captured',
                                deal_id: '{{ $deal->id }}',
                                amount: '{{ $deal->invoice_value * 100 }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert(data.message);
                                    // window.location.href = "{{ route('deal.index') }}";
                                } else {
                                    alert('Payment failed, please try again.');
                                }
                            }
                        });




                    },
                    "prefill": {
                        "name": order.prefill.name,
                        "email": order.prefill.email,
                        "contact": order.prefill.contact
                    },
                    "notes": {
                        "merchant_order_id": order.notes.merchant_order_id,
                        "deal_id": order.notes.deal_id,
                        "invoice_value": order.notes.invoice_value,
                        "min_investment_amount": order.notes.min_investment_amount
                    },
                    "theme": {
                        "color": "#F37254"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();


                rzp1.on('payment.modal.close', function(response) {
                    // Handle modal close event here
                    alert('Razorpay modal closed');
                });

                rzp1.on('payment.failed', function(response) {
                    // Extract relevant error details
                    var errorCode = response.error.code;
                    var errorDescription = response.error.description;
                    var errorSource = response.error.source;
                    var errorStep = response.error.step;
                    var errorReason = response.error.reason;
                    var orderId = response.error.metadata.order_id;
                    var paymentId = response.error.metadata.payment_id;

                    // Send data to server using AJAX
                    $.ajax({
                        url: "{{ route('invest.payment-handle') }}", // Your server-side script to handle the API call
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            errorCode: errorCode,
                            errorDescription: errorDescription,
                            errorSource: errorSource,
                            errorStep: errorStep,
                            errorReason: errorReason,
                            orderId: orderId,
                            registrationCreateId: registration_create_id,
                            email: email,
                            name: name,
                            real_number: real_number,
                            c_code: c_code,
                            plan_gst_main: plan_gst_main,
                            plan_total_main: plan_total_main,
                            plan_totalAmount_main: plan_price_main,
                            plan_price_og: plan_price_main,
                            paymentId: paymentId
                        },
                        success: function(response) {
                            var responseData = JSON.parse(response);
                            if (responseData.status == "success" && responseData.statusCode == 200) {
                                alert(responseData.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error saving payment failure details:', error);
                        }
                    });
                });





            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endpush