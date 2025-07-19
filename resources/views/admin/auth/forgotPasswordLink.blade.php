@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{$setting->website_title}} - Forgot Password</title>
    
    <!-- Favicon -->
    @if($setting->website_favicon != null || !empty($setting->website_favicon))
        <link rel="shortcut icon" type="image/x-icon" href="{{$setting->website_favicon}}">
    @else
        <link rel="shortcut icon" type="image/x-icon" href="/assets/admin/img/favicon-def.png">
    @endif

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}"> 
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
    <!-- toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>
<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">

                    <div class="login-left"> 
                        @if($setting->website_logo_light != null || !empty($setting->website_logo_light))
                            <img class="img-fluid" src="{{$setting->website_logo_light}}" alt="{{$setting->website_title}}">
                        @else
                            <img class="img-fluid" src="/assets/admin/img/logo-def.png" alt="Logo">
                        @endif
                    </div>

                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Recover Password</h1>
                            <p class="account-subtitle">Get the reset password email!</p>
                            
                            <!-- Form -->
                            <form action="{{ route('reset.password.post') }}" method="POST" autocomplete="off">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
    
                                <div class="form-group position-relative">
                                    <label for="email_address" class="required">E-Mail Address</label>
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group position-relative">
                                    <label for="password" class="required">Password</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                                    <span class="position-absolute" style="right: 10px; top: 72%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password', 'eyeIcon')">
                                        <i id="eyeIcon" class="fa fa-eye"></i>
                                    </span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
        
                                <div class="form-group position-relative">
                                    <label for="password-confirm" class="required">Confirm Password</label>
                                    <input class="form-control" name="password_confirmation" id="password-confirm" type="password" placeholder="Confirm Password">
                                    <span class="position-absolute" style="right: 10px; top: 72%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('password-confirm', 'confirmEyeIcon')">
                                        <i id="confirmEyeIcon" class="fa fa-eye"></i>
                                    </span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif                                 
                                </div>
        
                                <button type="submit" class="btn btn-primary btn-block">
                                    Reset Password
                                </button>
                                    
                            </form>
                            <!-- /Form -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /Main Wrapper -->
    
    <!-- jQuery -->
    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    
    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <!-- toastr JS -->
    <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    <!-- Custom JS -->
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>

    <script>
        function togglePassword(fieldId, eyeIconId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(eyeIconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
    
</body>
</html>
