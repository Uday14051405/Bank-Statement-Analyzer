@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>{{$setting->website_title}} - Login</title>
        
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
                                <h1>Login</h1>
                                <p class="account-subtitle">Access to our dashboard</p>
                                
                                <!-- Form -->
                                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                                    @csrf()
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="form-group position-relative">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                                        <span class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword()">
                                            <i id="eyeIcon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input class="remember" id="remember" type="checkbox" name="remember">
                                        <label class="text-dark" for="remember">{{__('auth.form.remember')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>
                                <!-- /Form -->
                                
                                <div class="text-center forgotpass">
                                    <a href="{{ route('forget.password.get') }}">Forgot Password?</a>
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('/home') }}" class="btn btn-secondary btn-block">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /Main Wrapper -->
        
        <!-- jQuery -->
        <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
        <!-- Custom JS -->
        <script src="{{ asset('assets/admin/js/script.js') }}"></script> 
        <!-- toastr JS -->
        <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
        {!! Toastr::message() !!}

        <script>
            function togglePassword() {
                const passwordField = document.getElementById('password');
                const eyeIcon = document.getElementById('eyeIcon');
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
