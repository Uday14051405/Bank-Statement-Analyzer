<!-- resources/views/home.blade.php -->
@extends('frontend.app-backend')
@section('pageclass')
<div class="fullHeightContainer">
    @endsection
    @section('header')
    @include('frontend.header-backend') {{-- Include header content --}}
    @endsection

    @section('content')
    <style>
        @media only screen and (max-width: 768px) {
            .logoBlue {
                max-width: 300px;
                width: 100%;
            }

            .loginBody {
                align-items: center;
                display: block;
                height: 75vh;
                justify-content: space-between;
                padding: 0 40px;
            }

            .signupBody {
                align-items: center;
                display: block;
                height: 75vh;
                justify-content: space-between;
                padding: 0 40px;
            }

            .loginBody .loginContent {
                display: flex;
                flex-direction: column;
                gap: 30px;
                width: 100%;
                min-width: 50%;
            }

            .signupBody .signupContent {
                display: flex;
                flex-direction: column;
                gap: 30px;
                width: 100%;
                min-width: 50%;
            }

            .loginBody .loginContent h1 {
                color: #00274d;
                font-size: 48px;
                font-weight: 700;
                line-height: normal;
                width: 100%;
                /* min-width: 500px; */
            }

            .signupBody .signupContent h1 {
                color: #00274d;
                font-size: 38px;
                font-weight: 700;
                line-height: normal;
                width: 100%;
                /* min-width: 500px; */
            }

            .loginBody .loginContent p {
                color: gray;
                font-size: 20px;
                font-weight: 500;
                line-height: 40px;
                width: 100%;
                /* min-width: 500px; */
                /* max-width: 500px; */
            }

            .signupBody .signupContent p {
                color: gray;
                font-size: 20px;
                font-weight: 500;
                line-height: 40px;
                width: 100%;
                /* min-width: 500px; */
                /* max-width: 500px; */
            }

            .loginBody .loginBox {
                align-items: center;
                justify-content: center;
                display: block;
                min-width: 50%;
                width: 100%;
            }

            .signupBody .signupBox {
                align-items: center;
                justify-content: center;
                display: block;
                min-width: 50%;
                width: 100%;
                margin: 20px 0;
            }

            .authCard {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 16px 0 #00000040;
                padding: 30px;
                width: 100%;
                /* min-width: 470px; */
            }

            .loginForm {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
    <div class="signupBody">
        <div class="signupContent">
            <h1>
                Effortless Receivable Sales & Purchase Trading Activity Awaits
            </h1>
            <p>
                Discover the ease of managing your invoices with Rumbble.
                Login or sign up today to embark on a journey of financial
                efficiency.
            </p>
        </div>
        <div class="signupBox">
            <div class="authCard">
                <form class="signupForm" method="POST" action="{{ route('signup.post') }}">
                    @csrf
                    <div class="toggleSwitchBox">
                        <div class="toggleSwitch">
                            <a class="switchText" href="signin">
                                <p>Log In</p>
                            </a><a class="switchText active" href="signup">
                                <p>Sign Up</p>
                            </a>
                        </div>
                    </div>
                    <div>
                        <label for="userName">Name</label><input type="text"  name="name" id="userName" placeholder="Your Name" value="" />
                        @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div>
                        <label for="userEmail">Email</label><input type="email" name="email"  id="userEmail" placeholder="Your Email" value="" />
                        @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div>
                        <label for="userNumber">Phone Number</label><input type="tel" name="mobile"  id="userNumber" placeholder="Your Number" value="" />
                        @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div>
                        <label for="userNumber">Password</label><input type="password"  name="password"  id="password" placeholder="Your password" value="admin" />
                        @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div class="submitBtn">
                        <button class="blueBtn" style="cursor: pointer" type="submit">
                            Next
                        </button>
                    </div>
                </form>
                <div class="Toastify"></div>
            </div>
        </div>
    </div>
    @endsection
    @section('footer')
    <script>
        window.onload = function() {
            // Assuming you are using POST method for logout
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('logout') }}';
            form.style.display = 'none';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.setAttribute('name', '_token');
            csrfInput.setAttribute('value', csrfToken);
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
    @include('frontend.footer-backend') {{-- Include footer content --}}
    @endsection