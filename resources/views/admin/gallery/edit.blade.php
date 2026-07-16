@extends('layouts.admin', [
  'page_header' => 'Edit Video',
  'dash'        => '',
  'quiz'        => '',
  'users'       => '',
  'questions'   => '',
  'top_re'      => '',
  'all_re'      => '',
  'sett'        => '',
  'gallery'     => 'active',
])

@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-pencil"></i> แก้ไขวิดีโอ
      <a href="{{ route('gallery.index') }}" class="btn btn-gray btn-sm pull-right">
        <i class="fa fa-arrow-left"></i> Back
      </a>
    </h3>
  </div>
  <div class="box-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    <form method="POST" action="{{ route('gallery.update', $video->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-7">

          <div class="form-group{{ $errors->has('video_title') ? ' has-error' : '' }}">
            <label>ชื่อวิดีโอ <span class="required">*</span></label>
            <input type="text" name="video_title" class="form-control" value="{{ old('video_title', $video->video_title) }}" required>
            <small class="text-danger">{{ $errors->first('video_title') }}</small>
          </div>

          <div class="form-group{{ $errors->has('video_url') ? ' has-error' : '' }}">
            <label>URL วิดีโอ <span class="required">*</span></label>
            <input type="text" name="video_url" id="video_url" class="form-control" value="{{ old('video_url', $video->video_url) }}" required oninput="autoDetectType()">
            <small class="text-danger">{{ $errors->first('video_url') }}</small>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('video_type') ? ' has-error' : '' }}">
                <label>ประเภทวิดีโอ <span class="required">*</span></label>
                <select name="video_type" id="video_type" class="form-control" required>
                  <option value="youtube" {{ old('video_type', $video->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                  <option value="Url" {{ old('video_type', $video->video_type) == 'Url' ? 'selected' : '' }}>URL / อัพโหลด</option>
                </select>
                <small class="text-danger">{{ $errors->first('video_type') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('video_duration') ? ' has-error' : '' }}">
                <label>ความยาววิดีโอ</label>
                <input type="text" name="video_duration" class="form-control" placeholder="เช่น 10:30" value="{{ old('video_duration', $video->video_duration) }}">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>คำอธิบาย</label>
            <textarea name="video_description" class="form-control" rows="6">{{ old('video_description', strip_tags($video->video_description)) }}</textarea>
          </div>

        </div>
        <div class="col-md-5">

          <div class="form-group">
            <label>Thumbnail ปัจจุบัน / ใหม่</label>
            @php
              if (!empty($video->video_thumbnail)) {
                  $currentThumb = asset('video_image/' . $video->video_thumbnail);
              } elseif ($video->video_type === 'youtube' && !empty($video->video_id)) {
                  $currentThumb = "https://img.youtube.com/vi/{$video->video_id}/mqdefault.jpg";
              } else {
                  $currentThumb = 'https://via.placeholder.com/300x170/1a1a35/6c47ff?text=No+Image';
              }
            @endphp
            <div style="margin-bottom:10px;">
              <img id="thumb-preview" src="{{ $currentThumb }}"
                   style="width:100%;border-radius:8px;border:1px solid #ddd;" alt="Thumbnail">
            </div>
            <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="previewThumb(this)">
            <small class="text-muted">อัพโหลดรูปใหม่เพื่อเปลี่ยน Thumbnail (ทิ้งว่างเพื่อใช้รูปเดิม)</small>
          </div>

          <div class="form-group">
            <label>หมวดหมู่ (cat_id)</label>
            <input type="number" name="cat_id" class="form-control" value="{{ old('cat_id', $video->cat_id) }}" min="1">
          </div>

          <div class="form-group">
            <label>
              <input type="checkbox" name="video_status" value="1" {{ $video->video_status == 1 ? 'checked' : '' }} style="margin-right:6px;">
              เผยแพร่ (Active)
            </label>
          </div>

          <div class="form-group">
            <label>จำนวนการดู</label>
            <input type="text" class="form-control" value="{{ number_format($video->total_views) }} วิว" disabled>
          </div>

        </div>
      </div>

      <hr>
      <div class="btn-group">
        <button type="submit" class="btn btn-wave"><i class="fa fa-save"></i> อัปเดต</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-default">ยกเลิก</a>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
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
  } else if (url) {
    sel.value = 'Url';
  }
}
</script>
@endsection
