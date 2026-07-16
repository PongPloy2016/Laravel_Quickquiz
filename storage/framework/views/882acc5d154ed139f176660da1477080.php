<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo e($user->name); ?>'s Report</title>  
</head>
<body>
  <h1><?php echo e($user->name); ?></h1>
  <div class="container">
    <h2 class="text-center main-block-heading"><?php echo e($user->name); ?> ANSWER REPORT</h2>
    <h3 class="text-center main-block-heading">Quiz: <?php echo e($topic->title); ?></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Question</th>                  
          
          <th style="color: green;">Correct Answer</th>
          <th style="color: blue;"><?php echo e($user->name); ?> Answer</th>
          <th>Answer Explnation</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $questions = App\Question::where('topic_id', $topic->id)->get();
          $count_questions = $questions->count();
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

    <table class="table table-bordered result-table">
        <thead>
          <tr>
            <th>Total Questions</th>
            <th><?php echo e($user->name); ?>'s Marks</th>
            <th>Per Question Mark</th>
            <th>Total Marks</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo e($count_questions); ?></td>
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
            <td><?php echo e($topic->per_q_mark); ?></td>
            <td><?php echo e($topic->per_q_mark*$count_questions); ?></td>
          </tr>
        </tbody>
    </table>
  </div>
</body>
</html>
<?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/all_reports/report.blade.php ENDPATH**/ ?>