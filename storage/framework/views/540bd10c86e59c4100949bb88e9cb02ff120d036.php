<?php echo $__env->make('frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<style>
    body {
        font-family: 'Poppins' !important;
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
        padding-top: 80px;
        position: relative;
    }


    .container {
        max-width: 1200px;
        margin: 0 auto;
        /* padding: 20px; */
        flex: 1;
    }


    .signup-form {
        max-width: 300px;
        margin: 40px auto;
        /* padding: 20px; */
    }

    .signup-form h1 {
        /* color: #36408E;
        text-align: center;
        margin-bottom: 30px; */

        font-size: 28px;
        font-weight: 600;
        line-height: 52.5px;
        letter-spacing: 0.01em;
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;
        color: #273896;
        margin-bottom: 10px;

        width: 122px;
        height: 53px;
        gap: 0px;
        opacity: 0px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        /* display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: initial; */
        font-size: 15px !important;
        font-weight: 400;
        line-height: 31.3px;
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;
    }

    .form-group input {
        padding-left: 15px;
        height: 45px;
        font-size: 13px !important;
        font-weight: 400;
        line-height: 28.17px;
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;
    }

    .checkbox-group label {
        font-size: 17px !important;
        font-weight: 400;
        /* line-height: 25px !important; */
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1.5rem !important;
    }

    .mobile-input-group {
        display: flex;
        gap: 10px;
        position: relative;
    }

    .mobile-input-group input {
        flex: 1;
    }

    .otp-btn {
        /* background-color: #36408E;
        color: white;
        border: none;
        padding: 4px 20px;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap; */

        gap: 0px;
        border-radius: 6px 6px 6px 6px;
        opacity: 0px;
        padding: 0px 15px;



        /* font-family: Avenir LT Std !important; */
        font-size: 13px !important;
        font-weight: 200;
        line-height: 31.3px;
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;
        color: #ffffff;
        background-color: #273896;

    }

    .checkbox-group {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    /* Hide the default checkbox */
    /* input[type="checkbox"] {
            -webkit-appearance: none; 
            appearance: none; 
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
            background-color: #fff;
        }

        input[type="checkbox"]:checked {
            background-color: green;
            border-color: green;
        }

        input[type="checkbox"]:checked::after {
            content: '✔';
            color: white;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        } */

    .checkbox-group input[type="checkbox"] {
        margin-top: 4px;
    }

    .checkbox-group label {
        font-size: 14px;
        line-height: 1.4;
    }

    .checkbox-group a {
        color: #36408E;
        text-decoration: none;
    }

    .submit-btn {
        width: 100%;
        background-color: #36408E;
        color: white;
        border: none;
        padding: 6px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;


        /* font-family: Avenir LT Std !important; */
        font-size: 13px !important;
        font-weight: 300;
        line-height: 31.3px;
        text-align: left;
        text-underline-position: from-font;
        text-decoration-skip-ink: none;

    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .signup-form {
            margin: 20px auto;
            padding: 15px;
        }

        .mobile-input-group {
            flex-direction: column;
        }

        .otp-btn {
            width: 100%;
        }
    }

    /* Success message styles */
    .success-message {
        background-color: #e8f5e9;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .success-message .close-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }
</style>

<style>
    .notification-container {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 999;
        max-width: 300px;
        width: 100%;
    }

    .notification {
        padding: 7px;
        /* padding: 12px 20px; */
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    .notification-text {
        color: #333;
        font-size: 14px;
    }

    .notification.error {
        background-color: #ffd2d2;
        border: 2px solid #ee8585;
        /* border: 2px solid #ffcdd2; */
    }

    /* .notification.error .notification-text {
    color: #d32f2f;
} */

    .notification.success {
        background-color: #e5f8f6;
        border: 2px solid #a7e8e0;
    }

    .notification-close {
        background: none;
        border: none;
        color: #666;
        font-size: 25px;
        cursor: pointer;
        padding: 0;
        margin-left: 10px;
        line-height: 1;
        float: inline-end;
        font-weight: 300;
    }

    .notification.hide {
        opacity: 0;
    }

    @keyframes  slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .notification-container {
            top: 60px;
            right: 10px;
            left: 10px;
            max-width: none;
        }

        .notification {
            padding: 10px 15px;
        }
    }

    .resend-otp {
        margin-top: 8px;
        font-size: 12px;
        color: #666;
    }

    .countdown {
        color: #ff69b4;
        font-weight: 500;
    }

    .resend-btn {
        color: #ff69b4;
        text-decoration: none;
        font-size: 12px;
        font-weight: 400;
        display: none;
    }

    .resend-btn:hover {
        color: #ff69b4;
        text-decoration: none;
        font-size: 12px;
        font-weight: 400;
        display: none;
    }

    @media (max-width: 768px) {
        .mobile-input-group input {
            flex: unset;
        }
    }

    @media (max-width: 768px) {
        .mobile-prefix{
            top: 26% !important;
        }
    }

   
    .mobile-input-group input[type="tel"] {
        padding-left: 45px; 
    }

    .mobile-prefix {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #333;
        font-size: 13px;
        pointer-events: none;
        z-index: 1;
    }

    
</style>

<style>
    .form-control.error {
        border-color: red !important;
        color: red !important;
    }

    .mobile-prefix.error {
        color: red !important;
    }
</style>

    <div class="notification-container">
        <div class="notification success" style="display: none;">
            <span class="notification-text">OTP Sent Successfully</span>
            <button class="notification-close">&times;</button>
        </div>
        <div class="notification" id="notification" style="display: none;">
            <span class="notification-text" id="notification-text"></span>
            <button class="notification-close" onclick="hideNotification()">&times;</button>
        </div>

        <div class="notification error" style="display: none;">
            <span class="notification-text">Too many incorrect attempts.<br>Please try again in 24 hours.</span>
            <button class="notification-close">&times;</button>
        </div>

        
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success" id="success-message">
        <?php echo e(session('success')); ?>

    </div>
<?php elseif(session('error')): ?>
    <div class="alert alert-danger" id="error-message">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

   

    <div class="container" style="margin-bottom: 30px;">
    <div class="signup-form">
        <center>
            <h1>Sign In</h1>
        </center>

        <form id="otpForm">
        <input type="hidden" id="event_id" name="event_id" value="">

            <div class="form-group">
                <label for="fullname">Your Full Name</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your full name" required>
                <div id="fullname-error" class="error-message" style="color: red; display: none;">Please Enter your Full Name (As per PAN)</div>
                <div id="fullname-special-error" class="error-message" style="color: red; display: none;">No Special Characters "* , ) , etc." Allowed</div>
                <div id="fullname-length-error" class="error-message" style="color: red; display: none;">Name Length should not exceed 100 characters</div>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <div class="mobile-input-group">
                    <span class="mobile-prefix">+91</span>
                    <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile number" required>
                    <button type="button" class="otp-btn" style="font-size: small;" id="sendOtpBtn">
                        <center>Get OTP</center>
                    </button>
                </div>
                <div id="mobile-error" class="error-message" style="color: red; display: none;">Please enter a valid 10-digit mobile number</div>
                <div id="mobile-first-digit-error" class="error-message" style="color: red; display: none;">The first digit should be a number between 6 to 9</div>
                   
                <center>
                    <div class="resend-otp" id="countdown"  style="display: none;">
                        <span>Didn't receive the OTP? </span>
                        <span class="countdown"  id="timer" style="color: #ff69b4;">00:59</span>
                        <a href="#" class="resend-btn"  id="resendOtpBtn"   style="display: none;">RESEND OTP</a>
                    </div>
                </center>
            </div>

            <div class="form-group">
                <label for="otp">Enter OTP</label>
                <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>
                <div id="otp-error" class="error-message" style="color: red; display: none;">Please enter a valid 6-digit OTP</div>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="terms" name="terms" style="accent-color: #20a74e; height: auto;" required>
                <label for="terms" style="font-size: 12px !important; color: black;">
                    I agree to the <a href="<?php echo e(route('terms')); ?>" style="font-size: 12px;" target="_blank">T&C</a>, <a href="<?php echo e(route('policy')); ?>" style="font-size: 12px;" target="_blank">Privacy policy</a> and authorise OneInfinity representatives to contact me and receive my credit information. This consent supersedes  any DNC registration by me.
                </label>
            </div>
           
            <button type="submit" class="submit-btn"  id="signInBtn" disabled>
                <center>Sign In</center>
            </button>
        </form>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileInput = document.getElementById('mobile');
            const event_idInput = document.getElementById('event_id');
            const otpInput = document.getElementById('otp');
            const fullnameInput = document.getElementById('fullname');
            const sendOtpBtn = document.getElementById('sendOtpBtn');
            const signInBtn = document.getElementById('signInBtn');
            const countdownElem = document.getElementById('countdown');
            const resendOtpBtn = document.getElementById('resendOtpBtn');
            const timerElem = document.getElementById('timer');
            const notificationContainer = document.body; // Used to append notification
            let otpSent = false;
            const maxAttempts = <?php echo e(env('SMS_ATTEMPT_BLOCK', 100)); ?>; 
            let resendAttempts = 0;
            let countdownTimer;
            let timerValue = 59;

            const notification = document.querySelector('.notification');
            if (notification) {
                notification.style.display = 'none';
            }

            fullnameInput.addEventListener('input', function() {
                validateFullName(); // Call the validation function on input
            });

            // Helper Function to Validate Full Name
            function validateFullName() {
                const fullname = fullnameInput.value;
                const regex = /^[a-zA-Z\s]+$/;
                const lengthValid = fullname.length <= 100;
                const specialCharValid = regex.test(fullname);

                // Add or remove error class
                fullnameInput.classList.toggle('error', !fullname || !specialCharValid || !lengthValid);

                if (!fullname) {
                    document.getElementById('fullname-error').style.display = 'block';
                    document.getElementById('fullname-special-error').style.display = 'none';
                    document.getElementById('fullname-length-error').style.display = 'none';
                    return false;
                } else if (!specialCharValid) {
                    document.getElementById('fullname-special-error').style.display = 'block';
                    document.getElementById('fullname-error').style.display = 'none';
                    document.getElementById('fullname-length-error').style.display = 'none';
                    return false;
                } else if (!lengthValid) {
                    document.getElementById('fullname-length-error').style.display = 'block';
                    document.getElementById('fullname-special-error').style.display = 'none';
                    document.getElementById('fullname-error').style.display = 'none';
                    return false;
                }

                document.getElementById('fullname-error').style.display = 'none';
                document.getElementById('fullname-special-error').style.display = 'none';
                document.getElementById('fullname-length-error').style.display = 'none';
                return true;
            }

            // Helper Function to Validate Mobile Number
            function validateMobile() {
                const mobile = mobileInput.value;
                const mobileValid = /^\d{10}$/.test(mobile);
                const firstDigitValid = /^[6-9]/.test(mobile);
                const isValid = mobileValid && firstDigitValid;

                // Add or remove error class for both input and prefix
                mobileInput.classList.toggle('error', !isValid);
                document.querySelector('.mobile-prefix').classList.toggle('error', !isValid);

                if (!mobileValid) {
                    document.getElementById('mobile-error').style.display = 'block';
                    document.getElementById('mobile-first-digit-error').style.display = 'none';
                    return false;
                } else if (!firstDigitValid) {
                    document.getElementById('mobile-first-digit-error').style.display = 'block';
                    document.getElementById('mobile-error').style.display = 'none';
                    return false;
                }

                document.getElementById('mobile-error').style.display = 'none';
                document.getElementById('mobile-first-digit-error').style.display = 'none';
                return true;
            }

            // Validate OTP
            function validateOtp() {
                const otp = otpInput.value;
                const otpValid = /^\d{6}$/.test(otp);
                
                // Add or remove error class
                otpInput.classList.toggle('error', !otpValid);

                if (!otpValid) {
                    document.getElementById('otp-error').style.display = 'block';
                    return false;
                }
                document.getElementById('otp-error').style.display = 'none';
                return true;
            }

            // Show Success Notification after OTP is Sent
            function showNotification() {
                if (notification) {
                    notification.style.display = 'flex';

                    // Automatically hide after 5 seconds
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 5000);
                }
            }


            // Handle OTP Sending
            // sendOtpBtn.addEventListener('click', function () {
            sendOtpBtn.addEventListener('click', async function() {
                if (validateMobile() && validateFullName()) {
                    otpSent = true;
                    try {
                        const response = await fetch('/send-otp', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({
                                mobile: mobileInput.value
                            }),
                        });

                        const result = await response.json();
                        
                        const mobilePrefix = document.querySelector('.mobile-prefix');
                        

                        if (result.success) {
                            startCountdown();
                          
                            let eventId =  result.event_id ?? '';
                            event_idInput.value = eventId;

                            sendOtpBtn.style.display = 'none'; // Hide Get OTP button
                            resendOtpBtn.style.display = 'none'; // Hide Resend OTP button initially
                            countdownElem.style.display = 'block'; // Show countdown
                            mobilePrefix.style.setProperty('top', '51%', 'important');
                            showNotification();
                            
                        } else {
                            countdownElem.style.display = 'none';
                            showErrorNotification(result.error || 'Failed to send OTP','error');
                        }
                    } catch (error) {
                        console.error('Error sending OTP:', error);
                        countdownElem.style.display = 'none';
                        showErrorNotification(result.error,'error');
                    }

                }
            });

            // Countdown Timer
            function startCountdown() {
                countdownTimer = setInterval(() => {
                    timerElem.style.display = 'inline-block';
                    if (timerValue < 0) {
                        clearInterval(countdownTimer); // Stop the timer at 0
                        timerElem.innerText = '00:00'; // Ensure it displays 0 when stopped
                        timerElem.style.display = 'none';
                        resendOtpBtn.style.display = 'inline-block'; // Show Resend button
                        
                        
                    } else {
                        timerElem.textContent = `00:${timerValue.toString().padStart(2, '0')}`;
                        //timerElem.innerText = timerValue; // Display current value
                        timerValue--; // Decrement after displaying
                    }
                }, 1000);
            }



            // Resend OTP
            resendOtpBtn.addEventListener('click', function() {
                if (resendAttempts < maxAttempts) {
                    timerValue = 59;
                    sendOtpBtn.click();
                    otpSent = false;
                    resendAttempts++;
                    timerValue = 59; // Reset timer to 60 seconds
                    countdownElem.style.display = 'block';
                    resendOtpBtn.style.display = 'none'; // Hide Resend button during countdown
                    //clearInterval(countdownTimer); 
                    //startCountdown();
                    
                } else {
                    document.querySelector('.notification.error').style.display = 'block';
                }
            });

            // Enable Sign In Button if OTP is valid
            otpInput.addEventListener('input', function() {
                signInBtn.disabled = !validateOtp();
            });

            // Form Submit
            document.getElementById('otpForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                try {
                    const response = await fetch('/verify-otp', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            otp: otpInput.value,
                            fullname: fullnameInput.value,
                            mobile: mobileInput.value,
                            event_id: event_idInput.value
                        }),
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        showErrorNotification(result.success,'success');
                        // Redirect or perform success action
                        window.location.href = "<?php echo e(route('analyze_index')); ?>";
                    } else {
                        showErrorNotification( result.error, 'error');
                    }
                } catch (error) {
                    showErrorNotification( result.error, 'error');
                    console.error('Error verifying OTP:', error);
                }


            });
        });

        function showErrorNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');

            // Set the notification message and class
            notificationText.innerText = message;
            notification.className = `notification ${type}`; // Add class dynamically
            notification.style.display = 'flex'; // Show the notification

            // Automatically hide the notification after 3 seconds
            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        }

        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.style.display = 'none';
        }
    </script>
<script>
    // Wait for the DOM to load
    document.addEventListener('DOMContentLoaded', function () {
        // Automatically hide the success message after 5 seconds
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }

        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 5000);
        }
    });
</script>


<?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Laravel Project New\bsa_new\resources\views/frontend/signup.blade.php ENDPATH**/ ?>