@extends('admin.layouts.master')

@section('page_title')
    {{__('dashboard.title')}}
@endsection

@push('css')
<style>
        /* Scoped Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1050; /* Ensure it's on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: hidden; /* Disable scroll */
            background-color: rgba(0, 0, 0, 0.7); /* Black w/ opacity */
            display: flex; /* Use flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .modal-content {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
            width: 90%;
            max-width: 500px; /* Max width of the modal */
            text-align: center; /* Center text */
            z-index: 1051;
            position: relative;
        }

        .modal .close {
            color: #333;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .modal .close:hover,
        .modal .close:focus {
            color: #000;
            text-decoration: none;
        }

        .modal h4 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .modal p {
            margin-bottom: 25px;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .modal-buttons {
            margin-top: 1px;
        }

        .modal-buttons button {
            margin: 0 15px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-buttons .btn-primary {
            background-color: #28a745;
            color: #fff;
        }

        .modal-buttons .btn-primary:hover {
            background-color: #218838;
        }

        .modal-buttons .btn-secondary {
            background-color: #dc3545;
            color: #fff;
        }

        .modal-buttons .btn-secondary:hover {
            background-color: #c82333;
        }

        .icon {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>

@endpush

@section('content')   

            
    <!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">{{__('dashboard.title')}}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3">
					{{-- <div class="create-btn pull-right">
						<a href="{{ route('users.create') }}" class="btn custom-create-btn">{{ __('default.form.add-button') }}</a>
					</div> --}}
				</div>
			</div>
		</div><!-- /card finish -->	
	</div><!-- /Page Header -->

    <div class="row">
    
        <div class="col-xl-3 col-sm-6 col-12">
    <div class="card">
        <a href="{{ route('deal.index', ['status' => 'Active']) }}" class="text-decoration-none text-dark">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-primary border-primary">
                        <i class="fe fe-file"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ $activeDealsCount }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Active Deals</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary w-50"></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>


        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
            <a href="{{ route('deal.index_invested') }}" class="text-decoration-none text-dark">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-money"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $investedDealsCount }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        
                        <h6 class="text-muted">Invested Deals</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                    </div>
                </div>
                    </a>
            </div>
        </div>

        @unless(auth()->user()->hasRole('Investor'))
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
        <a href="{{ route('deal.index', ['status' => 'Expired']) }}" class="text-decoration-none text-dark">
        
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-danger border-danger">
                        <i class="fe fe-trash"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ $expiredDealsCount  }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Expired Deals</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger w-50"></div>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>
@endunless

        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
            <a href="{{ route('deal.index_invested') }}" class="text-decoration-none text-dark">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning border-warning">
                            <i class="fe fe-money"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $totalInvestment }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        
                        <h6 class="text-muted">Total Investment</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-50"></div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        </div>

        @auth
    @unless(auth()->user()->hasRole('Investor'))
       
        <div class="col-xl-3 col-sm-6 col-12 hidden" hidden>
            <div class="card">
            <a href="{{ route('deal.index') }}" class="text-decoration-none text-dark">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success border-success">
                            <i class="fe fe-activity"></i>
                        </span>
                        <div class="dash-count">
                            <h3></h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Order History</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        </div>
    @endunless
@endauth



    </div>

  <!-- Modal -->
  <div id="firstLoginModal" class="modal"   data-backdrop="static" data-keyboard="false" style="display:none">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="icon">
                <i class="fe fe-check-circle"></i>
            </div>
            <h4>Welcome to Rumbble!</h4>
            <p>Congratulations! Your account with Rumbble has been successfully created. We have completed the necessary KYC verification, and you are now ready to leverage the power of seamless Receivable Sales & Purchase Trading Activity.</p>
            <p>Do you want to add more Banks?</p>
            <div class="modal-buttons">
                <button id="yesButton" class="btn btn-primary">Yes</button>
                <button id="noButton" class="btn btn-secondary">No</button>
            </div>
        </div>
    </div>



    <div id="firstLoginModal_onlypopup" class="modal"   data-backdrop="static" data-keyboard="false" style="display:none">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="icon">
                <i class="fe fe-check-circle"></i>
            </div>
            <h4>Welcome to Rumbble!</h4>
            <p>Congratulations! Your account with Rumbble has been successfully created. We have completed the necessary KYC verification, and you are now ready to leverage the power of seamless Receivable Sales & Purchase Trading Activity.</p>
            <p>Do you want to add more Banks or Cards?</p>
            <div class="modal-buttons">
                <button id="yesButton" class="btn btn-primary">Yes</button>
                <button id="noButton" class="btn btn-secondary">No</button>
            </div>
        </div>
    </div>


@endsection




@push('css')
	
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/c3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/chartist.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/chartist.min.css') }}"/> --}}
    <style type="text/css">
    	.card{
    		background-color: #fff;
    	}
    </style>

@endpush

@push('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if this is the first login
            var isFirstLogin = {{ $login_status == 1 ? 'true' : 'false' }};
            //alert(isFirstLogin);
            if (isFirstLogin) {
                // Get the modal
                var modal = document.getElementById('firstLoginModal');
                //var modalpopup = document.getElementById('firstLoginModal_onlypopup');
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName('close')[0];
                // Get the "Yes" and "No" buttons
                var yesButton = document.getElementById('yesButton');
                var noButton = document.getElementById('noButton');
                
                // Show the modal
                if (isFirstLogin) {
                modal.style.display = 'flex';
            }
                
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = 'none';
                }
                
                // When the user clicks "Yes", redirect to profile route
                yesButton.onclick = function() {
                    //window.location.href = '{{ route('profile') }}';
                    // Set the bank_status variable
                    //var bank_status = 5;
                    var bank_status = 3;

                    // Redirect to the profile route with bank_status as a query parameter
                    window.location.href = '{{ route('profile') }}' + '?bank_status=' + bank_status;

                }
                
                // When the user clicks "No", close the modal
                noButton.onclick = function() {
                    modal.style.display = 'none';
                }
                
                // Disable closing the modal by clicking outside the content
                window.onclick = function(event) {
                    if (event.target == modal) {
                        event.stopPropagation(); // Prevent closing if backdrop is clicked
                    }
                }
                
                // Disable closing the modal with the keyboard
                document.onkeydown = function(event) {
                    if (event.key === 'Escape') {
                        event.preventDefault(); // Prevent the default action of Escape key
                    }
                }
            }
            
        });
    </script>
@endpush