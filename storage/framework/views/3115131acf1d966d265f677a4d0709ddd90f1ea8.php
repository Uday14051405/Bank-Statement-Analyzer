<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('customer.index.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .table tr td {
            vertical-align: middle;
        }

        .modal-body .table th {
    width: 30%;
    background-color: #f8f9fa;
}

.modal-body .table td {
    width: 70%;
}
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title"><?php echo e(__('customer.index.title')); ?></h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('customer.index.title')); ?></a>
						</li>
					</ul>
				</div>
                <?php if(Gate::check('customer-create')): ?>
                    <div class="col-md-6">
                        <div class="create-btn pull-right">
                            <a href="<?php echo e(route('customer.create')); ?>" class="btn custom-create-btn"><?php echo e(__('default.form.customer-add-button')); ?></a>
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
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class=""><?php echo e(__('default.table.sl')); ?></th>
                                <!-- <th class=""><?php echo e(__('default.table.image')); ?></th> -->
                                <th class=""><?php echo e(__('default.table.name')); ?></th>
                                <!-- <th class=""><?php echo e(__('default.table.email')); ?></th> -->
                                <th class=""><?php echo e(__('default.table.mobile')); ?></th>
                                <!-- <th class=""><?php echo e(__('default.table.role')); ?></th>
                                <th class=""><?php echo e(__('default.table.status')); ?></th> -->

                                <?php if(Gate::check('customer-edit') || Gate::check('customer-delete')): ?>
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

     <!-- User Details Modal -->
     <div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    <table class="table table-bordered">
        <tbody>
        <!-- <tr>
                <th>Company Name</th>
                <td id="company_name"></td>
            </tr> -->
            <tr>
                <th>Name</th>
                <td id="userName"></td>
            </tr>
            <!-- <tr>
                <th>Email</th>
                <td id="userEmail"></td>
            </tr> -->
            <tr>
                <th>Mobile</th>
                <td id="userMobile"></td>
            </tr>
            <!-- <tr>
                <th>PAN Number</th>
                <td id="pan_number"></td>
            </tr>
            <tr>
                <th>GST Number</th>
                <td id="gst"></td>
            </tr>
            <tr>
                <th>Bank Name</th>
                <td id="bank_name"></td>
            </tr>
            <tr>
                <th>Account Number</th>
                <td id="account_number"></td>
            </tr>
            <tr>
                <th>IFSC Code</th>
                <td id="ifsc_code"></td>
            </tr>
            <tr>
                <th>Annual Turnover</th>
                <td id="annual_turnover"></td>
            </tr>
            <tr>
                <th>Other Comments</th>
                <td id="other_comments"></td>
            </tr>
            <tr>
                <th>Image</th>
                <td id="image"> <img id="userImage" src="" alt="User Image" style="max-width: 100px;"></td>
            </tr>
            <tr>
                <th>Role</th>
                <td id="userRole"></td>
            </tr>
            <tr>
                <th>Status</th>
                <td id="userStatus"></td>
            </tr> -->
            <tr>
                <th>Created At</th>
                <td id="userCreatedAt"></td>
            </tr>
            <!-- <tr>
                <th>Updated At</th>
                <td id="userUpdatedAt"></td>
            </tr> -->
        </tbody>
    </table>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
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
                    [0, 'desc']
                ],
                ajax: '<?php echo e(route('customer.index')); ?>',
                columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    // {  data: 'image', name: 'image' },
                    {  data: 'name', name: 'name' },
                    // {  data: 'email', name: 'email' },
                    {  data: 'mobile',  name: 'mobile' },
                    // { data: 'role',  name: 'role' },
                    // { data: 'status',  name: 'status'  },

                    <?php if(Gate::check('customer-edit') || Gate::check('customer-delete')): ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    <?php endif; ?>
                ],
            });

  // View user details
  $(document).on('click', '.view-user-btn1', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '<?php echo e(route("customer.show", ":id")); ?>'.replace(':id', userId),
                    type: 'GET',
                    success: function(data) {
                        //alert(data.user.name);
                        //$('#company_name').text(data.company_name);
                      
                        $('#userName').text(data.user.name);
                        $('#userMobile').text(data.user.mobile);
                      //  $('#userEmail').text(data.user.email);
                        // $('#userMobile').text(data.user.mobile);
                        // $('#pan_number').text(data.pan_number);
                        // $('#gst').text(data.gst);
                        // $('#bank_name').text(data.bank_name);
                        // $('#account_number').text(data.account_number);
                        // $('#ifsc_code').text(data.ifsc_code);
                        // $('#annual_turnover').text(data.annual_turnover);
                        // $('#other_comments').text(data.other_comments);
                        // $('#userRole').text(data.role);
                        // $('#userStatus').text(data.status ? 'Active' : 'Inactive');
                         $('#userCreatedAt').text(data.user.created_at);
                         $('#userUpdatedAt').text(data.user.updated_at);
                        // $('#userImage').attr('src', data.image);
                        $('#userDetailsModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to fetch user details.');
                    }
                });
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

    
<script>
    document.getElementById('export-button').addEventListener('click', function() {
        var dealStatusElement = document.getElementById('deal_status');
            var fromDateElement = document.getElementById('from_date');
            var toDateElement = document.getElementById('to_date');

            var dealStatus = dealStatusElement ? dealStatusElement.value : '';
            var fromDate = fromDateElement ? fromDateElement.value : '';
            var toDate = toDateElement ? toDateElement.value : '';


        var exportUrl = '<?php echo e(route("customer.export")); ?>' + '?deal_status=' + dealStatus + '&from_date=' + fromDate + '&to_date=' + toDate;
        window.location.href = exportUrl;
    });


</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\customer\index.blade.php ENDPATH**/ ?>