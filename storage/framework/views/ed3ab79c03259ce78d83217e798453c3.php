

<?php $__env->startSection('head'); ?>
  <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
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
              
              <?php if($topic): ?>
                <h4 class="heading"><?php echo e($topic->title); ?></h4>
              
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">              
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li id="clock"></li>
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
    <div class="home-main-block">
      <?php 
        $users =  App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->first();
        // dd($users);
        $que =  App\Question::where('topic_id',$topic->id)->first();
      ?>

      <?php if(empty($users)): ?>
        <div id="question_block" class="question-block">
          <question :topic_id="<?php echo e($topic->id); ?>" ></question>
        </div>
        <?php if(empty($que)): ?>
        <div class="alert alert-danger">
          <p>
            No Questions in this quiz <b> <?php echo e($topic->title); ?> </b>
          </p>
          <p>
            <a class="text-danger" href="<?php echo e(url('/home')); ?>"> <u> <i class="fa fa-home" aria-hidden="true"></i> Return Home </u> </a>
          </p>
        </div>
        <?php endif; ?>
      <?php else: ?>
        <div class="alert alert-danger text-center">
          <p>
            You have already submitted the quiz <b> <?php echo e($topic->title); ?>.</b>
          </p>
          <p>
            <a class="text-danger" href="<?php echo e(url('/home')); ?>"> <u> <i class="fa fa-home" aria-hidden="true"></i> Return Home </u> </a>
          </p>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <!-- jQuery 3 -->
  <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.cookie.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.countdown.js')); ?>"></script>

  <?php if(!empty($que) && empty($users)): ?>
   <script>
    var topic_id = <?php echo e($topic->id); ?>;
    var timer = <?php echo e($topic->timer); ?>;
     $(document).ready(function() {
      function e(e) {
          (116 == (e.which || e.keyCode) || 82 == (e.which || e.keyCode)) && e.preventDefault()
      }
      setTimeout(function() {
          $(".myQuestion:first-child").addClass("active");
          $(".prebtn").attr("disabled", true); 
      }, 2500), history.pushState(null, null, document.URL), window.addEventListener("popstate", function() {
          history.pushState(null, null, document.URL)
      }), $(document).on("keydown", e), setTimeout(function() {
          $(".nextbtn").click(function() {
              var e = $(".myQuestion.active");
              $(e).removeClass("active"), 0 == $(e).next().length ? (Cookies.remove("time"), Cookies.set("done", "Your Quiz is Over...!", {
                  expires: 1
              }), location.href = "<?php echo e($topic->id); ?>/finish") : ($(e).next().addClass("active"), $(".myForm")[0].reset(),
              $(".prebtn").attr("disabled", false))
          }),
          $(".prebtn").click(function() {  
              var e = $(".myQuestion.active");
              $(e).removeClass("active"),
              $(e).prev().addClass("active"), $(".myForm")[0].reset()
              $(".myQuestion:first-child").hasClass("active") ?  $(".prebtn").attr("disabled", true) :   $(".prebtn").attr("disabled", false);
          })
      }, 700);
      var i, o = (new Date).getTime() + 6e4 * timer;
      if (Cookies.get("time") && Cookies.get("topic_id") == topic_id) {
          i = Cookies.get("time");
          var t = o - i,
              n = o - t;
          $("#clock").countdown(n, {
              elapse: !0
          }).on("update.countdown", function(e) {
              var i = $(this);
              e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                  expires: 1
              }), Cookies.remove("time"), location.href = "<?php echo e($topic->id); ?>/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
          })
      } else Cookies.set("time", o, {
          expires: 1
      }), Cookies.set("topic_id", topic_id, {
          expires: 1
      }), $("#clock").countdown(o, {
          elapse: !0
      }).on("update.countdown", function(e) {
          var i = $(this);
          e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
              expires: 1
          }), Cookies.remove("time"), location.href = "<?php echo e($topic->id); ?>/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
      })
  });
  </script>
  <?php else: ?>
  <?php echo e(""); ?>

  <?php endif; ?>

  
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
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/main_quiz.blade.php ENDPATH**/ ?>