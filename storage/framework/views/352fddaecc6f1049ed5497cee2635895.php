

<?php $__env->startSection('content'); ?>
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="example1" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Topic</th>
            <th>Amount</th>
            <th>Payment ID</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
        <?php if($data): ?>
          <?php if($auth->role != 'A'): ?>
            <?php ($n = 1); ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <?php echo e($n); ?>

                  <?php ($n++); ?>
                </td>
                <td><?php echo e($auth->name); ?></td>
                <td><?php echo e($item->title); ?></td>
                <td><i class="<?php echo e($setting->currency_symbol); ?>"></i> <?php echo e($item->pivot->amount); ?></td>
                <td><?php echo e($item->pivot->transaction_id); ?></td>
                <td><?php echo e($item->pivot->status == 1 ? 'Successful' : 'Unsuccessful'); ?></td>
                <td><?php echo e($item->pivot->created_at->toDateString()); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
          <?php else: ?>
            <?php ($n = 1); ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $item->user()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pivot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <?php echo e($n); ?>

                    <?php ($n++); ?>
                  </td>
                  <td><?php echo e($pivot->name); ?></td>
                  <td><?php echo e($item->title); ?></td>
                  <td><i class="<?php echo e($setting->currency_symbol); ?>"></i> <?php echo e($pivot->pivot->amount); ?></td>
                  <td><?php echo e($pivot->pivot->transaction_id); ?></td>
                  <td><?php echo e($pivot->pivot->status == 1 ? 'Successful' : 'Unsuccessful'); ?></td>
                  <td><?php echo e($pivot->pivot->created_at->toDateString()); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Payment History',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => '',
  'pay' => 'active'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/payment.blade.php ENDPATH**/ ?>