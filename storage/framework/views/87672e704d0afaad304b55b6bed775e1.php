

<?php $__env->startSection('content'); ?>
  <div class="margin-bottom">
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Add Quiz</button>
  </div>
  <!-- Create Modal -->
  <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Quiz</h4>
        </div>
        <?php echo Form::open(['method' => 'POST', 'action' => 'TopicController@store']); ?>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('title', 'Quiz Title'); ?>

                  <span class="required">*</span>
                  <?php echo Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Quiz Title', 'required' => 'required']); ?>

                  <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('per_q_mark') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('per_q_mark', 'Per Question Mark'); ?>

                  <span class="required">*</span>
                  <?php echo Form::number('per_q_mark', null, ['class' => 'form-control positive-number-input', 'placeholder' => 'Please Enter Per Question Mark', 'required' => 'required', 'min' => '0']); ?>

                  <small class="text-danger"><?php echo e($errors->first('per_q_mark')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('timer') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('timer', 'Quiz Time (in minutes)'); ?>

                  <?php echo Form::number('timer', null, ['class' => 'form-control positive-number-input', 'placeholder' => 'Please Enter Quiz Total Time (In Minutes)', 'min' => '0']); ?>

                  <small class="text-danger"><?php echo e($errors->first('timer')); ?></small>
                </div>

                <label for="married_status">Quiz Price:</label>
                

                <input type="checkbox" class="quizfp toggle-input" name="quiz_price" id="toggle">
                <label for="toggle"></label>
               
                <div style="display: none;" id="doabox">
                   <br>
                  <label for="dob">Choose Quiz Price: </label>
                  <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                <input value="" name="amount" id="doa" type="text" class="form-control positive-number-input" min="0" placeholder="Please Enter Quiz Price" aria-label="Quiz Price">
                 <small class="text-danger"><?php echo e($errors->first('amount')); ?></small>
                 </div>
                </div>
                <br>
              <div class="form-group <?php echo e($errors->has('show_ans') ? ' has-error' : ''); ?>">
                  <label for="">Enable Show Answer: </label>
                 <input type="checkbox" class="toggle-input" name="show_ans" id="toggle2">
                 <label for="toggle2"></label>
                <br>
              </div>                
              </div>
              <div class="col-md-6">
                <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('description', 'Description'); ?>

                  <?php echo Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Quiz Description', 'rows' => '8']); ?>

                  <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group pull-right">
              <?php echo Form::reset("Reset", ['class' => 'btn btn-default']); ?>

              <?php echo Form::submit("Add", ['class' => 'btn btn-wave']); ?>

            </div>
          </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body table-responsive">
      <table id="topicsTable" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Quiz Title</th>
            <th>Description</th>
            <th>Per Question Mark</th>
            <th>Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php if(isset($topics)): ?>
        <tbody>
         
        </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">  
 
  $(function() {
    $('#fb_check').change(function() {
      $('#fb').val(+ $(this).prop('checked'))
    })
  }) 
                  
  $(document).ready(function(){

      $('.quizfp').change(function(){

        if ($('.quizfp').is(':checked')){
            $('#doabox').show('fast');
        }else{
            $('#doabox').hide('fast');
        }
       
      });

  });                             

                               
  $('#priceCheck').change(function(){
    // price check toggle handler
  });

  function showprice(id)
  {
    if ($('#toggle2'+id).is(':checked')){
      $('#doabox2'+id).show('fast');
    }else{

      $('#doabox2'+id).hide('fast');
    }
  }     

$(function () {

    var table = $('#topicsTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      scrollCollapse: true,

      ajax: "<?php echo e(route('topics.index')); ?>",
      columns: [

      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
      {data: 'title', name: 'title'},
      {data: 'description', name: 'description'},
      {data: 'per_q_mark', name: 'per_q_mark'},
      {data: 'timer', name: 'timer'},
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
  'page_header' => 'Quiz',
  'dash' => '',
  'quiz' => 'active',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/quiz/index.blade.php ENDPATH**/ ?>