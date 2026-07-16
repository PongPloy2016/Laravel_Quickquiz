@extends('layouts.admin', [
  'page_header' => 'Dashboard',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
<h3>API Setting</h3>
<div class="dashboard-block col-md-8">

  <form action="{{ route('api.update') }}" method="POST" role="form" aria-label="API Settings Form">
    {{ csrf_field() }}

    <label for="STRIPE_KEY">STRIPE KEY:</label>
    <div class="input-group">
      <input type="password" name="STRIPE_KEY" value="{{ $env_files['STRIPE_KEY'] }}" class="form-control" aria-label="Stripe Key">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="STRIPE_SECRET">STRIPE SECRET:</label>
    <div class="input-group">
      <input type="password" name="STRIPE_SECRET" value="{{ $env_files['STRIPE_SECRET'] }}" class="form-control" aria-label="Stripe Secret">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>

    <label for="MAILCHIMP_APIKEY">MAILCHIMP APIKEY:</label>
    <div class="input-group">
      <input type="password" name="MAILCHIMP_APIKEY" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" class="form-control" aria-label="Mailchimp API Key">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="MAILCHIMP_LIST_ID">MAILCHIMP LIST ID:</label>
    <input type="text" name="MAILCHIMP_LIST_ID" value="{{ $env_files['MAILCHIMP_LIST_ID'] }}" class="form-control" aria-label="Mailchimp List ID">
    <br>
    <label for="PAYPAL_CLIENT_ID">PAYPAL CLIENT ID:</label>
    <div class="input-group">
      <input type="password" name="PAYPAL_CLIENT_ID" value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" class="form-control" aria-label="PayPal Client ID">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="PAYPAL_SECRET_ID">PAYPAL SECRET ID:</label>
    <div class="input-group">
      <input type="password" value="{{ $env_files['PAYPAL_SECRET_ID'] }}" name="PAYPAL_SECRET_ID" class="form-control" aria-label="PayPal Secret ID">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="PAYPAL_MODE">PAYPAL MODE:</label>
    <input type="text" value="{{ $env_files['PAYPAL_MODE'] }}" name="PAYPAL_MODE" class="form-control" aria-label="PayPal Mode">
    <br>
    <label for="PAYU_METHOD">PAYU METHOD:</label>
    <input type="text" value="{{ $env_files['PAYU_METHOD'] }}" name="PAYU_METHOD" class="form-control" aria-label="PayU Method">
    <br>
    <label for="PAYU_DEFAULT">PAYU DEFAULT:</label>
    <input type="text" value="{{ $env_files['PAYU_DEFAULT'] }}" name="PAYU_DEFAULT" class="form-control" aria-label="PayU Default">
    <br>
    <label for="PAYU_MERCHANT_KEY">PAYU MERCHANT KEY:</label>
    <div class="input-group">
      <input type="password" value="{{ $env_files['PAYU_MERCHANT_KEY'] }}" name="PAYU_MERCHANT_KEY" class="form-control" aria-label="PayU Merchant Key">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <label for="PAYU_MERCHANT_SALT">PAYU MERCHANT SALT:</label>
    <div class="input-group">
      <input type="password" value="{{ $env_files['PAYU_MERCHANT_SALT'] }}" name="PAYU_MERCHANT_SALT" class="form-control" aria-label="PayU Merchant Salt">
      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle visibility">
        <i class="fa fa-eye" aria-hidden="true"></i>
      </span>
    </div>
    <br>
    <input type="submit" class="btn btn-md btn-success" value="Save Settings">
  </form>

</div>
@endsection
