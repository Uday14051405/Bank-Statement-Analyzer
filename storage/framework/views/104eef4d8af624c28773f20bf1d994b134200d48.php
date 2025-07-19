<?php $__env->startSection('page_title'); ?>
<?php echo e(__('deal.index.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    .table tr td {
        vertical-align: middle;
    }
</style>
<!-- Modal Styles -->
<style>
.modal {
    position: fixed;
    z-index: 1040;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    border-radius: 8px;
    text-align: center;
    position: relative;
}

.close-button {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 10px;
}

.close-button:hover,
.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

button {
    margin: 5px;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#confirmButton {
    background-color: #4CAF50;
    color: white;
}

#cancelButton {
    background-color: #f44336;
    color: white;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="page-header">
    <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
            <div class="col-md-6">
                <h3 class="page-title"><?php echo e(__('deal.my_investment.title')); ?></h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="<?php echo e(route('deal.index_invested')); ?>"><?php echo e(__('deal.my_investment.title')); ?></a>
                    </li>
                </ul>
            </div>
            <?php if(Gate::check('deal-create')): ?>
            <div class="col-md-3">
                <div class="create-btn pull-right">
                    <a href="<?php echo e(route('deal.create')); ?>" class="btn custom-create-btn"><?php echo e(__('default.form.deal-add-button')); ?></a>
                </div>
            <?php endif; ?>
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
                            <th class=""><?php echo e(__('default.table.sl')); ?></th>
                            <th class=""><?php echo e(__('default.table.deal_number')); ?></th>

                            <th class="">View Investment</th>
                            <th class=""><?php echo e(__('default.table.invoice')); ?></th>
                            <th class="">Select Bank for Repayment</th>
                            <th class="">Invoice Number</th>
                            <th class=""><?php echo e(__('default.table.payment_date')); ?></th>
                           
                            <?php if(Auth::user()->hasRole('Investor')): ?>
                              
                            <?php else: ?>
                            <th class=""><?php echo e(__('default.table.raised_by')); ?></th>
                            <?php endif; ?>


                            <th class="">Anchor Name</th>
                            <th class=""><?php echo e(__('default.table.invoice_amount')); ?></th>
                            <th class=""><?php echo e(__('default.table.invoice_date')); ?></th>
                            <th class=""><?php echo e(__('default.table.deal_expiry_date')); ?></th>
                            <th class=""><?php echo e(__('default.table.investment_period')); ?></th>
                            <th class=""><?php echo e(__('default.table.deal_maturity_date')); ?></th>
                            <th class=""><?php echo e(__('default.table.gross_yield')); ?></th>
                           
                            <th class="">Investor Name</th>
                            <th class=""><?php echo e(__('default.table.main_status')); ?></th>
                            <?php if(Gate::check('deal-edit') || Gate::check('deal-delete')): ?>
                            <th class=""><?php echo e(__('default.table.action')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Custom Modal HTML -->
<div id="customModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Confirmation</h2>
        <p>Please select a bank account carefully. Once chosen, it cannot be edited.</p>
        <button id="confirmButton">Confirm</button>
        <button id="cancelButton">Cancel</button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(function() {
        $('#table').DataTable({
            processing: false,
            responsive: false,
            serverSide: true,
            order: [
                [0, 'ASC']
            ],
            ajax: '<?php echo e(route('deal.index_invested')); ?>',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                { data: 'deal_number', name: 'deal_number' },
                {
                    data: 'view_deal',
                    name: 'view_deal'
                },
                {
                    data: 'upload_invoice_path',
                    name: 'upload_invoice_path'
                },
                { data: 'select_bank_name', name: 'select_bank_name', orderable: false, searchable: false },
                {
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                
                <?php if(Auth::user()->hasRole('Investor')): ?>
       
    <?php else: ?>
        { data: 'company_name', name: 'anchor_company_name' },
    <?php endif; ?>
    { data: 'anchor_company_name', name: 'anchor_company_name' },
    { data: 'invoice_value', name: 'invoice_value', render: function(data, type, row) {
                    return '₹ ' + data;
                }},
              
                { data: 'invoice_date', name: 'invoice_date' },
                { data: 'invoice_due_date', name: 'invoice_due_date' },
                { data: 'deal_period', name: 'deal_period' },
                { data: 'repayment_date', name: 'repayment_date' },
                { data: 'yield_returns', name: 'yield_returns', render: function(data, type, row) {
                    return data + ' %';
                }},
                { data: 'investor_name', name: 'investor_name' },
                {
                    data: 'deal_status',
                    name: 'deal_status'
                },
                <?php if(Gate::check('user-edit') || Gate::check('user-delete')): ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    <?php endif; ?>
            ],
        });
    });



	
</script>
<script>
$(document).ready(function() {
    var previousValue;

    $(document).on('focus', '.select-bank-name', function() {
        previousValue = $(this).val();
    });

    $(document).on('change', '.select-bank-name', function() {
        var dealId = $(this).data('id');
        var bankId = $(this).val();
        var selectElement = $(this);

        // Show custom modal
        $('#customModal').show();

        // Handle confirm button click
        $('#confirmButton').off('click').on('click', function() {
            $('#customModal').hide();
            $.ajax({
                url: '<?php echo e(route("deal.updatebank", ":id")); ?>'.replace(':id', dealId),
                type: 'POST',
                data: {
                    bank_id: bankId,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    alert('Bank updated successfully!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating bank:', error);
                    alert('Failed to update bank. Please try again.');
                }
            });
        });

        // Handle cancel button click
        $('#cancelButton, .close-button').off('click').on('click', function() {
            $('#customModal').hide();
            selectElement.val(previousValue);
        });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\deal\index_invested.blade.php ENDPATH**/ ?>