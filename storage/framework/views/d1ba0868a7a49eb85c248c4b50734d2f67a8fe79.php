<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('anchor.index.title')); ?>

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
					<h3 class="page-title"><?php echo e(__('anchor.index.title')); ?></h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('anchor.index.title')); ?></a>
						</li>
					</ul>
				</div>
                <?php if(Gate::check('anchor-create')): ?>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <a href="<?php echo e(route('anchor.create')); ?>" class="btn custom-create-btn"><?php echo e(__('default.form.anchor-add-button')); ?></a>
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
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class=""><?php echo e(__('default.table.sl')); ?></th>
                                <th class=""><?php echo e(__('default.table.image')); ?></th>
                                <th class=""><?php echo e(__('default.table.name')); ?></th>
                                <th class=""><?php echo e(__('default.table.email')); ?></th>
                                <th class=""><?php echo e(__('default.table.mobile')); ?></th>
                                <th class=""><?php echo e(__('default.table.role')); ?></th>
                                <th class=""><?php echo e(__('default.table.status')); ?></th>

                                <?php if(Gate::check('user-edit') || Gate::check('user-delete')): ?>
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
                ajax: '<?php echo e(route('anchor.index')); ?>',
                columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {  data: 'image', name: 'image' },
                    {  data: 'name', name: 'name' },
                    {  data: 'email', name: 'email' },
                    {  data: 'mobile',  name: 'mobile' },
                    { data: 'role',  name: 'role' },
                    { data: 'status',  name: 'status'  },

                    <?php if(Gate::check('user-edit') || Gate::check('user-delete')): ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    <?php endif; ?>
                ],
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


    <script type="text/javascript">
        function changeUserStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `<?php echo e(route('users.status_update')); ?>`,
                type: 'GET',
                data: {
                    _token: _token,
                    id: id,
                    status: status
                },
                success: function(result) {
					if(status == 1){
                    	toastr.success(result.message);
                	}else{
                    	toastr.error(result.message);
                	} 
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\admin\anchor\index.blade.php ENDPATH**/ ?>