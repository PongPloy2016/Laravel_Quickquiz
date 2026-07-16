<?php $__env->startSection('head'); ?>
    
    <meta name="theme-color" content="#6777EF">
    <link href="<?php echo e(asset('logo.png')); ?>" rel="apple-touch-icon">
    <link href="<?php echo e(asset('/manifest.json')); ?>" rel="manifest">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_bar'); ?>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="logo-main-block">
            <div class="container">
                <?php if($setting): ?>
                    <a href="<?php echo e(url('/')); ?>" title="<?php echo e($setting->welcome_txt); ?>">
                        <img src="<?php echo e(asset('/images/logo/' . $setting->logo)); ?>" class="img-responsive"
                            alt="<?php echo e($setting->welcome_txt); ?>">
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <?php if($setting): ?>
                                <a class="tt" title="Quick Quiz Home" href="<?php echo e(url('/')); ?>">
                                    <h4 class="heading"><?php echo e($setting->welcome_txt); ?></h4>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <?php if(auth()->guard()->guest()): ?>
                                    <li><a href="<?php echo e(route('login')); ?>" title="Login">Login</a></li>
                                    <li><a href="<?php echo e(route('register')); ?>" title="Register">Register</a></li>
                                <?php else: ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-expanded="false" aria-haspopup="true">
                                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" id="dropdown">
                                            <?php if($auth->role == 'A'): ?>
                                                <li><a href="<?php echo e(url('/admin')); ?>" title="Dashboard">Dashboard</a></li>
                                            <?php elseif($auth->role == 'S'): ?>
                                                <li><a href="<?php echo e(url('/admin/my_reports')); ?>" title="Dashboard">Dashboard</a>
                                                </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="<?php echo e(route('logout')); ?>"
                                                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                                    style="display: none;">
                                                    <?php echo e(csrf_field()); ?>

                                                </form>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a href="<?php echo e(route('faq.get')); ?>">FAQ</a></li>
                                    <li><a href="<?php echo e(route('videolist.index')); ?>" title="Video List"><i class="fa fa-play-circle"></i> Videos</a></li>
                                <?php endif; ?>
                                <?php if(!empty($menus)): ?>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(url('pages/' . $menu->slug)); ?>"><?php echo e($menu->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if($auth): ?>
            <div class="quiz-main-block">
                <div class="row">
                    <?php if($topics): ?>
                        <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="topic-block">
                                    <div class="card blue-grey darken-1">
                                        <div class="card-content white-text">
                                            <span class="card-title"><?php echo e($topic->title); ?></span>
                                            <p title="<?php echo e($topic->description); ?>"><?php echo e(str_limit($topic->description, 120)); ?>

                                            </p>
                                            <div class="row">
                                                <div class="col-xs-6 pad-0">
                                                    <ul class="topic-detail">
                                                        <li>Per Question Mark <i class="fa fa-long-arrow-right"></i></li>
                                                        <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                                                        <li>Total Questions <i class="fa fa-long-arrow-right"></i></li>
                                                        <li>Total Time <i class="fa fa-long-arrow-right"></i></li>
                                                        <li>Quiz Price <i class="fa fa-long-arrow-right"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-6">
                                                    <ul class="topic-detail right">
                                                        <li><?php echo e($topic->per_q_mark); ?></li>
                                                        <li>
                                                            <?php
                                                                $qu_count = 0;
                                                            ?>
                                                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($question->topic_id == $topic->id): ?>
                                                                    <?php
                                                                        $qu_count++;
                                                                    ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($topic->per_q_mark * $qu_count); ?>

                                                        </li>
                                                        <li>
                                                            <?php echo e($qu_count); ?>

                                                        </li>
                                                        <li>
                                                            <?php echo e($topic->timer); ?> minutes
                                                        </li>

                                                        <li class="amount">
                                                            <?php if(!empty($topic->amount)): ?>
                                                                
                                                            <?php else: ?>
                                                                Free
                                                            <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card-action text-center">

                                            <?php if(Session::has('added')): ?>
                                                <div class="alert alert-success sessionmodal">
                                                    <?php echo e(session('added')); ?>

                                                </div>
                                            <?php elseif(Session::has('updated')): ?>
                                                <div class="alert alert-info sessionmodal">
                                                    <?php echo e(session('updated')); ?>

                                                </div>
                                            <?php elseif(Session::has('deleted')): ?>
                                                <div class="alert alert-danger sessionmodal">
                                                    <?php echo e(session('deleted')); ?>

                                                </div>
                                            <?php endif; ?>

                                            <?php if($auth->topic()->where('topic_id', $topic->id)->exists()): ?>
                                                <a href="<?php echo e(route('start_quiz', ['id' => $topic->id])); ?>"
                                                    class="btn btn-block" title="Start Quiz">Start Quiz </a>
                                            <?php else: ?>
                                                <?php echo Form::open(['method' => 'POST', 'action' => 'PaypalController@paypal_post']); ?>

                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="topic_id" value="<?php echo e($topic->id); ?>" />
                                                <?php if(!empty($topic->amount)): ?>
                                                    <button type="submit" class="btn btn-default">Pay <i
                                                            class="<?php echo e($setting->currency_symbol); ?>"></i><?php echo e($topic->amount); ?></button>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('start_quiz', ['id' => $topic->id])); ?>"
                                                        class="btn btn-block" title="Start Quiz">Start Quiz </a>
                                                <?php endif; ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </div>


                                        
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!$auth): ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="home-main-block">
                        <?php if($setting): ?>
                            <h1 class="main-block-heading text-center"><?php echo e($setting->welcome_txt); ?></h1>
                        <?php endif; ?>
                        <blockquote>
                            Please <a href="<?php echo e(route('login')); ?>" title="Login">Login</a> To Start Quiz >>>
                        </blockquote>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('.sessionmodal').addClass("active");
            setTimeout(function() {
                $('.sessionmodal').removeClass("active");
            }, 4500);
        });
    </script>

    <?php if($setting->right_setting == 1): ?>
        <script type="text/javascript" language="javascript">
            // Right click disable
            $(function() {
                $(this).bind("contextmenu", function(inspect) {
                    inspect.preventDefault();
                });
            });
            // End Right click disable
        </script>
    <?php endif; ?>

    <?php if($setting->element_setting == 1): ?>
        <script type="text/javascript" language="javascript">
            //all controller is disable
            $(function() {
                var isCtrl = false;
                document.onkeyup = function(e) {
                    if (e.which == 17) isCtrl = false;
                }

                document.onkeydown = function(e) {
                    if (e.which == 17) isCtrl = true;
                    if (e.which == 85 && isCtrl == true) {
                        return false;
                    }
                };
                $(document).keydown(function(event) {
                    if (event.keyCode == 123) { // Prevent F12
                        return false;
                    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                        return false;
                    }
                });
            });
            // end all controller is disable
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/home.blade.php ENDPATH**/ ?>