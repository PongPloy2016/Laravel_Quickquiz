<?php $__env->startSection('content'); ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-plus-circle"></i> เพิ่มวิดีโอใหม่
      <a href="<?php echo e(route('gallery.index')); ?>" class="btn btn-gray btn-sm pull-right">
        <i class="fa fa-arrow-left"></i> Back
      </a>
    </h3>
  </div>
  <div class="box-body">
    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('gallery.store')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="row">
        <div class="col-md-7">

          <div class="form-group<?php echo e($errors->has('video_title') ? ' has-error' : ''); ?>">
            <label>ชื่อวิดีโอ <span class="required">*</span></label>
            <input type="text" name="video_title" class="form-control" placeholder="กรอกชื่อวิดีโอ" value="<?php echo e(old('video_title')); ?>" required>
            <small class="text-danger"><?php echo e($errors->first('video_title')); ?></small>
          </div>

          <div class="form-group<?php echo e($errors->has('video_url') ? ' has-error' : ''); ?>">
            <label>URL วิดีโอ <span class="required">*</span></label>
            <input type="text" name="video_url" id="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=... หรือ URL วิดีโออื่น" value="<?php echo e(old('video_url')); ?>" required oninput="autoDetectType()">
            <small class="text-muted">วาง YouTube URL แล้ว Video ID จะถูกดึงโดยอัตโนมัติ</small>
            <small class="text-danger"><?php echo e($errors->first('video_url')); ?></small>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group<?php echo e($errors->has('video_type') ? ' has-error' : ''); ?>">
                <label>ประเภทวิดีโอ <span class="required">*</span></label>
                <select name="video_type" id="video_type" class="form-control" required>
                  <option value="youtube" <?php echo e(old('video_type') == 'youtube' ? 'selected' : ''); ?>>YouTube</option>
                  <option value="Url" <?php echo e(old('video_type') == 'Url' ? 'selected' : ''); ?>>URL / อัพโหลด</option>
                </select>
                <small class="text-danger"><?php echo e($errors->first('video_type')); ?></small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group<?php echo e($errors->has('video_duration') ? ' has-error' : ''); ?>">
                <label>ความยาววิดีโอ</label>
                <input type="text" name="video_duration" class="form-control" placeholder="เช่น 10:30 หรือ 1:30:00" value="<?php echo e(old('video_duration')); ?>">
                <small class="text-danger"><?php echo e($errors->first('video_duration')); ?></small>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>คำอธิบาย</label>
            <textarea name="video_description" class="form-control" rows="5" placeholder="คำอธิบายวิดีโอ"><?php echo e(old('video_description')); ?></textarea>
          </div>

        </div>
        <div class="col-md-5">

          <div class="form-group">
            <label>Thumbnail (รูปภาพหน้าปก)</label>
            <div class="thumb-preview-wrap" style="margin-bottom:10px;">
              <img id="thumb-preview" src="https://via.placeholder.com/300x170/1a1a35/6c47ff?text=No+Preview"
                   style="width:100%;border-radius:8px;border:1px solid #ddd;" alt="Preview">
            </div>
            <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="previewThumb(this)">
            <small class="text-muted">รองรับ JPG, PNG, WEBP ขนาดไม่เกิน 4MB</small>
          </div>

          <div class="form-group">
            <label>หมวดหมู่ (cat_id)</label>
            <input type="number" name="cat_id" class="form-control" value="<?php echo e(old('cat_id', 1)); ?>" min="1">
          </div>

          <div class="form-group">
            <label>
              <input type="checkbox" name="video_status" value="1" <?php echo e(old('video_status', 1) ? 'checked' : ''); ?> style="margin-right:6px;">
              เผยแพร่ (Active)
            </label>
          </div>

        </div>
      </div>

      <hr>
      <div class="btn-group">
        <button type="submit" class="btn btn-wave"><i class="fa fa-save"></i> บันทึก</button>
        <a href="<?php echo e(route('gallery.index')); ?>" class="btn btn-default">ยกเลิก</a>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function previewThumb(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('thumb-preview').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function autoDetectType() {
  var url = document.getElementById('video_url').value;
  var sel = document.getElementById('video_type');
  if (url.indexOf('youtube.com') !== -1 || url.indexOf('youtu.be') !== -1) {
    sel.value = 'youtube';
    // Auto-fetch YouTube thumbnail for preview
    var match = url.match(/[?&]v=([a-zA-Z0-9_-]{11})/) || url.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/);
    if (match) {
      document.getElementById('thumb-preview').src = 'https://img.youtube.com/vi/' + match[1] + '/mqdefault.jpg';
    }
  } else if (url) {
    sel.value = 'Url';
  }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Add Video',
  'dash'        => '',
  'quiz'        => '',
  'users'       => '',
  'questions'   => '',
  'top_re'      => '',
  'all_re'      => '',
  'sett'        => '',
  'gallery'     => 'active',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/gallery/create.blade.php ENDPATH**/ ?>