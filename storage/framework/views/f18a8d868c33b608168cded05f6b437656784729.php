<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>1FIO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="<?php echo e(asset('assets_front/img/Items.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('assets_front/img/Items.png')); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/linearicons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/slick-theme.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/bootsnav.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/responsive.css')); ?>">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        :root {
            --default-font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Helvetica, Arial, "PingFang SC", "Hiragino Sans GB", "Microsoft Yahei UI", "Microsoft Yahei", "Source Han Sans CN", sans-serif !important;
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
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .header-container {
                align-items: center;
            }

            #right20 {
                width: 100%;
                justify-content: end;
            }
        }
    </style>
</head>

<body>
<header id="header" class="fixed-top">
    <div class="container header-container d-flex justify-content-between align-items-center">
        <div class="logo me-auto">
            <a href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('assets_front/img/Items.png')); ?>" alt="Logo">
            </a>
        </div>

        <div class="d-flex" id="right20">
            <a class="getstarted20" href="<?php echo e(url('/contact')); ?>">Talk to sales</a>
        </div>
    </div>
</header>

<!-- Scripts -->
<script src="<?php echo e(asset('assets_front/js/jquery.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="<?php echo e(asset('assets_front/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/bootsnav.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets_front/js/slick.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="<?php echo e(asset('assets_front/js/custom.js')); ?>"></script>

<script>
    function openModal() {
        setTimeout(function() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
            modal.offsetHeight;
            modal.style.opacity = 1;
        }, 300);
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.opacity = 0;
        setTimeout(function() {
            modal.style.display = 'none';
        }, 500);
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

<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views/frontend/header.blade.php ENDPATH**/ ?>