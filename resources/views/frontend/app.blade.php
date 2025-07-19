@php
$setting = \App\Models\Setting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'BSA - Bank Statement Analysis')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicon -->
    @if($setting->website_favicon != null || !empty($setting->website_favicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{$setting->website_favicon}}">
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_front/admin/img/favicon-def.png') }}">
    @endif

    {{-- Add Font Awesome and Bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">

    {{-- Local CSS --}}
    <link rel="stylesheet" href="{{ asset('assets_front/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/bootsnav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_front/css/responsive.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Poppins" rel="stylesheet">

    {{-- Inline Styles --}}
    <style>
        :root {
            --default-font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC",
                "Hiragino Sans GB", "Microsoft Yahei UI", "Microsoft Yahei",
                "Source Han Sans CN", sans-serif !important;
        }

        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: #1ebbf4;
            /* color: #0087ca; */
        }

        .hover-underline-animation::after {
            content: '';
            position: absolute;
            width: 95%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 15px;
            background-color: #1ebbf4;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }

        .hover-underline-animation:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .bi-list::before {
            content: "\f479";
            color: black;
        }


        #header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            width: 100%;
            z-index: 1000;
            top: 0;
            position: fixed;
        }

        #header .logo img {
            max-height: 50px;
        }



        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        #header .getstarted20 {
            background-color: #ed217c;
            /* background: linear-gradient(to bottom right, #27cafd, #028ad7); */
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
            /* margin-left: 15px; */
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .header-container {
                /* flex-direction: column; */
                align-items: center;
                /* text-align: center; */
            }

            /* #left20, */
            #right20 {
                width: 100%;
                justify-content: end;
                /* margin-bottom: 10px; */
            }


        }
    </style>

    @yield('styles')
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container header-container d-flex justify-content-between align-items-center">
            <div class="logo me-auto">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets_front/img/Items.png') }}" alt="Logo">
                </a>
            </div>
            <div class="d-flex" id="right20">
                <a class="getstarted20" href="{{ url('/contact') }}">Talk to sales</a>
            </div>
        </div>
    </header>

    @yield('content')


    @yield('footer')


    {{-- JS Scripts --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets_front/js/jquery.js') }}"></script>
    <script src="{{ asset('assets_front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets_front/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/custom.js') }}"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = window.location.href;
            const menuItems = document.querySelectorAll('.nav-link, .dropdown ul li a');
            menuItems.forEach(item => {
                if (currentLocation.includes(item.href)) {
                    item.classList.add("active");
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>