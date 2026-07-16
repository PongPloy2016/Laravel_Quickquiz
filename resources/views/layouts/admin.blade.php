<!DOCTYPE html>
<html lang="en">
@php
    $setting = App\Setting::first();
@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#6777EF">
    <link href="{{ asset('logo.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('/manifest.json') }}" rel="manifest">
    <link href="{{ asset('/images/logo/' . $setting->favicon) }}" rel="icon" type="image/ico">
    <!--[if IE]>
        <link href="/favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon" >
    <![endif]-->
    <title>{{ $setting->welcome_txt }} Admin Panel</title>    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"><!-- Bootstrap-->    
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"><!-- Font Awesome -->    
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet"><!-- Ionicons -->
    <!-- Admin Theme style -->
    <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skin-black.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"><!-- Select 2 -->    
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet"><!-- DataTable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet"><!-- Google Font -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
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
    @yield('head')
</head>

<body class="hold-transition skin-black sidebar-mini">
    @if ($auth)
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="logo" title="{{ $setting->welcome_txt }}">
                    <span class="logo-lg">
                        @if ($setting)
                            <img src="{{ asset('/images/logo/' . $setting->logo) }}" class="ad-logo img-responsive"
                                alt="{{ $setting->welcome_txt }}">
                        @endif
                    </span>
                </a>                
                <nav class="navbar navbar-static-top" role="navigation">                    
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <a href="{{ url('/') }}" class="btn visit-btn" target="_blank" title="Visit Site">Visit Site
                        <i class="fa fa-arrow-circle-o-right"></i></a>                    
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                            
                            <li class="dropdown">                                
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs">{{ $auth->name }}</span>
                                    <i class="fa fa-user hidden-lg hidden-md hidden-sm"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/admin/profile') }}" title="Profile">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" title="Logout"
                                            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    @auth
                                        @if (Auth::user()->role == 'S')
                                            <li>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Delete Account Request
                                                </button>
                                            </li>
                                        @endif
                                    @endauth
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
                        <form action="{{ route('delete.user.account') }}" method="POST">
                            @csrf

                            @if (Auth::user()->delete_request == '1')
                                <div class="modal-body">

                                    <div class="alert alert-warning" role="alert">
                                        You have already submitted a delete request.
                                    </div>
                                </div>
                            @else
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
                            @endif

                        </form>
                    </div>
                </div>
            </div>            
            <aside class="main-sidebar">                
                <section class="sidebar">                    
                    <div class="user-panel">
                        <div style="display: inline-flex;" class="pull-left info">

                            @if (Auth::user()->image != '' || Auth::user()->image != null)
                                <img title="{{ $auth->name }}" class="img-circle" width="50px" height="50px"
                                    src="{{ url('images/user/' . Auth::user()->image) }}" alt="">
                            @else
                                <img title="{{ $auth->name }}" class="img-circle" width="50px" height="50px"
                                    src="{{ Avatar::create($auth->name)->toBase64() }}" alt="">
                            @endif
                            <h4 style="margin:15px;">{{ $auth->name }}</h4>
                        </div>
                    </div>                    
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Main Sections</li>
                        @php
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
                        @endphp
                        @if ($auth->role == 'A')                            
                            <li class="{{ $dash }}"><a href="{{ url('/admin') }}" title="Dashboard"><i
                                        class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                            <li class="{{ $users }}"><a href="{{ url('/admin/users') }}" title="Students"><i
                                        class="fa fa-users"></i> <span>Students</span></a></li>
                            <li class="{{ $quiz }}"><a href="{{ url('admin/topics') }}" title="Quiz"><i
                                        class="fa fa-gears"></i> <span>Quiz</span></a></li>
                            <li class="{{ isset($gallery) ? $gallery : '' }}"><a href="{{ url('admin/gallery') }}" title="Video List"><i
                                        class="fa fa-film"></i> <span>Video List</span></a></li>
                            <li class="{{ $questions }}"><a href="{{ url('admin/questions') }}"
                                    title="Questions"><i class="fa fa-question-circle-o"></i>
                                    <span>Questions</span></a></li>
                            <li class="{{ $all_re }}"><a href="{{ url('/admin/all_reports') }}"
                                    title="Student Report"><i class="fa fa-file-text-o"></i> <span>Student
                                        Report</span></a></li>
                            <li class="{{ $top_re }}"><a href="{{ url('/admin/top_report') }}"
                                    title="Top Student Report"><i class="fa fa-user"></i> <span>Top Student
                                        Report</span></a></li>

                            <li class="{{ $delete }}"><a href="{{ url('/admin/user-requests') }}"
                                    title="User Delete Requests"><i class="fa fa-user-circle-o"></i> <span>User Delete
                                        Requests</span></a></li>

                            <li class="{{ $sett }}"><a href="{{ url('/admin/settings') }}"
                                    title="Settings"><i class="fa fa-gear"></i> <span>Settings</span></a></li>

                            <li class="{{ $pwa }}"><a href="{{ url('/admin/pwa-setting') }}"
                                    title="Pwa Setting"><i class="fa fa-cogs"></i> <span>PWA Settings</span></a>
                            </li>

                            <li
                                class="treeview {{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }} {{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }} {{ Nav::isRoute('copyright.index') }} {{ Nav::isRoute('set.facebook') }} {{ Nav::isRoute('customstyle') }} {{ Nav::isRoute('mail.getset') }} {{ Nav::isRoute('socialicons.index') }}">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>More settings</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li
                                        class="{{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }}">
                                        <a href="{{ route('pages.index') }}"><i class="fa fa-circle-o"></i>Pages</a>
                                    </li>

                                    <li
                                        class="{{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }}">
                                        <a href="{{ route('faq.index') }}"><i class="fa fa-circle-o"></i>FAQ</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('copyright.index') }}"><a
                                            href="{{ route('copyright.index') }}"><i
                                                class="fa fa-circle-o"></i>Copyright</a>
                                    </li>

                                    <li class="{{ Nav::isRoute('set.facebook') }}"><a
                                            href="{{ route('set.facebook') }}"><i class="fa fa-circle-o"></i>Social
                                            Login Setting</a>
                                    </li>

                                    <li class="{{ Nav::isRoute('socialicons.index') }}"><a
                                            href="{{ route('socialicons.index') }}"><i
                                                class="fa fa-circle-o"></i>Social
                                            Icon</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('mail.getset') }}"><a
                                            href="{{ route('mail.getset') }}"><i class="fa fa-circle-o"></i>Mail
                                            Setting</a>
                                    </li>
                            </li>
                            <li class="{{ Nav::isRoute('customstyle') }}"><a href="{{ route('customstyle') }}"><i
                                        class="fa fa-circle-o"></i>Custom Style Settings</a>
                            </li>

                    </ul>
                    </li>
                    <li class="{{ Nav::isRoute('admin.payment') }}"><a href="{{ route('admin.payment') }} "
                            title="Payment History"><i class="fa fa-money"></i> <span>Payment History</span></a></li>
                @elseif ($auth->role == 'S')
                    <li><a href="{{ url('/admin/my_reports') }}" title="My Reports"><i
                                class="fa fa-file-text-o"></i>
                            <span>My Reports</span></a></li>

                    <li><a href="{{ url('/admin/profile') }}" title="My Profile"><i class="fa fa-file-text-o"></i>
                            <span>My Profile</span></a></li>

                    {{-- <li><a href="{{url('/admin/payment')}}" title="Payment History"><i class="fa fa-money"></i> <span>Payment History</span></a></li> --}}
    @endif
    </ul>
    <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if (Session::has('added'))
            <div class="alert alert-success sessionmodal">
                {{ session('added') }}
            </div>
        @elseif (Session::has('updated'))
            <div class="alert alert-info sessionmodal">
                {{ session('updated') }}
            </div>
        @elseif (Session::has('deleted'))
            <div class="alert alert-danger sessionmodal">
                {{ session('deleted') }}
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_header }}
                {{-- <small>Optional description</small> --}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        @php
            $copyright = \DB::table('copyrighttexts')->first()->name;
        @endphp
        <!-- Default to the left -->
        <strong>

            {{ $copyright }}

        </strong>
    </footer>
    </div>
    @endif
    <!-- ./wrapper --> 
    <script src="{{ asset('js/jquery.min.js') }}"></script><!-- jQuery -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script><!-- Bootstrap -->    
    <script src="{{ asset('js/datatables.min.js') }}"></script><!-- DataTable -->    
    <script src="{{ asset('js/select2.full.min.js') }}"></script><!-- Select2 -->    
    <script src="{{ asset('js/adminlte.min.js') }}"></script><!-- Admin -->
    <script src="{{ asset('js/fontawesome-iconpicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    @include('partials.validation-scripts')
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

    @if ($setting->right_setting == 1)
        <script type="text/javascript" language="javascript">
            // Right click disable
            $(function() {
                $(this).bind("contextmenu", function(inspect) {
                    inspect.preventDefault();
                });
            });
            // End Right click disable
        </script>
    @endif

    @if ($setting->element_setting == 1)
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
    @endif

    @yield('scripts')
</body>

</html>
