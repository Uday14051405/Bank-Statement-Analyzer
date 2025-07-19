@extends('admin.layouts.master')

@section('page_title')
{{ __('customer.index.title') }}
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
                <h3 class="page-title">Contact Us Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="{{ route('deal.index') }}">Contact Us Details</a>
                    </li>
                </ul>
            </div>
            @if (Gate::check('deal-create'))
           
            <div class="col-md-6">
                <div class="create-btn pull-right">
                    <a href="{{ route('deal.create') }}" class="btn custom-create-btn">{{ __('default.form.deal-add-button') }}</a>
                </div>

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
            
                <form id="filter-form">
                    <div class="row mb-4">
                   
                    <div class="col-md-3">
            <input type="text" id="filter-mobile" class="form-control" placeholder="Filter by Mobile Number">
        </div>
        <div class="col-md-3">
            <input type="text" id="filter-email" class="form-control" placeholder="Filter by Email">
        </div>
        <div class="col-md-2">
            <input type="date" id="filter-from-date" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-2">
            <input type="date" id="filter-to-date" class="form-control" placeholder="To Date">
        </div>


                       
                       
                        <div class="col-md-2">
                            
                            <button type="button" id="filter-button" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
               
                <table class="table table-hover table-center mb-0" id="table">
                    <thead>
                    <tr>
                    <th>ID</th>
                <th>Business Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Bank Statements Count</th>
                <th>Message</th>
                <th>User</th>
                <th>Created At</th>
                <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
                url: '{{ route('customer.contact_us') }}',
                data: function(d) {
                    d.mobile_number = $('#filter-mobile').val();
                    d.email = $('#filter-email').val();
                    d.from_date = $('#filter-from-date').val();
                    d.to_date = $('#filter-to-date').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'business_name', name: 'business_name' },
                { data: 'contact_number', name: 'contact_number' },
                { data: 'email', name: 'email' },
                { data: 'bank_statements_count', name: 'bank_statements_count' },
                { data: 'message', name: 'message' },
                { data: 'user', name: 'user' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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

        var exportUrl = '{{ route("deal.export") }}' + '?deal_status=' + dealStatus + '&from_date=' + fromDate + '&to_date=' + toDate;
        window.location.href = exportUrl;
    });
</script>

@endpush
