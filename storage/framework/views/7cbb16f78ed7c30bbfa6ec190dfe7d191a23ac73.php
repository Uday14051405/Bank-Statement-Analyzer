<!-- resources/views/home.blade.php -->



<?php $__env->startSection('content'); ?>
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
                <button class="btn"><a href="<?php echo e(url('/')); ?>" class="text-light fw-bold fs-4">Go to Home</a></button>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\frontend\contact_thank_you.blade.php ENDPATH**/ ?>