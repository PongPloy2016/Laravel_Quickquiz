
@extends('layouts.admin')

@section('content')

    <div class="box">
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @elseif (session('warning'))
                <h6 class="alert alert-warning">{{ session('warning') }}</h6>
            @endif
            <h4 class="panel-setting-heading">{{ __('PWA Settings') }}</h4>
            <!-- form code start -->
            {{-- <form action="{{ route('pwa.store') }}" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="client-detail-block">
                <div class="card-importnat-note">
                    <div class="col-lg-12 col-md-12">
                        <small class="text-success process-fonts"><i class="flaticon-info me-2"></i>
                            {{ __('Progressive Web App Requirements') }}
                            <ul class="pwa-text-widget">
                                <li><strong>HTTPS {{ __('HTTPS') }}</strong>
                                    {{ __('must required in your domain (for enable contact your host provider for SSL configuration).') }}
                                </li>
                                <li><strong> {{ __('Icons and splash screens') }}</strong>
                                    {{ __('required and to be updated in Icon Settings') }}
                                </li>
                                <li>
                                    {{ __('PWA is lite app, When you open it in Mobile Browser its ask for add app in mobile. Its Not APK. You can not submit to Play Store.') }}
                                </li>
                                <li>
                                    {{ __('Splash Screen works only on Apple Device.') }}
                                </li>
                            </ul>
                        </small>
                    </div>
                </div>

                <div class="row">
                    {!! Form::open(['method' => 'POST', 'route' => ['pwa.store'], 'enctype' => 'multipart/form-data']) !!}
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
                            {!! Form::label('heading', 'APP NAME') !!}
                            {!! Form::text('APP_NAME', old('APP_NAME', $appname), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
                            {!! Form::label('heading', 'APP URL') !!}
                            {!! Form::url('APP_URL', old('APP_URL', $appurl), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'PWA Icon') !!}
                            {!! Form::file('icon_512', ['accept' => 'image/jpeg,image/jpg,image/png,image/webp'], ['onchange' => 'readURL(this)']) !!}
                            <div class="form-control-icon"><i class="flaticon-upload"></i></div>

                            <div class="edit-img-show">
                                <img src="{{ url('/images/icons/icon-144x144.png') }}" id="icon_512"
                                    alt="{{ __('Pwa Icon') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'PWA Splash Screen') !!}
                            {!! Form::file('splash_2048', ['accept' => 'image/jpeg,image/jpg,image/png,image/webp'], ['onchange' => 'readURL(this)']) !!}
                            <div class="form-control-icon"><i class="flaticon-upload"></i></div>

                            <div class="edit-img-show">
                                <img src="{{ url('/images/icons/splash-640x1136.png') }}" id="splash_2048"
                                    alt="{{ __('Pwa Splash Screen') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('PWA_THEME_COLOR', 'Theme Color for Header') !!}
                            {!! Form::input('color', 'PWA_THEME_COLOR', $pwathemecolor, ['class' => 'form-control', 'id' => 'PWA_THEME_COLOR']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            {!! Form::label('PWA_BG_COLOR', 'Background Color') !!}
                            {!! Form::input('color', 'PWA_BG_COLOR', $pwabgcolor, ['class' => 'form-control', 'id' => 'PWA_BG_COLOR']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group{{ $errors->has('verify_status') ? ' has-error' : '' }} switch-main-block">
                            <div class="custom-switch">
                                {!! Form::checkbox('PWA_ENABLE', 1, old('PWA_ENABLE', isset($pwaenable) ? $pwaenable : null), ['id' => 'switch1', 'class' => 'custom-control-input']) !!}
                                <label class="custom-control-label" for="switch1">{{ __('PWA ENABLE') }}</label>
                            </div>
                        </div>
                    </div>              

                    <div class="col-lg-12">
                        {!! Form::submit('Submit', ['class' => 'btn btn-wave']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {                    
                    // Image loaded successfully
                }
                reader.readAsDataURL(input.files[0]);
                
                if (input.files[0].size > 512000) { 
                    alert("The file is too large. Please select a file less than 500KB.");
                    input.value = ""; 
                }
            }
        }
    </script>
@endsection
