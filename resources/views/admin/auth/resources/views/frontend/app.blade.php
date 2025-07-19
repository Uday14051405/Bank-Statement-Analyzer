<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumbble - P2P Receivable Sales & Purchase Trading Activity platform')</title>
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
            color: #ffd700; /* or another color to indicate active state */
        }
    </style>
</head>

<body>
    <div id="root">
        <div class="App">
        @yield('pageclass')
            
                <div>
                    @yield('header')
                </div>
                @yield('content')
               

                @yield('footer')
            </div>
            </div>
            </div>
</body>

</html>