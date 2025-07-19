<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/rumbble.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="apple-touch-icon" href="/rumbble.png" />
    <link rel="manifest" href="/manifest.json" />
    <title>Rumbble - P2P Receivable Sales & Purchase Trading Activity platform</title>
    <script defer="defer" src="static/js/main.f22c8d86.js"></script>
    <link href="static/css/main.f400f3ed.css" rel="stylesheet" />
    <link href="static/css/main.main.45ffaa6d.css" rel="stylesheet" />

    <style>
        @media  only screen and (max-width: 768px) {
            .logoBlue {
                max-width: 300px;
                width: 100%;
            }

            .loginBody {
                align-items: center;
                display: block;
                height: 75vh;
                justify-content: space-between;
                padding: 0 40px;
            }

            .loginBody .loginContent {
                display: flex;
                flex-direction: column;
                gap: 30px;
                width: 100%;
                min-width: 50%;
            }

            .loginBody .loginContent h1 {
                color: #00274d;
                font-size: 38px;
                font-weight: 700;
                line-height: normal;
                width: 100%;
                /* min-width: 500px; */
            }

            .loginBody .loginContent p {
                color: gray;
                font-size: 20px;
                font-weight: 500;
                line-height: 40px;
                width: 100%;
                /* min-width: 500px; */
                /* max-width: 100%; */
            }

            .loginBody .loginBox {
                align-items: center;
                justify-content: center;
                display: block;
                min-width: 50%;
                width: 100%;
                margin: 20px 0;
            }

            .authCard {
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 16px 0 #00000040;
                padding: 30px;
                width: 100%;
                /* min-width: 470px; */
            }

            .loginForm {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
        }

        .text-danger {
            color: #dc3545;
            font-weight: normal;
            font-size: 16px;
            text-transform: uppercase;
            /* Add more styles as needed */
        }
    </style>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/toastr.min.css')); ?>">
</head>

<body>
    <div id="root">
        <div class="App">
            <?php echo $__env->yieldContent('pageclass'); ?>

            <div>
                <?php echo $__env->yieldContent('header'); ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>


            <?php echo $__env->yieldContent('footer'); ?>
        </div>
    </div>
    </div>
</body>

</html><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\app-backend.blade.php ENDPATH**/ ?>