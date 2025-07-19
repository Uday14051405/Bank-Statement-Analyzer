<!-- resources/views/home.blade.php -->
@extends('frontend.app-backend')
@section('pageclass')
<div class="fullHeightContainer">
    @endsection
    @section('header')
    <style>
        /* Basic styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .modalImg {
            width: 100px;
            height: auto;
        }

        .modalTitle {
            font-size: 24px;
            font-weight: bold;
        }

        .modalDesc,
        .modalInfo {
            font-size: 16px;
        }

        .modalBtn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .modalBtn:hover {
            background-color: #45a049;
        }

        /* Basic styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .modalImg {
            width: 100px;
            height: auto;
        }

        .modalTitle {
            font-size: 24px;
            font-weight: bold;
        }

        .modalDesc,
        .modalInfo {
            font-size: 16px;
        }

        .modalBtn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .modalBtn:hover {
            background-color: #45a049;
        }

        .modal-content .modalBtn {
            background-color: #4caf50;
            color: white;
            border: 1px solid #00274d;
            border-radius: 10px;
            /* padding: 10px 20px; */
        }

        /* Basic styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .modalImg {
            width: 100px;
            height: auto;
        }

        .modalTitle {
            font-size: 24px;
            font-weight: bold;
        }

        .modalDesc,
        .modalInfo {
            font-size: 16px;
        }

        .modalBtn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .modalBtn:hover {
            background-color: #45a049;
        }

        .modal-content .modalBtn {
            background-color: #4caf50;
            color: white;
            border: 1px solid #00274d;
            border-radius: 10px;
            /* padding: 10px 20px; */
        }

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

            .modal-content .modalBtn {
                background-color: #4caf50;
                color: white;
                border: 1px solid #00274d;
                border-radius: 10px;
                padding: 10px 20px;
            }
        }
    </style>
    @include('frontend.header-backend') {{-- Include header content --}}
    @endsection

    @section('content')
    <div class="userAuthBody">
        <div class="stepperContainer">
            <div class="step">
                <div class="node">
                    <span class="state green"></span>
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


        <div class="userAuthBox">
            <div class="authCard">
                <form class="panForm" method="POST" action="{{ route('form-bank-details.post') }}">
                    @csrf
                    <p class="formTitle">Bank Details</p>
                    <div>
                        <label for="userName">Account Holder Name</label><input type="text" name="account_holder_name"  id="userName" placeholder="Name on Account" value="" />
                        @error('account_holder_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div>
                        <label for="userAccNumber">Account Number</label><input type="text"  name="account_number" id="userAccNumber" placeholder="Your Account Number" value="" />
                        @error('account_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                    <div>
                        <label for="userIFSC">IFSC Code</label><input type="text" name="ifsc_code"  id="userIFSC" placeholder="Your IFSC Code" value="" />
                        @error('ifsc_code')
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
    <!-- <button id="openModalBtn">Open Modal</button> -->

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <img src="/static/media/verify-success.d6f2557f8dd77471e0fe.gif" alt="Verification Success" class="modalImg" />
            <p class="modalTitle">Successfully Created!</p>
            <p class="modalDesc">
                Congratulations! Your account with Rumbble has been successfully
                created. We've completed the necessary KYC verification, and
                you're now ready to leverage the power of seamless invoice
                discounting.
            </p>
            <p class="modalInfo">
                We've sent you a confirmation email with the password.
            </p>
            <button class="modalBtn" id="closeModalBtn">Okay</button>
        </div>
    </div>
    @endsection
    @section('footer')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModalBtn");

        // Get the button that closes the modal
        var closeBtn = document.getElementById("closeModalBtn");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        };

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
    @include('frontend.footer-backend') {{-- Include footer content --}}
    @endsection