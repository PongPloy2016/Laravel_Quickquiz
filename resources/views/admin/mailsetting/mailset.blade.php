<style type="text/css">

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}

</style>
@extends('layouts.admin', [
  'page_header' => 'Mail Settings',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')

<div class="box">
  <div class="box-body">
    <div class="row">
  
  <form action="{{ route('mail.update') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-6">
      <label for="MAIL_FROM_NAME">Sender Name: <small>(ex. John)</small></label>
    <input type="text" name="MAIL_FROM_NAME" value="{{ $env_files['MAIL_FROM_NAME'] }}"  class="form-control">
    <br>
    <label for="MAIL_FROM_ADDRESS">Address Name: <small>(example@exampledomain.com)</small></label>
    <input type="text" name="MAIL_FROM_ADDRESS" value="{{ $env_files['MAIL_FROM_ADDRESS'] }}" class="form-control">
    <br>
    <label for="MAIL_DRIVER">Mail Driver: <small>(ex. sendmail,smtp,mail)</small></label>
    <input type="text" name="MAIL_DRIVER" value="{{ $env_files['MAIL_DRIVER'] }}" class="form-control">
    <br>
    <label for="MAIL_HOST">Mail Host: <small>(ex. smtp.gmail.com)</small></label>
    <input type="text" name="MAIL_HOST" value="{{ $env_files['MAIL_HOST'] }}" class="form-control">
    </div>  

    <div class="col-md-6">
    <label for="MAIL_PORT">Mail PORT: <small>(587,465)</small></label>
    <input type="text" name="MAIL_PORT" value="{{ $env_files['MAIL_PORT'] }}" class="form-control">
    <br>
    <label for="MAIL_USERNAME">Mail Username: <small>(ex. username@exampledomain.com)</small></label>
    <input type="text" name="MAIL_USERNAME" value="{{ $env_files['MAIL_USERNAME'] }}" class="form-control">
    <br>

    <label for="MAIL_PASSWORD">Mail Password:</label>
    <div class="input-group">
      <input type="password" value="{{ $env_files['MAIL_PASSWORD'] }}" name="MAIL_PASSWORD" class="form-control" id="password-field" aria-label="Mail Password">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="MAIL_ENCRYPTION">Mail Encryption: <small>(TLS,SSL)</small></label>
    <input type="text" value="{{ $env_files['MAIL_ENCRYPTION'] }}" name="MAIL_ENCRYPTION" class="form-control">
    <br>  
</div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-md btn-success"><i class="fa fa-save"></i> Save Settings</button>      
    </div>

</form>
</div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  
  // Password toggle handled by shared validation-scripts partial

</script>

@endsection
