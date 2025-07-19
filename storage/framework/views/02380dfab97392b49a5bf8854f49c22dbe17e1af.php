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

            .userAuthBody {
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

            .userAuthBody .userAuthContent {
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
                min-width: 500px;
            }

            .userAuthBody .userAuthContent h1 {
                color: #00274d;
                font-size: 48px;
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
                min-width: 500px;
                /* max-width: 500px; */
            }

            .userAuthBody .userAuthContent p {
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

            .userAuthBody .userAuthBox {
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
                /* max-width: 470px; */
            }

            .loginForm {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
    <div class="userAuthBody">

        <div class="verificationStepper">
            <div class="stepperContainer">
                <div class="step">
                    <div class="node">
                        <span class="state yellow"></span>
                    </div>
                    <div class="stepText">
                        <p class="stepTitle">PAN Verification</p>
                        <p class="stepDesc">
                            Please enter your Pan Card Number, Name and Upload
                            Your Pan Card Photo below.
                        </p>
                    </div>
                </div>
                <div class="step">
                    <div class="node"><span class="state gray"></span></div>
                    <div class="stepText bank">
                        <p class="stepTitle grayText">Bank Verification</p>
                        <p class="stepDesc grayText">
                            Please enter your Pan Card Number, Name and Upload
                            Your Pan Card Photo below.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="userAuthBox">
            <div class="authCard">
                <div class="mainPage">
                    <form class="panForm" method="POST" action="<?php echo e(route('form-pan-details.post')); ?>">
                        <?php echo csrf_field(); ?>
                        <p class="formTitle">PAN Card</p>
                        <div>
                            <label for="userPan">PAN Number</label><input type="text" id="userPan" placeholder="Your PAN Number" name="pan_number" value="" />
                            <?php $__errorArgs = ['pan_number'];
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
                            <label for="userPanName">PAN Name</label><input type="text" id="userPanName" placeholder="Name on PAN" name="pan_name" value="" />
                            <?php $__errorArgs = ['pan_name'];
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
                            <button class="blueBtn" type="submit" style="cursor: pointer">
                                Verify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('frontend.footer-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\userauth.blade.php ENDPATH**/ ?>