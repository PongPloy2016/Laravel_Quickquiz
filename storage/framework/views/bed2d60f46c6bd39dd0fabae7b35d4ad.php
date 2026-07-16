<?php $__env->startSection('head'); ?>
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="">
    <div class="container">
      <?php if(Session::has('error')): ?>
        <div class="alert alert-danger sessionmodal" role="alert">
          <?php echo e(session('error')); ?>

        </div>
      <?php endif; ?>

      <div class="login-page">
        <div class="logo">
          <?php if($setting): ?>
            <a href="<?php echo e(url('/')); ?>" title="<?php echo e($setting->welcome_txt); ?>">
              <img src="<?php echo e(asset('/images/logo/'.$setting->logo)); ?>" class="login-logo img-responsive" alt="<?php echo e($setting->welcome_txt); ?>">
            </a>
          <?php endif; ?>
        </div>

        <h4 class="user-register-heading text-center">Login</h4>
        <div class="row">
          <?php
            $fb_status = App\Setting::select('fb_login')->where('id','=',1)->first();
            $g_status = App\Setting::select('google_login')->where('id','=',1)->first();
            $gitlab_status = App\Setting::select('gitlab_login')->where('id','=',1)->first();
          ?>

          <?php if($fb_status->fb_login == 1): ?>
            <div class="col-md-12">
              <a onclick="window.open('<?php echo e(route('sociallogin','facebook')); ?>','popup','width=600','height=600')" class="btn btn-facebook btn-block" role="button" aria-label="Login with Facebook">
                <i class="fa fa-facebook" aria-hidden="true"></i> <?php echo e(__('Facebook')); ?>

              </a>
            </div>
          <?php endif; ?>

          <?php if($gitlab_status->gitlab_login == 1): ?>
            <div class="gap col-md-12 mt-5">
              <a onclick="window.open('<?php echo e(route('sociallogin','gitlab')); ?>','popup','width=600','height=600')" class="btn btn-gitlab btn-block" role="button" aria-label="Login with Gitlab">
              <i class="fa fa-gitlab" aria-hidden="true"></i> <?php echo e(__('Gitlab')); ?>

            </a>
            </div>
          <?php endif; ?>

          <?php if($g_status->google_login == 1): ?>
            <div class="gap col-md-12 mt-5">
              <a onclick="window.open('<?php echo e(route('sociallogin','google')); ?>','popup','width=600','height=600')" class="btn btn-google btn-block" role="button" aria-label="Login with Google">
                <i class="fa fa-google" aria-hidden="true"></i> Google
              </a>
            </div>
          <?php endif; ?>
        </div>
        <br>

        <form class="form login-form" method="POST" action="<?php echo e(route('login')); ?>" role="form" aria-label="Login Form">
          <?php echo e(csrf_field()); ?>

          <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <label for="email" class="sr-only">Email</label>
            <input id="email" type="email" class="form-control email-input" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Your Email" required autofocus maxlength="60" aria-label="Email Address">
            <?php if($errors->has('email')): ?>
              <span class="help-block" role="alert">
                <strong><?php echo e($errors->first('email')); ?></strong>
              </span>
            <?php endif; ?>
          </div>

          <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
            <label for="password" class="sr-only">Password</label>
            <div class="password-wrapper">
              <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required aria-label="Password">
              <span class="toggle-password-btn" role="button" tabindex="0" aria-label="Toggle password visibility">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </span>
            </div>
            <?php if($errors->has('password')): ?>
              <span class="help-block" role="alert">
                <strong><?php echo e($errors->first('password')); ?></strong>
              </span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <div class="checkbox remember-me">
              <label>
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                 Remember Me
              </label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-wave"> Login </button>
            <p class="messege text-center">
              Not registered?
              <a href="<?php echo e(url('/register')); ?>" title="Create An Account">Create an account</a>
            </p>
          </div>

          <div class="form-group text-center">
            <a href="<?php echo e(url('/password/reset')); ?>" title="Forgot Password">Forgot Password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
    $(function () {
      $( document ).ready(function() {
         $('.sessionmodal').addClass("active");
         setTimeout(function() {
             $('.sessionmodal').removeClass("active");
        }, 4500);
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/auth/login.blade.php ENDPATH**/ ?>