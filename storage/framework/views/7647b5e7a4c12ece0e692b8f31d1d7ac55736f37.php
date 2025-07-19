<?php echo $__env->make('frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    * {
        font-family: Poppins, var(--default-font-family) !important;
    }

    .nav-tabs .nav-link {
        background-color: none !important;
        border-color: none !important;
    }
</style>

<!-- CSS for Bank Statement Analyser Section -->
<style>
    .analyser-section {
        padding: 60px 0;
        background-color: rgba(255, 255, 255, 0.7);
        /* transparent background */
    }

    .analyser-image {
        max-width: 300px;
        margin: 0 auto;
    }

    .analyser-image img {
        width: 70%;
        height: auto;
    }

    .analyser-title {
        color: #002B5B;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 20px 0;
    }

    .btn-try {
        background-color: #E31C5F;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-try:hover {
        background-color: #C81853;
        color: white;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .analyser-section {
            padding: 40px 0;
            text-align: center;
        }

        .analyser-image {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .analyser-title {
            font-size: 2rem;
            margin: 15px 0;
        }

        .btn-try {
            margin-top: 20px;
        }
    }
</style>

<style>
    /*-------------------------------------
     FAQ
--------------------------------------*/


    .custom-toggle {
        font-family: 'Poppins';
        /* font-family: Arial, sans-serif; */
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        width: 400px;
        margin: 20px auto;
    }

    .toggle-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 1.5rem;
        position: relative;
        /* padding-left: 35px; */
    }

    .toggle-header .arrow {
        cursor: pointer;
        height: 32px;
        /* Circle size */
        width: 31px;
        /* Circle size */
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        border-radius: 50%;
        /* Make the background circular */
        /* background-color: #f1f1f1; */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* .toggle-header.active {
border: 1px solid #273896;
} */

    .toggle-header .arrow::before {
        content: '';
        border: solid #29397d;
        /* Arrow color */
        border-width: 0 2px 2px 0;
        /* Create an arrow shape */
        display: inline-block;
        padding: 4px;
        /* Arrow size */
        transform: rotate(-135deg);
        /* Default: Arrow pointing up */
        transition: transform 0.3s ease;
    }

    /* When div is open, rotate the arrow to point down */
    .toggle-header.active .arrow::before {
        transform: rotate(45deg);
        /* Arrow pointing down */
    }

    /* Circle background and shadow for active state */
    .toggle-header.active .arrow {
        background-color: #29397d;
        /* Blue color when open */
        /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); */
    }

    .toggle-header.active .arrow::before {
        border-color: #fff;
        /* Change arrow color to white when open */
    }

    .toggle-content {
        display: none;
        padding: 0px 15px;
        background-color: #ffffff;
        animation: slideDown 0.3s ease forwards;
        /* border-top: 1px solid #ddd; */
    }

    .toggle-content.show {
        display: block;
    }

    @keyframes  slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .frame-96 {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 40px;
        margin: 50px auto;
        width: 100%;
        /* Adjusted width for responsiveness */
        max-width: 1200px;
        /* Limit width on larger screens */
        z-index: 1;
    }

    .fi-partners,
    .referrals-partners,
    .customers-lakhs,
    .integrations,
    .portfolio-cr,
    .universe-cr {
        flex-shrink: 0;
        /* text-align: center; */
        /* Center text in smaller screens */
        font-size: 26px;
        /* Adjusted font size for smaller screens */
        font-weight: 400;
        line-height: 1.5;
        white-space: nowrap;
        z-index: 2;
        color: #000000;
        font-family: Poppins, var(--default-font-family);
    }

    .text-6,
    .text-8,
    .text-a,
    .text-c,
    .text-e,
    .text-10 {
        font-size: 27px;
        /* Adjusted for better readability on smaller screens */
        font-weight: 500;
        color: #000000;
        font-family: Poppins, var(--default-font-family);
    }

    .line,
    .line-99,
    .line-9a,
    .line-9c,
    .line-9d {
        width: 1px;
        height: 46px;
        /* Adjusted height for smaller screens */
        background: #ccc;
        /* Simplified background for performance */
        z-index: 3;
        color: #000000;
        font-family: Poppins, var(--default-font-family);
    }

    .universe,
    .portfolio,
    .integrations-9b,
    .customers,
    .fi-partners-97,
    .referrals-partners-98 {
        font-size: 19px;
        color: #000000;
        font-family: Poppins, var(--default-font-family);
    }

    /* Media queries for responsiveness */
    @media (max-width: 768px) {
        .frame-96>div {
            width: 50%;
            /* Stack items in a single column */
        }

        .frame-96>div::after {
            display: none;
            /* Hide the dividing line in stacked layout */
        }

        .fi-partners,
        .referrals-partners,
        .customers-lakhs,
        .integrations,
        .portfolio-cr,
        .universe-cr {
            font-size: 18px;
        }

        .text-6,
        .text-8,
        .text-a,
        .text-c,
        .text-e,
        .text-10 {
            font-size: 20px;
        }

        .line,
        .line-99,
        .line-9a,
        .line-9c,
        .line-9d {
            width: 1px;
            height: 1px;
            /* Adjusted height for smaller screens */
            background: #ccc;
            /* Simplified background for performance */
            z-index: 3;
        }

    }

    @media (max-width: 576px) {

        .fi-partners,
        .referrals-partners,
        .customers-lakhs,
        .integrations,
        .portfolio-cr,
        .universe-cr {
            font-size: 16px;
        }

        .text-6,
        .text-8,
        .text-a,
        .text-c,
        .text-e,
        .text-10 {
            font-size: 18px;
        }

        .line,
        .line-99,
        .line-9a,
        .line-9c,
        .line-9d {
            width: 1px;
            height: 1px;
            /* Adjusted height for smaller screens */
            background: #ccc;
            /* Simplified background for performance */
            z-index: 3;
        }

        #home .leverage {
            text-align: center !important;
        }

        .why-title {
            font-size: 18px !important;
        }

        .text-collapse {
            font-size: 1.3em !important;
        }

    }
</style>


<!--welcome-hero start -->
<section id="home" class="container-xxl welcome-hero">
    <div class="container">
        <div class="row g-5 align-items-end">
            <div class="col-lg-6 col-sm-6 text-center text-lg-start welcome-hero-txt1">
                <p class="bank">Bank Statement Analyser for 360-degree view of Financial Health</p>
                <span class="leverage">Leverage advanced AI and ML models trained on over 500 data points to assist banks and financial institutions in identifying red flags efficiently</span>
                <a href="signup" class="btn welcome-btn py-sm-3 px-sm-5 btn-lg">Try Now</a>
            </div>

            <div class="col-lg-6 col-sm-6 text-center text-lg-start welcome-hero-txt">
                <img class="img-fluid imge1 animated zoomIn" src="assets_front/img/img.png" alt="">
                <!-- <img class="img-fluid animated zoomIn" src="img/hero.png" alt=""> -->
            </div>
        </div>
    </div>
</section>
<!--welcome-hero end -->

<!--list-topics start -->
<section id="list-topics" class="list-topics py-4 hidden" hidden>
    <div class="container">
        <div class="list-topics-content">
            <div class="frame-96">
                <div class="fi-partners">
                    <span class="fi-partners-97">FI Partners<br /></span><span class="text-6">100+</span>
                </div>
                <div class="line"></div>
                <div class="referrals-partners">
                    <span class="referrals-partners-98">Referrals Partners<br /></span><span class="text-8">15000+</span>
                </div>
                <div class="line-99"></div>
                <div class="customers-lakhs">
                    <span class="customers">Customers<br /></span><span class="text-a">4 Lakhs</span>
                </div>
                <div class="line-9a"></div>
                <div class="integrations">
                    <span class="integrations-9b">Integrations<br /></span><span class="text-c">100+</span>
                </div>
                <div class="line-9c"></div>
                <div class="portfolio-cr">
                    <span class="portfolio">Portfolio<br /></span><span class="text-e">10000 Cr+</span>
                </div>
                <div class="line-9d"></div>
                <div class="universe-cr">
                    <span class="universe">Universe<br /></span><span class="text-10">5 Cr+</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!--list-topics end-->


<!--works start -->
<section id="works" class="works py-5">
    <div class="container">
        <div class="section-header1 text-center mb-4">
            <h2>Top Challenges with Traditional Bank Statement Analysis Processes</h2>
            <p>Manual verification can be time consuming and prone to errors</p>
        </div>
        <div class="works-content">
            <div class="row g-4" id="sidepace">
                <div class="col-md-4 col-sm-6">
                    <div class="single-how-works flex-grow-1" style="background:#f0f5ff;">
                        <div class="single-how-works-icon mb-3">
                            <img class="single-space" alt="" src="assets_front/img/Clip path group.png">
                        </div>
                        <p class="mb-2">Resource Heavy Process</p>
                        <p class="para">Operationally inefficient, manual analysis is huge drain of costs, non-scalable and susceptible to errors.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-how-works flex-grow-1" style="background:#fde6f2;">
                        <div class="single-how-works-icon mb-3">
                            <img class="single-space" alt="" src="assets_front/img/Clip path group-1.png">
                        </div>
                        <p class="mb-2">Physical Document Submissions</p>
                        <p class="para" style="margin-top: 0% !important;">Physical Account statement submissions are a huge hassle to maintain for compliance, and come with privacy concerns</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-how-works flex-grow-1" style="background:#f5f6f7;">
                        <div class="single-how-works-icon mb-3">
                            <img class="single-space" alt="" src="assets_front/img/Clip path group-2.png">
                        </div>
                        <p class="mb-2">Unconfirmed Authenticity</p>
                        <p class="para">Manual processes are unable to identify tampered or unauthentic statements.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--works end -->


<section id="features" class="features py-5">
        <div class="container">
            <div class="section-header text-center mb-4">
                <h2>Bank Statement Analyser API Features</h2>
            </div>
            <div class="features-content">
                <!-- <ul class="nav nav-tabs justify-content-center mb-4" id="featureTabs" role="tablist" style="margin-bottom: 0px !important;">
                    <center>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="financial-health-tab" data-bs-toggle="tab" data-bs-target="#financial-health" type="button" role="tab">Financial Health <br> Analysis</button>
                        </li>
                    </center>
                    <center>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-integration-tab" data-bs-toggle="tab" data-bs-target="#data-integration" type="button" role="tab">Data Integration<br> and Collection</button>
                        </li>
                    </center>
                    <center>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="verification-tab" data-bs-toggle="tab" data-bs-target="#verification" type="button" role="tab">Verification and<br> Anomaly Detection</button>
                        </li>
                    </center>
                    <center>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reporting-tab" data-bs-toggle="tab" data-bs-target="#reporting" type="button" role="tab">Reporting and<br> Insights</button>
                        </li>
                    </center>
                </ul> -->
                <!-- <div class="tab-content" id="featureTabsContent"> -->
                    <!-- Financial health -->

                    <!-- <div class="tab-pane show active" id="financial-health" role="tabpanel"> -->
                    <div class="tab-pane" id="financial-health" role="tabpanel">
                        <div class="row align-items-center">
                            <p class="feature-intro">Utilize advanced analytics to obtain a comprehensive view of a customer's financial status, integrating multiple data points for thorough evaluation.</p>
                            <div class="col-lg-6">

                                <div class="feature-list">
                                    <div class="feature-item">
                                        <i class="fa-solid fa-rotate"></i>
                                        <div class="feature-text">
                                            <h3>360-degree Financial Health:</h3>
                                            <p>Leverages data on payment histories, transaction patterns, and account balances to offer a holistic view of financial status.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <div class="feature-text">
                                            <h3>Data Integration and Collection:</h3>
                                            <p>Collectes information across multiple accounts to give a holistic view of the financial standing of the account holder.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        <div class="feature-text">
                                            <h3>Verification and Anomaly Detection:</h3>
                                            <p>Can identify tampered statements and anomaly transactions.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-file"></i>
                                        <div class="feature-text">
                                            <h3>Reporting and Insights:</h3>
                                            <p>Access to details like income and obligation, expenditure trends, derived information for underwriting all at the click of a button.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-image">
                                    <img src="assets_front/img/Frame 48096815.png" alt="Financial Analysis Dashboard" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data integration -->

                    <!-- <div class="tab-pane" id="data-integration" role="tabpanel">
                        <div class="row align-items-center">
                            <p class="feature-intro">Utilize advanced analytics to obtain a comprehensive view of a customer's financial status, integrating multiple data points for thorough evaluation.</p>
                            <div class="col-lg-6">

                                <div class="feature-list">
                                    <div class="feature-item">
                                        <i class="fa-solid fa-rotate"></i>
                                        <div class="feature-text">
                                            <h3>360-degree Financial Health:</h3>
                                            <p>Leverages data on payment histories, transaction patterns, and account balances to offer a holistic view of financial status.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <div class="feature-text">
                                            <h3>Expense and Income Identification:</h3>
                                            <p>Utilizes sophisticated algorithms to accurately identify and categorize income and expenses, giving precise insights into financial behavior and trends.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        <div class="feature-text">
                                            <h3>Obligation Identification:</h3>
                                            <p>Applies advanced financial models to evaluate debts and liabilities, offering a clear picture of financial commitments and repayment capacities.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-image">
                                    <img src="assets/img/Frame 48096815.png" alt="Financial Analysis Dashboard" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Verification -->

                    <!-- <div class="tab-pane" id="verification" role="tabpanel">
                        <div class="row align-items-center">
                            <p class="feature-intro">Utilize advanced analytics to obtain a comprehensive view of a customer's financial status, integrating multiple data points for thorough evaluation.</p>
                            <div class="col-lg-6">

                                <div class="feature-list">
                                    <div class="feature-item">
                                        <i class="fa-solid fa-rotate"></i>
                                        <div class="feature-text">
                                            <h3>360-degree Financial Health:</h3>
                                            <p>Leverages data on payment histories, transaction patterns, and account balances to offer a holistic view of financial status.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <div class="feature-text">
                                            <h3>Expense and Income Identification:</h3>
                                            <p>Utilizes sophisticated algorithms to accurately identify and categorize income and expenses, giving precise insights into financial behavior and trends.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        <div class="feature-text">
                                            <h3>Obligation Identification:</h3>
                                            <p>Applies advanced financial models to evaluate debts and liabilities, offering a clear picture of financial commitments and repayment capacities.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-image">
                                    <img src="assets/img/Frame 48096815.png" alt="Financial Analysis Dashboard" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Reporting -->

                    <!-- <div class="tab-pane" id="reporting" role="tabpanel">
                        <div class="row align-items-center">
                            <p class="feature-intro">Utilize advanced analytics to obtain a comprehensive view of a customer's financial status, integrating multiple data points for thorough evaluation.</p>
                            <div class="col-lg-6">

                                <div class="feature-list">
                                    <div class="feature-item">
                                        <i class="fa-solid fa-rotate"></i>
                                        <div class="feature-text">
                                            <h3>360-degree Financial Health:</h3>
                                            <p>Leverages data on payment histories, transaction patterns, and account balances to offer a holistic view of financial status.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <div class="feature-text">
                                            <h3>Expense and Income Identification:</h3>
                                            <p>Utilizes sophisticated algorithms to accurately identify and categorize income and expenses, giving precise insights into financial behavior and trends.</p>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        <div class="feature-text">
                                            <h3>Obligation Identification:</h3>
                                            <p>Applies advanced financial models to evaluate debts and liabilities, offering a clear picture of financial commitments and repayment capacities.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="feature-image">
                                    <img src="assets/img/Frame 48096815.png" alt="Financial Analysis Dashboard" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
    </section>

<!-- Bank Statement Analyser -->
<section class="analyser-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="analyser-image">
                    <img src="assets_front/img/Other 08 1.png" alt="Bank Statement" class="img-fluid">
                </div>
            </div>
            <div class="col-md-5">
                <h2 class="analyser-title" style="font-size: 42px;">Bank Statement Analyser</h2>
            </div>
            <div class="col-md-3">
                <center>
                    <a href="signup" class="btn welcome-btn py-sm-3 px-sm-5 btn-lg" style="background-color: #ed217c; color: white; font-size: 1.5rem;font-weight: 700;">Try Now</a>
                </center>
            </div>
        </div>
    </div>
</section>


<!--explore start -->
<section id="explore" class="explore">
    <div class="container">
        <div class="section-header2">
            <h2>Use Cases of Bank Statement Analyser API</h2>
            <!-- <p>Explore New place, food, culture around the world and many more</p> -->
        </div>
        <div class="explore-content">
            <div class="single-explore-card">
                <!-- <i class="icon fas fa-user"></i> -->
                <i class="icon"><img class="iconic" src="assets_front/img/Icons.png"></i>
                <div class="single-explore-item">
                    <h2 class="title">Insurance Underwriting</h2>
                    <p class="description">Improve risk assessment during the insurance underwriting process by analysing the financial behaviour and transaction history of applicants, leading to more accurate premium calculations and policy terms.</p>
                </div>
            </div>
            <div class="single-explore-card">
                <!-- <i class="icon fas fa-check-circle"></i> -->
                <i class="icon"><img class="iconic" src="assets_front/img/Icons-1.png"></i>
                <div class="single-explore-item">
                    <h2 class="title">Corporate Expense Verification</h2>
                    <p class="description">Verify employee expense claims by auditing bank statements to ensure compliance with company policies, reducing the likelihood of fraudulent or erroneous claims.</p>
                </div>
            </div>
            <div class="single-explore-card">
                <!-- <i class="icon fas fa-search"></i> -->
                <i class="icon"><img class="iconic" src="assets_front/img/Icons-2.png"></i>
                <div class="single-explore-item">
                    <h2 class="title">KYC and Fraud Detection</h2>
                    <p class="description">Automate the verification of customer identity & financial behaviour. This approach ensures adherence to regulary standards & mitigates potiential fraud risks.</p>
                </div>
            </div>
            <div class="single-explore-card">
                <!-- <i class="icon fas fa-chart-line"></i> -->
                <i class="icon"><img class="iconic" src="assets_front/img/Icons-3.png"></i>
                <div class="single-explore-item">
                    <h2 class="title">Loan Processing</h2>
                    <p class="description">Improve risk assessment during the insurance underwriting process by analysing the financial behaviour and transaction history of applicants, leading to more accurate premium calculations and policy terms.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--explore end -->


<!--why-us-->
<section id="why-us" class="why-us section-bg">
    <div class="container-fluid" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                <div class="content">
                    <h1 class="text-center">FAQ's of Bank Statement Analyser API</h1>

                </div>

                <div class="accordion-list">
                    <ul>
                        <li id="boxT1">
                            <div class="toggle-header active" data-target="accordion-list-1">
                                <h5 class="why-title text-wrap">What is a Bank Statement Analyser?</h5>
                                <div class="arrow">
                                    <div class="arrow-top"></div>
                                    <div class="arrow-bottom"></div>
                                </div>
                            </div>
                            <div id="accordion-list-1" class="toggle-content show">
                                <p class="text-collapse text-wrap" style="font-size:1.5em">
                                    A bank statement analyser is a tool that helps analyse and interpret bank statements. It automatically extracts transactional data from the statements to provide insight on the financial health of the account holder.
                                </p>
                            </div>
                        </li>

                        <!-- <li id="boxT2">
                                <div class="toggle-header" data-target="accordion-list-2">
                                    <h5 class="why-title text-wrap">Why is a Bank Statement Analyser important?</h5>
                                    <div class="arrow">
                                        <div class="arrow-top"></div>
                                        <div class="arrow-bottom"></div>
                                    </div>
                                </div>
                                <div id="accordion-list-2" class="toggle-content">
                                    <p class="text-collapse text-wrap" style="font-size:1.5em">It saves time and reduces errors in financial analysis.</p>
                                </div>
                            </li> -->
                        <li id="boxT3">
                            <div class="toggle-header" data-target="accordion-list-3">
                                <h5 class="why-title text-wrap">How does a Bank Statement Analyser work?</h5>
                                <div class="arrow">
                                    <div class="arrow-top"></div>
                                    <div class="arrow-bottom"></div>
                                </div>
                            </div>
                            <div id="accordion-list-3" class="toggle-content">
                                <p class="text-collapse text-wrap" style="font-size:1.5em">The bank statement analyser extracts data from native bank statements and aligns it to give meaningful insight on the behaviour of the account holder. The analyser also has the ability to combine the output for various accounts held by the same individual.</p>
                            </div>
                        </li>
                        <li id="boxT4">
                            <div class="toggle-header" data-target="accordion-list-4">
                                <h5 class="why-title text-wrap">What are the key features of Bank Statement Analyser?</h5>
                                <div class="arrow">
                                    <div class="arrow-top"></div>
                                    <div class="arrow-bottom"></div>
                                </div>
                            </div>
                            <div id="accordion-list-4" class="toggle-content">
                                <p class="text-collapse text-wrap" style="font-size:1.5em">Financial insights, fraud detection, and data verification.</p>
                            </div>
                        </li>
                        <li id="boxT5">
                            <div class="toggle-header" data-target="accordion-list-5">
                                <h5 class="why-title text-wrap">How do you see the output of the Bank Statement Analyser?</h5>
                                <div class="arrow">
                                    <div class="arrow-top"></div>
                                    <div class="arrow-bottom"></div>
                                </div>
                            </div>
                            <div id="accordion-list-5" class="toggle-content">
                                <p class="text-collapse text-wrap" style="font-size:1.5em">The Bank Statement Analyser is capable of creating excel, .csv and json outputs making it accessible to all kind of users.</p>
                            </div>
                        </li>
                        <!-- <li id="boxT6">
                                <div class="toggle-header" data-target="accordion-list-6">
                                    <h5 class="why-title text-wrap">What is the primary function of the Bank Statement Analyser?</h5>
                                    <div class="arrow">
                                        <div class="arrow-top"></div>
                                        <div class="arrow-bottom"></div>
                                    </div>
                                </div>
                                <div id="accordion-list-6" class="toggle-content">
                                    <p class="text-collapse text-wrap" style="font-size:1.5em">Financial insights, fraud detection, and data verification.</p>
                                </div>
                            </li> -->
                        <!-- <li id="boxT7">
                                <div class="toggle-header" data-target="accordion-list-7">
                                    <h5 class="why-title text-wrap">Which industries benefit from this solution?</h5>
                                    <div class="arrow">
                                        <div class="arrow-top"></div>
                                        <div class="arrow-bottom"></div>
                                    </div>
                                </div>
                                <div id="accordion-list-7" class="toggle-content">
                                    <p class="text-collapse text-wrap" style="font-size:1.5em">Financial insights, fraud detection, and data verification.</p>
                                </div>
                            </li> -->
                        <!-- <li id="boxT8">
                                <div class="toggle-header" data-target="accordion-list-8">
                                    <h5 class="why-title text-wrap">What types of reports can it generate?</h5>
                                    <div class="arrow">
                                        <div class="arrow-top"></div>
                                        <div class="arrow-bottom"></div>
                                    </div>
                                </div>
                                <div id="accordion-list-8" class="toggle-content">
                                    <p class="text-collapse text-wrap" style="font-size:1.5em">Financial insights, fraud detection, and data verification.</p>
                                </div>
                            </li> -->
                    </ul>
                </div>


            </div>

            <!-- <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style="background-image: url(&quot;img/why-us.png&quot;);" data-aos="zoom-in" data-aos-delay="150">
                &nbsp;</div> -->
        </div>

    </div>
</section>


<?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Include jQuery -->
<script src="<?php echo e(asset('assets_front/js/jquery.js')); ?>"></script>

<!-- modernizr.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

<!-- bootstrap.min.js -->
<script src="<?php echo e(asset('assets_front/js/bootstrap.min.js')); ?>"></script>

<!-- bootsnav js -->
<script src="<?php echo e(asset('assets_front/js/bootsnav.js')); ?>"></script>

<!-- feather.min.js -->
<script src="<?php echo e(asset('assets_front/js/feather.min.js')); ?>"></script>

<!-- counter js -->
<script src="<?php echo e(asset('assets_front/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/waypoints.min.js')); ?>"></script>

<!-- slick.min.js -->
<script src="<?php echo e(asset('assets_front/js/slick.min.js')); ?>"></script>

<!-- Custom JS -->
<script src="<?php echo e(asset('assets_front/js/custom.js')); ?>"></script>

<!-- Script for features tab options -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all tab buttons
        const tabButtons = document.querySelectorAll('.features .nav-link');

        // Add click event listeners
        tabButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all buttons and tab panes
                tabButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.features .tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Add active class to clicked button
                this.classList.add('active');

                // Show corresponding tab content
                const targetId = this.getAttribute('data-bs-target').substring(1); // Remove the # from the ID
                const targetPane = document.getElementById(targetId);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
            });
        });
    });
</script>

<!-- Script for financial health tab -->
<script>
    $(document).ready(function() {
        // Show financial health tab by default
        $('#financial-health').addClass('show active');
    });
</script>

<!-- Script for toggle headers -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleHeaders = document.querySelectorAll('.toggle-header');

        toggleHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const targetId = header.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);

                // Toggle visibility of the content
                targetContent.classList.toggle('show');

                // Toggle the active class on the header to rotate the arrow
                header.classList.toggle('active');
            });
        });
    });
</script>
</body>

</html><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views/frontend/home.blade.php ENDPATH**/ ?>