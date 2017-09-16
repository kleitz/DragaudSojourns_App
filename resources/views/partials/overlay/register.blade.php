<!-- multistep form -->
<form id="msform" class="hidden">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Social Profiles</li>
		<li>Personal Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Create your account</h2>
		<h4 class="fs-subtitle">Login credentials</h3>
		<input class="register-input" type="text" name="email" placeholder="Email" />
		<input class="register-input" type="password" name="pass" placeholder="Password" />
		<input class="register-input" type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button" name="next" class="next action-button margin-auto" value="Next" />
	</fieldset>
	<fieldset class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Personal Details</h2>
		<h4 class="fs-subtitle">Tell us about yourself.</h3>
		<input class="register-input" type="text" name="fullname" placeholder="Twitter" />
    <div class="flex-row-between">
  		<input class="register-input" type="text" name="cellphone" style="margin-right: 10px" placeholder="Cell phone" />
  		<input class="register-input" type="text" name="homephone" placeholder="Home phone" />
    </div>
    <textarea class="register-input" name="address" placeholder="Address"></textarea>
    <input class="register-input" type="text" name="zip" placeholder="Zip" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset class="modal-ds-form">
    <div class="msform-close">
      <span class="modal-ds-close pointer">X</span>
    </div>
		<h4 class="fs-title">Traveler Details</h2>
		<h4 class="fs-subtitle">Who will be traveling with us?</h3>
		<input class="register-input" type="text" name="fname" placeholder="First Name" />
		<input class="register-input" type="text" name="lname" placeholder="Last Name" />
		<input class="register-input" type="text" name="phone" placeholder="Phone" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
