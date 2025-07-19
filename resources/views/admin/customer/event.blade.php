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
                <h3 class="page-title">Event Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="{{ route('deal.index') }}">Event Details</a>
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
                   
     <div class="col-md-4">
                            <label for="deal_status">Deal Status</label>
                            <select id="deal_status" name="deal_status" class="form-control">
    <option value="">All</option>
   
    <option value="OTP_NOT_VERIFIED" {{ request('deal_status') == 'OTP_NOT_VERIFIED' ? 'selected' : '' }}>OTP not verified</option>
    <option value="OTP_VERIFIED" {{ request('deal_status') == 'OTP_VERIFIED' ? 'selected' : '' }}>OTP verified</option>
    <option value="BANK_STATEMENT_UPLOADED" {{ request('deal_status') == 'BANK_STATEMENT_UPLOADED' ? 'selected' : '' }}>Bank statement uploaded</option>
    <option value="BANK_STATEMENT_SAVED" {{ request('deal_status') == 'BANK_STATEMENT_SAVED' ? 'selected' : '' }}>Bank statement saved</option>
    <option value="BANK_STATEMENT_ANALYSIS_RUN" {{ request('deal_status') == 'BANK_STATEMENT_ANALYSIS_RUN' ? 'selected' : '' }}>Run Bank Statement Analysis</option>
    <option value="BSA_REPORT_DOWNLOADED" {{ request('deal_status') == 'BSA_REPORT_DOWNLOADED' ? 'selected' : '' }}>Download BSA Report</option>
    <!-- <option value="CONTACT_US_SUBMITTED" {{ request('deal_status') == 'CONTACT_US_SUBMITTED' ? 'selected' : '' }}>Contact Us</option> -->
</select>


                        </div>


                       
                        <div class="col-md-2">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date">Mobile No</label>
                            <input type="number" id="mobile_number" name="mobile_number" class="form-control" value="{{ $mobile }}">
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
                        <th>ID</th>
            <th>Event Type</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <!-- <th>Location</th> -->
            <th>IP Address</th>
            <th>Event Time</th>
            <!-- <th>Event Time Update</th> -->
            <!-- <th>User ID</th> -->
            <th>Device Type</th>
            <th>Browser Details</th>
            <th>Interface</th>
            <!-- <th>Additional Data</th>
            <th>Created At</th> -->
            <!-- <th>Action</th> -->
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
                url: '{{ route('customer.event_list') }}',
                data: function(d) {
                    d.deal_status = $('#deal_status').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.mobile_number = $('#mobile_number').val();
                }
            },
            columns: [
                
                { data: 'id', name: 'id' },
            { data: 'event_type', name: 'event_type' },
            { data: 'name', name: 'name' },
            { data: 'mobile_number', name: 'mobile_number' },
            // { data: 'location', name: 'location' },
            { data: 'ip_address', name: 'ip_address' },
            { data: 'event_time', name: 'event_time' },
            // { data: 'event_time_update', name: 'event_time_update' },
            // { data: 'user_id', name: 'user_id' },
            { data: 'device_type', name: 'device_type' },
            { data: 'browser_details', name: 'browser_details' },
            { data: 'interface', name: 'interface' },
            // { data: 'additional_data', name: 'additional_data', defaultContent: 'N/A' },
            // { data: 'created_at', name: 'created_at' },
            // { data: 'action', name: 'action', orderable: false, searchable: false },
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
