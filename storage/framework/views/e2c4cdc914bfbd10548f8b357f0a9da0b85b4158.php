<?php
    $setting = \App\Models\Setting::find(1);
?>



<?php $__env->startSection('pageclass'); ?>
<div class="fullHeightContainer">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('frontend.header-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="loginBody">
    <div class="loginContent">
        <h1>
            Effortless Receivable Sales & Purchase Trading Activity Awaits
        </h1>
        <p>
            Discover the ease of managing your invoices with Rumbble.
            Login or sign up today to embark on a journey of financial
            efficiency.
        </p>
    </div>
    <div class="loginBox">
        <div class="authCard">
            <form class="loginForm" action="<?php echo e(route('login')); ?>" method="POST">
                <div class="toggleSwitchBox">
                    <div class="toggleSwitch">
                        <a class="switchText active" href="signin">
                            <p>Log In</p>
                        </a><a class="switchText" href="signup">
                            <p>Sign Up</p>
                        </a>
                    </div>
                </div>
                
                <?php echo csrf_field(); ?>
                <div>
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" placeholder="Your email" value="" name="email" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label for="userPass">Password</label>
                    <div class="inputPass">
                        <input type="password" id="userPass" placeholder="Password" value="admin" name="password" />
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="footerElement">
                    <div class="remeberMeBox">
                        <input type="checkbox" id="rememberMe" name="remember" /><label for="rememberMe">Remember Me</label>
                    </div>
                    <p> <a href="<?php echo e(route('forget.password.get')); ?>" style="color:black">Forgot your password?</a></p>
                </div>
                <div class="submitBtn">
                    <button class="blueBtn" type="submit" style="cursor: pointer">
                        Log In
                    </button>
                </div> 
                <div class="Toastify"></div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('frontend.footer-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<script>
    // Toastr options for customization
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\signin.blade.php ENDPATH**/ ?>