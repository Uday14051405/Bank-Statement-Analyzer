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
        Effortless Invoice <br />
        Discounting Awaits
      </h1>
      <p>
        Discover the ease of managing your invoices with Rumbble.
        Login or sign up today to embark on a journey of financial
        efficiency.
      </p>
    </div>
    <div class="loginBox">
      <div class="authCard">
        <div class="loginForm">
          <div class="toggleSwitchBox">
            <div class="toggleSwitch">
              <a class="switchText active" href="signin">
                <p>Log In</p>
              </a><a class="switchText" href="signup">
                <p>Sign Up</p>
              </a>
            </div>
          </div>
          <div>
            <label for="userEmail">Email</label>
            <input type="email" id="userEmail" placeholder="Your email" value="" name="email" />
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
            <label for="userPass">Password</label>
            <div class="inputPass">
            <input type="password" id="userPass" placeholder="Password" value="admin" name="password" />
              <!-- <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAFZSURBVHgB5ZMtUgNBEIU7BBMkIBCAQCSCEwSBWbMiWA4Ri+UK3AHsIsGCwESyiAjWRASBiSUCqqBf7TeV2UlQYChe1avq7Zl+/Tdr9pdwAn+E9cjedB5h3zg3nJlzF1t4dD45Z98JtiNbF7cQaTknzpykEvgkYU4Cnb+ngq3kW4LnBNxSaYqB1aNRkgtLqm0nYmfOD2flPCZhxZmSzPkeUa1Y4l8SHBKkrA/YOaIKOnXuIzjHp/EckKAh2OewIEB4xddFtODeC4LihPaDbWsEZ1ErAXu2PLcra6KC/eAIgiMq6UaXp0lwvIyAEHNnScsqt2fNIYdB9xIBzXZs9aKGJL5OBUP56ebCGEqC9O60qG38Hauf18oth80F0TdbLGCGmL4PoUSLWExIH7bRkuaVITQlqBO1/MwoVOVlHNxeIahKxrbY+A5i8uv31KbvOcuotLRfwgD+Z3wBXvpcYEXa0c8AAAAASUVORK5CYII=" alt="eye-icon" class="eyeIcon" /> -->
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
          </div>
          <div class="footerElement">
            <div class="remeberMeBox">
              <input type="checkbox" id="rememberMe" /><label for="rememberMe">Remember Me</label>
            </div>
            <p>Forgot your password?</p>
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
<?php echo $__env->make('frontend.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\auth\resources\views\frontend\signin1.blade.php ENDPATH**/ ?>