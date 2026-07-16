<?php $__env->startSection('head'); ?>
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="login-page">

      <div class="logo">
        <?php if($setting): ?>
          <a href="<?php echo e(url('/')); ?>" title="<?php echo e($setting->welcome_txt); ?>">
            <img src="<?php echo e(asset('/images/logo/'.$setting->logo)); ?>" class="img-responsive login-logo" alt="<?php echo e($setting->welcome_txt); ?>">
          </a>
        <?php endif; ?>
      </div>

      <h3 class="user-register-heading text-center">Register</h3>
      <form class="form login-form" method="POST" action="<?php echo e(route('register')); ?>" role="form" aria-label="Registration Form">
        <?php echo e(csrf_field()); ?>


        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <?php echo Form::label('name', 'Name'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter your name', 'aria-label' => 'Full Name']); ?>

          <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
        </div>

        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
          <?php echo Form::label('email', 'Email address'); ?>

          <?php echo Form::email('email', null, ['class' => 'form-control email-input', 'placeholder' => 'eg: foo@bar.com', 'maxlength' => '60', 'aria-label' => 'Email Address']); ?>

          <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
        </div>

        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
          <?php echo Form::label('password', 'Password'); ?>

          <div class="password-wrapper">
            <input type="password" name="password" class="form-control" required placeholder="Enter Password" aria-label="Password">
            <span class="toggle-password-btn" role="button" tabindex="0" aria-label="Toggle password visibility">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
          </div>
          <small class="text-danger" style="color: red; background-color: #FFF;"><?php echo e($errors->first('password')); ?></small>
        </div>

        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
          <?php echo Form::label('password_confirmation', 'Confirm Password'); ?>

          <div class="password-wrapper">
            <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password" aria-label="Confirm Password">
            <span class="toggle-password-btn" role="button" tabindex="0" aria-label="Toggle password visibility">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
          </div>
          <small class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></small>
        </div>

        <div class="mr-t-20">
          <button type="submit" class="btn btn-wave">Create Account</button>
          <a href="<?php echo e(url('/login')); ?>" class="text-center btn-block" title="Already Have Account">Already Have Account ?</a>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/auth/register.blade.php ENDPATH**/ ?>