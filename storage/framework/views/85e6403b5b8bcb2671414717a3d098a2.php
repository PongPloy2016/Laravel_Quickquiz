<?php $__env->startSection('head'); ?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
<style>
  /* Premium Dark Mode Styling Wrapper */
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

  /* Premium stats card overrides */
  .db-card-gradient {
      border: none;
      border-radius: 14px;
      padding: 22px;
      color: #fff;
      position: relative;
      overflow: hidden;
      margin-bottom: 24px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
      transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
  }
  .db-card-gradient:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
  }
  .db-card-yellow { background: linear-gradient(135deg, #ff9f43 0%, #ffc048 100%); }
  .db-card-red    { background: linear-gradient(135deg, #ff4d4d 0%, #ff7675 100%); }
  .db-card-green  { background: linear-gradient(135deg, #2ed573 0%, #1dd1a1 100%); }
  .db-card-purple { background: linear-gradient(135deg, #6c47ff 0%, #8c7ae6 100%); }
  
  .db-card-icon {
      position: absolute;
      right: 15px;
      bottom: 10px;
      font-size: 60px;
      opacity: 0.25;
      transition: all 0.35s ease;
  }
  .db-card-gradient:hover .db-card-icon {
      transform: scale(1.18) rotate(-8deg);
      opacity: 0.42;
  }
  .db-card-number { font-size: 38px; font-weight: 800; margin-bottom: 4px; line-height: 1; font-family: 'Outfit', sans-serif; }
  .db-card-text   { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; opacity: 0.9; }
  .db-card-link   { color: rgba(255,255,255,0.85); display: inline-block; margin-top: 15px; font-size: 12px; font-weight: 600; text-decoration: none; transition: 0.2s; }
  .db-card-link:hover { color: #fff; text-decoration: none; padding-left: 4px; }

  /* Dark Boxes */
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
      display: flex;
      align-items: center;
      gap: 10px;
  }
  .db-dark-wrapper .box-body {
      padding: 20px;
  }

  /* Table styling */
  .db-table-dark {
      width: 100%;
      border-collapse: collapse;
  }
  .db-table-dark th {
      color: #8c8fa3;
      font-size: 0.78rem;
      text-transform: uppercase;
      font-weight: 700;
      padding: 12px 10px;
      border-bottom: 1px solid rgba(255,255,255,.06);
      letter-spacing: 0.5px;
  }
  .db-table-dark td {
      padding: 12px 10px;
      font-size: 0.9rem;
      color: #e2e5f0;
      border-bottom: 1px solid rgba(255,255,255,.03);
      vertical-align: middle;
  }
  .db-table-dark tr:last-child td { border-bottom: none; }
  .db-table-dark tr:hover td {
      background: rgba(255,255,255,.015);
  }

  /* User items */
  .db-user-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 0;
      border-bottom: 1px solid rgba(255,255,255,.03);
  }
  .db-user-item:last-child { border-bottom: none; }
  .db-user-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: 2px solid var(--primary);
      object-fit: cover;
      box-shadow: 0 0 12px rgba(108,71,255,.3);
  }
  .db-user-details { flex: 1; min-width: 0; }
  .db-user-name { font-weight: 600; font-size: 0.92rem; color: #fff; margin-bottom: 2px; }
  .db-user-meta { font-size: 0.8rem; color: #8c8fa3; }

  /* Danger zone widget */
  .danger-zone-box {
      border: 1.5px dashed #ff4d4d;
      background: rgba(255, 77, 77, 0.03);
      border-radius: 14px;
      padding: 20px;
      margin-bottom: 24px;
  }
  .danger-zone-title { color: #ff4d4d; font-weight: 700; margin-bottom: 10px; font-size: 1.1rem; display: flex; align-items: center; gap: 8px; }
  .danger-zone-desc { color: #8c8fa3; font-size: 0.9rem; margin-bottom: 15px; }

  /* Thumbnail list */
  .db-video-row {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 0;
      border-bottom: 1px solid rgba(255,255,255,.03);
  }
  .db-video-row:last-child { border-bottom: none; }
  .db-video-thumb {
      width: 74px;
      aspect-ratio: 16/9;
      object-fit: cover;
      border-radius: 8px;
      background: #11112b;
      border: 1px solid rgba(255,255,255,.08);
  }
  .db-video-info { flex: 1; min-width: 0; }
  .db-video-title { font-weight: 600; font-size: 0.92rem; color: #fff; margin-bottom: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .db-video-meta { font-size: 0.8rem; color: #8c8fa3; display: flex; gap: 12px; }
  .db-video-meta i { color: #6c47ff; }

  /* Progress bar updates */
  .db-progress-wrap { margin-bottom: 18px; }
  .db-progress-info { display: flex; justify-content: space-between; font-size: 0.88rem; font-weight: 600; margin-bottom: 6px; }
  .db-dark-wrapper .progress { background: rgba(255,255,255,.05); border-radius: 6px; height: 8px; box-shadow: none; overflow: hidden; }

  /* Score badges */
  .badge-score {
      background: rgba(46, 213, 115, 0.12);
      color: #2ed573;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 0.82rem;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php
    $video_count = App\Gallery::count();
    $yt_count = App\Gallery::where('video_type', 'youtube')->count();
    $url_count = App\Gallery::where('video_type', 'Url')->count();
    $latest_videos = App\Gallery::orderBy('id', 'desc')->take(5)->get();

    // 📊 1. Popular Quizzes Statistics
    $popular_quizzes = DB::table('tests')
        ->join('topics', 'tests.topic_id', '=', 'topics.id')
        ->select('topics.title', DB::raw('COUNT(tests.id) as attempts'), DB::raw('ROUND(AVG(tests.marks / tests.total_marks * 100), 1) as avg_score'))
        ->groupBy('topics.id', 'topics.title')
        ->orderBy('attempts', 'desc')
        ->take(5)
        ->get();

    // 📈 2. Latest Exam Results
    $latest_results = DB::table('tests')
        ->join('users', 'tests.user_id', '=', 'users.id')
        ->join('topics', 'tests.topic_id', '=', 'topics.id')
        ->select('users.name', 'topics.title', 'tests.marks', 'tests.total_marks', 'tests.created_at')
        ->orderBy('tests.id', 'desc')
        ->take(5)
        ->get();

    // 📉 3. Monthly Exam Completion Trends
    $monthly_stats = DB::table('tests')
        ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('COUNT(*) as count'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

    $trend_labels = [];
    $trend_data = [];
    for ($i = 6; $i >= 0; $i--) {
        $m = date('Y-m', strtotime("-$i month"));
        $trend_labels[] = date('M Y', strtotime("-$i month"));
        $trend_data[] = $monthly_stats[$m] ?? 0;
    }
  ?>

  <div class="db-dark-wrapper">
    
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="db-card-gradient db-card-yellow">
          <div class="db-card-number"><?php echo e($user); ?></div>
          <div class="db-card-text">Total Students</div>
          <div class="db-card-icon"><i class="fa fa-users"></i></div>
          <a href="<?php echo e(url('/admin/users')); ?>" class="db-card-link">Manage Users <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="db-card-gradient db-card-red">
          <div class="db-card-number"><?php echo e($quiz); ?></div>
          <div class="db-card-text">Total Quiz</div>
          <div class="db-card-icon"><i class="fa fa-gears"></i></div>
          <a href="<?php echo e(url('/admin/topics')); ?>" class="db-card-link">Manage Quizzes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="db-card-gradient db-card-green">
          <div class="db-card-number"><?php echo e($question); ?></div>
          <div class="db-card-text">Total Questions</div>
          <div class="db-card-icon"><i class="fa fa-question-circle-o"></i></div>
          <a href="<?php echo e(url('/admin/questions')); ?>" class="db-card-link">Manage Questions <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="db-card-gradient db-card-purple">
          <div class="db-card-number"><?php echo e($video_count); ?></div>
          <div class="db-card-text">Total Videos</div>
          <div class="db-card-icon"><i class="fa fa-film"></i></div>
          <a href="<?php echo e(url('/admin/gallery')); ?>" class="db-card-link">Manage Videos <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    
    <div class="row">
      <div class="col-md-7">
        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-line-chart" style="color:#6c47ff"></i> Monthly Exam Completion Trend</h4>
          </div>
          <div class="box-body">
            <div style="height:250px; width:100%; position:relative;">
              <canvas id="examTrendChart"></canvas>
            </div>
          </div>
        </div>

        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-check-square-o" style="color:#2ed573"></i> Latest Exam Results</h4>
          </div>
          <div class="box-body no-padding">
            <div class="table-responsive">
              <table class="db-table-dark">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Quiz Title</th>
                    <th>Score</th>
                    <th>Date Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($latest_results->count()): ?>
                    <?php $__currentLoopData = $latest_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td style="font-weight:600;"><?php echo e($res->name); ?></td>
                        <td><?php echo e($res->title); ?></td>
                        <td>
                          <span class="badge-score">
                            <?php echo e($res->marks); ?>/<?php echo e($res->total_marks); ?>

                          </span>
                        </td>
                        <td style="font-size:0.82rem;color:#8c8fa3;"><?php echo e(date('d M Y, H:i', strtotime($res->created_at))); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4" class="text-center text-muted" style="padding:20px 0;">No exam results yet.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-film" style="color:#ffc048"></i> Recently Added Videos</h4>
            <div class="box-tools pull-right">
              <a href="<?php echo e(route('gallery.create')); ?>" class="btn btn-primary btn-xs" style="background:#6c47ff;border:none;"><i class="fa fa-plus"></i> Add Video</a>
            </div>
          </div>
          <div class="box-body">
            <?php if($latest_videos->count()): ?>
              <?php $__currentLoopData = $latest_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $thumb = $video->getThumbnailUrl();
                ?>
                <div class="db-video-row">
                  <img src="<?php echo e($thumb); ?>" class="db-video-thumb" alt="">
                  <div class="db-video-info">
                    <div class="db-video-title" title="<?php echo e($video->video_title); ?>"><?php echo e($video->video_title); ?></div>
                    <div class="db-video-meta">
                      <span><i class="fa fa-eye"></i> <?php echo e(number_format($video->total_views)); ?> views</span>
                      <?php if($video->video_duration): ?>
                        <span><i class="fa fa-clock-o"></i> <?php echo e($video->video_duration); ?></span>
                      <?php endif; ?>
                      <span><i class="fa <?php echo e($video->video_type === 'youtube' ? 'fa-youtube-play' : 'fa-link'); ?>"></i> <?php echo e(ucfirst($video->video_type)); ?></span>
                    </div>
                  </div>
                  <a href="<?php echo e(route('gallery.edit', $video->id)); ?>" class="btn btn-default btn-xs" style="background:rgba(255,255,255,0.05);color:#fff;border:1px solid rgba(255,255,255,0.1);"><i class="fa fa-pencil"></i></a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <p class="text-muted text-center" style="padding:20px 0;">No videos added yet.</p>
            <?php endif; ?>
          </div>
        </div>

        
        <div class="danger-zone-box">
          <div class="danger-zone-title">
            <i class="fa fa-warning"></i> Danger Zone
          </div>
          <div class="danger-zone-desc">
            การดำเนินการล้างข้อมูลคะแนนคำตอบจะลบข้อมูลชีตคำตอบของนักเรียนทุกคนออกทันทีกรุณาตรวจสอบความมั่นใจก่อนกดปุ่มดำเนินการ
          </div>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal" style="background:#ff4d4d;border:none;">Delete All Answer Sheets</button>

          <!-- All Delete Modal -->
          <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="background:#0d0d2b; border:1px solid rgba(255,255,255,0.1); color:#fff;">
                <div class="modal-header" style="border-bottom:1px solid rgba(255,255,255,0.05);">
                  <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                  <div class="delete-icon"></div>
                </div>
                <div class="modal-body text-center">
                  <h4 class="modal-heading">Are You Sure?</h4>
                  <p style="color:#8c8fa3;">Do you really want to delete "All these records"? This process cannot be undone.</p>
                </div>
                <div class="modal-footer" style="border-top:1px solid rgba(255,255,255,0.05);">
                  <?php echo Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllAnswersDestroy']); ?>

                      <?php echo Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal', 'style' => 'background:rgba(255,255,255,0.05);color:#fff;border:none;']); ?>

                      <?php echo Form::submit("Yes", ['class' => 'btn btn-danger', 'style' => 'background:#ff4d4d;border:none;']); ?>

                  <?php echo Form::close(); ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-pie-chart" style="color:#1dd1a1"></i> Video Types Distribution</h4>
          </div>
          <div class="box-body">
            <?php
              $yt_percentage = $video_count ? ($yt_count / $video_count) * 100 : 0;
              $url_percentage = $video_count ? ($url_count / $video_count) * 100 : 0;
            ?>
            <div class="db-progress-wrap">
              <div class="db-progress-info">
                <span><i class="fa fa-youtube-play" style="color:#ff4d4d"></i> YouTube videos</span>
                <span><?php echo e($yt_count); ?> (<?php echo e(number_format($yt_percentage, 1)); ?>%)</span>
              </div>
              <div class="progress" style="background:rgba(255,255,255,0.05);height:8px;">
                <div class="progress-bar" style="width: <?php echo e($yt_percentage); ?>%; background:#ff4d4d;"></div>
              </div>
            </div>

            <div class="db-progress-wrap" style="margin-bottom:8px;">
              <div class="db-progress-info">
                <span><i class="fa fa-link" style="color:#1dd1a1"></i> Local URL / Uploads</span>
                <span><?php echo e($url_count); ?> (<?php echo e(number_format($url_percentage, 1)); ?>%)</span>
              </div>
              <div class="progress" style="background:rgba(255,255,255,0.05);height:8px;">
                <div class="progress-bar" style="width: <?php echo e($url_percentage); ?>%; background:#1dd1a1;"></div>
              </div>
            </div>
          </div>
        </div>

        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-trophy" style="color:#ffc048"></i> Popular Quizzes (Top 5)</h4>
          </div>
          <div class="box-body no-padding">
            <div class="table-responsive">
              <table class="db-table-dark">
                <thead>
                  <tr>
                    <th>Quiz Title</th>
                    <th>Attempts</th>
                    <th>Avg Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($popular_quizzes->count()): ?>
                    <?php $__currentLoopData = $popular_quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz_stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td style="font-weight:600;"><?php echo e($quiz_stat->title); ?></td>
                        <td><span class="label label-info" style="background:rgba(108,71,255,0.15);color:#a29bfe;border:1px solid rgba(108,71,255,0.25);font-size:0.8rem;padding:3px 8px;border-radius:10px;"><?php echo e($quiz_stat->attempts); ?> attempts</span></td>
                        <td style="font-weight:700;color:#2ed573;"><?php echo e($quiz_stat->avg_score); ?>%</td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3" class="text-center text-muted" style="padding:20px 0;">No quiz attempts logged.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
        <div class="box">
          <div class="box-header">
            <h4 class="box-title"><i class="fa fa-users" style="color:#ff9f43"></i> Latest Students</h4>
          </div>
          <div class="box-body no-padding">
            <div style="padding:0 20px;">
              <?php if($user_latest): ?>
                <?php $__currentLoopData = $user_latest->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="db-user-item">
                    <img src="<?php echo e(Avatar::create(ucfirst($u->name))->toBase64()); ?>" class="db-user-avatar" alt="">
                    <div class="db-user-details">
                      <div class="db-user-name"><?php echo e(ucfirst($u->name)); ?></div>
                      <div class="db-user-meta"><?php echo e($u->email); ?></div>
                    </div>
                    <span class="label label-default" style="background:rgba(255,255,255,0.04);border:1.5px solid rgba(255,255,255,0.06);color:#8c8fa3;border-radius:10px;padding:3px 8px;font-size:0.75rem;"><?php echo e($u->created_at->diffForHumans()); ?></span>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="box-footer text-center" style="background:rgba(255,255,255,0.01);border-top:1px solid rgba(255,255,255,0.05);padding:14px;">
            <a href="<?php echo e(url('admin/users')); ?>" class="uppercase" style="color:#6c47ff;font-weight:700;text-decoration:none;">View All Students</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var ctx = document.getElementById('examTrendChart').getContext('2d');
  
  var gradient = ctx.createLinearGradient(0, 0, 0, 220);
  gradient.addColorStop(0, 'rgba(108, 71, 255, 0.45)');
  gradient.addColorStop(1, 'rgba(108, 71, 255, 0.02)');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($trend_labels); ?>,
      datasets: [{
        label: 'Exams Completed',
        data: <?php echo json_encode($trend_data); ?>,
        backgroundColor: gradient,
        borderColor: '#6c47ff',
        borderWidth: 3,
        pointBackgroundColor: '#fff',
        pointBorderColor: '#6c47ff',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 7,
        tension: 0.35,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          grid: {
            color: 'rgba(255, 255, 255, 0.05)',
            borderColor: 'rgba(255, 255, 255, 0.1)'
          },
          ticks: {
            color: '#8c8fa3',
            font: {
              family: 'Inter',
              size: 11
            }
          }
        },
        y: {
          grid: {
            color: 'rgba(255, 255, 255, 0.05)',
            borderColor: 'rgba(255, 255, 255, 0.1)'
          },
          ticks: {
            color: '#8c8fa3',
            font: {
              family: 'Inter',
              size: 11
            },
            precision: 0
          },
          min: 0
        }
      }
    }
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
  'sett' => '',
  'delete' => ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>