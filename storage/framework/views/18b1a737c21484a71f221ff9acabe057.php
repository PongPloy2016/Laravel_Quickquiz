

<?php $__env->startSection('content'); ?>
  <?php if($auth): ?>

    <!-- Is user is admin -->
    <?php if($auth->role == 'A'): ?>
      <div class="box">
        <div class="box-body">
          <!-- Form Start -->
          <?php echo Form::model($auth, ['files' => true,'method' => 'PATCH', 'action' => ['UsersController@update', $auth->id]]); ?>

            <div class="row">

              <div class="col-md-6">
                <!-- Name -->
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('name', 'Name'); ?>

                  <span class="required">*</span>
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Your Name', 'aria-label' => 'Full Name']); ?>

                  <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                </div>

                <!-- Email -->
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('email', 'Email address'); ?>

                  <span class="required">*</span>
                  <?php echo Form::email('email', null, ['class' => 'form-control email-input', 'placeholder' => 'eg: info@example.com', 'required' => 'required', 'maxlength' => '60', 'aria-label' => 'Email Address']); ?>

                  <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                </div>

                <!-- Password -->
                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('password', 'Password'); ?>

                  <span class="required">*</span>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Change Your Password" aria-label="Password">
                    <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
                </div>

                <!-- Role -->
                <div class="form-group<?php echo e($errors->has('role') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('role', 'Role'); ?>

                  <span class="required">*</span>
                  <?php echo Form::select('role', ['S' => 'Student', 'A'=>'Administrator'], null, ['class' => 'form-control select2', 'required' => 'required', 'aria-label' => 'User Role']); ?>

                  <small class="text-danger"><?php echo e($errors->first('role')); ?></small>
                </div>

                <!-- User Profile -->
                <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
                  <label for="image">Choose Profile Picture:</label>
                  <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" aria-label="Profile Picture">
                </div>
              </div>

              <div class="col-md-6 margin-bottom">
                <!-- Mobile Number -->
                <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('mobile', 'Mobile No.'); ?>

                  <?php echo Form::text('mobile', null, ['class' => 'form-control mobile-input', 'placeholder' => 'eg: +911234567890', 'maxlength' => '15', 'pattern' => '[0-9+]{1,15}', 'aria-label' => 'Mobile Number']); ?>

                  <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                </div>

                <!-- City -->
                <div class="form-group<?php echo e($errors->has('city') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('city', 'Enter City'); ?>

                  <?php echo Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'Enter Your City', 'aria-label' => 'City']); ?>

                  <small class="text-danger"><?php echo e($errors->first('city')); ?></small>
                </div>

                <!-- Address -->
                <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('address', 'Address'); ?>

                    <?php echo Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Enter Your Address', 'aria-label' => 'Address']); ?>

                    <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                </div>
                </div>

                <!-- User Profile -->
                <?php if($auth->image !=""): ?>
                  <img title="Current image" class="img-circle" width="100px" height="100px" src="<?php echo e(url('images/user/'.$auth->image)); ?>" alt="User profile picture">
                <?php else: ?>
                    <img title="Current image" class="img-circle" width="100px" height="100px" src="<?php echo e(Avatar::create(ucfirst($auth->name))->toBase64()); ?>" alt="User profile picture">
                <?php endif; ?>
                <br><br>

                <!-- Update Button -->
                <div class="col-md-offset-3 col-md-6">
                  <?php echo Form::submit('Update', ['class' => 'btn btn-wave btn-block']); ?>

                </div>
              </div>
          <?php echo Form::close(); ?>

          <!-- Form End -->
        </div>
      </div>

    <!-- Is user is Student -->
    <?php elseif($auth->role == 'S'): ?>
      <div class="box">
        <div class="box-body">
          <!-- Form Start -->
          <?php echo Form::model($auth, ['files' => true, 'method' => 'PATCH', 'action' => ['UsersController@update', $auth->id]]); ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('name', 'Name'); ?>

                  <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Your Name', 'aria-label' => 'Full Name']); ?>

                  <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('email', 'Email address'); ?>

                  <?php echo Form::email('email', null, ['class' => 'form-control email-input', 'placeholder' => 'eg: info@example.com', 'required' => 'required', 'maxlength' => '60', 'aria-label' => 'Email Address']); ?>

                  <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('password', 'Password'); ?>

                  <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Change Your Password" aria-label="Password">
                    <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('mobile', 'Mobile No.'); ?>

                  <?php echo Form::text('mobile', null, ['class' => 'form-control mobile-input', 'placeholder' => 'eg: +911234567890', 'maxlength' => '15', 'pattern' => '[0-9+]{1,15}', 'aria-label' => 'Mobile Number']); ?>

                  <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
                  <label for="image">Choose Profile Picture:</label>
                  <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" aria-label="Profile Picture">
                </div>
              </div>
              <div class="col-md-6 margin-bottom">
                <div class="form-group<?php echo e($errors->has('city') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('city', 'Enter City'); ?>

                  <?php echo Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'Enter Your City', 'aria-label' => 'City']); ?>

                  <small class="text-danger"><?php echo e($errors->first('city')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('address', 'Address'); ?>

                  <?php echo Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'8', 'placeholder' => 'Enter Your Address', 'aria-label' => 'Address']); ?>

                  <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                </div>
                 <?php if($auth->image !=""): ?>
                  <img title="Current image" class="img-circle" width="100px" height="100px" src="<?php echo e(url('images/user/'.$auth->image)); ?>" alt="User profile picture">
                <?php else: ?>
                  <img title="Current image" class="img-circle" width="100px" height="100px" src="<?php echo e(Avatar::create(ucfirst($auth->name))->toBase64()); ?>" alt="User profile picture">
                <?php endif; ?>
                <br><br>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php echo Form::submit('Update', ['class' => 'btn btn-wave btn-block']); ?>

              </div>
            </div>
          <?php echo Form::close(); ?>

          <!-- Form End -->
        </div>
      </div>
    <?php endif; ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Your Profile',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/users/profile.blade.php ENDPATH**/ ?>