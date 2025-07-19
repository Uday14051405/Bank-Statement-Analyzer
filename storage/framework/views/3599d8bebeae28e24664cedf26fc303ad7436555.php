<?php
$setting = \App\Models\Setting::find(1);
?>

<!DOCTYPE html>
<html dir="ltr" lang="<?php echo e(Session::get('locale')); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php if($setting->website_title != null || !empty($setting->website_title)): ?> <?php echo e($setting->website_title); ?> <?php endif; ?> | <?php echo $__env->yieldContent('page_title'); ?></title>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="content-language" content="<?php echo e(Session::get('locale')); ?>">

    <!-- Favicon -->
    <?php if($setting->website_favicon != null || !empty($setting->website_favicon)): ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e($setting->website_favicon); ?>">
    <?php else: ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/admin/img/favicon-def.png')); ?>">
    <?php endif; ?>


    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/admin/js/jquery-3.2.1.min.js')); ?>"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/font-awesome.min.css')); ?>">
    <!-- toastr CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/toastr.min.css')); ?>">
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/feathericon.min.css')); ?>">
    <!-- <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/morris/morris.css')); ?>"> -->

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.bootstrap4.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="<?php echo e(asset('vendor/file-manager/css/file-manager.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">
    <style>
        .view-user-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .view-icon {
            font-size: 1.7em; /* Adjust the size as needed */
            color: #006266; /* You can change the color if needed */
        }
    </style>
    <style>
        #custom-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            display: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #3498db;
            animation: spin 1s linear infinite;
        }

        @keyframes  spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #output {
        height: 100px !important;
        width: 100px !important;
    }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')): ?>
        <?php echo $__env->make('admin.layouts.sidebar_other', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
        <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

    </div>
    <!-- /Main Wrapper -->

   <!-- Custom loader -->
   <div id="custom-loader">
        <div class="spinner"></div>
    </div>
    <!-- Bootstrap Core JS -->
    <script src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/hacu5s8ld7b5xx9hdo1laufa5yvhr6s48c38wigwc3gfarik/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

    <!-- Slimscroll JS -->
    <script src="<?php echo e(asset('assets/admin/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/raphael/raphael.min.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('assets/admin/plugins/morris/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/chart.morris.js')); ?>"></script> -->

    <!-- toastr JS -->
    <script src="<?php echo e(asset('assets/admin/js/toastr.min.js')); ?>"></script>
    <?php echo Toastr::message(); ?>



    <!-- Custom JS -->
    <script src="<?php echo e(asset('assets/admin/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/file-manager/js/file-manager.js')); ?>"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>

    <script>
        feather.replace()
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2();
        });
    </script>
 <script>
        $(document).ajaxStart(function() {
            $('#custom-loader').show(); // Show loader when AJAX request starts
        }).ajaxStop(function() {
            $('#custom-loader').hide(); // Hide loader when AJAX request completes
        });

       
    </script>
    <script>
        // $(document).ready(function() {
        //     $('form').attr('autocomplete', 'off');
        // });

        // Place this in your main layout file or a script that runs globally

        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.getElementsByTagName('form');
            for (var i = 0; i < forms.length; i++) {
                forms[i].setAttribute('autocomplete', 'off');
            }

            var inputs = document.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].setAttribute('autocomplete', 'off');
            }

            var textareas = document.getElementsByTagName('textarea');
            for (var i = 0; i < textareas.length; i++) {
                textareas[i].setAttribute('autocomplete', 'off');
            }
        });
    </script>


    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\layouts\master.blade.php ENDPATH**/ ?>