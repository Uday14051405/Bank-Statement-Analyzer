@php
    $setting = \App\Models\Setting::find(1);
@endphp

@extends('frontend.app-backend')

@section('pageclass')
<div class="fullHeightContainer">
@endsection

@section('header')
@include('frontend.header-backend') {{-- Include header content --}}

@endsection

@section('content')
<div class="loginBody">
    <div class="loginContent">
        <h1>
            Effortless Receivable Sales & Purchase Trading Activity Awaits
        </h1>
        <p>
            Discover the ease of managing your invoices with Rumbble.
            Login or sign up today to embark on a journey of financial
            efficiency.
        </p>
    </div>
    <div class="loginBox">
        <div class="authCard">
            <form class="loginForm" action="{{ route('login') }}" method="POST">
                <div class="toggleSwitchBox">
                    <div class="toggleSwitch">
                        <a class="switchText active" href="signin">
                            <p>Log In</p>
                        </a><a class="switchText" href="signup">
                            <p>Sign Up</p>
                        </a>
                    </div>
                </div>
                
                @csrf
                <div>
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" placeholder="Your email" value="" name="email" />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="userPass">Password</label>
                    <div class="inputPass">
                        <input type="password" id="userPass" placeholder="Password" value="admin" name="password" />
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="footerElement">
                    <div class="remeberMeBox">
                        <input type="checkbox" id="rememberMe" name="remember" /><label for="rememberMe">Remember Me</label>
                    </div>
                    <p> <a href="{{ route('forget.password.get') }}" style="color:black">Forgot your password?</a></p>
                </div>
                <div class="submitBtn">
                    <button class="blueBtn" type="submit" style="cursor: pointer">
                        Log In
                    </button>
                </div> 
                <div class="Toastify"></div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('frontend.footer-backend') {{-- Include footer content --}}

<script>
    // Toastr options for customization
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@endsection
