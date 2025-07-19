<!-- resources/views/home.blade.php -->
@extends('frontend.app')


@section('content')
     <style>
        .card-body .btn{
            background-color: #ed217c;
            padding: 10px 20px;
        }
        .card-body a{
            text-decoration: none;
        }
        .card {
            max-width: 500px;
            background-color: #fff;
        }
        .card-body h1{
            font-size: 4rem;
        }

        .min-vh-100 {
            min-height: 100vh;
        }
        .card-body .btn:hover{
            background-color: #ed217c;
        }
        @media (max-width: 767px) {
            .sticky-top .img {
                width: 50% !important;
            }
        }
    </style>
</head>

<body class="bg-light">


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm border-0 rounded-lg p-4 w-100">
            <div class="card-body text-center">
                <h1 class="mb-4">Thank You!</h1>
                <p class="lead mb-5 fs-3 text-dark">Your message has been successfully sent. We will get back to you shortly.
                </p>
                <button class="btn"><a href="{{ url('/') }}" class="text-light fw-bold fs-4">Go to Home</a></button>
            </div>
        </div>
    </div>



@endsection

@section('footer')
@include('frontend.footer') {{-- Include footer content --}}

@endsection

@section('scripts')

@endsection