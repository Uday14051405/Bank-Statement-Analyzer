<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>1FIO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('assets_front/img/Items.png') }}" rel="icon">
    <link href="{{ asset('assets_front/img/Items.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Local Stylesheets -->
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- External Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Inline Styles -->
    <style>
        :root {
            --default-font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC",
                "Hiragino Sans GB", "Microsoft Yahei UI", "Microsoft Yahei",
                "Source Han Sans CN", sans-serif !important;
        }

        /* Profile Image css  */
        .profile {
            display: flex;
            align-items: center;
            position: relative;
            margin-left: 15px;
        }

        .profile-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-name {
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .dropdown14 {
            position: relative;
        }

        .dropdown-btn14 {
            background-color: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #000;
            margin-left: 5px;
        }

        .dropdown-content14 {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 120px;
        }

        .dropdown-content14 a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content14 a:hover {
            background-color: #f1f1f1;
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .profile:hover .dropdown-content14 {
            display: block;
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
        @media (max-width: 426px) {
            .profile-name{
                display: none;
            }
        }
    </style>
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
            <div class="profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA3W3oppN7sdVCsUWwwnPIn9pX6E6G2UW70w&s" alt="Profile" class="profile-img">
                <span class="profile-name">{{ Auth::user()->name}}</span>
                <div class="dropdown14">
                    <button class="dropdown-btn14">▼</button>
                    <div class="dropdown-content14">
                        <!-- <a href="#">Profile</a> -->
                        <a href="{{ route('customer_logout') }}">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Scripts -->
<script src="{{ asset('assets_front/js/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="{{ asset('assets_front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets_front/js/bootsnav.js') }}"></script>
<script src="{{ asset('assets_front/js/feather.min.js') }}"></script>
<script src="{{ asset('assets_front/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets_front/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets_front/js/slick.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{ asset('assets_front/js/custom.js') }}"></script>

<script>
    function openModal() {
        setTimeout(function() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block'; // Show the modal
            modal.offsetHeight; // This line forces a reflow
            modal.style.opacity = 1; // Change opacity to 1 for the fade effect
        }, 300); // Delay of 2200 ms
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.opacity = 0; // Change opacity to 0
        setTimeout(function() {
            modal.style.display = 'none'; // Hide the modal after fade out
        }, 500); // Match this duration with the CSS transition duration
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#myModal .close').addEventListener('click', closeModal);
        document.querySelector('#myModal .btn-secondary').addEventListener('click', closeModal);
    });

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

