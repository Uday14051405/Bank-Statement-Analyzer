<style>
    * {
        font-family: Poppins, var(--default-font-family) !important;
    }

    .contact-box ul li {
        margin-top: 4rem;
    }

    .fa-solid,
    .fas {
        font-family: "Font Awesome 6 Free" !important;
    }

    .fa-brands,
    .fab {
        font-family: "Font Awesome 6 Brands" !important;
        font-weight: 400;
    }

    body {
        padding-top: 80px;
    }


    .contact-box {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
        border-radius: 10px;
        overflow: hidden;
        min-height: 405px;
        width: 88% !important;
    }

    .contact-links {
        color: #fff;
        background-color: #1f2e43;
        background:
            radial-gradient(circle at 90% 90%, rgba(0, 18, 115, 0.5) 0 30%, transparent 10.2%),
            radial-gradient(circle at 60% 70%, rgba(44, 62, 164, 255) 10% 15%, transparent 10%),
            #273896;
    }

    .contact-links h2 {
        color: #fff;
        /* letter-spacing: 0.5px; */
        /* text-align: center; */
    }

    .contact-form-wrapper {
        background-color: #ffffff8f;
    }

    label {
        font-size: 1.1rem;
        font-weight: 400 !important;
    }

    .col-md-6,
    .col-12 {
        padding: 0em 1.3em !important;
    }

    @media (max-width: 768px) {
        .contact-box {
            flex-direction: column;
        }

        .contact-links,
        .contact-form-wrapper {
            border-radius: 0;
        }
    }

    @media (max-width: 400px) {
        .contact-box {
            margin: 10px;
        }
    }

    #captchaImage {
        width: 100px;
        height: 40px;
    }

    .li {
        margin-left: -4.5rem;
    }

    .contact-box li a {
        font-weight: lighter;
        font-size: small;
    }

    .contact-box ul {
        padding-left: 22px !important;
        margin-left: 22px !important;
    }
</style>
<style>
    #image {
        margin-top: 10px;
        box-shadow: 5px 5px 5px 5px gray;
        width: 60px;

        padding: 20px;
        font-weight: 400;
        padding-bottom: 0px;
        height: 40px;
        user-select: none;
        text-decoration: line-through;
        font-style: italic;
        font-size: x-large;
        border: red 2px solid;
        margin-left: 10px;

    }

    #user-input {
        box-shadow: 5px 5px 5px 5px gray;
        width: auto;
        margin-right: 10px;
        padding: 10px;
        padding-bottom: 0px;
        height: 40px;
        border: red 0px solid;
    }

    input {
        border: 1px black solid;
    }

    .inline {
        display: inline-block;
    }

    #btn {
        box-shadow: 5px 5px 5px grey;
        color: aqua;
        margin: 10px;
        background-color: brown;
    }
</style>
<style>
    .fa-rotate {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 2.5rem;
        margin-left: 40% !important;
        color: #273896;
    }

    button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    canvas {
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        width: 144px;
        /* height: 55px; */
    }

    .error {
        color: red;
        font-size: 14px;
    }

    .captcha-container {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Space between canvas and button */
        margin-bottom: 16px;
        margin-top: 7px;
    }

    .refresh-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        /* margin-top: -10px; Adjusts the button's vertical position slightly upward */
        font-size: 1.2rem;
        /* Adjust icon size if needed */

    }

    .refresh-btn:hover {
        color: #007bff;
        /* Optional: Change color on hover */
    }

    .send-msg {
        background-color: #ed217c !important;
        font-weight: 600 !important;
        height: 37px;
    }

    textarea::placeholder {
        font-size: 1.1rem;
        padding-top: 1%;
        padding-left: 1%;
    }

    #email {
        outline: none;
    }

    #contactNumber {
        padding-left: 40px;
        outline: none;
        box-shadow: none;
    }

    .nine-one {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #897e7e;
        pointer-events: none;
        font-size: 1.1rem;
    }

    .contact-form-wrapper {
        padding: 3.5rem !important;
    }

    .contact-links {
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        border-bottom-left-radius: 16px;
        border: 5px solid #fff;
    }
</style>

@include('frontend.header')

<div class="container my-5">
    <div class="row text-center">
        <h3 class="fw-bold fs-1" style="color: #273896;">Contact Us</h3>
        <p class="text-dark fs-3">Any question or remarks? Just write us a message!</p>
    </div>
</div>
<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="contact-box row">
        <div class="contact-links col-lg-4 col-md-4 d-flex flex-column p-5">
            <h2 class="mb-5 mt-4">Contact Information</h2>
            <ul class="fs-5" style="list-style-type: none;">
                <li class="mb-4 li">
                    <i class="fa-solid fa-phone-volume me-4" style="rotate:316deg; font-size:small;"></i>
                    <a href="tel:+919167968283" class="text-light" style="text-decoration:none;">+91 91679 68283</a>
                </li>
                <li class="li">
                    <i class="fa-solid fa-envelope me-4" style="font-size:small;"></i>
                    <a href="mailto:info@oneinfinty.in" class="text-light" style="text-decoration:none;text-transform:lowercase;">info@oneinfinty.in</a>
                </li>
                <!-- <li class="li">
                    <a href="https://www.linkedin.com/company/oneinfinity/" class="bg-light" style="text-decoration:none;text-transform:lowercase;margin-top:100%; padding: 5px 6px 5px 5px; border-radius: 50%;"><i class="fa-brands fa-linkedin" style="color: #273896;"></i></a>
                </li> -->
            </ul>
        </div>



        <div class="contact-form-wrapper col-lg-8 col-md-7">
            <form class="form py-3" method="POST" id="contact-form" action="{{ route('contact-us-store') }}">
            @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Business Name *</label>
                        <input type="text" id="businessName" class="form-control" name="businessName" required>
                        <span id="businessNameError" class="form-text text-danger fs-5"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Number *</label>
                        <div style="position: relative;">
                            <span class="nine-one">
                                +91
                            </span>
                            <input type="tel" id="contactNumber" class="form-control" name="contactNumber" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                        <span id="contactNumberError" class="form-text text-danger fs-5"></span>
                    </div>



                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" id="email" class="form-control" name="email" required maxlength="45">
                        <span id="emailError" class="form-text text-danger fs-5"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No. of bank statements to analyze in a month</label>
                        <input type="number" id="statements" name="statements" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" maxlength="1000" placeholder="Type your message here..."></textarea>
                    </div>

                    <div class="col-12 capt">
                        <!-- <div class="captcha-container">
                            <canvas id="captchaCanvas" width="200" height="60"></canvas>
                            <button onclick="generateCaptcha()"><i class="fa-solid fa-rotate"></i></button>
                        </div> -->
                        <div class="captcha-container d-flex align-items-center">
                            <canvas id="captchaCanvas" width="200" height="60"></canvas>
                            <button onclick="generateCaptcha(event)" class="refresh-btn" type="button">
                                <i class="fa-solid fa-rotate"></i>
                            </button>
                        </div>
                        <input type="text" id="captchaInput" placeholder="Enter captcha" class="form-control mb-2" oninput="validateCaptcha()" required>
                        <span id="captchaError" class="error form-text text-danger fs-5"></span>
                    </div>
                    <div class="col-12 text-start">
                        <button class="btn text-light px-5 fs-5 send-msg" type="submit" name="submit" id="submit">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





@include('frontend.footer')

<script>
    document.getElementById('contact-form').addEventListener('submit', function (event) {
        let isValid = true;

        // Business Name Validation
        const businessName = document.getElementById('businessName').value.trim();
        const businessNameError = document.getElementById('businessNameError');
        if (!businessName || businessName.length > 100) {
            isValid = false;
            businessNameError.textContent = 'Please enter a valid Business Name (1-100 characters)';
        } else {
            businessNameError.textContent = '';
        }

        // Contact Number Validation
        const contactNumber = document.getElementById('contactNumber').value.trim();
        const contactNumberError = document.getElementById('contactNumberError');
        if (!/^[6-9]\d{9}$/.test(contactNumber)) {
            isValid = false;
            contactNumberError.textContent = 'Please enter a valid Mobile Number (10 digits starting with 6-9)';
        } else {
            contactNumberError.textContent = '';
        }

        // Email Validation
        const email = document.getElementById('email').value.trim();
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if (!emailPattern.test(email) || email.length > 45) {
            isValid = false;
            emailError.textContent = 'Please enter a valid Email address';
        } else {
            emailError.textContent = '';
        }

        // Captcha Validation
        const captchaInput = document.getElementById('captchaInput').value.trim();
        const captchaError = document.getElementById('captchaError');
        if (captchaInput !== generatedCaptcha) {
            isValid = false;
            captchaError.textContent = 'Captcha does not match. Please try again.';
        } else {
            captchaError.textContent = '';
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            console.error("Form validation failed.");
        }
    });

    // Captcha generation
    let generatedCaptcha = "";

    function generateCaptcha(event) {
        if (event) event.preventDefault();
        const canvas = document.getElementById("captchaCanvas");
        const ctx = canvas.getContext("2d");
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        generatedCaptcha = "";

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = "#f4f4f4";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        for (let i = 0; i < 6; i++) {
            generatedCaptcha += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        ctx.font = "24px Arial";
        ctx.fillStyle = "#333";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText(generatedCaptcha, canvas.width / 2, canvas.height / 2);
    }


      // Validate captcha input
      function validateCaptcha() {
        const captchaInput = document.getElementById("captchaInput").value;
        const captchaError = document.getElementById("captchaError");
        if (captchaInput === generatedCaptcha) {
            captchaError.textContent = "";
            submitButton.disabled = false;
        } else {
            captchaError.textContent = "Captcha does not match.";
            submitButton.disabled = true;
        }
    }
    // Generate initial captcha
    window.onload = generateCaptcha;
</script>