<?php $__env->startSection('head'); ?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
<style>
  /* Content wrapper override */
  .content-wrapper {
      background: #06061a !important;
  }

  /* Premium Dark Mode Wrapper */
  .db-dark-wrapper {
      background: #06061a;
      color: #f1f3f9;
      padding: 24px;
      margin: -15px;
      min-height: calc(100vh - 100px);
      font-family: 'Inter', sans-serif;
  }

  /* Header styling override */
  .content-header > h1 {
      color: #fff !important;
      font-weight: 700;
  }

  /* Mini stats cards */
  .mini-stat-card {
      border: none;
      border-radius: 12px;
      padding: 16px 20px;
      color: #fff;
      position: relative;
      overflow: hidden;
      margin-bottom: 24px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: space-between;
  }
  .mini-stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
  }
  .mini-stat-purple { background: linear-gradient(135deg, #6c47ff 0%, #8c7ae6 100%); }
  .mini-stat-red    { background: linear-gradient(135deg, #ff4d4d 0%, #ff7675 100%); }
  .mini-stat-green  { background: linear-gradient(135deg, #2ed573 0%, #1dd1a1 100%); }
  
  .mini-stat-number { font-size: 26px; font-weight: 800; font-family: 'Outfit', sans-serif; }
  .mini-stat-title  { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9; margin-top: 2px; }
  .mini-stat-icon   { font-size: 32px; opacity: 0.25; }

  /* Toolbar buttons */
  .vl-toolbar-wrap {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 24px;
      flex-wrap: wrap;
  }
  .btn-premium-action {
      background: linear-gradient(135deg, #6c47ff 0%, #5b36f5 100%);
      color: #fff !important;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 600;
      transition: 0.3s;
      box-shadow: 0 4px 15px rgba(108,71,255,.35);
  }
  .btn-premium-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(108,71,255,.5);
  }
  .btn-premium-default {
      background: rgba(255,255,255,0.04);
      color: #fff !important;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 600;
      transition: 0.3s;
  }
  .btn-premium-default:hover {
      background: rgba(255,255,255,0.08);
      border-color: rgba(255,255,255,0.15);
      transform: translateY(-2px);
  }

  /* Table panel */
  .db-dark-wrapper .box {
      background: #0d0d2b;
      border: 1px solid rgba(255,255,255,.05) !important;
      border-radius: 14px;
      box-shadow: 0 10px 30px rgba(0,0,0,.4) !important;
      color: #f1f3f9;
      margin-bottom: 24px;
      overflow: hidden;
  }
  .db-dark-wrapper .box-header {
      border-bottom: 1px solid rgba(255,255,255,.05);
      color: #fff;
      padding: 16px 20px;
  }
  .db-dark-wrapper .box-header .box-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: #fff;
  }

  /* DataTable UI Overrides */
  .db-dark-wrapper table.table {
      width: 100% !important;
      margin-bottom: 20px !important;
      border-collapse: collapse !important;
      background: #0d0d2b !important;
  }
  .db-dark-wrapper table.table th {
      color: #8c8fa3 !important;
      background: transparent !important;
      font-size: 0.92rem !important; /* Increased from 0.78rem */
      text-transform: uppercase !important;
      font-weight: 700 !important;
      padding: 14px 12px !important;
      border-bottom: 1.5px solid rgba(255,255,255,.08) !important;
      letter-spacing: 0.5px;
  }
  
  /* Force dark backgrounds on rows and cells */
  .db-dark-wrapper table.table tbody tr td {
      padding: 14px 12px !important;
      font-size: 0.98rem !important; /* Increased from 0.9rem */
      color: #ffffff !important; /* Force high contrast white text */
      border-bottom: 1px solid rgba(255,255,255,.03) !important;
      vertical-align: middle !important;
  }

  /* Target DataTables specific .odd and .even row classes */
  .db-dark-wrapper table.table tbody tr,
  .db-dark-wrapper table.table tbody tr.even td,
  .db-dark-wrapper table.table tbody tr.even {
      background: #0d0d2b !important;
      background-color: #0d0d2b !important;
  }
  
  .db-dark-wrapper table.table tbody tr.odd td,
  .db-dark-wrapper table.table tbody tr.odd {
      background: #11112b !important;
      background-color: #11112b !important;
  }
  
  .db-dark-wrapper table.table tbody tr:hover td,
  .db-dark-wrapper table.table tbody tr:hover {
      background: rgba(255,255,255,.035) !important;
      background-color: rgba(255,255,255,.035) !important;
  }

  /* DataTables control widgets */
  .dataTables_wrapper .dataTables_filter input,
  .dataTables_wrapper .dataTables_length select {
      background: #11112b !important;
      border: 1px solid rgba(255,255,255,.08) !important;
      color: #fff !important;
      border-radius: 8px !important;
      padding: 8px 14px !important; /* Larger padding */
      font-size: 0.95rem !important; /* Increased font-size */
      transition: all 0.3s ease;
  }
  .dataTables_wrapper .dataTables_filter input:focus,
  .dataTables_wrapper .dataTables_length select:focus {
      border-color: #6c47ff !important;
      box-shadow: 0 0 10px rgba(108,71,255,.3) !important;
      outline: none !important;
  }
  .dataTables_wrapper .dataTables_info {
      color: #8c8fa3 !important;
      font-size: 0.95rem; /* Increased from 0.88rem */
  }
  
  /* Export buttons */
  .db-dark-wrapper .dt-buttons .dt-button,
  .db-dark-wrapper .buttons-csv,
  .db-dark-wrapper .buttons-excel,
  .db-dark-wrapper .buttons-pdf,
  .db-dark-wrapper .buttons-print {
      background: rgba(255,255,255,0.04) !important;
      border: 1px solid rgba(255,255,255,.15) !important;
      color: #fff !important;
      border-radius: 8px !important;
      padding: 8px 16px !important; /* Larger padding */
      font-size: 0.92rem !important; /* Increased from 0.85rem */
      font-weight: 600 !important;
      transition: all 0.2s ease !important;
      margin-right: 5px !important;
      box-shadow: none !important;
  }
  .db-dark-wrapper .dt-buttons .dt-button:hover,
  .db-dark-wrapper .buttons-csv:hover,
  .db-dark-wrapper .buttons-excel:hover,
  .db-dark-wrapper .buttons-pdf:hover,
  .db-dark-wrapper .buttons-print:hover {
      background: #6c47ff !important;
      border-color: #6c47ff !important;
      color: #fff !important;
      transform: translateY(-1px) !important;
  }

  /* Pagination buttons */
  .dataTables_wrapper .dataTables_paginate .paginate_button {
      background: #11112b !important;
      border: 1.5px solid rgba(255,255,255,.08) !important;
      color: #8c8fa3 !important;
      border-radius: 6px !important;
      padding: 8px 14px !important; /* Larger padding */
      margin: 0 3px !important;
      font-size: 0.95rem !important;
      transition: all 0.2s ease !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: rgba(255,255,255,0.06) !important;
      border-color: rgba(255,255,255,0.15) !important;
      color: #fff !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: linear-gradient(135deg, #6c47ff 0%, #8c7ae6 100%) !important;
      border-color: #6c47ff !important;
      color: #fff !important;
      font-weight: 700 !important;
      box-shadow: 0 4px 12px rgba(108,71,255,.35) !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
      opacity: 0.25 !important;
      cursor: not-allowed !important;
      background: #11112b !important;
      border-color: rgba(255,255,255,.05) !important;
  }

  /* Specific column elements */
  .vl-admin-thumb {
      width: 80px; /* Slightly larger */
      aspect-ratio: 16/9;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 2px 8px rgba(0,0,0,.3);
  }
  .badge-yt  { background: rgba(255, 77, 77, 0.12); color: #ff4d4d; padding: 5px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; border: 1px solid rgba(255, 77, 77, 0.2); }
  .badge-url { background: rgba(29, 209, 161, 0.12); color: #1dd1a1; padding: 5px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; border: 1px solid rgba(29, 209, 161, 0.2); }
  .views-count { font-weight: 700; color: #a29bfe; font-family: 'Outfit', sans-serif; font-size: 1.05rem; }
  
  /* Edit/delete actions */
  .admin-table-action-block { display: flex; gap: 8px; justify-content: center; }
  .admin-table-action-block .btn { border-radius: 6px; padding: 6px 12px; border: none; font-size: 0.95rem; transition: 0.2s; }
  .admin-table-action-block .btn-primary { background: rgba(108,71,255,0.2) !important; color: #b4a7ff !important; border: 1px solid rgba(108,71,255,0.4) !important; }
  .admin-table-action-block .btn-primary:hover { background: #6c47ff !important; color: #fff !important; }
  .admin-table-action-block .btn-danger { background: rgba(255,77,77,0.2) !important; color: #ff8f8f !important; border: 1px solid rgba(255,77,77,0.4) !important; }
  .admin-table-action-block .btn-danger:hover { background: #ff4d4d !important; color: #fff !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $totalVideos  = App\Gallery::count();
  $youtubeCount = App\Gallery::where('video_type', 'youtube')->count();
  $urlCount     = App\Gallery::where('video_type', 'Url')->count();
?>

<div class="db-dark-wrapper">
  
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="mini-stat-card mini-stat-purple">
        <div>
          <div class="mini-stat-number"><?php echo e($totalVideos); ?></div>
          <div class="mini-stat-title">Total Videos</div>
        </div>
        <div class="mini-stat-icon"><i class="fa fa-film"></i></div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6">
      <div class="mini-stat-card mini-stat-red">
        <div>
          <div class="mini-stat-number"><?php echo e($youtubeCount); ?></div>
          <div class="mini-stat-title">YouTube Videos</div>
        </div>
        <div class="mini-stat-icon"><i class="fa fa-youtube-play"></i></div>
      </div>
    </div>

    <div class="col-md-4 col-sm-12">
      <div class="mini-stat-card mini-stat-green">
        <div>
          <div class="mini-stat-number"><?php echo e($urlCount); ?></div>
          <div class="mini-stat-title">URL / Uploads</div>
        </div>
        <div class="mini-stat-icon"><i class="fa fa-link"></i></div>
      </div>
    </div>
  </div>

  
  <div class="vl-toolbar-wrap">
    <a href="<?php echo e(route('gallery.create')); ?>" class="btn-premium-action">
      <i class="fa fa-plus"></i> Add Video
    </a>
    <a href="<?php echo e(route('videolist.index')); ?>" target="_blank" class="btn-premium-default">
      <i class="fa fa-eye"></i> View Public Page
    </a>
  </div>

  
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-film" style="color:#6c47ff"></i> จัดการวิดีโอทั้งหมด</h3>
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(function () {
  $('#galleryTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: "<?php echo e(route('gallery.index')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Video List',
  'dash'        => '',
  'quiz'        => '',
  'users'       => '',
  'questions'   => '',
  'top_re'      => '',
  'all_re'      => '',
  'sett'        => '',
  'gallery'     => 'active',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/gallery/index.blade.php ENDPATH**/ ?>