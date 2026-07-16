

<?php $__env->startSection('content'); ?>
  <div class="row">
    <?php if($topics): ?>
      <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-4">
          <div class="quiz-card">
            <h3 class="quiz-name"><?php echo e($topic->title); ?></h3>
            <p title="<?php echo e($topic->description); ?>">
              <?php echo e(str_limit($topic->description, 120)); ?>

            </p>
            <div class="row">
              <div class="col-xs-6 pad-0">
                <ul class="topic-detail">
                  <li>Per Question Marks <i class="fa fa-long-arrow-right"></i></li>
                  <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                  <li>Total Questions <i class="fa fa-long-arrow-right"></i></li>
                  <li>Time <i class="fa fa-long-arrow-right"></i></li>
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
                    <?php echo e($topic->per_q_mark*$qu_count); ?>

                  </li>
                  <li>
                    <?php echo e($qu_count); ?>

                  </li>
                  <li>
                    <?php echo e($topic->timer); ?> minutes
                  </li>
                </ul>
              </div>
            </div>

            <?php if($topic->show_ans ==1): ?>
            <a href="<?php echo e(route('my_report_show', $topic->id)); ?>" class="btn btn-wave" title="Show Report">Show Report</a>
            <?php endif; ?>
            
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'My Reports By Topic Wise',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/my_reports/index.blade.php ENDPATH**/ ?>