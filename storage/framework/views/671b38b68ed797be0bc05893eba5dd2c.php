

<?php $__env->startSection('content'); ?>
    <div class="contentbar">
        <div class="row">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger" role="alert">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($error); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                title="<?php echo e(__('Close')); ?>">
                                <span aria-hidden="true" style="color:red;">&times;</span></button></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <!-- row started -->
            <div class="col-lg-12">
                <div class="card dashboard-card m-b-30">                    
                    <div class="card-header">
                        
                        <h3 class="card-box"><?php echo e(__('All Delete Requests List')); ?></h3 >
                    </div>
                    <!-- card body started -->
                    <div class="content-block box">
                        <div class="box-body table-responsive">
                          <table id="example1" class="table table-striped">
                                <thead>
                                    <th>
                                        <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                            value="all" />
                                        <label for="checkboxAll" class="material-checkbox"></label> #
                                    </th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Reason')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($test)): ?>
                                            <tr>
                                                <td>
                                                    <input type='checkbox' form='bulk_delete_form'
                                                        class='check filled-in material-checkbox-input' name='checked[]'
                                                        value="<?php echo e($test->id); ?>" id='checkbox<?php echo e($test->id); ?>'>
                                                    <label for='checkbox<?php echo e($test->id); ?>'
                                                        class='material-checkbox'></label>
                                                    <?php echo $key + 1; ?>
                                                    <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                                        <div class="modal-dialog modal-sm">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        title="<?php echo e(__('Close')); ?>">&times;</button>
                                                                    <div class="delete-icon"></div>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <h4 class="modal-heading"><?php echo e(__('Are You Sure')); ?> ?
                                                                    </h4>
                                                                    <p><?php echo e(__('Do you really want to delete selected item ? This process
                                                                                                                        cannot be undone')); ?>.
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form id="bulk_delete_form" method="post"
                                                                        action="<?php echo e(route('users-bulk-delete')); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('POST'); ?>
                                                                        <button type="reset"
                                                                            class="btn btn-gray translate-y-3"
                                                                            data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo e($test->name); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($test->delete_reason); ?>

                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        
                                                        
                                                            <a class="dropdown-item btn" data-toggle="modal"
                                                                data-target="#delete<?php echo e($test->id); ?>"
                                                                title="<?php echo e(__('Delete')); ?>">
                                                                <i
                                                                    class="feather icon-delete mr-2"></i><?php echo e(__('Delete')); ?></a>
                                                            </a>
                                                        
                                                    </div>
                                                    
                                                    <!-- delete Modal start -->
                                                    <div class="modal fade bd-example-modal-sm"
                                                        id="delete<?php echo e($test->id); ?>" tabindex="-1" role="dialog"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleSmallModalLabel">
                                                                        <?php echo e(__('Delete')); ?></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"
                                                                        title="<?php echo e(__('Close')); ?>">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4><?php echo e(__('Are You Sure ?')); ?></h4>
                                                                    <p><?php echo e(__('Do you really want to delete')); ?>

                                                                        <b><?php echo e($test->title); ?></b>
                                                                        ? <?php echo e(__('This process cannot be undone.')); ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post"
                                                                        action="<?php echo e(url('admin/user-delete/' . $test->id)); ?>"
                                                                        class="pull-right">
                                                                        <?php echo e(csrf_field()); ?>

                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                        <button type="reset" class="btn btn-secondary"
                                                                            data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary"><?php echo e(__('Yes')); ?></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- delete Model ended -->
                                                    
                                                </td>

                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <!-- table to display faq data end -->
                        </div><!-- table-responsive div end -->
                    </div><!-- card body end -->

                </div><!-- col end -->
            </div>
        </div>
    </div>
    <!-- row end -->
    <br><br>
<?php $__env->stopSection(); ?>
<!-- main content section ended -->
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url('admin_assets/assets/js/lightbox-plus-jquery.min.js')); ?>"></script>
    <script>
        $("#checkboxAll").on('click', function() {
            $('input.check').not(this).prop('checked', this.checked);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/users/requests.blade.php ENDPATH**/ ?>