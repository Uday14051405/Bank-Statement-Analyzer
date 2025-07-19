@php
$setting = \App\Models\Setting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BSA - Bank Statement Analysis')</title>

    <!-- Meta tags -->
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />

    <!-- Favicon -->
    @if($setting->website_favicon != null || !empty($setting->website_favicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{$setting->website_favicon}}">
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_front/admin/img/favicon-def.png') }}">
    @endif

    <!-- Stylesheets -->
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        * {
            font-family: Poppins, var(--default-font-family) !important;
        }

        .nav-link.active {
            font-weight: bold;
            color: #ffd700;
        }

        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: #1ebbf4;
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

        .analyser-section {
            padding: 60px 0;
            background-color: rgba(255, 255, 255, 0.7);
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
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-try:hover {
            background-color: #C81853;
        }

        .custom-toggle {
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
        }

        .toggle-content {
            display: none;
            padding: 15px;
            background-color: #ffffff;
        }

        .toggle-content.show {
            display: block;
        }

        #header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        #header .getstarted20 {
            background-color: #ed217c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .analyser-section {
                padding: 40px 0;
                text-align: center;
            }

            .analyser-title {
                font-size: 2rem;
            }
        }
    </style>

    <style>
        #insta:hover {
            border-radius: 40px;
            padding: 9.2px;
            margin-top: -9px;
            background: radial-gradient(circle at 33% 100%, #fed373 4%, #f15245 30%, #d92e7f 62%, #9b36b7 85%, #515ecf);
        }

        #faceb:hover {
            border-radius: 40px;
            padding: 9.2px;
            margin-top: -9px;
            background-color: #3b5998;
        }

        #twit:hover {
            border-radius: 40px;
            padding: 9.2px;
            margin-top: -8.78px;
            color: #55acee;
            background-color: #fff;
        }

        #sky:hover {
            border-radius: 40px;
            padding: 9.2px;
            margin-top: -8.78px;
            color: #00aff0;
            background-color: #fff;
        }

        #linke:hover {
            border-radius: 40px;
            padding: 9.2px;
            margin-top: -8.78px;
            background-color: #0077b5;
        }

        #anchor::after {
            content: '';
            display: block;
            width: 0;
            height: 1.5px;
            background: #3b5998;
            transition: width .3s;
        }

        #anchor:hover::after {
            width: 100%;
        }

        #sub:hover {
            box-shadow: 0 0 5px rgba(6, 15, 120, 1);
        }

        @media only screen and (max-width: 768px) {
            #copy {
                padding-bottom: 10% !important;
            }
        }

        @media only screen and (min-width: 576px) {
            #copy {
                padding-bottom: 3% !important;
            }
        }

        .twitter i svg {
            width: 18px;
            height: 18px;
            fill: #fff;
        }
    </style>


    @yield('styles')
</head>

<body>
    @yield('header')

    @yield('content')

    @yield('footer')

    <!-- Scripts -->
    <script src="{{ asset('assets_front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets_front/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets_front/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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