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
                            <th class=""><?php echo e(__('default.table.deal-view_deal')); ?></th>
                            <th class=""><?php echo e(__('default.table.invoice')); ?></th>
                           
                            <th class=""><?php echo e(__('default.table.raised_by')); ?></th>
                            <th class=""><?php echo e(__('default.table.gross_yield')); ?></th>
                            <th class=""><?php echo e(__('default.table.maturity_date')); ?></th>
                            <th class=""><?php echo e(__('default.table.invoice_amount')); ?></th>
                            <th class=""><?php echo e(__('default.table.deal_buffer_days_val')); ?></th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(function() {
        $('#table').DataTable({
            processing: true,
            responsive: false,
            serverSide: true,
            order: [
                [0, 'desc']
            ],
            ajax: '<?php echo e(route('deal.index')); ?>',
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
                    data: 'deal_buffer_days_val.main_status',
                    name: 'deal_buffer_days_val.main_status'
                },
                <?php if(Gate::check('user-edit') || Gate::check('user-delete')): ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    <?php endif; ?>
            ],
        });
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\admin\deal\index.blade.php ENDPATH**/ ?>