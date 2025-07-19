<!-- resources/views/home.blade.php -->

<?php $__env->startSection('pageclass'); ?>
<div class="returnPolicy">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<?php echo $__env->make('frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="heroBanner">
              <h1 class="siteTitle">Return Policy</h1>
            </div>
            <div class="bodyText">
              <h2 class="bodyTitle">Return Policy</h2>
              <p>
                Since this is an investment product, there is no return policy
              </p>
            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\return-policy.blade.php ENDPATH**/ ?>