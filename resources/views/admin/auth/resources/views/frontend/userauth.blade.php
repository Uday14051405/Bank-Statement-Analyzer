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

            .userAuthBody {
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

            .userAuthBody .userAuthContent {
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
                min-width: 500px;
            }

            .userAuthBody .userAuthContent h1 {
                color: #00274d;
                font-size: 48px;
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
                min-width: 500px;
                /* max-width: 500px; */
            }

            .userAuthBody .userAuthContent p {
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

            .userAuthBody .userAuthBox {
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
                /* max-width: 470px; */
            }

            .loginForm {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
    <div class="userAuthBody">

        <div class="verificationStepper">
            <div class="stepperContainer">
                <div class="step">
                    <div class="node">
                        <span class="state yellow"></span>
                    </div>
                    <div class="stepText">
                        <p class="stepTitle">PAN Verification</p>
                        <p class="stepDesc">
                            Please enter your Pan Card Number, Name and Upload
                            Your Pan Card Photo below.
                        </p>
                    </div>
                </div>
                <div class="step">
                    <div class="node"><span class="state gray"></span></div>
                    <div class="stepText bank">
                        <p class="stepTitle grayText">Bank Verification</p>
                        <p class="stepDesc grayText">
                            Please enter your Pan Card Number, Name and Upload
                            Your Pan Card Photo below.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="userAuthBox">
            <div class="authCard">
                <div class="mainPage">
                    <form class="panForm" method="POST" action="{{ route('form-pan-details.post') }}">
                        @csrf
                        <p class="formTitle">PAN Card</p>
                        <div>
                            <label for="userPan">PAN Number</label><input type="text" id="userPan" placeholder="Your PAN Number" name="pan_number" value="" />
                            @error('pan_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div>
                            <label for="userPanName">PAN Name</label><input type="text" id="userPanName" placeholder="Name on PAN" name="pan_name" value="" />
                            @error('pan_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="submitBtn">
                            <button class="blueBtn" type="submit" style="cursor: pointer">
                                Verify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('footer')
    @include('frontend.footer-backend') {{-- Include footer content --}}
    @endsection