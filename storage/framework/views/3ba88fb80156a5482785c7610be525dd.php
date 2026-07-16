

<?php $__env->startSection('content'); ?>
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="topTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Mobile No.</th>            
            <th>Topic</th>
            <th>Total Question Marks</th>
            <th>Marks you Got</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if($answers): ?>
            <?php $__currentLoopData = $filtStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <?php echo e($key+1); ?>

                </td>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e($student->mobile ? $student->mobile : '-'); ?></td>               
                <td><?php echo e($topic->title); ?></td>
                <td>
                  <?php echo e($c_que*$topic->per_q_mark); ?>

                </td>
                <td>
                  <?php
                    $mark = 0;
                    $correct = collect();
                  ?>
                  <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($answer->user_id == $student->id && $answer->answer == $answer->user_answer): ?>
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
                
                <td>
                  <a data-toggle="modal" data-target="#delete<?php echo e($topic->id); ?>" title="It will delete the answer sheet of this student" href="#" class="btn btn-sm btn-warning">
                    Reset Response
                  </a>

                  <a href="<?php echo e(route('pdf.report',['id' => $topic->id, 'userid' => $student->id])); ?>" title="Download in PDF Format" class="btn btn-md btn-default">
                     <i class="fa fa-download"></i>
                  </a>

                  <div id="delete<?php echo e($topic->id); ?>" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">Are You Sure ?</h4>
                            <p>Do you really want to delete these record? This process cannot be undone.</p>
                          </div>
                          <div class="modal-footer">
                            <?php echo Form::open(['method' => 'DELETE', 'action' => ['AllReportController@delete', 'topicid' => $topic->id, 'userid' => $student->id] ]); ?>

                                <?php echo Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']); ?>

                                <?php echo Form::submit("Yes", ['class' => 'btn btn-danger']); ?>

                            <?php echo Form::close(); ?>

                          </div>
                        </div>
                      </div>
                    </div>

                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => "Top Students / {$topic->title}",
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => 'active',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/all_reports/show.blade.php ENDPATH**/ ?>