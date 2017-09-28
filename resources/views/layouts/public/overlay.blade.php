<div id="dark-overlay" class="dark-overlay-gen fix-fill flex-abs-center hidden">
  <!-- Loading login credentials -->
  @include('partials.overlay.loader', [
    'id' => 'login-loader',
    'header' => 'Please wait...',
    'msg' => "We're logging you in now."
  ])
  <!-- Password reset modal -->
  <div id="overlay-public-pwreset" class="overlay-rounded-wrapper flex-row-between overlay-near-shadow hidden">
    <div class="overlay-content-wide overlay-pwreset">
      <h3 class="overlay-wide-header">Forgot your password?</h3>
      <p class="overlay-wide-msg">No problem. Confirm your email below and we'll send you a new one</p>
      <div class="modal-ds-form" id="public-pwreset-form">
        <input id="pwreset-email" class="register-input" name="login-email" type="text" placeholder="Email"></input>
        <span id="pwreset-email-err" class="ds-form-errmsg">Please enter a valid email</span>
        <div class="flex-row-center">
          <a href="javascript:;" id="pwreset-confirm" class="overlay-wide-button modal-ds-button">Reset</a>
          <a href="javascript:;" id="pwreset-cancel" class="overlay-wide-button modal-ds-button button-alt">Cancel</a>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Loading password reset -->
@include('partials.overlay.loader', [
  'id' => 'pwreset-loader',
  'header' => 'Please wait...',
  'msg' => "We're resetting your password"
])
<!-- Password successfully reset -->
@include('partials.overlay.success', [
  'id' => 'pwreset-success',
  'header' => 'Password reset',
  'msg' => 'Please check your inbox for the new password',
  'button' => 'Continue'
])
<!-- Login Successful -->
@include('partials.overlay.success', [
  'id' => 'login-success',
  'header' => 'Welcome back!',
  'msg' => 'Click my account to continue to your account page or close this box to continue browsing.',
  'button' => 'Continue'
])
<!-- Create new account -->
@include('partials.overlay.register')

</div>
