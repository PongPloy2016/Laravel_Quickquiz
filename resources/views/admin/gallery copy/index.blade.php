@extends('layouts.admin', [
  'page_header' => 'Video List',
  'dash'        => '',
  'quiz'        => '',
  'users'       => '',
  'questions'   => '',
  'top_re'      => '',
  'all_re'      => '',
  'sett'        => '',
  'gallery'     => 'active',
])

@section('head')
<style>
  .vl-admin-thumb { width:80px;height:45px;object-fit:cover;border-radius:6px;border:1px solid rgba(255,255,255,.1); }
  .badge-yt  { background:#ff5252;color:#fff;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:700; }
  .badge-url { background:#43d9b4;color:#0a2a25;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:700; }
  .views-count { font-weight:700;color:#6c47ff; }
</style>
@endsection

@section('content')
<div class="margin-bottom" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
  <a href="{{ route('gallery.create') }}" class="btn btn-wave">
    <i class="fa fa-plus"></i> Add Video
  </a>
  <a href="{{ route('videolist.index') }}" target="_blank" class="btn btn-default">
    <i class="fa fa-eye"></i> View Public Page
  </a>
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-film"></i> จัดการวิดีโอทั้งหมด</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="galleryTable" class="table table-hover table-striped" style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Thumbnail</th>
          <th>Video Title</th>
          <th>Type</th>
          <th>Duration</th>
          <th>Views</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
  $('#galleryTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: "{{ route('gallery.index') }}",
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '40px' },
      { data: 'thumbnail',   name: 'thumbnail',   orderable: false, searchable: false, width: '90px' },
      { data: 'video_title', name: 'video_title' },
      { data: 'type_badge',  name: 'video_type',  width: '90px' },
      { data: 'video_duration', name: 'video_duration', width: '80px' },
      { data: 'total_views', name: 'total_views', width: '70px', className: 'views-count' },
      { data: 'status_badge', name: 'video_status', width: '80px' },
      { data: 'action', name: 'action', orderable: false, searchable: false, width: '100px' },
    ],
    dom: 'lBfrtip',
    buttons: ['csv', 'excel', 'pdf', 'print'],
    order: [[0, 'desc']],
  });
});
</script>
@endsection
