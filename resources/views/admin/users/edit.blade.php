@extends('layouts.admin', [
  'page_header' => 'Students',
  'dash' => '',
  'quiz' => '',
  'users' => 'active',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
 <div class="box">
    <div class="box-body">
        <h3>Edit User: {{ $user->name }}
          <a href="{{url()->previous()}}" class="btn btn-gray pull-right" title="Back"><i class="fa fa-arrow-left"></i> Back</a></h3>
      <hr>
      {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'files' => true]) !!}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                <span class="required">*</span>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter your name', 'aria-label' => 'Full Name']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'Email address') !!}
                <span class="required">*</span>
                {!! Form::email('email', null, ['class' => 'form-control email-input', 'placeholder' => 'eg: info@example.com', 'required' => 'required', 'maxlength' => '60', 'aria-label' => 'Email Address']) !!}
                <small class="text-danger">{{ $errors->first('email') }}</small>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Password') !!}
                <span class="required">*</span>
                <div class="input-group">
                  <input type="password" name="password" class="form-control" placeholder="Change Your Password" aria-label="Password">
                  <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </span>
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>
              </div>
              <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                  {!! Form::label('role', 'User Role') !!}
                  <span class="required">*</span>
                  {!! Form::select('role', ['S' => 'Student', 'A'=>'Administrator'], null, ['class' => 'form-control select2', 'required' => 'required', 'aria-label' => 'User Role']) !!}
                  <small class="text-danger">{{ $errors->first('role') }}</small>
              </div>

               <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                <label for="image">Choose Profile Picture:</label>
                <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" aria-label="Profile Picture">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                {!! Form::label('mobile', 'Mobile No.') !!}
                {!! Form::text('mobile', null, ['class' => 'form-control mobile-input', 'placeholder' => 'eg: +911234567890', 'maxlength' => '15', 'pattern' => '[0-9+]{1,15}', 'aria-label' => 'Mobile Number']) !!}
                <small class="text-danger">{{ $errors->first('mobile') }}</small>
              </div>
              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                {!! Form::label('city', 'Enter City') !!}
                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'Enter Your City', 'aria-label' => 'City']) !!}
                <small class="text-danger">{{ $errors->first('city') }}</small>
              </div>

              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                {!! Form::label('address', 'Address') !!}
                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Enter Your Address', 'aria-label' => 'Address']) !!}
                <small class="text-danger">{{ $errors->first('address') }}</small>
              </div>

                @if($user->image !="")
                <img title="Current image" class="img-circle" width="100px" height="100px" src="{{ url('images/user/'.$user->image) }}" alt="User profile picture">
                @else
                  <img title="Current image" class="img-circle" width="100px" height="100px" src="{{ url('images/user/default.png') }}" alt="Default profile picture">
                @endif

            </div>
          </div>

          <div class="btn-group pull-right">
            {!! Form::submit("Update", ['class' => 'btn btn-wave']) !!}
          </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection
