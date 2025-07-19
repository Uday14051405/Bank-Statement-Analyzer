@extends('admin.layouts.master')

@section('page_title')
    {{ __('investor.index.title') }}
@endsection

@push('css')
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
    
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{__('investor.index.title')}}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="{{ route('users.index') }}">{{ __('investor.index.title') }}</a>
                        </li>
                    </ul>
                </div>
                @if (Gate::check('user-create'))
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button id="export-button" class="btn custom-create-btn">Export to Excel</button>
                        </div>                 
                    </div>
                @endif
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
                                <th class="">{{ __('default.table.sl') }}</th>
                                <th class="">{{ __('default.table.image') }}</th>
                                <th class="">{{ __('default.table.name') }}</th>
                                <th class="">{{ __('default.table.email') }}</th>
                                <th class="">{{ __('default.table.mobile') }}</th>
                                <th class="">{{ __('default.table.pan_number') }}</th>
                                <th class="">{{ __('default.table.status') }}</th>
                                @if (Gate::check('investor-edit') || Gate::check('investor-delete'))
                                    <th class="">{{ __('default.table.action') }}</th>
                                @endif
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel">Investor Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Name</th>
                <td id="userName"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td id="userEmail"></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td id="userMobile"></td>
            </tr>
            <tr>
                <th>PAN Number</th>
                <td id="pan_number"></td>
            </tr>
            <tr>
                <th>PAN Name</th>
                <td id="pan_name"></td>
            </tr>
            <tr class="hidden" hidden>
                <th>Account Holder Name</th>
                <td id="account_holder_name"></td>
            </tr>
            <tr class="hidden" hidden>
                <th>Account Number</th>
                <td id="account_number"></td>
            </tr>
            <tr class="hidden" hidden>
                <th>IFSC Code</th>
                <td id="ifsc_code"></td>
            </tr>
            <tr>
                <th>Image</th>
                <td id="image"> <img id="userImage" src="" alt="User Image" style="max-width: 100px;"></td>
            </tr>
            <tr class="hidden" hidden>
                <th>Cheque / Passbook Upload</th>
                <td id="image"> <a id="cheque_pass" href="" target="_blank" alt="Cheque / Passbook Upload" >View</a></td>
            </tr>
            <tr>
                <th>Role</th>
                <td id="userRole"></td>
            </tr>
            <tr>
                <th>Status</th>
                <td id="userStatus"></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td id="userCreatedAt"></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td id="userUpdatedAt"></td>
            </tr>
        </tbody>
    </table>

    <h5>Card Details</h5>
<table class="table table-bordered" id="bankDetailsTable">
    <thead>
        <tr>
            <th>Credit Card No</th>
            <th>Credit Card Bank</th>
            <th>Account Holder Name</th>
            <th>Bank Name</th>
            <th>IFSC Code</th>
            <th>Account Number</th>
            <th>Nick Name</th>
            <th>Cheque / Passbook</th>
        </tr>
    </thead>
    <tbody>
        <!-- Bank details will be dynamically inserted here -->
    </tbody>
</table>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var storageBaseUrl = '{{ asset("storage/") }}';
        $(function() {
            $('#table').DataTable({
                processing: false,
                responsive: false,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: '{{ route('investor.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {  data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'pan_number', name: 'pan_number' },
                    { data: 'status', name: 'status' },
                    @if (Gate::check('investor-edit') || Gate::check('investor-delete'))
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    @endif
                ],
            });

            // View user details
            $(document).on('click', '.view-user-btn', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '{{ route("investor.show", ":id") }}'.replace(':id', userId),
                    type: 'GET',
                    success: function(data) {
                        $('#userName').text(data.user.name);
                        $('#userEmail').text(data.user.email);
                        $('#userMobile').text(data.user.mobile);
                        $('#pan_number').text(data.user.pan_number);
                        $('#pan_name').text(data.user.pan_name);
                        $('#account_holder_name').text(data.user.account_holder_name);
                        $('#account_number').text(data.user.account_number);
                        $('#ifsc_code').text(data.user.ifsc_code);
                        $('#userRole').text(data.user.role);
                        $('#userStatus').text(data.user.status ? 'Active' : 'Inactive');
                        $('#userCreatedAt').text(data.user.created_at);
                        $('#userImage').attr('src', data.user.image);
                        $('#cheque_pass').attr('href', data.user.cheque_pass);
                        $('#userUpdatedAt').text(data.user.updated_at);
                        $('#userDetailsModal').modal('show');

                        $('#bankDetailsTable tbody').empty();

            // Update bank details
            $.each(data.bankDetails, function(index, detail) {
                var bankRow = '<tr>' +
                    '<td>' + detail.credit_card_no + '</td>' +
                    '<td>' + detail.credit_bank_name + '</td>' +
                    '<td>' + detail.account_holder_name + '</td>' +
                    '<td>' + detail.bank_name + '</td>' +
                    '<td>' + detail.ifsc_code + '</td>' +
                    '<td>' + detail.account_number + '</td>' +
                    '<td>' + detail.nick_name + '</td>' +
                    '<td>';
                    if (detail.cheque_passbook) {
    bankRow += '<a href="' + storageBaseUrl +"/"+ detail.cheque_passbook + '" target="_blank">View</a>';
} else {
    bankRow += 'N/A'; // Display 'N/A' or another placeholder if no link is available
}
                bankRow += '</td></tr>';

                $('#bankDetailsTable tbody').append(bankRow);
            });
                    },
                    error: function() {
                        alert('Failed to fetch user details.');
                    }
                });
            });
        });

        // Export functionality
        document.getElementById('export-button').addEventListener('click', function() {
            var dealStatusElement = document.getElementById('deal_status');
            var fromDateElement = document.getElementById('from_date');
            var toDateElement = document.getElementById('to_date');

            var dealStatus = dealStatusElement ? dealStatusElement.value : '';
            var fromDate = fromDateElement ? fromDateElement.value : '';
            var toDate = toDateElement ? toDateElement.value : '';

            var exportUrl = '{{ route("investor.export") }}' + '?deal_status=' + dealStatus + '&from_date=' + fromDate + '&to_date=' + toDate;
            window.location.href = exportUrl;
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
                url: `{{ route('users.status_update') }}`,
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

    
@endpush
