<!-- resources/views/home.blade.php -->

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
                Discover the ease of managing your invoices
                with Rumbble. Login today to embark on a
                journey of financial efficiency.
            </p>
        </div>
        <div class="loginBox">
            <div class="authCard">
                <div class="loginForm">
                    <div>
                        <label for="userEmail">Email</label><input type="email" id="userEmail" placeholder="Your email" value="sumeet@rumbble.co" />
                    </div>
                    <div>
                        <label for="userPass">Password</label>
                        <div class="inputPass">
                            <input type="password" id="userPass" placeholder="Password" value="admin" /><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAFZSURBVHgB5ZMtUgNBEIU7BBMkIBCAQCSCEwSBWbMiWA4Ri+UK3AHsIsGCwESyiAjWRASBiSUCqqBf7TeV2UlQYChe1avq7Zl+/Tdr9pdwAn+E9cjedB5h3zg3nJlzF1t4dD45Z98JtiNbF7cQaTknzpykEvgkYU4Cnb+ngq3kW4LnBNxSaYqB1aNRkgtLqm0nYmfOD2flPCZhxZmSzPkeUa1Y4l8SHBKkrA/YOaIKOnXuIzjHp/EckKAh2OewIEB4xddFtODeC4LihPaDbWsEZ1ErAXu2PLcra6KC/eAIgiMq6UaXp0lwvIyAEHNnScsqt2fNIYdB9xIBzXZs9aKGJL5OBUP56ebCGEqC9O60qG38Hauf18oth80F0TdbLGCGmL4PoUSLWExIH7bRkuaVITQlqBO1/MwoVOVlHNxeIahKxrbY+A5i8uv31KbvOcuotLRfwgD+Z3wBXvpcYEXa0c8AAAAASUVORK5CYII=" alt="eye-icon" class="eyeIcon" />
                        </div>
                    </div>
                    <div class="submitBtn">
                        <button class="blueBtn" style="cursor: pointer">
                            Log In
                        </button>
                    </div>
                    <div class="Toastify"></div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('frontend.footer-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\admin-signin.blade.php ENDPATH**/ ?>