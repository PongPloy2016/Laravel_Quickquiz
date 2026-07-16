

<?php $__env->startSection('content'); ?>
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="example1" class="table table-striped table-hover">
        <thead class="info">
          <tr>
            <th>#</th>
            <th>Question</th>
            <th>Correct Answer</th>
            <th>My Answer</th>
            <th>Answer Explanation</th>
            <th>Marks</th>
            <th>Total Marks</th>
          </tr>
        </thead>
        <tbody>
          <?php if($topic->show_ans ==1): ?>
          <?php if($answers): ?>
            <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <?php echo e($key+1); ?>

                  <?php
                    $correct_answer = strtolower($answer->answer);
                    $user_answer = strtolower($answer->user_answer);
                  ?>
                </td>
                <td><?php echo e($answer->question->question); ?></td>
                <td><?php echo e($answer->question->$correct_answer); ?></td>
                <td><?php echo e($answer->question->$user_answer); ?></td>
                <td><?php echo e($answer->question->answer_exp ? $answer->question->answer_exp : '-'); ?></td>
                <td>
                  <?php if($answer->answer == $answer->user_answer): ?>
                    <?php echo e(1*$topic->per_q_mark); ?>

                  <?php else: ?>
                    0
                  <?php endif; ?>
                </td>
                <td>
                  <?php echo e($total_marks * $topic->per_q_mark); ?>

                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => "My Report / {$topic->title}",
  'dash' => '',
  'users' => '',
  'questions' => '',
  'answers' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/my_reports/show.blade.php ENDPATH**/ ?>