@extends('admin.layouts.master')

@section('page_title')
    {{__('investor.edit.title')}}
@endsection

@push('css')
	<style>
		#output{
			height: 300px;
			width: 300px;
		}

	</style>
@endpush

@section('content')
	<form method="post" action="{{ route('investor.update', $user->id) }}" enctype="multipart/form-data">
		@csrf()

		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">{{__('investor.index.title')}}</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('investor.index') }}">{{ __('investor.index.title') }}</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('investor.edit', $user->id) }}">{{ __('investor.edit.title') }} - ({{ $user->name }})</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
						</div>
					</div>
				</div>
			</div><!-- /card finish -->	
		</div><!-- /Page Header -->

		<div class="card-body">

			<div class="row">
				<div class="col-md-12">

				<div class="row">
					<div class="col-md-4 col-sm-12" style="margin: auto;">
						<div class="input-group mb-1">
							@if(!empty($user->image))
							<img src="{{ asset($user->image) }}" alt="User Image" id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/admin/img/default-user.png') }}';">
							@else
							<img src="{{ asset('assets/admin/img/default-user.png') }}" alt="User Image" id="output" class="img-thumbnail rounded mx-auto d-block mb-3">
							@endif

							<input type="hidden" id="image1" class="form-control" name="image1" value="{{ $user->image ?? '' }}">

							<div class="input-group-append" style="width: 100%;">
								<label class="btn btn-secondary btn-md btn-block">
									<i data-feather="image" class="feather-icon"></i>
									Change User's Image
									<input type="file" accept="image/*" style="display: none;" id="button-image" onchange="previewImage(event)" name="image">
								</label>
							</div>
						</div>
					</div>
				</div>


					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">
										{{ $user->name }}, Personal Information
									</h5>
								</div>
						

							

								<div class="card-body">	
									
									<div class="form-group">
										<label for="name" class="required">{{__('default.form.name')}}:</label>
										<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{$user->name}}">

										@error('name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="mobile">{{__("default.form.mobile")}}:</label>
										<input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror"  value="{{$user->mobile}}">

										@error('mobile')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
                            <label for="pan_number" class="required">{{ __('default.form.pan_number') }}:</label>
                            <input type="text" name="pan_number" id="pan_number" class="form-control @error('pan_number') form-control-error @enderror" value="{{$user->pan_number }}" required="required">

                            @error('pan_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="gst"  class="required">{{ __('default.form.pan_name') }}:</label>
                            <input type="text" name="pan_name" id="pan_name" class="form-control @error('pan_name') form-control-error @enderror" value="{{ $user->pan_name }}" required="required">

                            @error('pan_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<h5 class="card-header">
									Authentication
								</h5>

								<div class="card-body">

									<div class="form-group">
										<label for="email">{{__("default.form.email")}}:</label>
										<input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" value="{{$user->email}}" disabled>

										@error('email')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="password">{{__("default.form.password")}}:</label>
										<input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror">

										@error('password')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="password-confirm">{{__("default.form.password-confirm")}}:</label>
										<input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror">

										@error('confirm-password')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-4 " >
                <div class="card">
                    <h5 class="card-header">
                    Bank Details & Other
                    </h5>

                    <div class="card-body">

					<div class="form-group">
                            <label for="bank_name" class="required">{{ __('default.form.account_holder_name') }}:</label>
                            <input type="text" name="account_holder_name" id="account_holder_name" class="form-control @error('account_holder_name') form-control-error @enderror" required="required" value="{{ $user->account_holder_name }}">

                            @error('account_holder_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    <div class="form-group">
                            <label for="ifsc_code" class="required">{{ __('default.form.ifsc_code') }}:</label>
                            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control @error('ifsc_code') form-control-error @enderror" required="required" value="{{ $user->ifsc_code }}">

                            @error('ifsc_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="account_number" class="required">{{ __('default.form.account_number') }}:</label>
                            <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') form-control-error @enderror" required="required" value="{{ $user->account_number }}">

                            @error('account_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                       
						<div class="form-group">
                        <label for="upload_invoice" class="">{{ __('default.form.cheque_passbook') }}:</label>
                        <input type="file" name="cheque_passbook" id="cheque_passbook" class="form-control @error('cheque_passbook') form-control-error @enderror"  value="{{ old('cheque_passbook') }}">
                        @error('cheque_passbook')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

						@if($user->cheque_pass)
                                    <a href="{{ asset('storage/' . $user->cheque_pass) }}" target="_blank">View</a>
                                    @else
                                    
                                    @endif
                    </div>

                        <div class="form-group hidden" hidden>
                            <label for="company_name" class="">{{ __('default.form.annual_turnover') }}:</label>
                            <input type="text" name="annual_turnover" id="annual_turnover" class="form-control @error('annual_turnover') form-control-error @enderror"  value="{{ $user->annual_turnover }}">

                            @error('annual_turnover')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group hidden" hidden>
                            <label for="other_comments" class="">{{ __('default.form.other_comments') }}:</label>
                            <input type="text" name="other_comments" id="other_comments" class="form-control @error('other_comments') form-control-error @enderror" value="{{ $user->other_comments }}">

                            @error('other_comments')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div> <!-- card-body-end -->
                </div> <!-- card-end -->
            </div> <!-- col-md-4-end -->



						<div class="col-md-4 hidden" hidden>
							<div class="card">
								<h5 class="card-header">
									Role & Permission
								</h5>

								<div class="card-body">
									<div class="form-group">
										<label for="roles" class="required">{{ __('default.form.role') }}</label>
										<select name="roles[]" id="roles" class="select2" multiple="multiple">
											@foreach ($roles as $role)
												<option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
											@endforeach
										</select>
	
										@error('roles')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div> <!-- col-md-12-end -->
			</div> <!-- row-end -->		
		</div> <!-- card-end -->
	</form>
@endsection


@push('scripts')

<script>
	// Function to preview selected image
	function previewImage(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);

		// Set the hidden input field value to the selected image name or URL
		var imageInput = document.getElementById('image1');
		imageInput.value = event.target.files[0].name; // Update to capture the image name or adjust as needed
	}
</script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var ifscCodeInput = document.getElementById('ifsc_code');
            var panCardInput = document.getElementById('pan_number');
            
            if (ifscCodeInput) {
                ifscCodeInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }

            if (panCardInput) {
                panCardInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }
        });
    </script>
@endpush