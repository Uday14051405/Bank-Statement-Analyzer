<!-- resources/views/home.blade.php -->

<?php $__env->startSection('pageclass'); ?>
<div class="fullHeightContainer">
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('header'); ?>
    <?php echo $__env->make('frontend.header-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
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

            .signupBody {
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

            .signupBody .signupContent {
                display: flex;
                flex-direction: column;
                gap: 30px;
                width: 100%;
                min-width: 50%;
            }

            .loginBody .loginContent h1 {
                color: #00274d;
                font-size: 48px;
                font-weight: 700;
                line-height: normal;
                width: 100%;
                /* min-width: 500px; */
            }

            .signupBody .signupContent h1 {
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
                /* max-width: 500px; */
            }

            .signupBody .signupContent p {
                color: gray;
                font-size: 20px;
                font-weight: 500;
                line-height: 40px;
                width: 100%;
                /* min-width: 500px; */
                /* max-width: 500px; */
            }

            .loginBody .loginBox {
                align-items: center;
                justify-content: center;
                display: block;
                min-width: 50%;
                width: 100%;
            }

            .signupBody .signupBox {
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
    </style>
    <div class="signupBody">
        <div class="signupContent">
            <h1>
                Effortless Receivable Sales & Purchase Trading Activity Awaits
            </h1>
            <p>
                Discover the ease of managing your invoices with Rumbble.
                Login or sign up today to embark on a journey of financial
                efficiency.
            </p>
        </div>
        <div class="signupBox">
            <div class="authCard">
                <form class="signupForm" method="POST" action="<?php echo e(route('signup.post')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="toggleSwitchBox">
                        <div class="toggleSwitch">
                            <a class="switchText" href="signin">
                                <p>Log In</p>
                            </a><a class="switchText active" href="signup">
                                <p>Sign Up</p>
                            </a>
                        </div>
                    </div>
                    <div>
                        <label for="userName">Name</label><input type="text"  name="name" id="userName" placeholder="Your Name" value="" />
                        <?php $__errorArgs = ['name'];
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
                        <label for="userEmail">Email</label><input type="email" name="email"  id="userEmail" placeholder="Your Email" value="" />
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
                        <label for="userNumber">Phone Number</label><input type="tel" name="mobile"  id="userNumber" placeholder="Your Number" value="" />
                        <?php $__errorArgs = ['mobile'];
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
                        <label for="userNumber">Password</label><input type="password"  name="password"  id="password" placeholder="Your password" value="admin" />
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
                    <div class="submitBtn">
                        <button class="blueBtn" style="cursor: pointer" type="submit">
                            Next
                        </button>
                    </div>
                </form>
                <div class="Toastify"></div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('footer'); ?>
    <script>
        window.onload = function() {
            // Assuming you are using POST method for logout
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo e(route('logout')); ?>';
            form.style.display = 'none';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.setAttribute('name', '_token');
            csrfInput.setAttribute('value', csrfToken);
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <?php echo $__env->make('frontend.footer-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\signup.blade.php ENDPATH**/ ?>