<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="description" content="Quiz Application">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('/images/logo/'. $setting->favicon)}}" rel="icon" type="image/ico">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom-style.css')}}" rel="stylesheet">
    <style>
      /* ADA Focus styles */
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
      /* Responsive fixes */
      @media (max-width: 767px) {
        .login-page { padding: 15px; }
        .login-logo { max-width: 200px; margin: 0 auto; }
        .topic-block { margin-bottom: 20px; }
        .quiz-main-block .col-md-4 { width: 100%; }
        .front-footer .col-md-6 { text-align: center; margin-bottom: 10px; }
        .nav-bar .heading { font-size: 16px; }
        .logo-main-block img { max-width: 100%; height: auto; }
        .card-content { padding: 10px; }
        .topic-detail { padding-left: 10px; }
        .navbar-toggle { margin-top: 8px; margin-right: 0; }
      }
      @media (max-width: 480px) {
        .btn-wave, .btn-facebook, .btn-google, .btn-gitlab { font-size: 14px; padding: 8px 12px; }
        h1.main-block-heading { font-size: 24px; }
        .user-register-heading { font-size: 20px; }
      }
      /* Password toggle - overlay icon inside input */
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
    <!--[if IE]>
        <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
    <![endif]-->    
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>{{$setting->welcome_txt}}</title>
    <!-- Styles -->
    @yield('head')

</head>
<body>
    <a href="#main-content" class="sr-only sr-only-focusable" style="position:absolute;top:-40px;left:0;background:#000;color:#fff;padding:8px;z-index:10000;transition:top 0.3s;">Skip to main content</a>
    <div id="app" style="position: relative;">
        @yield('top_bar')
        <main id="main-content" role="main">
        @yield('content')
        </main>
        <br>
        <br>
    </div>
    @php
     $ct = App\copyrighttext::where('id','=',1)->first();
    @endphp
    
   <div class="front-footer">
        <div class="container" >
            <div class="row">
                <div class="col-md-6">
                    {{ $ct->name }}
                </div>
                <div class="col-md-6">
                    @php
                    $si = App\SocialIcons::all();
                    @endphp
                    @foreach($si as $s)
                    @if($s->status==1)
                        <a target="_blank" title="Visit {{ $s->title }}" href="{{ $s->url }}"><img width="32px" src="{{ asset('images/socialicons/'.$s->icon) }}" alt="{{ $s->title }}" title="{{ $s->title }}" style="margin-top:-5px;z-index:9999;"></a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>   
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom-js.js') }}"></script>
    @include('partials.validation-scripts')
    @yield('scripts')
</body>
</html>
