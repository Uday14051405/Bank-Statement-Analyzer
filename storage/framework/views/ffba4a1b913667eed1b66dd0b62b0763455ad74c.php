<?php $__env->startSection('page_title'); ?>
<?php echo e(__('deal.index.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    .table tr td {
        vertical-align: middle;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="page-header">
    <div class="card breadcrumb-card">
        <div class="row justify-content-between align-content-between" style="height: 100%;">
            <div class="col-md-6">
                <h3 class="page-title"><?php echo e(__('deal.index.title')); ?></h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="<?php echo e(route('deal.index')); ?>"><?php echo e(__('deal.index.title')); ?></a>
                    </li>
                </ul>
            </div>
            <?php if(Gate::check('deal-create')): ?>
           
            <div class="col-md-6">
                <div class="create-btn pull-right">
                    <a href="<?php echo e(route('deal.create')); ?>" class="btn custom-create-btn"><?php echo e(__('default.form.deal-add-button')); ?></a>
                </div>

                <div class="create-btn pull-right">
                <button id="export-button" class="btn custom-create-btn">Export to Excel</button>
                </div>
            </div>
            <?php endif; ?>

            
        </div>
    </div><!-- /card finish -->
</div><!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            
                <form id="filter-form">
                    <div class="row mb-4">
                    <?php if(!Auth::user()->hasRole('Investor') && !Auth::user()->hasRole('Customer')): ?>
     <div class="col-md-4">
                            <label for="deal_status">Deal Status</label>
                            <select id="deal_status" name="deal_status" class="form-control">
    <option value="">All</option>
    <option value="Active" <?php echo e(request('status') == 'Active' ? 'selected' : ''); ?>>Active</option>
    <option value="Invested" <?php echo e(request('status') == 'Invested' ? 'selected' : ''); ?>>Invested</option>
    <option value="Expired" <?php echo e(request('status') == 'Expired' ? 'selected' : ''); ?>>Expired</option>
    <!-- Add other statuses as needed -->
</select>

                        </div>
<?php endif; ?>

                       
                        <div class="col-md-3">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button type="button" id="filter-button" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
               
                <table class="table table-hover table-center mb-0" id="table">
                    <thead>
                        <tr>
                            <th class=""><?php echo e(__('default.table.sl')); ?></th>
                            <th class=""><?php echo e(__('default.table.deal_number')); ?></th>
                            <th class=""><?php echo e(__('default.table.main_status')); ?></th>
                            <?php if(Auth::user()->hasRole('Investor')): ?>
                                <th class=""><?php echo e(__('default.table.deal-view_deal')); ?></th>
                            <?php else: ?>
                            <th class=""><?php echo e(__('default.table.deal-view_deal_view')); ?></th>
                            <?php endif; ?>
                            <th class=""><?php echo e(__('default.table.invoice')); ?></th>
                            <th class="">Invoice Number</th>
                           
                          
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(function() {
        var table = $('#table').DataTable({
            processing: false,
            responsive: false,
            serverSide: true,
            order: [
                [0, 'desc']
            ],
            ajax: {
                url: '<?php echo e(route('deal.index')); ?>',
                data: function(d) {
                    d.deal_status = $('#deal_status').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'deal_number', name: 'deal_number' },
                { data: 'deal_buffer_days_val.main_status', name: 'deal_buffer_days_val.main_status' },
                { data: 'view_deal', name: 'view_deal' },
                { data: 'upload_invoice_path', name: 'upload_invoice_path' },
                { data: 'invoice_number', name: 'invoice_number' },
                
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
               
            
                <?php if(Gate::check('deal-edit') || Gate::check('deal-delete')): ?>
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                <?php endif; ?>
            ],
        });

        $('#filter-button').click(function() {
            table.draw();
        });
    });
</script>
<script type="text/javascript">
        $("body").on("click", ".remove-user", function() {
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
            }, function(result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='POST' action='" + action + "'></form>");
                    $('body').find('.remove-form').append( '<input name="_method" type="hidden" value="post">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    </script>
<script>
    document.getElementById('export-button').addEventListener('click', function() {
        var dealStatus = document.getElementById('deal_status').value;
        var fromDate = document.getElementById('from_date').value;
        var toDate = document.getElementById('to_date').value;

        var exportUrl = '<?php echo e(route("deal.export")); ?>' + '?deal_status=' + dealStatus + '&from_date=' + fromDate + '&to_date=' + toDate;
        window.location.href = exportUrl;
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\deal\index.blade.php ENDPATH**/ ?>