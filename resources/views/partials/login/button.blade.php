<div class="login-container">
  <div>
    <span id="login-button" class="login-button flex-abs-center pointer" href="javascript:;">
      <div class="login-icon">
        <img src="/assets/images/icons/enter_arrow.png"/>
      </div>
      <span id="login-button-context">REGISTER/LOGIN</span>
    </span>
  </div>
  <div id="login-modal" class="login-modal modal-ds">
    <div class="flex-row-reverse">
      <span id="login-close" class="modal-ds-close pointer">X</span>
    </div>
    <div class="modal-ds-label">
      <h5>LOG IN</h5>
    </div>
    <div class="modal-ds-content">
      <div class="modal-ds-form" id="public-login-form">
        <div id="login-details-err" class="hidden">
          <input class="ds-form-error login-details-err" readonly type="text" value="Your email or password are incorrect.">
            <img src="/assets/images/icons/hazard_tri.png" class="input-hazard"/>
          </input>
        </div>
        <input id="login-email" name="login-email" type="text" placeholder="Email"></input>
        <span id="login-email-err" class="ds-form-errmsg">Please enter a valid email</span>
        <input id="login-pass" class="" name="login-pass" type="password" placeholder="Password"></input>
        <span id="login-pass-err" class="ds-form-errmsg">Please enter your password</span>
        <a href="javascript:;" id="login-attempt" class="modal-ds-button">Continue</a>
      </div>
      <div class="flex-row-between">
        <a href="javascript:;" id="login-pwreset" class="modal-ds-link">
          FORGOT PASSWORD?
        </a>
        <a href="javascript:;" id="login-register" class="modal-ds-link">
          CREATE AN ACCOUNT
        </a>
      </div>
    </div>
  </div>
</div>
