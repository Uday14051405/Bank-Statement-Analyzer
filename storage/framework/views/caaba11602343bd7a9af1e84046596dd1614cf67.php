<?php $__env->startSection('page_title'); ?>
Deal Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                        <a href="<?php echo e(route('deal.index_invested')); ?>">My Investment</a>
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
                                <td><?php echo e($deal->customer->name ?? 'N/A'); ?></td>
                            </tr> -->
                            <!-- <tr>
                                <th>Anchor</th>
                                <td><?php echo e($deal->select_anchor); ?></td>
                            </tr> -->
                            <tr>
                                <th>Deal Name</th>
                                <td><?php echo e($deal->deal_name); ?></td>
                            </tr>
                            <tr>
                                <th>Invoice Value</th>
                                <td><?php echo e($deal->invoice_value); ?></td>
                            </tr>
                            <tr>
                                <th>Invoice Date</th>
                                <td><?php echo e($deal->invoice_date); ?></td>
                            </tr>
                            <tr>
                                <th>Deal Start Date</th>
                                <td><?php echo e($deal->deal_expiry_date); ?></td>
                            </tr>
                            <tr>
                                <th>Yield Returns</th>
                                <td><?php echo e($deal->yield_returns); ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Company Name</th>
                                <td><?php echo e($deal->customer->company_name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <th>Min Investment Amount</th>
                                <td><?php echo e($deal->min_investment_amount); ?></td>
                            </tr>
                            <tr>
                                <th>Invoice Due Date</th>
                                <td><?php echo e($deal->invoice_due_date); ?></td>
                            </tr>
                            <tr>
                                <th>Deal Due Date</th>
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


                </div>

                <?php if($deal->deal_status == 'Pending'): ?>
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <button id="invest-button" class="btn btn-primary">Invest</button>
                    </div>
                </div>
                <?php endif; ?>
                <center><h3>Payment Transaction Details</h3></center>

                <a href="<?php echo e(route('export.payments')); ?>" class="btn btn-primary">Export Payments</a>
                <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Payment ID</th>
                <!-- <th>Razorpay Signature</th> -->
                <!-- <th>Name</th> -->
                <th>Entity</th>
                <th>Amount</th>
                <!-- <th>Amount in Paisa</th> -->
                <!-- <th>Currency</th> -->
                <th>Status</th>
                <th>Order ID</th>
                <!-- <th>Invoice ID</th>
                <th>International</th> -->
                <th>Method</th>
                <th>Amount Refunded</th>
                <th>Refund Status</th>
                <!-- <th>Captured</th> -->
                <th>Description</th>
                <th>Card ID</th>
                <th>Bank</th>
                <th>Wallet</th>
                <th>VPA</th>
                <th>Email</th>
                <th>Contact</th>
                <!-- <th>Fee</th>
                <th>Tax</th> -->
                <th>Error Code</th>
                <th>Error Description</th>
                <th>Error Source</th>
                <th>Error Step</th>
                <th>Error Reason</th>
                <th>RRN</th>
                <th>UPI Transaction ID</th>
                <th>Bank Transaction ID</th>
                <th>UPI VPA</th>
                <th>Renew Status</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Customer Company Name</th>
                <th>Customer Account Holder Name</th>
                <th>Customer Bank Name</th>
                <th>Customer Account Number</th>
                <th>Customer IFSC Code</th>
                <th>Investor ID</th>
                <th>Investor Name</th>
                <th>Investor Mobile</th>
                <th>Investor Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $deal->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($payment->id); ?></td>
                <td><?php echo e($payment->payments_id); ?></td>
                <!-- <td><?php echo e($payment->razorpay_signature); ?></td> -->
                <!-- <td><?php echo e($payment->name); ?></td> -->
                <td><?php echo e($payment->entity); ?></td>
                <td><?php echo e($payment->amount); ?></td>
                <!-- <td><?php echo e($payment->amount_in_paisa); ?></td> -->
                <!-- <td><?php echo e($payment->currency); ?></td> -->
                <td><?php echo e($payment->status); ?></td>
                <td><?php echo e($payment->order_id); ?></td>
                <!-- <td><?php echo e($payment->invoice_id); ?></td>
                <td><?php echo e($payment->international); ?></td> -->
                <td><?php echo e($payment->method); ?></td>
                <td><?php echo e($payment->amount_refunded); ?></td>
                <td><?php echo e($payment->refund_status); ?></td>
                <!-- <td><?php echo e($payment->captured); ?></td> -->
                <td><?php echo e($payment->description); ?></td>
                <td><?php echo e($payment->card_id); ?></td>
                <td><?php echo e($payment->bank); ?></td>
                <td><?php echo e($payment->wallet); ?></td>
                <td><?php echo e($payment->vpa); ?></td>
                <td><?php echo e($payment->email); ?></td>
                <td><?php echo e($payment->contact); ?></td>
                <!-- <td><?php echo e($payment->fee); ?></td>
                <td><?php echo e($payment->tax); ?></td> -->
                <td><?php echo e($payment->error_code); ?></td>
                <td><?php echo e($payment->error_description); ?></td>
                <td><?php echo e($payment->error_source); ?></td>
                <td><?php echo e($payment->error_step); ?></td>
                <td><?php echo e($payment->error_reason); ?></td>
                <td><?php echo e($payment->rrn); ?></td>
                <td><?php echo e($payment->upi_transaction_id); ?></td>
                <td><?php echo e($payment->bank_transaction_id); ?></td>
                <td><?php echo e($payment->upi_vpa); ?></td>
                <td><?php echo e($payment->renew_status); ?></td>
                <td><?php echo e($payment->customer_id); ?></td>
                <td><?php echo e($payment->cust_name); ?></td>
                <td><?php echo e($payment->cust_mobile); ?></td>
                <td><?php echo e($payment->cust_company_name); ?></td>
                <td><?php echo e($payment->cust_account_holder_name); ?></td>
                <td><?php echo e($payment->cust_bank_name); ?></td>
                <td><?php echo e($payment->cust_account_number); ?></td>
                <td><?php echo e($payment->cust_ifsc_code); ?></td>
                <td><?php echo e($payment->investor_id); ?></td>
                <td><?php echo e($payment->investor_name); ?></td>
                <td><?php echo e($payment->investor_mobile); ?></td>
               
                
                <td><?php echo e($payment->investor_email); ?></td>
                <td><?php echo e($payment->created_at); ?></td>
                <td><?php echo e($payment->updated_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var payment_id = '';
    document.getElementById('invest-button').addEventListener('click', function() {
        fetch('<?php echo e(route('invest.create-order')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        amount: <?php echo e($deal->min_investment_amount); ?>,
                        deal_id: <?php echo e($deal->id); ?>,
                        invoice_value: <?php echo e($deal->invoice_value); ?>,
                        min_investment_amount: <?php echo e($deal->min_investment_amount); ?>,
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
                        //window.location.href = '<?php echo e(route('invest.payment-success')); ?>';


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
                                    alert(data.message);
                                   // window.location.href = "<?php echo e(route('deal.index')); ?>";
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\admin\reports\view_mis_details.blade.php ENDPATH**/ ?>