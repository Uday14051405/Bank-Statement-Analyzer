<!-- resources/views/home.blade.php -->
@extends('frontend.app')
@section('pageclass')
<div class="privacyPolicy">
@endsection
@section('header')
@include('frontend.header') {{-- Include header content --}}
@endsection

@section('content')
<div class="heroBanner">
              <h1 class="siteTitle">Privacy Policy</h1>
            </div>
            <div class="bodyText">
              <h2 class="bodyTitle">Privacy Policy</h2>
              <p>
                This privacy policy outlines how we make use of the information
                you submit to us during registration and your upload or sync of
                invoices. Please note that this privacy policy does not apply to
                any information you provide to third parties in connection with
                websites hosted by Rumbble (Hottcart Ecommerce Pvt. Ltd) <br />
                <br />Rumbble (Hottcart Ecommerce Pvt. Ltd) reserves the right to modify
                this privacy policy at any time. To protect your interests,
                please visit this page periodically to review the current terms
                of our privacy policy. <br />
                <br />By using the website, filling out any forms or if you use
                our services you approve that we use your information or the
                company information you provide and we collect from you.
              </p>
              <h2 class="bodyTitle">COLLECTED INFORMATION</h2>
              <p>
                Personal information is requested when you register to become a
                member. During registration, you are asked to provide your name,
                email address, postal or post code, etc. The more information
                you submit and the more accurate it is, the better we are able
                to tailor our services to your needs. <br />
                <br />Additional information, such as your IP address, operating
                system, or browser information, may be collected whenever you
                interact with us or our website. We collect this information in
                order to compile usage statistics and for your safety. <br />
                <br />Information that you provide for any third-party
                integration within our website is used to your account only. We
                may store your account ID, your access token, and certain pieces
                of information that are returned by the integration in order to
                maintain the connection between your third-party integration and
                your corresponding account
              </p>
              <h2 class="bodyTitle">Cookies</h2>
              <p>
                Whenever you interact with us or our website, Rumbble may place
                a “cookie” in the browser files of your computer. Cookies are
                data files that help your browser communicate with Rumbble
                (Hottcart Ecommerce Pvt. Ltd). <br />
                <br />Most browsers are set to accept cookies by default. You
                can reject or block cookies by changing your browser settings.
                However, if your browser rejects or blocks a cookie, it may
                impact your ability to use some of our website and our service.
              </p>
              <h2 class="bodyTitle">USE OF INFORMATION</h2>
              <p>
                Rumbble (Hottcart Ecommerce Pvt. Ltd) purpose in collecting personal
                information is to identify the member as well as to send recent
                updates and important announcements via post and/or email. In
                order to serve our members better, we do research on our
                members’ demographics and interests based on the information you
                submitted to us upon registration. <br />
                <br />We will not disclose or transfer your personal information
                to any third parties except as outlined in this privacy policy.
                We reserve the right to disclose or transfer your personal
                information under the following conditions: <br />
                <br />
                <ul style="padding: 0px 20px">
                  <li>We have your consent to do so.</li>
                  <li>
                    We believe that it is necessary to do so in order to respond
                    to any claims.
                  </li>
                  <li>
                    We believe that it is necessary to do so in order to comply
                    with the law, legal processes, or authorities.
                  </li>
                  <li>
                    We believe that it is necessary to do so in order to protect
                    the rights, property, interests, or safety of Rumbble Our
                    employees, our users, or the public.
                  </li>
                  <li>
                    We are required to do so in connection with an acquisition,
                    merger, or sale of all or a portion of our business.
                  </li>
                </ul>
              </p>
              <h2 class="bodyTitle">CONTACT US</h2>
              <p>
                If you believe Rumbble is not abiding by its posted privacy
                policy, or if you want to remove anything according to the
                regulation, or if you have any comments, please let us know.
              </p>
            </div>
@endsection

@section('footer')
@include('frontend.footer') {{-- Include footer content --}}
@endsection