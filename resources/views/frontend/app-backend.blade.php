@php
$setting = \App\Models\Setting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BSA - Bank Statement Analysis')</title>
    <!-- Replace with your favicon link if needed -->
    <link rel="icon" href="{{ asset('path_to_your_favicon') }}" />
    <!-- Meta tags for theme color, description, etc., if necessary -->
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <!-- Add your stylesheets -->
    <link href="{{ asset('static/css/main.45ffaa6d.css') }}" rel="stylesheet" />
    <style>
        .nav-link.active {
            font-weight: bold;
            color: #ffd700;
            /* or another color to indicate active state */
        }

        #globalLoader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            display: none;
            /* Hidden by default */
        }
    </style>
    @if($setting->website_favicon != null || !empty($setting->website_favicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{$setting->website_favicon}}">
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_front/admin/img/favicon-def.png') }}">
    @endif


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">
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

    <!-- Favicon -->
    <link href="{{ asset('assets_front/img/Items.png') }}" rel="icon">
    <link href="{{ asset('assets_front/img/Items.png') }}" rel="apple-touch-icon">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


</head>

<body>
    <!-- Loader -->
    <div id="globalLoader">
        <i class="fas fa-spinner fa-spin" style="font-size: 50px;"></i> <!-- Using FontAwesome spinner -->
    </div>

    @yield('pageclass')


    @yield('header')

    @yield('content')


    @yield('footer')

    @stack('scripts')
    <!-- JavaScript -->
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
        // Custom modal functionality
        function openModal() {
            setTimeout(function() {
                var modal = document.getElementById('myModal');
                modal.style.display = 'block';
                modal.offsetHeight; // Force reflow
                modal.style.opacity = 1;
            }, 300); // Delay of 300 ms
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.opacity = 0;
            setTimeout(function() {
                modal.style.display = 'none';
            }, 500); // Match duration with CSS transition
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#myModal .close').addEventListener('click', closeModal);
            document.querySelector('#myModal .btn-secondary').addEventListener('click', closeModal);

            const currentLocation = window.location.href;
            const menuItems = document.querySelectorAll('.nav-link, .dropdown ul li a');
            menuItems.forEach(item => {
                if (currentLocation.includes(item.href)) {
                    item.classList.add('active');
                }
            });
        });
    </script>


    <script>
        // Show loader on AJAX start and hide on AJAX stop
        $(document).ready(function() {
            // Show loader when an AJAX request starts
            $(document).ajaxStart(function() {
                $('#globalLoader').show();
            });

            // Hide loader when all AJAX requests complete
            $(document).ajaxStop(function() {
                $('#globalLoader').hide();
            });
        });
    </script>
</body>

</html>