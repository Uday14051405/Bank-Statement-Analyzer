<!-- resources/views/home.blade.php -->
@extends('frontend.app')
@section('pageclass')
<div class="homePage">
@endsection
@section('header')
@include('frontend.header') {{-- Include header content --}}
@endsection

@section('content')
<div class="heroSection" style="background:url(https://d125.vvelocity.com/rumble/static/media/heroBanner.a852aeb9e373f053c45c.png) !important">
    <h1 class="heroHeading">
        India's Leading
        <span style="color: rgb(255, 215, 0)">Receivable Sales & Purchase Trading Activity
        Platform
    </h1>
    <div class="statsBoxContainer">
        <div class="statsBox">
            <img src="https://rumbble.co/static/media/activeInvestor.6dd15a88598b0ce67083b3b367e1c764.svg" alt="" />
            <h6 class="statNumber">25</h6>
            <p class="statTitle">Active Investor</p>
        </div>
        <div class="statsBox">
            <img src="https://rumbble.co/static/media/amountInvested.b87aceabd85de016880f500c157fa256.svg" alt="" />
            <h6 class="statNumber">20</h6>
            <p class="statTitle">Invoice Discounted</p>
        </div>
        <div class="statsBox">
            <img src="https://rumbble.co/static/media/amountInvested.b87aceabd85de016880f500c157fa256.svg" alt="" />
            <h6 class="statNumber">Rs.10 Crores</h6>
            <p class="statTitle">Amount Invested</p>
        </div>
        <div class="statsBox">
            <img src="https://rumbble.co/static/media/blueChipCompany.a03a06a4126d4ba3c3b27c667338c2cc.svg" alt="" />
            <h6 class="statNumber">10</h6>
            <p class="statTitle">Blue chip companies</p>
        </div>
    </div>
</div>
<div class="whyRumbble infoSection">
    <h2 class="infoHeading">
        WHY <span style="color: rgb(255, 215, 0)">RUMBBLE</span> FOR
        <br />
        Receivable Sales & Purchase Trading Activity?
    </h2>
    <hr />
    <div class="iconBoxContainer">
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/minimalRisk.4cae1bdabb632e8cc85e78053c8a0330.svg" alt="" />
            <h6 class="iconTitle">Minimal Risk</h6>
            <p class="iconDesc">
                Every invoice is verified before getting listed on the
                Rumbble platform
            </p>
        </div>
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/shortTermMaturity.1f52910962672056ffff5debc872ea87.svg" alt="" />
            <h6 class="iconTitle">Short-term Maturity</h6>
            <p class="iconDesc">
                Earn quick returns within a short time frame of 30-90 days
            </p>
        </div>
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/partialPayment.1d6c7cf9cd2f1c9b84281464682de372.svg" alt="" />
            <h6 class="iconTitle">Pay Partial or Full</h6>
            <p class="iconDesc">
                You decide your invested amount. No need to pay the invoice
                in full
            </p>
        </div>
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/highReturns.2890a3e86b9f6b1945e42e362167eddb.svg" alt="" />
            <h6 class="iconTitle">High Returns</h6>
            <p class="iconDesc">
                On our platform, get returns as high as 15% at low-risk
            </p>
        </div>
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/riskAnalysis.dd4733777174a5f8742c00f2b1c50c63.svg" alt="" />
            <h6 class="iconTitle">Risk Analysis</h6>
            <p class="iconDesc">
                We arrive at a Rumbble score for every enrolled borrower
                after analyzing multiple stages
            </p>
        </div>
        <div class="iconBox">
            <img src="https://rumbble.co/static/media/easyProcess.d3396aef4cc8b9fcdb7dc004be2e1e78.svg" alt="" />
            <h6 class="iconTitle">Quick and Easy Process</h6>
            <p class="iconDesc">
                Easy onboarding and the quick paperless process will save
                your time and effort
            </p>
        </div>
    </div>
</div>
<div class="stepRumbble infoSection">
    <h2 class="infoHeading">
        HOW DOES
        <span style="color: rgb(255, 215, 0)">RUMBBLE</span> Receivable Sales & Purchase Trading Activity
    </h2>
    <hr />
    <div class="stepContainer">
        <div class="step">
            <p class="stepNumber">1.</p>
            <p class="stepTitle">Quick Sign Up</p>
            <p class="stepDesc">
                Sign up online to become an investor on the Rumbble platform
            </p>
        </div>
        <div class="step">
            <p class="stepNumber">2.</p>
            <p class="stepTitle">Complete KYC</p>
            <p class="stepDesc">
                Complete the KYC process after submitting the requisite
                documents
            </p>
        </div>
        <div class="step">
            <p class="stepNumber">3.</p>
            <p class="stepTitle">Buy Invoice</p>
            <p class="stepDesc">
                Start investing in your desired invoices with a single click
            </p>
        </div>
        <div class="step">
            <p class="stepNumber">4.</p>
            <p class="stepTitle">Bank Transfer</p>
            <p class="stepDesc">
                Get returns directly into your bank account on the maturity
                date
            </p>
        </div>
    </div>
</div>
<div class="testimonial infoSection">
    <h2 class="infoHeading">
        WHAT PEOPLE ARE SAYING <br />
        ABOUT <span style="color: rgb(255, 215, 0)">RUMBBLE</span>?
    </h2>
    <hr />
    <div class="testimonialBox">
        <div class="testimonialContainer">
            <div class="testimonial">
                <img src="static/media/fiveStar.49c5f8d161203ab5bef8.png" alt="" class="star" />
                <p class="name">Vikram Chopra</p>
                <p class="desc">
                    I search for possibilities to invest in that are secure
                    and yield strong profits. I'm happy I found Rumbble
                    because they provided me with excellent financial returns.
                </p>
            </div>
            <div class="testimonial">
                <img src="static/media/fiveStar.49c5f8d161203ab5bef8.png" alt="" class="star" />
                <p class="name">Amit Shah</p>
                <p class="desc">
                    Having a platform like Rumbble that allows me to invest
                    for a shorter amount of time and pays higher returns than
                    the majority of other investment options is excellent.
                </p>
            </div>
            <div class="testimonial">
                <img src="static/media/fiveStar.49c5f8d161203ab5bef8.png" alt="" class="star" />
                <p class="name">Varun Goel</p>
                <p class="desc">
                    Rumbble offers investors a great chance because their
                    money isn't locked up for a longer period of time and they
                    can access it more quickly.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="contactSection infoSection">
    <h2 class="infoHeading">CONTACTS</h2>
    <hr />
    <div class="contactContainer">
        <div class="contactDetails">
            <div class="contactItem">
                <img src="https://rumbble.co/static/media/locationIcon.a4a67a364165c6c76ce2ce3670d35d6c.svg" alt="" />
                <div class="details">
                    <p class="title">Address:</p>
                    <p class="desc">
                        108, 10th Floor, Pt no. 228, B.R Patel Marg, Mittal
                        Chamber, Nariman Point, Maharashtra, India, 400021
                    </p>
                </div>
            </div>
            <div class="contactItem">
                <img src="https://rumbble.co/static/media/phoneIcon.6c4177620a9bc201a299c176c0a505f4.svg" alt="" />
                <div class="details">
                    <p class="title">Phone:</p>
                    <p class="desc">022-22813137/8</p>
                </div>
            </div>
            <div class="contactItem">
                <img src="https://rumbble.co/static/media/emailIcon.16ad61a17f72a1fdb1fb22d17850a15c.svg" alt="" />
                <div class="details">
                    <p class="title">Email:</p>
                    <p class="desc">info@test.technoberg.in</p>
                </div>
            </div>
        </div>
        <div class="map">
            <iframe title="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3774.1105352458076!2d72.81718997906526!3d18.926500910897726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7d1eecb1a89eb%3A0x7bf6c6ca47706ce!2sMittal%20Chambe.%20New%20India%20assurance!5e0!3m2!1sen!2sin!4v1708027531649!5m2!1sen!2sin" height="350" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border: 0px; width: 100%"></iframe>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('frontend.footer') {{-- Include footer content --}}
@endsection