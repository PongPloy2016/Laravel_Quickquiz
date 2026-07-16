

<?php $__env->startSection('head'); ?>
  <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" >
  <!-- Font Awesome -->
  <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" >
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet" >
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
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
            <img src="<?php echo e(asset('/images/logo/'. $setting->logo)); ?>" class="img-responsive" alt="<?php echo e($setting->welcome_txt); ?>">
          </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              <?php if($setting): ?>
                <a title="Quick Quiz Home" class="tt" href="<?php echo e(url('/')); ?>"><h4 class="heading"><?php echo e($setting->welcome_txt); ?></h4></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">             
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                  <li><a href="<?php echo e(route('login')); ?>" title="Login">Login</a></li>
                  <li><a href="<?php echo e(route('register')); ?>" title="Register">Register</a></li>
                <?php else: ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <?php if($auth->role == 'A'): ?>
                        <li><a href="<?php echo e(url('/admin')); ?>" title="Dashboard">Dashboard</a></li>
                      <?php elseif($auth->role == 'S'): ?>
                        <li><a href="<?php echo e(url('/admin/my_reports')); ?>" title="Dashboard">Dashboard</a></li>
                      <?php endif; ?>
                      <li>
                        <a href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                      </form>
                      </li>
                    </ul>
                 </li>
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
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="home-main-block">

         <button title="Print Report" class="print_btn pull-right btn btn-md btn-default">
              <i class="fa fa-print"></i>
         </button>

        <?php if($topic->show_ans==1): ?>
        
         <div class="question-block">
            <h2 class="text-center main-block-heading"><?php echo e($topic->title); ?> ANSWER REPORT</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Question</th>                  
                  
                  <th style="color: green;">Correct Answer</th>
                  <th style="color: red;">Your Answer</th>
                  <th>Answer Explnation</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();
                ?>             
               
                <?php
                $x = $count_questions;               
                $y = 1;
                ?>
                <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <?php if($a->user_answer != "0" && $topic->id == $a->topic_id): ?>
                    <tr>
                      <td><?php echo e($a->question->question); ?></td>
                      <td><?php echo e($a->answer); ?></td>
                      <td><?php echo e($a->user_answer); ?></td>
                      <td><?php echo e($a->question->answer_exp); ?></td>
                    </tr>
                    <?php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    ?>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
               
              </tbody>
            </table>
            
          </div>

          <?php endif; ?>



          <div class="question-block">
            <h2 class="text-center main-block-heading"><?php echo e($topic->title); ?> Result</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Total Questions</th>
                  <th>Per Question Mark</th>
                  <th>Total Question Marks</th>
                  <th>My Marks</th>
                 
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo e($count_questions); ?></td>
                  <td><?php echo e($topic->per_q_mark); ?></td>
                  <td><?php echo e($topic->per_q_mark*$count_questions); ?></td>
                  <td>

                    <?php
                      $mark = 0;
                      $correct = collect();
                    ?>

                    <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($answer->answer == $answer->user_answer): ?>
                        <?php
                        $mark++;
                        ?>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $correct = $mark*$topic->per_q_mark;
                    ?>
                    <?php echo e($correct); ?>

                    
                  </td>
                 
                </tr>
              </tbody>
            </table>
            <h2 class="text-center">Thank You!</h2>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
    $(document).ready(function(){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
      });
    });
  </script>

  <script>
    $('.print_btn').click(function(){
      window.print();
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/finish.blade.php ENDPATH**/ ?>