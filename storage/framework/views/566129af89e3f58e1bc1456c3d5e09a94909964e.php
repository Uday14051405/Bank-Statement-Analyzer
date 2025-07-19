<!-- ======= Footer ======= -->
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

    @media  only screen and (max-width: 768px) {
        #copy {
            padding-bottom: 10% !important;
        }
    }

    @media  only screen and (min-width: 576px) {
        #copy {
            padding-bottom: 3% !important;
        }
    }

    .twitter i svg {
        width: 18px; /* Adjust icon width */
        height: 18px; /* Adjust icon height */
        fill: #fff; /* Optional: Adjust color */
    }
</style>

<!-- External Styles -->
<link rel="stylesheet" href="<?php echo e(asset('assets_front/css/style.css')); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<footer id="footer" class="footer text-white py-4">
    <div class="container">
        <div class="footer-menu">
            <div class="row">
                <!-- Left Column: Links -->
                <div class="col-md-6 col-12 mb-3 mb-md-0">
                    <ul class="footer-menu-item list-unstyled text-center text-md-start">
                        <li class="scroll mb-2">
                            <a href="<?php echo e(url('terms')); ?>" class="text-white text-decoration-none">Terms & Conditions</a>
                        </li>
                        <li class="scroll mb-2">
                            <a href="<?php echo e(url('policy')); ?>" class="text-white text-decoration-none">Privacy Policy</a>
                        </li>
                        <li class="scroll">
                            <a href="<?php echo e(url('contact')); ?>" class="text-white text-decoration-none">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <!-- Right Column: Copyright -->
                <div class="col-md-6 col-12 text-center text-md-end">
                    <p class="m-0" style="color:#ffff;">
                        &copy;<?php echo e(date('Y')); ?> Powered by Oneinfinity. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
        <!-- Uncomment this section if needed -->
        <!-- <div id="scroll-Top">
          <div class="return-to-top">
            <i class="fa fa-angle-up" id="scroll-top" data-toggle="tooltip" data-placement="top" title="Back to Top" aria-hidden="true"></i>
          </div>
        </div> -->
    </div>
</footer>

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<?php /**PATH C:\xampp\htdocs\Laravel Project New\bsa\resources\views/frontend/footer.blade.php ENDPATH**/ ?>