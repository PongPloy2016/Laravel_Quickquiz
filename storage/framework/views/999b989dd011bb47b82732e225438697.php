

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-body">
      <div class="margin-bottom">
      <a title="Create a new page" href="<?php echo e(route('pages.add')); ?>" class="btn btn-md btn-primary">+ Create Page</a>        
      </div>
      
      <table id="pagesTable" class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Title</th>
            <th>URL</th>
            <th>Status</th>
            <th>Action
            </th>
          </tr>
        </thead>
        <?php if(isset($pages)): ?>
        <tbody>
        </tbody>
        <?php endif; ?>
      </table>
    </div> 
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  $(function () {

    var table = $('#pagesTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      scrollCollapse: true,

      ajax: "<?php echo e(route('pages.index')); ?>",
      columns: [

      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
      {data: 'name', name: 'name'},
      {data: 'url', name: 'url'},
      {data: 'status', name: 'status'},
      {data: 'action', name: 'action',searchable: false}

      ],
      dom : 'lBfrtip',
      buttons : [
      'csv','excel','pdf','print'
      ],
      order : [[0,'desc']]
    });

  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Dashboard',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/pages/index.blade.php ENDPATH**/ ?>