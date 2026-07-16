<!DOCTYPE html>
<html lang="en">
<?php
    $setting = App\Setting::first();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#6777EF">
    <link href="<?php echo e(asset('logo.png')); ?>" rel="apple-touch-icon">
    <link href="<?php echo e(asset('/manifest.json')); ?>" rel="manifest">
    <link href="<?php echo e(asset('/images/logo/' . $setting->favicon)); ?>" rel="icon" type="image/ico">
    <!--[if IE]>
        <link href="/favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon" >
    <![endif]-->
    <title><?php echo e($setting->welcome_txt); ?> Admin Panel</title>    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet"><!-- Bootstrap-->    
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet"><!-- Font Awesome -->    
    <link href="<?php echo e(asset('css/ionicons.min.css')); ?>" rel="stylesheet"><!-- Ionicons -->
    <!-- Admin Theme style -->
    <link href="<?php echo e(asset('css/AdminLTE.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/skin-black.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/fontawesome-iconpicker.min.css')); ?>" rel="stylesheet">    
    <link href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet"><!-- Select 2 -->    
    <link href="<?php echo e(asset('css/datatables.min.css')); ?>" rel="stylesheet"><!-- DataTable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet"><!-- Google Font -->
    <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <style>
      a:focus, button:focus, input:focus, select:focus, textarea:focus {
        outline: 2px solid #4A90D9;
        outline-offset: 2px;
      }
      .sr-only-focusable:focus {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 10000 !important;
        padding: 10px 15px !important;
        background: #000 !important;
        color: #fff !important;
        text-decoration: none !important;
        font-weight: bold !important;
      }
      .input-group .toggle-password-btn { cursor: pointer; }
      /* Password wrapper overlay style (alternative to input-group) */
      .password-wrapper {
        position: relative;
      }
      .password-wrapper .form-control {
        padding-right: 40px;
      }
      .password-wrapper .toggle-password-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        z-index: 3;
        background: none;
        border: none;
        padding: 0;
        line-height: 1;
      }
      .password-wrapper .toggle-password-btn:hover {
        color: #333;
      }
    </style>
    <?php echo $__env->yieldContent('head'); ?>
</head>

<body class="hold-transition skin-black sidebar-mini">
    <?php if($auth): ?>
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo e(url('/')); ?>" class="logo" title="<?php echo e($setting->welcome_txt); ?>">
                    <span class="logo-lg">
                        <?php if($setting): ?>
                            <img src="<?php echo e(asset('/images/logo/' . $setting->logo)); ?>" class="ad-logo img-responsive"
                                alt="<?php echo e($setting->welcome_txt); ?>">
                        <?php endif; ?>
                    </span>
                </a>                
                <nav class="navbar navbar-static-top" role="navigation">                    
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <a href="<?php echo e(url('/')); ?>" class="btn visit-btn" target="_blank" title="Visit Site">Visit Site
                        <i class="fa fa-arrow-circle-o-right"></i></a>                    
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                            
                            <li class="dropdown">                                
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"><?php echo e($auth->name); ?></span>
                                    <i class="fa fa-user hidden-lg hidden-md hidden-sm"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(url('/admin/profile')); ?>" title="Profile">Profile</a></li>
                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>" title="Logout"
                                            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                            style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(Auth::user()->role == 'S'): ?>
                                            <li>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Delete Account Request
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Account Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo e(route('delete.user.account')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <?php if(Auth::user()->delete_request == '1'): ?>
                                <div class="modal-body">

                                    <div class="alert alert-warning" role="alert">
                                        You have already submitted a delete request.
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="deleteReason">Reason for Account Deletion:</label>
                                        <textarea class="form-control" id="deleteReason" name="deleteReason" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger request">Submit</button>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>
            </div>            
            <aside class="main-sidebar">                
                <section class="sidebar">                    
                    <div class="user-panel">
                        <div style="display: inline-flex;" class="pull-left info">

                            <?php if(Auth::user()->image != '' || Auth::user()->image != null): ?>
                                <img title="<?php echo e($auth->name); ?>" class="img-circle" width="50px" height="50px"
                                    src="<?php echo e(url('images/user/' . Auth::user()->image)); ?>" alt="">
                            <?php else: ?>
                                <img title="<?php echo e($auth->name); ?>" class="img-circle" width="50px" height="50px"
                                    src="<?php echo e(Avatar::create($auth->name)->toBase64()); ?>" alt="">
                            <?php endif; ?>
                            <h4 style="margin:15px;"><?php echo e($auth->name); ?></h4>
                        </div>
                    </div>                    
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Main Sections</li>
                        <?php
                            $dash = '';
                            $users = '';
                            $quiz = '';
                            $questions = '';
                            $all_re = '';
                            $top_re = '';
                            $sett = '';
                            $delete = '';
                            $page_header = '';
                            $pwa = '';
                        ?>
                        <?php if($auth->role == 'A'): ?>                            
                            <li class="<?php echo e($dash); ?>"><a href="<?php echo e(url('/admin')); ?>" title="Dashboard"><i
                                        class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                            <li class="<?php echo e($users); ?>"><a href="<?php echo e(url('/admin/users')); ?>" title="Students"><i
                                        class="fa fa-users"></i> <span>Students</span></a></li>
                            <li class="<?php echo e($quiz); ?>"><a href="<?php echo e(url('admin/topics')); ?>" title="Quiz"><i
                                        class="fa fa-gears"></i> <span>Quiz</span></a></li>
                            <li class="<?php echo e(isset($gallery) ? $gallery : ''); ?>"><a href="<?php echo e(url('admin/gallery')); ?>" title="Video List"><i
                                        class="fa fa-film"></i> <span>Video List</span></a></li>
                            <li class="<?php echo e($questions); ?>"><a href="<?php echo e(url('admin/questions')); ?>"
                                    title="Questions"><i class="fa fa-question-circle-o"></i>
                                    <span>Questions</span></a></li>
                            <li class="<?php echo e($all_re); ?>"><a href="<?php echo e(url('/admin/all_reports')); ?>"
                                    title="Student Report"><i class="fa fa-file-text-o"></i> <span>Student
                                        Report</span></a></li>
                            <li class="<?php echo e($top_re); ?>"><a href="<?php echo e(url('/admin/top_report')); ?>"
                                    title="Top Student Report"><i class="fa fa-user"></i> <span>Top Student
                                        Report</span></a></li>

                            <li class="<?php echo e($delete); ?>"><a href="<?php echo e(url('/admin/user-requests')); ?>"
                                    title="User Delete Requests"><i class="fa fa-user-circle-o"></i> <span>User Delete
                                        Requests</span></a></li>

                            <li class="<?php echo e($sett); ?>"><a href="<?php echo e(url('/admin/settings')); ?>"
                                    title="Settings"><i class="fa fa-gear"></i> <span>Settings</span></a></li>

                            <li class="<?php echo e($pwa); ?>"><a href="<?php echo e(url('/admin/pwa-setting')); ?>"
                                    title="Pwa Setting"><i class="fa fa-cogs"></i> <span>PWA Settings</span></a>
                            </li>

                            <li
                                class="treeview <?php echo e(Nav::isRoute('pages.index')); ?> <?php echo e(Nav::isRoute('pages.add')); ?> <?php echo e(Nav::isRoute('pages.edit')); ?> <?php echo e(Nav::isRoute('faq.index')); ?> <?php echo e(Nav::isRoute('faq.add')); ?> <?php echo e(Nav::isRoute('faq.edit')); ?> <?php echo e(Nav::isRoute('copyright.index')); ?> <?php echo e(Nav::isRoute('set.facebook')); ?> <?php echo e(Nav::isRoute('customstyle')); ?> <?php echo e(Nav::isRoute('mail.getset')); ?> <?php echo e(Nav::isRoute('socialicons.index')); ?>">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>More settings</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li
                                        class="<?php echo e(Nav::isRoute('pages.index')); ?> <?php echo e(Nav::isRoute('pages.add')); ?> <?php echo e(Nav::isRoute('pages.edit')); ?>">
                                        <a href="<?php echo e(route('pages.index')); ?>"><i class="fa fa-circle-o"></i>Pages</a>
                                    </li>

                                    <li
                                        class="<?php echo e(Nav::isRoute('faq.index')); ?> <?php echo e(Nav::isRoute('faq.add')); ?> <?php echo e(Nav::isRoute('faq.edit')); ?>">
                                        <a href="<?php echo e(route('faq.index')); ?>"><i class="fa fa-circle-o"></i>FAQ</a>
                                    </li>
                                    <li class="<?php echo e(Nav::isRoute('copyright.index')); ?>"><a
                                            href="<?php echo e(route('copyright.index')); ?>"><i
                                                class="fa fa-circle-o"></i>Copyright</a>
                                    </li>

                                    <li class="<?php echo e(Nav::isRoute('set.facebook')); ?>"><a
                                            href="<?php echo e(route('set.facebook')); ?>"><i class="fa fa-circle-o"></i>Social
                                            Login Setting</a>
                                    </li>

                                    <li class="<?php echo e(Nav::isRoute('socialicons.index')); ?>"><a
                                            href="<?php echo e(route('socialicons.index')); ?>"><i
                                                class="fa fa-circle-o"></i>Social
                                            Icon</a>
                                    </li>
                                    <li class="<?php echo e(Nav::isRoute('mail.getset')); ?>"><a
                                            href="<?php echo e(route('mail.getset')); ?>"><i class="fa fa-circle-o"></i>Mail
                                            Setting</a>
                                    </li>
                            </li>
                            <li class="<?php echo e(Nav::isRoute('customstyle')); ?>"><a href="<?php echo e(route('customstyle')); ?>"><i
                                        class="fa fa-circle-o"></i>Custom Style Settings</a>
                            </li>

                    </ul>
                    </li>
                    <li class="<?php echo e(Nav::isRoute('admin.payment')); ?>"><a href="<?php echo e(route('admin.payment')); ?> "
                            title="Payment History"><i class="fa fa-money"></i> <span>Payment History</span></a></li>
                <?php elseif($auth->role == 'S'): ?>
                    <li><a href="<?php echo e(url('/admin/my_reports')); ?>" title="My Reports"><i
                                class="fa fa-file-text-o"></i>
                            <span>My Reports</span></a></li>

                    <li><a href="<?php echo e(url('/admin/profile')); ?>" title="My Profile"><i class="fa fa-file-text-o"></i>
                            <span>My Profile</span></a></li>

                    
    <?php endif; ?>
    </ul>
    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php if(Session::has('added')): ?>
            <div class="alert alert-success sessionmodal">
                <?php echo e(session('added')); ?>

            </div>
        <?php elseif(Session::has('updated')): ?>
            <div class="alert alert-info sessionmodal">
                <?php echo e(session('updated')); ?>

            </div>
        <?php elseif(Session::has('deleted')): ?>
            <div class="alert alert-danger sessionmodal">
                <?php echo e(session('deleted')); ?>

            </div>
        <?php endif; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo e($page_header); ?>

                
            </h1>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            <?php echo $__env->yieldContent('content'); ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <?php
            $copyright = \DB::table('copyrighttexts')->first()->name;
        ?>
        <!-- Default to the left -->
        <strong>

            <?php echo e($copyright); ?>


        </strong>
    </footer>
    </div>
    <?php endif; ?>
    <!-- ./wrapper --> 
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script><!-- jQuery -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script><!-- Bootstrap -->    
    <script src="<?php echo e(asset('js/datatables.min.js')); ?>"></script><!-- DataTable -->    
    <script src="<?php echo e(asset('js/select2.full.min.js')); ?>"></script><!-- Select2 -->    
    <script src="<?php echo e(asset('js/adminlte.min.js')); ?>"></script><!-- Admin -->
    <script src="<?php echo e(asset('js/fontawesome-iconpicker.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <?php echo $__env->make('partials.validation-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(function() {
            $(document).ready(function() {
                $('.sessionmodal').addClass("active");
                setTimeout(function() {
                    $('.sessionmodal').removeClass("active");
                }, 4500);
            });

            $('#example1').DataTable({
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csvHtml5',
                    'excelHtml5',
                    'colvis',
                ]
            });

            $('#questions_table').DataTable({
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csvHtml5',
                    'excelHtml5',
                    'colvis',
                ],
                columnDefs: [{
                    targets: [10],
                    visible: false
                }, ]
            });

            $('#search').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': true,
                "sDom": "<'row'><'row'<'col-md-4'B><'col-md-8'f>r>t<'row'>",
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excelHtml5',
                    'csvHtml5',
                    'colvis',
                ]
            });

            $('#topTable').DataTable({
                "order": [
                    [5, "desc"]
                ],
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excelHtml5',
                    'csvHtml5',
                    'colvis',
                ]
            });
            //Initialize Select2 Elements
            $('.select2').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        });
    </script>

    <?php if($setting->right_setting == 1): ?>
        <script type="text/javascript" language="javascript">
            // Right click disable
            $(function() {
                $(this).bind("contextmenu", function(inspect) {
                    inspect.preventDefault();
                });
            });
            // End Right click disable
        </script>
    <?php endif; ?>

    <?php if($setting->element_setting == 1): ?>
        <script type="text/javascript" language="javascript">
            //all controller is disable
            $(function() {
                var isCtrl = false;
                document.onkeyup = function(e) {
                    if (e.which == 17) isCtrl = false;
                }

                document.onkeydown = function(e) {
                    if (e.which == 17) isCtrl = true;
                    if (e.which == 85 && isCtrl == true) {
                        return false;
                    }
                };
                $(document).keydown(function(event) {
                    if (event.keyCode == 123) { // Prevent F12
                        return false;
                    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                        return false;
                    }
                });
            });
            // end all controller is disable
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/layouts/admin.blade.php ENDPATH**/ ?>