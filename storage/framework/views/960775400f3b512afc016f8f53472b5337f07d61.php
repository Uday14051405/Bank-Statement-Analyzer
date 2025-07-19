<?php $__env->startSection('page_title'); ?>
Deal Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
     input[type="checkbox"] {
        padding: 0 !important; /* Remove padding for checkbox */
        width: 100px !important; /* Adjust width for checkbox */
        margin-right: 10px !important; /* Add margin to separate from label */
    }
    .terms {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    </style>
<div class="page-header">
    <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
            <div class="col-md-6">
                <h3 class="page-title">Deal Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('deal.index')); ?>">Deals</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">Deal Details</li>
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
                                <td><?php echo e($deal->customer->name ?? 'N/A'); ?></td>
                            </tr> -->
                            <!-- <tr>
                                <th>Anchor</th>
                                <td><?php echo e($deal->select_anchor); ?></td>
                            </tr> -->
                            <!-- <tr>
                                <th>Deal Name</th>
                                <td><?php echo e($deal->deal_name); ?></td>
                            </tr> -->
                            <tr >
                            <th>Deal Number</th>
                                <td><?php echo e($deal->deal_number); ?> </td>
                            </tr>
                            <tr>
                                <th>Anchor Name</th>
                                <td><?php echo e($deal->anchor->company_name ?? 'N/A'); ?></td>
                            </tr>
                           
                           
                            <tr>
                                <th>Deal Date</th>
                                <td><?php echo e($deal->invoice_date); ?></td>
                            </tr>
                            <!-- <tr>
                                <th>Deal Start Date</th>
                                <td><?php echo e($deal->deal_expiry_date); ?></td>
                            </tr> -->
                            <tr>
                                <th>Yield Returns</th>
                                <td><?php echo e($deal->yield_returns); ?> %</td>
                            </tr>
                            <tr>
                                <th>Deal Status</th>
                                <td><?php echo e($deal->deal_status); ?> </td>
                            </tr>
                            <tr>
                                <th>Investment Period(In Days)</th>
                                <td><?php echo e($deal->deal_period ?? ''); ?> </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('default.form.maturity_amount')); ?></th>
                                <td><?php echo e(__('default.table.currency_symbol')); ?> <?php echo e($deal->maturityAmountDeal ?? ''); ?> </td>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <td>
                                    <?php if($deal->upload_invoice): ?>
                                    <a href="<?php echo e(asset('storage/' . $deal->upload_invoice)); ?>" target="_blank">View</a>
                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                        <tr >
                                <th>Invoice Number</th>
                                <td><?php echo e($deal->invoice_number); ?> </td>
                            </tr>
                            <tr>
                                <th>Deal Value</th>
                                <td><?php echo e(__('default.table.currency_symbol')); ?> <?php echo e($deal->invoice_value); ?></td>
                            </tr>
                           
                            <!-- <tr>
                                <th>Min Investment Amount</th>
                                <td><?php echo e($deal->min_investment_amount); ?></td>
                            </tr> -->
                            <!-- <tr>
                                <th>Invoice Due Date</th>
                                <td><?php echo e($deal->invoice_due_date); ?></td>
                            </tr> -->
                            <tr>
                                <th>Deal Expiry Date</th>
                                <td><?php echo e($deal->deal_due_date); ?></td>
                            </tr>
                            <!-- <tr>
                                <th>Deal Buffer Days</th>
                                <td><?php echo e($deal->deal_buffer_days); ?></td>
                            </tr> -->

                            <!-- <tr>
                                <th>Rumbble Score</th>
                                <td><?php echo e($deal->rumbble_score); ?></td>
                            </tr> -->
                            <!-- <tr>
                                <th>Assign CRM</th>
                                <td><?php echo e($deal->assign_crm); ?></td>
                            </tr> -->
                           
                            <tr>
                                <th>Invested Date</th>
                                <td>
                                    <?php if($deal->formatted_payment_date): ?>
                                    <?php echo e($deal->formatted_payment_date); ?>

                                    <?php else: ?>
                                    
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr >
                                <th>Investor Name</th>
                                <td><?php echo e($deal->investor->name ?? ''); ?> </td>
                            </tr>
                            <tr >
                                <th>Repayment Date</th>
                                <td><?php echo e($deal->formatted_repayment_date); ?> </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('default.form.repayment_amount')); ?></th>
                                <td><?php echo e(__('default.table.currency_symbol')); ?> <?php echo e($deal->repaymentAmountDeal ?? ''); ?> </td>
                            </tr>
                        </table>
                    </div>


                </div>
                
                <?php if(Auth::user()->hasRole('Investor') && $deal->deal_status == 'Pending'): ?>
                <div class="row mt-4">
    <div class="col-md-12 text-center">
    <div class="terms">
                    <input type="checkbox" name="terms" id="terms" />
                    <label for="terms">I accept the <a href="<?php echo e(route('invest.generate-agreement', ['id' => $deal->id])); ?>" target="_blank">terms and conditions</a></label>
                    <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php if($deal->bank_status == 'true'): ?>
        <button id="invest-button" class="btn btn-primary"  style="cursor: not-allowed" >Invest</button>
        <div id="loader" style="display:none;">Loading...</div>
        <?php else: ?>
        <p style="color:red;"><?php echo e($deal->bankStatusMessage); ?></p>
        <?php endif; ?>
    </div>
</div>
                <?php endif; ?>




                <?php if($deal->deal_status == 'Invested'): ?>
                <center>
                    <h3>Payment Transaction Details</h3>
                </center>
                <!-- <a href="<?php echo e(url('export-payments/' . $deal->id)); ?>" class="btn btn-primary">Export Payments</a> -->

                <!-- <a href="<?php echo e(route('export.payments')); ?>" class="btn btn-primary">Export Payments</a> -->
                <!-- <a href="<?php echo e(route('export.payments', ['id' => $deal->id])); ?>" class="btn btn-primary">Export Payments</a> -->

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
                            <?php $__currentLoopData = $deal->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              
                            <td><?php echo e($payment->payments_id); ?></td>
                                <td><?php echo e($payment->razorpay_signature ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->name ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->entity); ?></td>
                                <td><?php echo e($payment->amount); ?></td>
                                <td><?php echo e($payment->amount_in_paisa ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->currency); ?></td>
                                <td><?php echo e($payment->status); ?></td>
                                <td><?php echo e($payment->order_id); ?></td>
                                <td><?php echo e($payment->invoice_id); ?></td>
                                <td><?php echo e($payment->international ? 'Yes' : 'No'); ?></td>
                                <td><?php echo e($payment->method); ?></td>
                                <td><?php echo e($payment->amount_refunded); ?></td>
                                <td><?php echo e($payment->refund_status ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->captured ? 'Yes' : 'No'); ?></td>
                                <td><?php echo e($payment->description); ?></td>
                                <td><?php echo e($payment->bank ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->wallet ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->email); ?></td>
                                <td><?php echo e($payment->contact); ?></td>
                                <td><?php echo e($payment->fee); ?></td>
                                <td><?php echo e($payment->tax); ?></td>
                                <td><?php echo e($payment->card_id ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_entity ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_name ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_last4 ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_network ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_type ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_issuer ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_sub_type ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->card_emi ? 'Yes' : 'No'); ?></td>
                                <td><?php echo e($payment->vpa ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->upi_payer_account_type ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->upi_flow ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->upi_transaction_id ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->acquirer_rrn ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->authentication_reference_number ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->bank_transaction_id ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->error_code ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->error_description ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->error_source ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->error_step ?? 'N/A'); ?></td>
                                <td><?php echo e($payment->error_reason ?? 'N/A'); ?></td>

                                <td><?php echo e($payment->repay_status ?? ''); ?></td>
                                <td><?php echo e($payment->repayment_made_on ?? ''); ?></td>
                                <td><?php echo e($payment->utr_reference_code ?? ''); ?></td>
                                <td><?php echo e($payment->repayment_interest_rate ?? ''); ?></td>
                                <td><?php echo e($payment->repayment_interest_amount ?? ''); ?></td>
                                <td><?php echo e($payment->total_repayment_amount ?? ''); ?></td>
                                <td><?php echo e($payment->actual_repaid_amount ?? ''); ?></td>
                              
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php endif; ?>






            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById("invest-button").disabled = true;
    document.getElementById("invest-button").style.cursor = "not-allowed";
</script>
<script>

document.addEventListener('DOMContentLoaded', function () {
        const termsCheckbox = document.getElementById('terms');
        const nextButton = document.getElementById('invest-button');

        termsCheckbox.addEventListener('change', function () {
            if (this.checked) {
                nextButton.disabled = false;
                nextButton.style.cursor = 'pointer';
            } else {
                nextButton.disabled = true;
                nextButton.style.cursor = 'not-allowed';
            }
        });
    });


    var payment_id = '';
    document.getElementById('invest-button').addEventListener('click', function() {
        var investButton = document.getElementById('invest-button');
        var loader = document.getElementById('loader');
        investButton.disabled = true;
        // Change button text to "Processing..."
        investButton.textContent = 'Processing...';
        
        // Show the loader
       //loader.style.display = 'block';
        fetch('<?php echo e(route('invest.create-order')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        amount: <?php echo e($deal->invoice_value); ?>,
                        deal_id: <?php echo e($deal->id); ?>,
                        invoice_value: <?php echo e($deal->invoice_value); ?>,
                        min_investment_amount: <?php echo e($deal->invoice_value); ?>,
                        _token: '<?php echo e(csrf_token()); ?>'
                    })
                })
            .then(response => response.json())
            .then(order => {
                payment_id = order.payment_id;
                var options = {
                    "key": "<?php echo e(env('RAZORPAY_KEY')); ?>",
                    "amount": order.amount * 100,
                    "currency": "INR",
                    "name": order.name,
                    "description": order.description,
                    "order_id": order.id,
            
                    "handler": function(response) {
                        alert('Payment successful');
                        
                        $.ajax({
                            url: "<?php echo e(route('invest.payment-handle')); ?>",
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                payment_id: payment_id,
                                status: 'captured',
                                deal_id: '<?php echo e($deal->id); ?>',
                                amount: '<?php echo e($deal->invoice_value * 100); ?>'
                            },
                            success: function(data) {
                                if (data.success) {
                                    window.location.reload();
                                    alert(data.message);
                                   // window.location.href = "<?php echo e(route('deal.index')); ?>";
                                } else {
                                    window.location.reload();
                                    investButton.disabled = false;
                                        // Change button text to "Processing..."
                                    investButton.textContent = 'Invest';
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
                    // Re-enable the invest button
                    investButton.disabled = false;
                    investButton.textContent = 'Invest';

                    // Handle modal close event here
                    alert('Razorpay modal closed');

                    // Reload the page
                    window.location.reload();
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
                                    url: "<?php echo e(route('invest.payment-handle')); ?>", // Your server-side script to handle the API call
                                    type: 'POST',
                                    data: {
                                        _token: '<?php echo e(csrf_token()); ?>',
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\deal\view_deal.blade.php ENDPATH**/ ?>