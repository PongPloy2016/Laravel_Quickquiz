

<?php $__env->startSection('content'); ?>

  <?php
    $setting = $settings[0];
  ?>

  <?php echo Form::model($setting, ['method' => 'PATCH', 'action' => ['SettingController@update', $setting->id], 'files' => true]); ?>

  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-body settings-block">
          <!-- Project Name -->
          <div class="form-group<?php echo e($errors->has('welcome_txt') ? ' has-error' : ''); ?>">
            <?php echo Form::label('welcome_txt', 'Project Name'); ?>

            <p class="label-desc"><?php echo e(__('Please Enter Your Project Name')); ?></p>
            <?php echo Form::text('welcome_txt', null, ['class' => 'form-control']); ?>

            <small class="text-danger"><?php echo e($errors->first('welcome_txt')); ?></small>
          </div>

          <!-- Project URL -->
          <div class="form-group<?php echo e($errors->has('APP_URL') ? ' has-error' : ''); ?>">
            <?php echo Form::label('APP_URL', 'Project URL'); ?>

            <p class="label-desc"><?php echo e(__('Please Enter Your Project URL')); ?></p>
            <input class="form-control" type="text" name="APP_URL" value="<?php echo e(env('APP_URL')? env('APP_URL') : ''); ?>" placeholder="Please enter your App URL eg: https://yourdomain.com/">
            <small class="text-danger"><?php echo e($errors->first('APP_URL')); ?></small>
          </div>

          <div class="row">
            <!-- Logo -->
            <div class="col-md-6">
              <div class="form-group<?php echo e($errors->has('logo') ? ' has-error' : ''); ?>">
                <?php echo Form::label('logo', 'Logo Select'); ?>

                <p class="label-desc"> <?php echo e(__('Please Select Logo')); ?> </p>
                <?php echo Form::file('logo',['accept'=>'image/jpeg,image/jpg,image/png,image/webp', 'aria-label' => 'Upload Logo']); ?>

                <small class="text-danger"><?php echo e($errors->first('logo')); ?></small>
              </div>
              <div class="logo-block">
                <img src="<?php echo e(asset('/images/logo/'. $setting->logo)); ?>" class="img-responsive"  alt="<?php echo e($setting->welcome_txt); ?>">
              </div>
            </div>

            <!-- Favicon -->
            <div class="col-md-6">
              <div class="form-group<?php echo e($errors->has('favicon') ? ' has-error' : ''); ?>">
                <?php echo Form::label('favicon', 'Favicon Select'); ?>

                <p class="label-desc"> <?php echo e(__('Please Select Favicon')); ?> </p>
                <?php echo Form::file('favicon',['accept'=>'image/x-icon,image/ico', 'aria-label' => 'Upload Favicon']); ?>

                <small class="text-danger"><?php echo e($errors->first('favicon')); ?></small>
              </div>
            </div>

            <!-- Default Email -->
            <div class="col-md-6">
               <div class="form-group<?php echo e($errors->has('w_email') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('w_email', 'Default Email'); ?>

                   <p class="label-desc">Please enter your default email</p>
                  <?php echo Form::email('w_email', null, ['class' => 'form-control email-input', 'placeholder' => 'eg: example@exampledomain.com', 'required' => 'required', 'maxlength' => '60', 'aria-label' => 'Default Email']); ?>

                  <small class="text-danger"><?php echo e($errors->first('w_email')); ?></small>
              </div>
            </div>

            <!-- Currency Code -->
            <div  class="col-md-6">
              <div class="form-group<?php echo e($errors->has('currency_code') ? ' has-error' : ''); ?>">
                <?php echo Form::label('currency_code', 'Currency Code'); ?>

                 <p class="label-desc">- Please enter your currency code</p>
                <?php echo Form::text('currency_code', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('currency_code')); ?></small>
              </div>
            </div>

            <!-- Currency Symbol -->
            <div class="col-md-6">
               <div class="form-group<?php echo e($errors->has('currency_symbol') ? ' has-error' : ''); ?> currency-symbol-block">
                <?php echo Form::label('currency_symbol', 'Currency Symbol'); ?>

                <p class="label-desc"> - Please select your currency symbol</p>
                  <div class="input-group">
                    <?php echo Form::text('currency_symbol', null, ['class' => 'form-control currency-icon-picker']); ?>

                    <span class="input-group-addon simple-input"><i class="fa fa-money"></i></span>
                  </div>
                <small class="text-danger"><?php echo e($errors->first('currency_symbol')); ?></small>
              </div>
            </div>

            <!-- Welcome Email -->
            <div class="col-md-6">
              <div class="form-group">
               <label for="wel_mail">Welcome email for user:</label>
                <input <?php echo e($setting->wel_mail == 1 ? "checked" : ""); ?> type="checkbox" class="toggle-input" name="wel_mail" id="wel_mail">
                <label for="wel_mail"></label>
              </div>
            </div>

            <!-- Debug -->
            <div class="col-md-6">
              <div class="form-group">
               <label for="APP_DEBUG">Debug:</label>
               <input type="checkbox" <?php echo e(env('APP_DEBUG') == true ? "checked" : ""); ?> name="APP_DEBUG" class="toggle-input" data-size="small" id="APP_DEBUG">
                <label for="APP_DEBUG"></label>
              </div>
            </div>

            <!-- Right Click -->
            <div class="col-md-6">
              <div class="form-group">
               <label for="status">Right Click Disable:</label>
                <input <?php echo e($setting->right_setting == 1 ? "checked" : ""); ?> type="checkbox" class="toggle-input" name="rightclick" id="rightclick">
                <label for="rightclick"></label>
              </div>
            </div>

            <!-- Inspect element -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="status">Inspect Element Disable:</label>
                    <input <?php echo e($setting->element_setting == 1 ? "checked" : ""); ?> type="checkbox" class="toggle-input" name="inspect" id="inspect">
                    <label for="inspect"></label>
              </div>
            </div>

            <!-- Coming Soon -->
            <div class="col-md-6">
              <div class="col-sm-5">
                <div class="form-group">
                 <label for="status">Coming Soon:</label>
                  <input <?php echo e($setting->coming_soon == 1 ? "checked" : ""); ?> type="checkbox" class="toggle-input coming_soon" name="coming_soon" id="coming_soon" onChange ='iscomingsoon()'>
                  <label for="coming_soon"></label>
                </div>
              </div>
              
              <div class="col-sm-7" id="coming_soon_link" style="<?php echo e($setting->coming_soon == '1' ? " " : "display: none"); ?>">
                <div class="form-group" style="width:100% !important;">
                   <label for="status">Coming Enabled IP:</label>
                  <select class="form-control select2" name="comingsoon_enabled_ip[]" multiple="multiple">
                   <?php if(isset($setting->comingsoon_enabled_ip) &&  $setting->comingsoon_enabled_ip != NULL): ?>
                      <?php $__currentLoopData = $setting->comingsoon_enabled_ip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enable_ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($enable_ip); ?>" <?php if(isset($enable_ip)): ?> selected="" <?php endif; ?>><?php echo e($enable_ip); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
            
            <!-- Repeat Quiz -->
                         
          </div>

          <!-- Save setting button -->
          <?php echo Form::submit("Save Setting", ['class' => 'btn btn-wave btn-block']); ?>

        </div>
       
      </div>
    </div>
  </div>
  <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <!---------- coming soon --------->
  <script type="text/javascript">
    function iscomingsoon()
    {
      if($('.coming_soon').is(":checked"))   
        $("#coming_soon_link").show();
      else
        $("#coming_soon_link").hide();
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Settings',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => 'active'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/settings.blade.php ENDPATH**/ ?>