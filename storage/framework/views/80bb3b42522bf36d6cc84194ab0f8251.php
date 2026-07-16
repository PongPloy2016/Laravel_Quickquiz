<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta name="description" content="Quiz Application">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(asset('/images/logo/'. $setting->favicon)); ?>" rel="icon" type="image/ico">
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/custom-style.css')); ?>" rel="stylesheet">
    <style>
      /* ADA Focus styles */
      a:focus, button:focus, input:focus, select:focus, textarea:focus {
        outline: 2px solid #4A90D9;
        outline-offset: 2px;
      }
      .sr-only-focusable:focus {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 10000 !important;
        padding: 10px 15px !important;
        background: #000 !important;
        color: #fff !important;
        text-decoration: none !important;
        font-weight: bold !important;
      }
      /* Responsive fixes */
      @media (max-width: 767px) {
        .login-page { padding: 15px; }
        .login-logo { max-width: 200px; margin: 0 auto; }
        .topic-block { margin-bottom: 20px; }
        .quiz-main-block .col-md-4 { width: 100%; }
        .front-footer .col-md-6 { text-align: center; margin-bottom: 10px; }
        .nav-bar .heading { font-size: 16px; }
        .logo-main-block img { max-width: 100%; height: auto; }
        .card-content { padding: 10px; }
        .topic-detail { padding-left: 10px; }
        .navbar-toggle { margin-top: 8px; margin-right: 0; }
      }
      @media (max-width: 480px) {
        .btn-wave, .btn-facebook, .btn-google, .btn-gitlab { font-size: 14px; padding: 8px 12px; }
        h1.main-block-heading { font-size: 24px; }
        .user-register-heading { font-size: 20px; }
      }
      /* Password toggle - overlay icon inside input */
      .password-wrapper {
        position: relative;
      }
      .password-wrapper .form-control {
        padding-right: 40px;
      }
      .password-wrapper .toggle-password-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        z-index: 3;
        background: none;
        border: none;
        padding: 0;
        line-height: 1;
      }
      .password-wrapper .toggle-password-btn:hover {
        color: #333;
      }
    </style>
    <!--[if IE]>
        <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
    <![endif]-->    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">    
    <title><?php echo e($setting->welcome_txt); ?></title>
    <!-- Styles -->
    <?php echo $__env->yieldContent('head'); ?>

</head>
<body>
    <a href="#main-content" class="sr-only sr-only-focusable" style="position:absolute;top:-40px;left:0;background:#000;color:#fff;padding:8px;z-index:10000;transition:top 0.3s;">Skip to main content</a>
    <div id="app" style="position: relative;">
        <?php echo $__env->yieldContent('top_bar'); ?>
        <main id="main-content" role="main">
        <?php echo $__env->yieldContent('content'); ?>
        </main>
        <br>
        <br>
    </div>
    <?php
     $ct = App\copyrighttext::where('id','=',1)->first();
    ?>
    
   <div class="front-footer">
        <div class="container" >
            <div class="row">
                <div class="col-md-6">
                    <?php echo e($ct->name); ?>

                </div>
                <div class="col-md-6">
                    <?php
                    $si = App\SocialIcons::all();
                    ?>
                    <?php $__currentLoopData = $si; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($s->status==1): ?>
                        <a target="_blank" title="Visit <?php echo e($s->title); ?>" href="<?php echo e($s->url); ?>"><img width="32px" src="<?php echo e(asset('images/socialicons/'.$s->icon)); ?>" alt="<?php echo e($s->title); ?>" title="<?php echo e($s->title); ?>" style="margin-top:-5px;z-index:9999;"></a>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>   
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom-js.js')); ?>"></script>
    <?php echo $__env->make('partials.validation-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/layouts/app.blade.php ENDPATH**/ ?>