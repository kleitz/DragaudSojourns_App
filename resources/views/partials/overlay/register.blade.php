<!-- multistep form -->
<form id="msform" class="hidden">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Personal Details</li>
		<li>Traveler Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset id="reg-fs-one" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Create your account</h2>
		<h4 class="fs-subtitle">Login credentials</h3>
		<input id="reg-new-email" class="register-input" type="text" name="email" placeholder="Email" value="j@j.com"/>
		<span id="reg-new-email-err" class="text-left ds-form-errmsg">Please enter a valid email</span>
		<input id="reg-new-pass" class="register-input" type="password" name="pass" placeholder="Password" value="Quasar88"/>
		<span id="reg-new-pass-err" class="text-left ds-form-errmsg">Password does not meet requirements</span>
		<div id="new-pass-helper" class="helper-modal hidden">
			<p>8 characters or longer.<br/>At least one number and uppercase letter</p>
		</div>
		<input id="reg-pass-confirm" class="register-input" type="password" name="cpass" placeholder="Confirm Password" value="Quasar88"/>
		<span id="reg-pass-confirm-err" class="text-left ds-form-errmsg">Passwords do not match</span>
		<input id="reg-next-acct" type="button" name="next" class="next action-button margin-auto" value="Next" />
	</fieldset>
	<fieldset id="reg-fs-two" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Personal Details</h2>
		<h4 class="fs-subtitle">Tell us about yourself.</h3>
		<input id="reg-new-fullname" class="register-input" type="text" name="fullname" placeholder="Full name" />
		<span id="reg-new-fullname-err" class="text-left ds-form-errmsg">Please enter your full name</span>
    <div class="flex-row-between">
  		<input id="reg-new-phone" class="register-input phone-format" type="text" name="cellphone" style="margin-right: 10px" placeholder="Cell phone" />
  		<input id="reg-new-home" class="register-input phone-format" type="text" name="homephone" placeholder="Home phone" />
    </div>
		<span id="reg-new-phone-err" class="text-left ds-form-errmsg"></span>
    <textarea id="reg-new-street" class="register-input" name="address" placeholder="Street address"></textarea>
		<span id="reg-new-street-err" class="text-left ds-form-errmsg">Please enter your street address</span>
    <input id="reg-new-zip" class="register-input zip-autofeed" type="number" name="zip" placeholder="Zip" maxlength="5" />
		<span class="register-zf zip-autofill"></span>
		<span id="reg-new-zip-err" class="text-left ds-form-errmsg">Please enter a valid zip code</span>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-next-det" type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset id="reg-fs-three" class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Traveler Details</h2>
		<h4 class="fs-subtitle">Who will be traveling with us?</h3>
		<input class="register-input" type="text" name="fname" placeholder="First Name" />
		<input class="register-input" type="text" name="lname" placeholder="Last Name" />
		<input class="register-input" type="text" name="phone" placeholder="Phone" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input id="reg-submit" type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
